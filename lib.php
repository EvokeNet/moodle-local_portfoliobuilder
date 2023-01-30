<?php

/**
 * Library of interface functions and constants.
 *
 * @package     local_portfoliobuilder
 * @copyright   2023 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
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
