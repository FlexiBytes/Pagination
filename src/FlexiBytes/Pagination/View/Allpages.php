<?php

/**
 * Pagination Module
 *
 * PHP version 5
 *
 * @category  Pagination
 * @package   FlexiBytes.Pagination
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
class Allpages extends Pagination
{
    /**
     * Get the information for the numerated pages links
     *
     * @return array prepared array
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public function getAllPages()
    {
        $this->checkSettings();

        return $this->getPagesArray(1, $this->pagination->getNumberOfTotalPages());
    }
}
