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
abstract class Pagination
{
    /**
     * Factory method
     *
     * @return object new static
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public static function factory()
    {
        return new static;
    }

    /**
     * Get variables value
     *
     * @param string $variable name of the variable
     *
     * @return mixed value
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public function get($variable)
    {
        return $this->{$variable};
    }

    /**
     * Magic getter, wraps get() method
     *
     * @param string $variable name of the variable
     *
     * @return mixed value
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public function __get($variable)
    {
        return $this->get($variable);
    }

    /**
     * Set a variables value
     *
     * @param string $variable name of the variable
     * @param string $value    value
     *
     * @return object self
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public function set($variable, $value)
    {
        $this->{$variable} = $value;
        return $this;
    }

    /**
     * Magic setter, wraps set() method
     *
     * @param string $variable name of the variable
     * @param string $value    value
     *
     * @return object self
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public function __set($variable, $value)
    {
        return $this->set($variable, $value);
    }

    /**
     * Bind a variables value
     *
     * @param string $variable name of the variable
     * @param string &$value   value
     *
     * @return object \FlexiBytes\View\View self
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public function bind($variable, & $value)
    {
        if (! isset($this->{$variable})) {
            $this->{$variable} = null;
        }

        $this->{$variable} =& $value;
        return $this;
    }

    /**
     * Check if the pagination object is set/bound
     *
     * @return nil
     * @throws \Exception
     *
     * @access	protected
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    protected function checkSettings()
    {
        if (empty($this->pagination) || !is_a($this->pagination, 'FlexiBytes\Pagination\Pagination')) {
            throw new \Exception('Pagination Object not Set');
        }
    }

    /**
     * Prepare the pages information as arrays for
     * the template engine
     *
     * @param integer $start start value
     * @param integer $stop  stop value
     *
     * @return array prepared pages array
     *
     * @access	protected
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    protected function getPagesArray($start, $stop)
    {
        $this->checkSettings();

        $return = array();
        for ($page = $start; $page <= $stop; $page++) {
            $return[] = array(
                'page'          => $page,
                'isCurrentPage' => (bool) ($this->pagination->getCurrentPage() == $page),
                'title'         => strtr(gettext('Go to page :page'), array(':page' => $page)),
                'url'               => $this->prepareURL($page),
            );
        }
        return $return;
    }

    /**
     * Get the information for "Jump to fist page" link
     *
     * @return array prepared first page array
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public function getFirstPage()
    {
        $this->checkSettings();

        // First page
        return array(
            'page'              => 1,
            'isCurrentPage'   => $this->pagination->getCurrentPage() == 1,
            'title'             => gettext('Go to first page'),
            'url'               => $this->prepareURL(1),
        );
    }

    /**
     * Get the information for "Jump to prev page" link
     *
     * @return array prepared prev page array
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public function getPreviousPage()
    {
        $this->checkSettings();

        // First page
        return array(
            'page'              => $this->pagination->getPreviousPage(),
            'isCurrentPage'     => $this->pagination->getCurrentPage() == $this->pagination->getPreviousPage(),
            'title'             => gettext('Go to previous page'),
            'url'               => $this->prepareURL($this->pagination->getPreviousPage()),
        );
    }

    /**
     * Get the information for "Jump to next page" link
     *
     * @return array prepared next page array
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public function getNextPage()
    {
        $this->checkSettings();

        // First page
        return array(
            'page'              => $this->pagination->getNextPage(),
            'isCurrentPage'     => $this->pagination->getCurrentPage() == $this->pagination->getNextPage(),
            'title'             => gettext('Go to next page'),
            'url'               => $this->prepareURL($this->pagination->getNextPage()),
        );
    }

    /**
     * Get the information for "Jump to last page" link
     *
     * @return array prepared last page array
     *
     * @access	public
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    public function getLastPage()
    {
        $this->checkSettings();

        // First page
        return array(
            'page'           => $this->pagination->getNumberOfTotalPages(),
            'isCurrentPage'  => $this->pagination->getCurrentPage() == $this->pagination->getNumberOfTotalPages(),
            'title'          => gettext('Go to last page'),
            'url'            => $this->prepareURL($this->pagination->getNumberOfTotalPages()),
        );
    }

    protected $url;

    /**
     * prepare the url with appropriate page setting
     *
     * @return string URL
     *
     * @access	protected
     *
     * @author Thorsten Schmidt
     * @date 05.04.14
     */
    protected function prepareURL($page)
    {
        $url = parse_url($this->url);

        $query = new \HttpQueryString(false);

        if (! empty($url['query'])) {
            $query->set($url['query']);
        }

        $query->set(array('page' => $page));

        $url['query'] = $query->toString();

        return http_build_url($url);
    }
}
