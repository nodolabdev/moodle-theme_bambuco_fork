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

/**
 * Theme courses page settings.
 *
 * @package   theme_dexter
 
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_dexter_courses', new lang_string('coursessettings', 'theme_dexter'));

if ($ADMIN->fulltree) {

    // Header position.
    $options = [
        'top' => new lang_string('coursesheaderposition_top', 'theme_dexter'),
        'content' => new lang_string('coursesheaderposition_content', 'theme_dexter'),
    ];

    $name = 'theme_dexter/coursesheaderposition';
    $title = new lang_string('coursesheaderposition', 'theme_dexter');
    $description = new lang_string('coursesheaderposition_desc', 'theme_dexter');
    $setting = new admin_setting_configselect($name, $title, $description, 'top', $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Header type.
    $options = [
        'default' => new lang_string('coursesheader_default', 'theme_dexter'),
        'none' => new lang_string('coursesheader_none', 'theme_dexter'),
        'basic' => new lang_string('coursesheader_basic', 'theme_dexter'),
        'teacher' => new lang_string('coursesheader_teacher', 'theme_dexter')
    ];

    $name = 'theme_dexter/coursesheader';
    $title = new lang_string('coursesheader', 'theme_dexter');
    $description = new lang_string('coursesheader_desc', 'theme_dexter');
    $setting = new admin_setting_configselect($name, $title, $description, 'default', $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Header layout.
    $options = [
        'course-view-' => new lang_string('courseheaderview_course', 'theme_dexter'),
        'mod-' => new lang_string('courseheaderview_mod', 'theme_dexter'),
        'blocks-' => new lang_string('courseheaderview_block', 'theme_dexter'),
        'my-' => new lang_string('courseheaderview_my', 'theme_dexter'),
        'user-' => new lang_string('courseheaderview_user', 'theme_dexter'),
        'report-' => new lang_string('courseheaderview_report', 'theme_dexter'),
    ];

    $name = 'theme_dexter/courseheaderview';
    $title = new lang_string('courseheaderview', 'theme_dexter');
    $description = new lang_string('courseheaderview_desc', 'theme_dexter');
    $setting = new admin_setting_configmultiselect($name, $title, $description, ['course-view-'], $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Header layout.
    $options = [
        'default' => new lang_string('courseheaderlayout_default', 'theme_dexter'),
        'fullwidth' => new lang_string('courseheaderlayout_fullwidth', 'theme_dexter')
    ];

    $name = 'theme_dexter/courseheaderlayout';
    $title = new lang_string('courseheaderlayout', 'theme_dexter');
    $description = new lang_string('courseheaderlayout_desc', 'theme_dexter');
    $setting = new admin_setting_configselect($name, $title, $description, 'default', $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Use courseheader image.
    $options = [
        'none' => new lang_string('courseheaderimage_none', 'theme_dexter'),
        'overviewonly' => new lang_string('courseheaderimage_overviewonly', 'theme_dexter'),
        'overview' => new lang_string('courseheaderimage_overview', 'theme_dexter'),
        'default' => new lang_string('courseheaderimage_default', 'theme_dexter'),
    ];

    $name = 'theme_dexter/courseheaderimage';
    $title = new lang_string('courseheaderimage', 'theme_dexter');
    $description = new lang_string('courseheaderimage_desc', 'theme_dexter');
    $setting = new admin_setting_configselect($name, $title, $description, 'overview', $options);
    $page->add($setting);

    // Course header image type.
    $options = [
        'default' => new lang_string('courseheaderimagetype_default', 'theme_dexter'),
        'generated' => new lang_string('courseheaderimagetype_generated', 'theme_dexter'),
    ];

    $name = 'theme_dexter/courseheaderimagetype';
    $title = new lang_string('courseheaderimagetype', 'theme_dexter');
    $description = new lang_string('courseheaderimagetype_desc', 'theme_dexter');
    $setting = new admin_setting_configselect($name, $title, $description, 'default', $options);
    $page->add($setting);

    // Background image setting.
    $name = 'theme_dexter/courseheaderimagefile';
    $title = get_string('courseheaderimagefile', 'theme_dexter');
    $description = get_string('courseheaderimagefile_desc', 'theme_dexter');
    $options = ['maxfiles' => 1, 'accepted_types' => ['.png', '.jpg', '.jpeg', '.svg', '.gif']];
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'courseheaderimagefile', 0, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Custom course menu options.
    $name = 'theme_dexter/coursemenu';
    $title = new lang_string('coursemenu', 'theme_dexter');
    $description = new lang_string('coursemenu_desc', 'theme_dexter');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Custom content by category.
    $name = 'theme_dexter/contentbycategory';
    $title = new lang_string('contentbycategory', 'theme_dexter');
    $description = new lang_string('contentbycategory_desc', 'theme_dexter');
    $default = '';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Use field to define course width.
    // Duration field.
    $fields = [0 => ''];

    $sql = "SELECT f.id, f.name
            FROM {customfield_field} f
            INNER JOIN {customfield_category} fc ON fc.id = f.categoryid AND fc.component = 'core_course' AND fc.area = 'course'";
    $customfields = $DB->get_records_sql($sql);

    if (is_array($fields) && count($fields) > 0) {

        foreach ($customfields as $k => $v) {
            $fields[$k] = format_string($v->name, true);
        }
    }

    $name = 'theme_dexter/coursewidthfield';
    $title = new lang_string('coursewidthfield', 'theme_dexter');
    $description = new lang_string('coursewidthfield_desc', 'theme_dexter');
    $setting = new admin_setting_configselect($name, $title, $description, '', $fields);
    $page->add($setting);

}
$settings->add('theme_dexter', $page);
