<?php

namespace local_portfoliobuilder\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;
use mod_portfoliogroup\util\user;
use mod_portfoliogroup\util\entry;
use mod_portfoliogroup\util\group as grouputil;
use mod_portfoliogroup\util\layout;

/**
 * Marketplace renderable class.
 *
 * @copyright   2022 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class group implements renderable, templatable {
    protected $context;
    protected $course;
    protected $group;

    public function __construct($context, $course, $group) {
        $this->context = $context;
        $this->course = $course;
        $this->group = $group;
    }

    public function export_for_template(renderer_base $output) {
        global $USER;

        $isloggedin = isloggedin();

        $groupsutil = new grouputil();

        $groupsmembers = $groupsutil->get_groups_members([$this->group], true, $this->context);

        $data = [
            'groupid' => $this->group->id,
            'groupname' => $this->group->name,
            'groupsmembers' => $groupsmembers,
            'courseid' => $this->course->id,
            'isloggedin' => $isloggedin,
            'contextid' => $this->context->id
        ];

        $userdata = [];
        if ($isloggedin) {
            $userutil = new user();
            $userdata = [
                'id' => $USER->id,
                'fullname' => fullname($USER),
                'picture' => $userutil->get_user_image_or_avatar($USER)
            ];
        }

        $entryutil = new entry();
        $entries = $entryutil->get_group_course_entries($this->course->id, $this->group->id);

        $data['hasentries'] = !empty($entries);

        $layoututil = new layout();
        $layout = $layoututil->get_group_layout($this->course->id, $this->group->id, 'timeline');

        $data['entries'] = $output->render_from_template("mod_portfoliogroup/layouts/{$layout}/entries",
            ['entries' => $entries, 'user' => $userdata, 'courseid' => $this->course->id, 'isloggedin' => $isloggedin]);

        return $data;
    }
}
