<?php

namespace spec\FlexiBytes\Pagination;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PaginationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FlexiBytes\Pagination\Pagination');
    }

    function it_should_have_a_static_factory_method()
    {
        $this::factory()->shouldHaveType('FlexiBytes\Pagination\Pagination');
    }

    function it_should_have_a_set_number_of_total_items_method()
    {
        $this->setNumberOfTotalItems()->shouldHaveType('FlexiBytes\Pagination\Pagination');
    }

    function it_should_have_a_set_number_of_total_items_taking_an_integer()
    {
        $this->setNumberOfTotalItems(23)->shouldHaveType('FlexiBytes\Pagination\Pagination');
    }

    function it_should_have_a_set_number_of_items_per_page_method()
    {
        $this->setNumberOfItemsPerPage()->shouldHaveType('FlexiBytes\Pagination\Pagination');
    }

    function it_should_have_a_set_number_of_items_per_page_method_taking_an_integer()
    {
        $this->setNumberOfItemsPerPage(5)->shouldHaveType('FlexiBytes\Pagination\Pagination');
    }

    function it_should_have_a_set_current_page_method()
    {
        $this->setCurrentPage()->shouldHaveType('FlexiBytes\Pagination\Pagination');
    }

    function it_should_have_a_set_current_page_method_taking_an_integer()
    {
        $this->setCurrentPage(5)->shouldHaveType('FlexiBytes\Pagination\Pagination');
    }

    function it_should_have_a_get_current_page_method()
    {
        $this
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10)
            ->setCurrentPage(5)
            ->getCurrentPage()
            ->shouldReturn(5);
    }

    function it_should_adapt_get_current_page_to_available_pages()
    {
        $this->setCurrentPage(5)->getCurrentPage()->shouldReturn(1);
    }

    function it_should_have_a_get_previous_page_method()
    {
        $this
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10)
            ->setCurrentPage(3)
            ->getPreviousPage()->shouldReturn(2);
    }

    function it_should_have_a_get_next_page_method()
    {
        $this
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10)
            ->setCurrentPage(3)
            ->getNextPage()->shouldReturn(4);
    }

    function it_should_have_a_get_total_number_of_pages_method()
    {
        $this->getNumberOfTotalPages()->shouldBeInteger();
    }

    function it_should_have_a_get_total_number_of_pages_method_and_calculate_the_number_of_pages()
    {
        $this
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10)
            ->getNumberOfTotalPages()->shouldReturn(12);
    }

    function it_should_have_a_get_limit_method()
    {
        $this->getLimit()->shouldBeInteger();
    }

    function it_should_have_a_get_offset_method()
    {
        $this->getOffset()->shouldBeInteger();
    }

    function it_should_calculate_the_offset()
    {
        $this
            ->setNumberOfTotalItems(120)
            ->setNumberOfItemsPerPage(10)
            ->setCurrentPage(5)
            ->getOffset()->shouldReturn(40);
    }
}
