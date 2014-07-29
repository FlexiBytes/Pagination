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

namespace FlexiBytes\Pagination;

/**
 * Pagination class.
 *
 * @category  Pagination
 * @package   FlexiBytes.Pagination
 * @author    Thorsten Schmidt <t.schmidt@flexibytes.com>
 * @copyright 2014 FlexiBytes
 * @license   MIT License (MIT)
 * @link      http://www.flexibytes.com
 */
class Pagination
{
    /**
     * Factory method
     *
     * @return object Pagination\Pagination
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 04.04.14
     */
    public static function factory()
    {
        return new static;
    }

    protected $number_of_total_items = 0;

    /**
     * Set the numer of total items
     *
     * @param integer $number_of_total_items Number of total items
     *
     * @return object self
     * @access  public
     *
     * @author Thorsten Schmidt
     * @date 04.04.2014
     */
    public function setNumberOfTotalItems($number_of_total_items = 0)
    {
        $this->number_of_total_items = max(0, abs($number_of_total_items));
        return $this;
    }

    protected $number_of_items_per_page = 1;

    /**
     * Set the numer of items per page
     *
     * @param integer $number_of_items_per_page Number of items per page
     *
     * @return object self
     * @access  public
     *
     * @author Thorsten Schmidt
     * @date 04.04.2014
     */
    public function setNumberOfItemsPerPage($number_of_items_per_page = 1)
    {
        $this->number_of_items_per_page = max(1, abs($number_of_items_per_page));
        return $this;
    }

    protected $current_page = 1;

    /**
     * Set the numer of the current page
     *
     * @param integer $current_page Current page
     *
     * @return object self
     * @access  public
     *
     * @author Thorsten Schmidt
     * @date 04.04.2014
     */
    public function setCurrentPage($current_page = 1)
    {
        $this->current_page = max(1, abs($current_page));
        return $this;
    }

    /**
     * Get the numer of the current page
     *
     * @return integer current page
     * @access  public
     *
     * @author Thorsten Schmidt
     * @date 04.04.2014
     */
    public function getCurrentPage()
    {
        return min($this->current_page, $this->getNumberOfTotalPages());
    }

    /**
     * Get the numer of the previous page
     *
     * @return integer previous page
     * @access  public
     *
     * @author Thorsten Schmidt
     * @date 06.04.2014
     */
    public function getPreviousPage()
    {
        return max(1, $this->current_page - 1);
    }

    /**
     * Get the numer of the next page
     *
     * @return integer next page
     * @access  public
     *
     * @author Thorsten Schmidt
     * @date 06.04.2014
     */
    public function getNextPage()
    {
        return min($this->current_page + 1, $this->getNumberOfTotalPages());
    }

    /**
     * Get the number of total pages
     *
     * @return integer number of total pages
     * @access  public
     *
     * @author Thorsten Schmidt
     * @date 04.04.2014
     */
    public function getNumberOfTotalPages()
    {
        return max(1, (int) ceil($this->number_of_total_items / $this->number_of_items_per_page));
    }

    /**
     * Get the limit for DB query
     *
     * @return integer limit
     * @access  public
     *
     * @author Thorsten Schmidt
     * @date 04.04.2014
     */
    public function getLimit()
    {
        return $this->number_of_items_per_page;
    }

    /**
     * Get the offset for DB query
     *
     * @return integer limit
     * @access  public
     *
     * @author Thorsten Schmidt
     * @date 04.04.2014
     */
    public function getOffset()
    {
        return ($this->number_of_items_per_page * $this->current_page) - $this->number_of_items_per_page;
    }
}
