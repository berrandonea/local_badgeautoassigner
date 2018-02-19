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

global $OUTPUT, $DB, $PAGE;

$pageurl = new moodle_url('/local/badgeautoassigner/badgemanagerlist.php');
$title = get_string('badgemanagerlist', 'local_badgeautoassigner');
$PAGE->set_title($title);
$PAGE->set_url($pageurl);
$PAGE->set_pagelayout('standard');
$PAGE->set_heading($title);

$context = context_system::instance();

$PAGE->set_context($context);

require_capability('local/badgeautoassigner:manage', $context);

$PAGE->navbar->add(get_string('badgemanagerlist', 'local_badgeautoassigner'), $pageurl);

echo $OUTPUT->header();

// List all badges with automatic conditions

$listautomaticbadges = $DB->get_records('local_badgesconditions');

$table = new html_table();
$table->head  = array(get_string('badgename', 'local_badgeautoassigner'),
    get_string('edit', 'local_badgeautoassigner'));
$table->colclasses = array('leftalign firstname', 'leftalign lastname');
$table->id = 'automaticbadges';
$table->attributes['class'] = 'admintable generaltable';

$data = array();

foreach ($listautomaticbadges as $automaticbadge) {

    $newautomaticbadge = $DB->get_record('badge', array('id' => $automaticbadge->badgeid));

    $line = array();
    $line[] = $newautomaticbadge->name;

    $editurl = new moodle_url('/local/badgeautoassigner/editconditions.php',
            array('automaticbadgeid' => $newautomaticbadge->id));

    $edittext = "<a href=$editurl>".get_string('edit', 'local_badgeautoassigner')."</a>";

    $line[] = $edittext;

    $data[] = $row = new html_table_row($line);
}

$table->data  = $data;
echo get_string('automaticbadgeslist', 'local_badgeautoassigner');
echo html_writer::table($table);


$listbadges = $DB->get_records('badge');

$tablebadges = new html_table();
$tablebadges->head  = array(get_string('badgename', 'local_badgeautoassigner'),
    get_string('edit', 'local_badgeautoassigner'));
$tablebadges->colclasses = array('leftalign firstname', 'leftalign lastname');
$tablebadges->id = 'automaticbadges';
$tablebadges->attributes['class'] = 'admintable generaltable';

$databadge = array();

foreach ($listbadges as $badge) {

    $newbadge = $DB->get_record('badge', array('id' => $badge->id));

    $line = array();
    $line[] = $newbadge->name;

    $editurl = new moodle_url('/local/badgeautoassigner/editconditions.php',
            array('badgeid' => $newbadge->id));

    $edittext = "<a href=$editurl>".get_string('edit', 'local_badgeautoassigner')."</a>";

    $line[] = $edittext;

    $databadge[] = $row = new html_table_row($line);
}

$tablebadges->data  = $databadge;
echo get_string('badgeslist', 'local_badgeautoassigner');
echo html_writer::table($tablebadges);

// List all badges (including those with automatic conditions ?)

echo $OUTPUT->footer();