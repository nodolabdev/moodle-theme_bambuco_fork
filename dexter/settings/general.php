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
 * @package   theme_dexter
 
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_dexter_general', get_string('generalsettings', 'theme_dexter'));

if ($ADMIN->fulltree) {

    // Unaddable blocks.
    // Blocks to be excluded when this theme is enabled in the "Add a block" list: Administration, Navigation, Courses and
    // Section links.
    $default = 'navigation,settings,course_list,section_links';
    $setting = new admin_setting_configtext('theme_dexter/unaddableblocks',
        get_string('unaddableblocks', 'theme_dexter'), get_string('unaddableblocks_desc', 'theme_dexter'), $default, PARAM_TEXT);
    $page->add($setting);

    // Preset.
    $name = 'theme_dexter/preset';
    $title = get_string('preset', 'theme_dexter');
    $description = get_string('preset_desc', 'theme_dexter');
    $default = 'default.scss';

    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_dexter', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configthemepreset($name, $title, $description, $default, $choices, 'dexter');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_dexter/presetfiles';
    $title = get_string('presetfiles','theme_dexter');
    $description = get_string('presetfiles_desc', 'theme_dexter');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Background image setting.
    $name = 'theme_dexter/backgroundimage';
    $title = get_string('backgroundimage', 'theme_dexter');
    $description = get_string('backgroundimage_desc', 'theme_dexter');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'backgroundimage');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_dexter/brandcolor';
    $title = get_string('brandcolor', 'theme_dexter');
    $description = get_string('brandcolor_desc', 'theme_dexter');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $lblhandwriting = get_string('fontfamily_handwriting', 'theme_dexter');
    $lblicons = get_string('fontfamily_icons', 'theme_dexter');

    // Google fonts available.
    $fonts = [
        'Agbalumo' => 'Agbalumo',
        'Caveat' => 'Caveat' . $lblhandwriting,
        'Dancing Script' => 'Dancing Script' . $lblhandwriting,
        'Dosis' => 'Dosis',
        'Droid Sans' => 'Droid Sans',
        'Edu TAS Begginer' => 'Edu TAS Begginer' . $lblhandwriting,
        'Exo 2' => 'Exo 2',
        'Great Vibes' => 'Great Vibes' . $lblhandwriting,
        'Griffy' => 'Griffy',
        'Inconsolata' => 'Inconsolata',
        'Indie Flower' => 'Indie Flower' . $lblhandwriting,
        'Josefin Sans' => 'Josefin Sans',
        'Kenia' => 'Kenia',
        'Lato' => 'Lato',
        'Lobster' => 'Lobster',
        'Montserrat' => 'Montserrat',
        'Noto Sans Symbols 2' => 'Noto Sans Symbols 2' . $lblicons,
        'Nunito' => 'Nunito',
        'Open Sans' => 'Open Sans',
        'Oswald' => 'Oswald',
        'Pacifico' => 'Pacifico' . $lblhandwriting,
        'Playfair Display' => 'Playfair Display',
        'Playpen Sans' => 'Playpen Sans' . $lblhandwriting,
        'Poppins' => 'Poppins',
        'Raleway' => 'Raleway',
        'Roboto' => 'Roboto',
        'Roboto Condensed' => 'Roboto Condensed',
        'Roboto Mono' => 'Roboto Mono',
        'Rubik' => 'Rubik',
        'Ruge Boogie' => 'Ruge Boogie' . $lblhandwriting,
        'Sacramento' => 'Sacramento' . $lblhandwriting,
        'Sora' => 'Sora',
        'Source Sans Pro' => 'Source Sans Pro',
        'Space Grotesk' => 'Space Grotesk',
        'Splash' => 'Splash' . $lblhandwriting,
        'Tangerine' => 'Tangerine' . $lblhandwriting,
        'Ubuntu' => 'Ubuntu',
        'Zeyada' => 'Zeyada' . $lblhandwriting,
    ];

    // Font family to apply to the site.
    $name = 'theme_dexter/fontfamily';
    $title = get_string('fontfamily', 'theme_dexter');
    $description = get_string('fontfamily_desc', 'theme_dexter');
    $setting = new admin_setting_configselect($name, $title, $description, '', [''] + $fonts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Other fonts to include.
    $name = 'theme_dexter/otherfontfamily';
    $title = get_string('otherfontfamily', 'theme_dexter');
    $description = get_string('otherfontfamily_desc', 'theme_dexter');
    $setting = new admin_setting_configmultiselect($name, $title, $description, [], $fonts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

}
$settings->add('theme_dexter', $page);
