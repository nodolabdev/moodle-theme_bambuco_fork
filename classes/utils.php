<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace theme_bambuco;

/**
 * Some util functions.
 *
 * @package    theme_bambuco
 * @copyright  2023 David Herney Bernal - cirano. https://bambuco.co
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class utils {

    /**
     * Wrap text in two spans.
     *
     * @param string $text
     * @return string
     */
    public static function wrap_text(string $text) : string {

        // Only apply to headings that don't already have HTML tags.
        if (strip_tags($text) == $text) {
            $words = explode(' ', $text);

            // Escribir en una variable la primera mitad de las palabras y en otra variable las restantes.
            $firsthalf = implode(' ', array_slice($words, 0, count($words) / 2));
            $secondhalf = implode(' ', array_slice($words, count($words) / 2));

            $text = \html_writer::tag('span', $firsthalf) . ' ' . \html_writer::tag('span', $secondhalf);
        }

        return $text;
    }

    /**
     * Get the course preview image.
     *
     * @param \stdClass $course Course object.
     * @return string Image url.
     */
    public static function get_courseimage($course) : string {
        global $CFG, $OUTPUT, $PAGE;

        $config = get_config('theme_bambuco');

        if (empty($config->courseheaderimage) || $config->courseheaderimage == 'none') {
            return '';
        }

        $courseimage = '';
        if (strpos($config->courseheaderimage, 'overview') !== false) {
            $coursefull = new \core_course_list_element($course);

            foreach ($coursefull->get_course_overviewfiles() as $file) {
                $isimage = $file->is_valid_image();

                if ($isimage) {
                    $url = \moodle_url::make_file_url("$CFG->wwwroot/pluginfile.php",
                            '/' . $file->get_contextid() . '/' . $file->get_component() . '/' .
                            $file->get_filearea() . $file->get_filepath() . $file->get_filename(), !$isimage);

                    $courseimage = $url;
                    break;
                }
            }
        }

        if (empty($courseimage) && $config->courseheaderimage != 'overviewonly') {

            switch ($config->courseheaderimagetype) {
                case 'generated':
                    $courseimage = $OUTPUT->get_generated_image_for_id($course->id);
                break;
                default:
                    $imageurl = $PAGE->theme->setting_file_url('courseheaderimagefile', 'courseheaderimagefile');
                    if (!empty($imageurl)) {
                        $courseimage = $imageurl;
                    } else {
                        $courseimage = (string)(new \moodle_url($CFG->wwwroot . '/theme/bambuco/pix/bannercourse.png'));
                    }
            }
        }

        return $courseimage;
    }

    /**
     * Define if use custom header in the current page.
     *
     * @return bool
     */
    public static function use_custom_header() : bool {
        global $PAGE;

        $config = get_config('theme_bambuco');

        $pagetype = $PAGE->pagetype;

        $enabledviews = explode(',', $config->courseheaderview);

        foreach ($enabledviews as $view) {
            if (strpos($pagetype, $view) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the course footer image.
     *
     * @param \stdClass $course Course object.
     * @return \stdClass Image object: src and name properties.
     */
    public static function get_coursefooterimage($course) : ?object {
        global $DB;

        $config = get_config('theme_bambuco');

        if (empty($config->bannerbycategory) || $course->id == SITEID) {
            return null;
        }

        $category = $DB->get_record('course_categories', ['id' => $course->category]);

        if (!$category) {
            return null;
        }

        $images = explode("\n", $config->bannerbycategory);

        $customcategorybanner = null;
        foreach ($images as $image) {
            $options = explode('|', $image);

            if (count($options) != 2) {
                continue;
            }

            $parentid = $options[0];
            if ($category->id == $parentid || strpos($category->path, "/{$parentid}/") !== false) {
                $customcategorybanner = new \stdClass();
                $customcategorybanner->src = $options[1];
                $customcategorybanner->name = $category->name;
                break;
            }
        }

        return $customcategorybanner;
    }
}
