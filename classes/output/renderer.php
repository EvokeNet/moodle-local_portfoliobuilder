<?php

/**
 * Evoke game main renderer
 *
 * @package     local_portfoliobuilder
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */

namespace local_portfoliobuilder\output;

defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;
use renderable;

class renderer extends plugin_renderer_base {
    public function render_index(renderable $page) {
        $data = $page->export_for_template($this);

        return $this->render_from_template("mod_portfoliobuilder/portfolio", $data);
    }
}
