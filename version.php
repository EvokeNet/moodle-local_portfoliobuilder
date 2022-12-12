<?php

/**
 * Plugin version and other meta-data are defined here.
 *
 * @package     local_portfoliobuilder
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'local_portfoliobuilder';
$plugin->release = '1.0.0';
$plugin->version = 2022092900;
$plugin->requires = 2022041200;
$plugin->maturity = MATURITY_STABLE;
$plugin->dependencies = [
    'mod_portfoliobuilder' => 2022111500
];
