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
 * File : badgemanagerlist.php
 * List all badges that can be attributed automatically
 */

// Restrict access

require_once(__DIR__ . '/../../config.php');

$automaticbadgeid = optional_param('automaticbadgeid', 0, PARAM_INT);
$badgeid = optional_param('badgeid', 0, PARAM_INT);

global $OUTPUT, $DB, $PAGE;

$pageurl = new moodle_url('/local/badgeautoassigner/editconditions.php');
$title = get_string('editconditions', 'local_badgeautoassigner');
$PAGE->set_title($title);
$PAGE->set_url($pageurl);
$PAGE->set_pagelayout('standard');
$PAGE->set_heading($title);

$context = context_system::instance();

$PAGE->set_context($context);

require_capability('local/badgeautoassigner:manage', $context);

$PAGE->navbar->add(get_string('editconditions', 'local_badgeautoassigner'), $pageurl);

echo $OUTPUT->header();

echo $OUTPUT->footer();