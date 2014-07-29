<?php

namespace spec\FlexiBytes\Pagination\View;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FragmentedSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FlexiBytes\Pagination\View\Fragmented');
    }

    function it_should_have_a_static_factory_method()
    {
        $this::factory()->shouldHaveType('FlexiBytes\Pagination\View\Fragmented');
    }

    function it_should_extend_abstract_pagination_view()
    {
        $this::factory()->shouldHaveType('FlexiBytes\Pagination\View\Pagination');
    }

    function it_should_throw_an_exception_if_pagination_class_not_set()
    {
        $this->shouldThrow(new \Exception('Pagination Object not Set'))->duringGetLeftPages();
        $this->shouldThrow(new \Exception('Pagination Object not Set'))->duringGetRightPages();
        $this->shouldThrow(new \Exception('Pagination Object not Set'))->duringGetCenterPages();
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

        $this->set('query', 'key=value&page=3&key2=value2');

        $expected = array(
            'text' => 'first',
            'page' => 1,
            'isCurrentPage' => true,
            'title' => 'Go to first page',
            'query' => 'key=value&page=1&key2=value2'
        );

        $this->set('pagination', $pagination)->getFirstPage()->shouldReturn($expected);
    }

    function it_should_have_a_getPreviousPage_method_returning_array()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(3)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('query', 'key=value&page=3&key2=value2');

        $expected = array(
            'text' => 'prev',
            'page' => 2,
            'isCurrentPage' => false,
            'title' => 'Go to previous page',
            'query' => 'key=value&page=2&key2=value2'
        );

        $this->set('pagination', $pagination)->getPreviousPage()->shouldReturn($expected);
    }

    function it_should_have_a_getNextPage_method_returning_array()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(3)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('query', 'key=value&page=3&key2=value2');

        $expected = array(
            'text' => 'next',
            'page' => 4,
            'isCurrentPage' => false,
            'title' => 'Go to next page',
            'query' => 'key=value&page=4&key2=value2'
        );

        $this->set('pagination', $pagination)->getNextPage()->shouldReturn($expected);
    }

    function it_should_have_a_getLastPage_method_returning_array()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('query', 'key=value&page=3&key2=value2');

        $expected = array(
            'text' => 'last',
            'page' => 12,
            'isCurrentPage' => false,
            'title' => 'Go to last page',
            'query' => 'key=value&page=12&key2=value2'
        );

        $this->set('pagination', $pagination)->getLastPage()->shouldReturn($expected);
    }

    function it_should_have_a_getLeftPages_method()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('pagination', $pagination)->getLeftPages()->shouldBeArray();
    }

    function it_should_have_a_hasLeftEllipsis_method()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('pagination', $pagination)->hasLeftEllipsis()->shouldBeBoolean();
    }

    function it_should_have_a_getCenterPages_method()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('pagination', $pagination)->getCenterPages()->shouldBeArray();
    }

    function it_should_have_a_hasRightEllipsis_method()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('pagination', $pagination)->hasRightEllipsis()->shouldBeBoolean();
    }

    function it_should_have_a_getRightPages_method()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10);

        $this->set('pagination', $pagination)->getRightPages()->shouldBeArray();
    }

    function it_should_set_an_array_with_pages_informations()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(1420)
            ->setNumberOfItemsPerPage(10);

        $this->set('query', 'key=value&page=1&key2=value2');
        $this->set('amountOfLeftPages', 2);
        $this->set('amountOfRightPages', 2);

        $expected = array(
            0 => array(
                'page' => 1,
                'isCurrentPage' => true,
                'title' => 'Go to page 1',
                'query' => 'key=value&page=1&key2=value2'
            ),
            1 => array(
                'page' => 2,
                'isCurrentPage' => false,
                'title' => 'Go to page 2',
                'query' => 'key=value&page=2&key2=value2'
            ),
        );

        $this->set('pagination', $pagination)->getLeftPages()->shouldReturn($expected);

        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setCurrentPage(8)
            ->setNumberOfTotalItems(1420)
            ->setNumberOfItemsPerPage(10);

        $expected_left = array(
            0 => array(
                'page' => 1,
                'isCurrentPage' => false,
                'title' => 'Go to page 1',
                'query' => 'key=value&page=1&key2=value2'
            ),
            1 => array(
                'page' => 2,
                'isCurrentPage' => false,
                'title' => 'Go to page 2',
                'query' => 'key=value&page=2&key2=value2'
            ),
        );

        $expected_center = array(
            0 => array(
                'page' => 5,
                'isCurrentPage' => false,
                'title' => 'Go to page 5',
                'query' => 'key=value&page=5&key2=value2'
            ),
            1 => array(
                'page' => 6,
                'isCurrentPage' => false,
                'title' => 'Go to page 6',
                'query' => 'key=value&page=6&key2=value2'
            ),
            2 => array(
                'page' => 7,
                'isCurrentPage' => false,
                'title' => 'Go to page 7',
                'query' => 'key=value&page=7&key2=value2'
            ),
            3 => array(
                'page' => 8,
                'isCurrentPage' => true,
                'title' => 'Go to page 8',
                'query' => 'key=value&page=8&key2=value2'
            ),
            4 => array(
                'page' => 9,
                'isCurrentPage' => false,
                'title' => 'Go to page 9',
                'query' => 'key=value&page=9&key2=value2'
            ),
            5 => array(
                'page' => 10,
                'isCurrentPage' => false,
                'title' => 'Go to page 10',
                'query' => 'key=value&page=10&key2=value2'
            ),
            6 => array(
                'page' => 11,
                'isCurrentPage' => false,
                'title' => 'Go to page 11',
                'query' => 'key=value&page=11&key2=value2'
            ),
        );

        $expected_right = array(
            0 => array(
                'page' => 141,
                'isCurrentPage' => false,
                'title' => 'Go to page 141',
                'query' => 'key=value&page=141&key2=value2'
            ),
            1 => array(
                'page' => 142,
                'isCurrentPage' => false,
                'title' => 'Go to page 142',
                'query' => 'key=value&page=142&key2=value2'
            ),
        );

        $this->set('pagination', $pagination)->getLeftPages()->shouldReturn($expected_left);
        $this->set('pagination', $pagination)->hasLeftEllipsis()->shouldReturn(true);

        $this->set('pagination', $pagination)->getCenterPages()->shouldReturn($expected_center);

        $this->set('pagination', $pagination)->getRightPages()->shouldReturn($expected_right);
        $this->set('pagination', $pagination)->hasRightEllipsis()->shouldReturn(true);
    }

    function it_should_set_a_reversed_array_with_pages_informations()
    {
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setReverseOrder(true)
            ->setCurrentPage(1)
            ->setNumberOfTotalItems(1420)
            ->setNumberOfItemsPerPage(10);

        $this->set('query', 'key=value&page=1&key2=value2');
        $this->set('amountOfLeftPages', 2);
        $this->set('amountOfRightPages', 2);
/*
        $expected = array(
            0 => array(
                'page' => 1,
                'isCurrentPage' => true,
                'title' => 'Go to page 1',
                'query' => 'key=value&page=1&key2=value2'
            ),
            1 => array(
                'page' => 2,
                'isCurrentPage' => false,
                'title' => 'Go to page 2',
                'query' => 'key=value&page=2&key2=value2'
            ),
        );

        $this->set('pagination', $pagination)->getLeftPages()->shouldReturn($expected);
*/
        $pagination = \FlexiBytes\Pagination\Pagination::factory()
            ->setReverseOrder(true)
            ->setCurrentPage(8)
            ->setNumberOfTotalItems(1420)
            ->setNumberOfItemsPerPage(10);

        $expected_right = array(
            0 => array(
                'page' => 1,
                'isCurrentPage' => false,
                'title' => 'Go to page 1',
                'query' => 'key=value&page=1&key2=value2'
            ),
            1 => array(
                'page' => 2,
                'isCurrentPage' => false,
                'title' => 'Go to page 2',
                'query' => 'key=value&page=2&key2=value2'
            ),
        );

        $expected_center = array(
            0 => array(
                'page' => 5,
                'isCurrentPage' => false,
                'title' => 'Go to page 5',
                'query' => 'key=value&page=5&key2=value2'
            ),
            1 => array(
                'page' => 6,
                'isCurrentPage' => false,
                'title' => 'Go to page 6',
                'query' => 'key=value&page=6&key2=value2'
            ),
            2 => array(
                'page' => 7,
                'isCurrentPage' => false,
                'title' => 'Go to page 7',
                'query' => 'key=value&page=7&key2=value2'
            ),
            3 => array(
                'page' => 8,
                'isCurrentPage' => true,
                'title' => 'Go to page 8',
                'query' => 'key=value&page=8&key2=value2'
            ),
            4 => array(
                'page' => 9,
                'isCurrentPage' => false,
                'title' => 'Go to page 9',
                'query' => 'key=value&page=9&key2=value2'
            ),
            5 => array(
                'page' => 10,
                'isCurrentPage' => false,
                'title' => 'Go to page 10',
                'query' => 'key=value&page=10&key2=value2'
            ),
            6 => array(
                'page' => 11,
                'isCurrentPage' => false,
                'title' => 'Go to page 11',
                'query' => 'key=value&page=11&key2=value2'
            ),
        );

        $expected_left = array(
            0 => array(
                'page' => 141,
                'isCurrentPage' => false,
                'title' => 'Go to page 141',
                'query' => 'key=value&page=141&key2=value2'
            ),
            1 => array(
                'page' => 142,
                'isCurrentPage' => false,
                'title' => 'Go to page 142',
                'query' => 'key=value&page=142&key2=value2'
            ),
        );

        $expected_left = array_reverse($expected_left);
        $expected_center = array_reverse($expected_center);
        $expected_right = array_reverse($expected_right);

        $this->set('pagination', $pagination)->getLeftPages()->shouldReturn($expected_left);
        $this->set('pagination', $pagination)->hasLeftEllipsis()->shouldReturn(true);

        $this->set('pagination', $pagination)->getCenterPages()->shouldReturn($expected_center);

        $this->set('pagination', $pagination)->getRightPages()->shouldReturn($expected_right);
        $this->set('pagination', $pagination)->hasRightEllipsis()->shouldReturn(true);
    }
}
