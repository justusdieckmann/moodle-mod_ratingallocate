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
 * Contains unit tests for the sdwithopt algorithm.
 *
 * @package    raalgo_sdwithopt
 * @copyright  2019 WWU
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

class raalgo_sdwithopt_reduce_choices_max_size_test extends advanced_testcase {

    public function test_reduce_choice_max_size() {

        $algorithm = new raalgo_sdwithopt\algorithm_impl_testable();
        $user1 = new \raalgo_sdwithopt\user();
        $user1->id = 1;
        $user1->preferencelist = [2000];
        $user1->currentchoice = 1000;

        $user2 = new \raalgo_sdwithopt\user();
        $user2->id = 1;
        $user2->preferencelist = [2000];
        $user2->currentchoice = 1000;
        $users = [
            1 => $user1,
            2 => $user2,
        ];
        $globalranking = [
            1 => 0,
            2 => 1,
        ];
        $choice1 = new \raalgo_sdwithopt\choice();
        $choice1->id = 1000;
        $choice1->minsize = 1;
        $choice1->maxsize = 2;
        $choice1->optional = true;
        $choice1->waitinglist = [0 => 1, 1 => 2];

        $choice2 = new \raalgo_sdwithopt\choice();
        $choice2->id = 2000;
        $choice2->minsize = 1;
        $choice2->maxsize = 2;
        $choice2->optional = false;
        $choice2->waitinglist = [];

        $choices = [
            1000 => $choice1,
            2000 => $choice2,
        ];
        $algorithm->set_global_ranking($globalranking);
        $algorithm->set_users($users);
        $algorithm->set_choices($choices);

        $algorithm->reduce_choices_max_size(1);
        $choices = $algorithm->get_choices();

        $this->assertEquals(1, $choices[1000]->maxsize);
    }

    public function test_reduce_choices_max_size_with_multiple_possibilities() {

        $algorithm = new raalgo_sdwithopt\algorithm_impl_testable();
        $user1 = new \raalgo_sdwithopt\user();
        $user1->id = 1;
        $user1->preferencelist = [1000];
        $user1->currentchoice = 3000;

        $user2 = new \raalgo_sdwithopt\user();
        $user2->id = 2;
        $user2->preferencelist = [1000];
        $user2->currentchoice = 2000;

        $user3 = new \raalgo_sdwithopt\user();
        $user3->id = 3;
        $user3->preferencelist = [3000];
        $user3->currentchoice = 3000;

        $users = [
            1 => $user1,
            2 => $user2,
            3 => $user3,
        ];
        $globalranking = [
            1 => 0,
            2 => 1,
            3 => 2,
        ];
        $choice1 = new \raalgo_sdwithopt\choice();
        $choice1->id = 1000;
        $choice1->minsize = 2;
        $choice1->maxsize = 2;
        $choice1->optional = true;
        $choice1->waitinglist = [];

        $choice2 = new \raalgo_sdwithopt\choice();
        $choice2->id = 2000;
        $choice2->minsize = 0;
        $choice2->maxsize = 1;
        $choice2->optional = true;
        $choice2->waitinglist = [1 => 2];

        $choice3 = new \raalgo_sdwithopt\choice();
        $choice3->id = 3000;
        $choice3->minsize = 1;
        $choice3->maxsize = 2;
        $choice3->optional = true;
        $choice3->waitinglist = [0 => 1, 2 => 3];

        $choices = [
            1000 => $choice1,
            2000 => $choice2,
            3000 => $choice3,
        ];
        $algorithm->set_global_ranking($globalranking);
        $algorithm->set_users($users);
        $algorithm->set_choices($choices);

        $algorithm->calculate_assignment_counts();
        $algorithm->reduce_choices_max_size(2);
        $choices = $algorithm->get_choices();

        $this->assertEquals(2, $choices[1000]->maxsize);
        $this->assertEquals(0, $choices[2000]->maxsize);
        $this->assertEquals(1, $choices[3000]->maxsize);
    }
}