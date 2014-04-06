<?php

/**
 * Pagination Module
 *
 * PHP version 5
 *
 * @category  Pagination
 * @package   FlexiBytes.SEPA
 * @author    Thorsten Schmidt <t.schmidt@flexibytes.com>
 * @copyright 2014 FlexiBytes
 * @license   MIT License (MIT)
 * @link      http://www.flexibytes.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace FlexiBytes\Pagination\View;

/**
 * Allpages class.
 *
 * @category  Pagination
 * @package   FlexiBytes.Pagination
 * @author    Thorsten Schmidt <t.schmidt@flexibytes.com>
 * @copyright 2014 FlexiBytes
 * @license   MIT License (MIT)
 * @link      http://www.flexibytes.com
 */
class Fragmented extends Pagination
{
    protected $amountOfLeftPages = 0;
    protected $amountOfRightPages = 0;
    protected $amountOfCenterPages = 3;

    /**
     * Get the information for the numerated pages links
     * that are always shown left of the fragmented center
     *
     * @return array prepared array
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 06.04.14
     */
    public function getLeftPages()
    {
        $this->checkSettings();
        return $this->getPagesArray(1, $this->amountOfLeftPages);
    }

    /**
     * Do we need to display left ellipsis?
     *
     * @return bool
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 06.04.14
     * @version 1.0
     * @since 1.0
     */
    public function hasLeftEllipsis()
    {
        $this->checkSettings();
        return (bool) ( // Current page > left section
                ($this->pagination->getCurrentPage() > ($this->amountOfLeftPages + $this->amountOfCenterPages + 1)) and
                // And there is more to come on right hand side
                $this->pagination->getNumberOfTotalPages() > ($this->amountOfLeftPages + 2*$this->amountOfCenterPages + 1 + $this->amountOfRightPages));
    }

    /**
     * Returns the middle page numbers
     *
     * @return array prepared array
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 04.06.2012
     * @version 1.0
     * @since 1.0
     */
    public function getCenterPages()
    {
        $this->checkSettings();
        $return = array();

        $start = $this->pagination->getCurrentPage() - $this->amountOfCenterPages;
        $stop  = $this->pagination->getCurrentPage() + $this->amountOfCenterPages;

        // Correct the startstop values if we move to the left/right edges
        if ($start <= $this->amountOfLeftPages) {
            $start = $this->amountOfLeftPages + 1;
            $stop  = $start + 2*$this->amountOfCenterPages;
        }

        if ($stop >= $this->pagination->getNumberOfTotalPages() - $this->amountOfRightPages) {
            $stop  = $this->pagination->getNumberOfTotalPages() - $this->amountOfRightPages;
            $start = $stop - 2*$this->amountOfCenterPages;
        }

        // Actually not enough pages for fragmentated display?
        if ($start > $this->pagination->getNumberOfTotalPages() or $start < 1) {
            $start = 1;
        }

        if ($stop > $this->pagination->getNumberOfTotalPages() or $stop < 1) {
            $stop = 1;
        }

        // Page numbers
        return $this->getPagesArray($start, $stop);
    }

    /**
     * Do we need to display right ellipsis?
     *
     * @return bool
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 06.04.14
     * @version 1.0
     * @since 1.0
     */
    public function hasRightEllipsis()
    {
        $this->checkSettings();
        return (// We can still scroll right?
                ($this->pagination->getCurrentPage() + $this->amountOfCenterPages < ($this->pagination->getNumberOfTotalPages() - $this->amountOfRightPages)) and
                // And there is more to come on right hand side
                $this->pagination->getNumberOfTotalPages() > ($this->amountOfLeftPages + 2*$this->amountOfCenterPages + 1 + $this->amountOfRightPages)
        );
    }

    /**
     * Returns the last page numbers
     *
     * @return array prepared array
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 04.06.2012
     * @version 1.0
     * @since 1.0
     */
    public function getRightPages()
    {
        $this->checkSettings();
        return $this->getPagesArray($this->pagination->getNumberOfTotalPages() - $this->amountOfRightPages + 1, $this->pagination->getNumberOfTotalPages());
    }
}
