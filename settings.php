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
 * Initially developped for :
 * Université de Cergy-Pontoise
 * 33, boulevard du Port
 * 95011 Cergy-Pontoise cedex
 * FRANCE
 *
 * Create conditions for automatic assignment of badges and assign them.
 *
 * @package   local_badgeautoassigner
 * @copyright 2017 Laurent Guillet <laurent.guillet@u-cergy.fr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * File : settings.php
 * Settings file
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) { // needs this condition or there is error on login page

    $settings = new admin_settingpage('local_badgeautoassigner',
            get_string('pluginname', 'local_badgeautoassigner'));

    $badgemanagerurl = new moodle_url('/local/badgeautoassigner/badgemanagerlist.php');

    $ADMIN->add('badges', new admin_externalpage('badgemanager',
            get_string('autoassignbadgemanager', 'local_badgeautoassigner'),
            $badgemanagerurl, 'local/badgeautoassigner:manage'));
}