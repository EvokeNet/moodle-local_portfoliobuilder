<?php

namespace local_portfoliobuilder\output;

defined('MOODLE_INTERNAL') || die();

use renderable;
use templatable;
use renderer_base;
use mod_portfoliobuilder\util\user;
use mod_portfoliobuilder\util\entry;

/**
 * Index renderable class.
 *
 * @package     local_portfoliobuilder
 * @copyright   2023 World Bank Group <https://worldbank.org>
 * @author      Willian Mano <willianmanoaraujo@gmail.com>
 */
class index implements renderable, templatable {
    protected $course;
    protected $user;

    public function __construct($course, $user) {
        $this->course = $course;
        $this->user = $user;
    }

    public function export_for_template(renderer_base $output) {
        global $USER;

        $isloggedin = isloggedin();

        $userutil = new user();
        $data = [
            'userfullname' => fullname($this->user),
            'userimage' => $userutil->get_user_image_or_avatar($this->user),
            'courseid' => $this->course->id,
            'isloggedin' => $isloggedin
        ];

        $userdata = [];
        if ($isloggedin) {
            $userdata = [
                'id' => $USER->id,
                'fullname' => fullname($USER),
                'picture' => $userutil->get_user_image_or_avatar($USER)
            ];
        }

        $entryutil = new entry();
        $entries = $entryutil->get_user_course_entries($this->course->id, $this->user->id);

        $data['hasentries'] = !empty($entries);

        $layoututil = new \mod_portfoliobuilder\util\layout();
        $layout = $layoututil->get_user_layout($this->course->id, $this->user->id);

        $data['entries'] = $output->render_from_template("mod_portfoliobuilder/layouts/{$layout}/entries",
            ['entries' => $entries, 'user' => $userdata, 'courseid' => $this->course->id, 'isloggedin' => $isloggedin]);

        return $data;
    }
}
