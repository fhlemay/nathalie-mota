<?php

use Timber\Timber;

$current_template = pathinfo(__FILE__, PATHINFO_FILENAME) . '.twig';

// Timber's shenanigans
$context = Timber::context();
Timber::render($current_template, $context);
