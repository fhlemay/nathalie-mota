<?php

use Timber\Timber;

$current_template = pathinfo(__FILE__, PATHINFO_FILENAME) . '.twig';

$context = Timber::context();


Timber::render($current_template, $context);
