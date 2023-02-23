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
 * Theme config.
 *
 * @package    theme_bambuco
 * @copyright  2023 David Herney Bernal - cirano. https://bambuco.co
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$THEME->name = 'bambuco';
$THEME->sheets = [];
$THEME->editor_sheets = [];
$THEME->editor_scss = ['editor'];
$THEME->usefallback = false;
$THEME->scss = function($theme) {
    return theme_bambuco_get_main_scss_content($theme);
};

$THEME->layouts = [
    // Main course page.
    'course' => array(
        'file' => 'drawers.php',
        'regions' => ['above', 'top', 'content', 'side-pre', 'bottom'],
        'defaultregion' => 'side-pre',
        'options' => array('langmenu' => true),
    ),
    // Part of course, typical for modules - default page layout if $cm specified in require_login().
    'incourse' => array(
        'file' => 'drawers.php',
        'regions' => ['above', 'top', 'content', 'side-pre', 'bottom'],
        'defaultregion' => 'side-pre',
    ),
    // The site home page.
    'frontpage' => [
        'file' => 'frontpage.php',
        'regions' => ['above', 'top', 'content', 'side-pre', 'bottom'],
        'defaultregion' => 'side-pre',
        'options' => ['nonavbar' => true],
    ],
];

$THEME->parents = ['boost'];
$THEME->enable_dock = false;
$THEME->extrascsscallback = 'theme_bambuco_get_extra_scss';
$THEME->prescsscallback = 'theme_bambuco_get_pre_scss';
$THEME->precompiledcsscallback = 'theme_bambuco_get_precompiled_css';
$THEME->yuicssmodules = [];
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->requiredblocks = '';
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->iconsystem = \core\output\icon_system::FONTAWESOME;
$THEME->haseditswitch = true;
$THEME->usescourseindex = true;
// By default, all boost theme do not need their titles displayed.
$THEME->activityheaderconfig = [
    'notitle' => true
];
