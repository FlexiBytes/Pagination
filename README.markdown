[![Build Status](https://travis-ci.org/FlexiBytes/Pagination.svg?branch=master)](https://travis-ci.org/FlexiBytes/Pagination)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/FlexiBytes/Pagination/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/FlexiBytes/Pagination/?branch=master)

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
    $pagination->setCurrentPage(3);

    // Get number of total pages
    $pagination->getNumberOfTotalPages();

    // Get the limit for DB query
    $pagination->getLimit();

    // Get the offset for DB query
    $pagination->getOffset();

Create a View
-----
The included views and templates are supposed to be used with mustache.php

    // Create the view, bin the pagination class to it
    $view = new \FlexiBytes\Pagination\View\Fragmented;
    $view->bind('pagination', $pagination);

    // Render the template
    $m = new \Mustache_Engine;
    $template = './src/FlexiBytes/Pagination/Templates/Fragmented.mustache';
    echo $m->render(file_get_contents($template), $view);
