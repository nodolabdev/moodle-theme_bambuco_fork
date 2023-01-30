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
 * Theme global settings.
 *
 * @package   theme_bambuco
 * @copyright 2023 David Herney Bernal - cirano. https://bambuco.co
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Advanced settings.
$page = new admin_settingpage('theme_bambuco_advanced', get_string('advancedsettings', 'theme_bambuco'));

if ($ADMIN->fulltree) {

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_bambuco/scsspre',
        get_string('rawscsspre', 'theme_bambuco'), get_string('rawscsspre_desc', 'theme_bambuco'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_bambuco/scss', get_string('rawscss', 'theme_bambuco'),
        get_string('rawscss_desc', 'theme_bambuco'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
}

$settings->add('theme_bambuco', $page);
