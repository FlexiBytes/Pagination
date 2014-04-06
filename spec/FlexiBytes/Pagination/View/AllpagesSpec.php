<?php

namespace spec\FlexiBytes\Pagination\View;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AllpagesSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FlexiBytes\Pagination\View\Allpages');
    }

    function it_should_have_a_static_factory_method()
    {
        $this::factory()->shouldHaveType('FlexiBytes\Pagination\View\Allpages');
    }

    function it_should_extend_abstract_pagination_view()
    {
        $this::factory()->shouldHaveType('FlexiBytes\Pagination\View\Pagination');
    }

    function it_should_throw_an_exception_if_pagination_class_not_set()
    {
        $this->shouldThrow(new \Exception('Pagination Object not Set'))->duringGetAllPages();
    }

    function it_should_have_a_getFirstPage_method()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('pagination', $pagination)->getFirstPage()->shouldBeArray();
    }

    function it_should_have_a_getFirstPage_method_returning_array()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('url', 'http://www.test.url/?key=value&page=3&key2=value2');

        $expected = array(
            'page' => 1,
            'isCurrentPage' => true,
            'title' => 'Go to first page',
            'url' => 'http://www.test.url/?key=value&page=1&key2=value2'
        );

        $this->set('pagination', $pagination)->getFirstPage()->shouldReturn($expected);
    }

    function it_should_have_a_getPreviousPage_method_returning_array()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(3)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('url', 'http://www.test.url/?key=value&page=3&key2=value2');

        $expected = array(
            'page' => 2,
            'isCurrentPage' => false,
            'title' => 'Go to previous page',
            'url' => 'http://www.test.url/?key=value&page=2&key2=value2'
        );

        $this->set('pagination', $pagination)->getPreviousPage()->shouldReturn($expected);
    }

    function it_should_have_a_getNextPage_method_returning_array()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(3)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('url', 'http://www.test.url/?key=value&page=3&key2=value2');

        $expected = array(
            'page' => 4,
            'isCurrentPage' => false,
            'title' => 'Go to next page',
            'url' => 'http://www.test.url/?key=value&page=4&key2=value2'
        );

        $this->set('pagination', $pagination)->getNextPage()->shouldReturn($expected);
    }

    function it_should_have_a_getLastPage_method_returning_array()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('url', 'http://www.test.url/?key=value&page=3&key2=value2');

        $expected = array(
            'page' => 12,
            'isCurrentPage' => false,
            'title' => 'Go to last page',
            'url' => 'http://www.test.url/?key=value&page=12&key2=value2'
        );

        $this->set('pagination', $pagination)->getLastPage()->shouldReturn($expected);
    }

    function it_should_have_a_getAllPages_method()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('pagination', $pagination)->getAllPages()->shouldBeArray();
    }

    function it_should_set_an_array_with_pages_informations()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(14)
            ->setNumberOfItemsPerPage(10);

        $this->set('url', 'http://www.test.url/?key=value&page=1&key2=value2');

        $expected = array(
            0 => array(
                'page' => 1,
                'isCurrentPage' => true,
                'title' => 'Go to page 1',
                'url' => 'http://www.test.url/?key=value&page=1&key2=value2'
            ),
            1 => array(
                'page' => 2,
                'isCurrentPage' => false,
                'title' => 'Go to page 2',
                'url' => 'http://www.test.url/?key=value&page=2&key2=value2'
            ),
        );

        $this->set('pagination', $pagination)->getAllPages()->shouldReturn($expected);

        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(2)
            ->setNumberOfTotalItems(14)
            ->setNumberOfItemsPerPage(10);

        $expected = array(
            0 => array(
                'page' => 1,
                'isCurrentPage' => false,
                'title' => 'Go to page 1',
                'url' => 'http://www.test.url/?key=value&page=1&key2=value2'
            ),
            1 => array(
                'page' => 2,
                'isCurrentPage' => true,
                'title' => 'Go to page 2',
                'url' => 'http://www.test.url/?key=value&page=2&key2=value2'
            ),
        );

        $this->set('pagination', $pagination)->getAllPages()->shouldReturn($expected);
    }
}
