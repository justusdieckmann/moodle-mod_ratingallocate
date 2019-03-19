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
 *
 * Contains the algorithm for the distribution
 *
 * @package    raalgo_sdwithopt
 * @copyright  2019 Wwu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace raalgo_sdwithopt;
defined('MOODLE_INTERNAL') || die();

class algorithm_impl_testable extends algorithm_impl {

    public function prepare_execution() {
        parent::prepare_execution();
    }

    public function get_global_ranking() {
        return $this->globalranking;
    }

    public function get_users() {
        return $this->users;
    }

    public function get_choices() {
        return $this->choices;
    }

    public function set_global_ranking($globalranking) {
        $this->globalranking = $globalranking;
    }

    public function set_users($users) {
        $this->users = $users;
    }

    public function set_choices($choices) {
        $this->choices = $choices;
    }

    public function application_by_students() {
        parent::application_by_students();
    }

    public function rejection_by_choices() {
        return parent::rejection_by_choices();
    }

    public function run_deferred_acceptance() {
        parent::run_deferred_acceptance();
    }

    public function close_optional_choice() {
        return parent::close_optional_choice();
    }

    public function calculate_assignment_counts() {
        parent::calculate_assignment_counts();
    }

    public function reduce_choices_max_size($sumcountmissingplaces) {
        return parent::reduce_choices_max_size($sumcountmissingplaces);
    }

    public function extract_allocation() {
        return parent::extract_allocation();
    }
}
