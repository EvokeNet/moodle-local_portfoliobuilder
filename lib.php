<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Library of interface functions and constants.
 *
 * @package     local_portfoliobuilder
 * @copyright   2022 Willian Mano <willianmanoaraujo@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function local_portfoliobuilder_before_standard_html_head() {
    global $PAGE, $CFG;

    if ($PAGE->pagetype == 'local-portfoliobuilder-index') {
        $id = required_param('id', PARAM_INT);
        $u = required_param('u', PARAM_INT);

        $publicurl = new \moodle_url('/local/portfoliobuilder/index.php', ['id' => $id, 'u' => $u]);

        $ogimage = new \moodle_url('/mod/portfoliobuilder/pix/og_image.png');

        $header = '
            <meta name="description"          content="This is my portfolio on evoke site." />
        ';

        $header .= '
            <meta property="og:url"           content="'.$publicurl->out(false).'" />
            <meta property="og:type"          content="website" />
            <meta property="og:title"         content="My portfolio on evoke" />
            <meta property="og:description"   content="This is my portfolio on evoke site." />
            <meta property="og:image"         content="'.$ogimage->out().'" />
        ';

        $header .= '
            <meta name="twitter:card"          content="summary_large_image" />
            <meta name="twitter:title"         content="My portfolio on evoke" />
            <meta name="twitter:description"   content="This is my portfolio on evoke site." />
            <meta name="twitter:image"         content="'.$ogimage->out().'" />
        ';

        return $header;
    }
}
