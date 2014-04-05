[![Build Status](https://travis-ci.org/FlexiBytes/Pagination.svg?branch=master)](https://travis-ci.org/FlexiBytes/Pagination)

# Pagination
This module provides a basic pagination

Usage
-----

    $pagination = FlexiBytes\Pagination\Pagination::factory();

    // Set number of total items
    $pagination->setNumberOfTotalItems(5678);

    // Set number of items per page
    $pagination->setNumberOfItemsPerPage(20);

    // Set the current page
    $pagination->current_page(3);

    // Get number of total pages
    $pagination->getNumberOfTotalPages();

    // Get the limit for DB query
    $pagination->getLimit();

    // Get the offset for DB query
    $pagination->getOffset();