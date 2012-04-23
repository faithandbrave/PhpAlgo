<?php

// Copyright Akira Takahashi 2012.
// Use, modification and distribution is subject to the Boost Software License,
// Version 1.0. (See accompanying file LICENSE_1_0.txt or copy at
// http://www.boost.org/LICENSE_1_0.txt)

require_once('algorithm.php');

class Test {
    public static function countIf() {
        $ar = array(1, 2, 3, 4, 5);
        $pred = function ($x) { return $x % 2 == 0; };
        $expected = 2; // even element count

        $result = Algo::countIf($ar, $pred);
        if ($expected !== $result) {
            echo "countIf test 1 failure\n";
        }
    }

    public static function predAll() {
        $ar = array(1, 2, 3, 4, 5);
        $pred = function ($x) { return $x > 0; };
        if (!Algo::predAll($ar, $pred)) {
            echo "predAll test 1 failure\n";
        }

        $ar = array(1, 2, -1, 4, 5);
        if (Algo::predAll($ar, $pred)) {
            echo "predAll test 2 failure\n";
        }
    }

    public static function minElement() {
        $ar = array(
            array('name' => 'Alice', 'age' => 20),
            array('name' => 'Bob',   'age' => 38),
            array('name' => 'Carol', 'age' => 16),
        );

        $result = Algo::minElement($ar, function($x) { return $x['age']; });
        if ($result !== array('name' => 'Carol', 'age' => 16)) {
            echo "minElement test 1 failure\n";
        }
    }

    public static function containIf() {
        $ar = array(2, 4, 5, 6, 8);
        $pred = function ($x) { $x % 2 !== 0; };
        if (!Algo::containIf($ar, $pred)) {
            echo "containIf test 1 failure\n";
        }
    }

    public static function findIf() {
        $ar = array(
            array('name' => 'Alice', 'age' => 20),
            array('name' => 'Bob',   'age' => 38),
            array('name' => 'Carol', 'age' => 16),
        );

        $result = Algo::findIf($ar, function($x) { return $x['age'] > 30; });
        if ($result !== array('name' => 'Bob', 'age' => 38)) {
            echo "findIf test 1 failure\n";
        }

        $result = Algo::findIf($ar, function($x) { return $x['age'] > 50; });
        if (!is_null($result)) {
            echo "findIf test 2 failure\n";
        }
    }

    public static function flatten() {
        $ar = array(1, array(2, 3), array(4, array(5, 6)));
        $expected = array(1, 2, 3, 4, 5, 6);

        $result = Algo::flatten($ar);
        if ($expected !== $result) {
            echo "flatten test 1 failure\n";
        }
    }

    public static function unique_by_compare() {
        $ar = array(
            array('name' => 'Carol', 'action' => 'dash'),
            array('name' => 'Alice', 'action' => 'walk'),
            array('name' => 'Bob', 'action' => 'walk'),
            array('name' => 'Alice', 'action' => 'dash'),
        );

        usort($ar, function($a, $b) { return $a['name'] < $b['name'] ? -1 : 1; });

        $expected = array('Alice', 'Bob', 'Carol');

        $result = Algo::unique_by_compare($ar, function($a, $b) { return $a['name'] === $b['name']; });
        $resultArray = array();
        foreach ($result as $x) {
            $resultArray[] = $x['name'];
        }

        if ($expected !== $result) {
            echo "unique_by_compare test 1 failure\n";
        }
    }
}

Test::countIf();
Test::predAll();
Test::minElement();
Test::containIf();
Test::findIf();
Test::flatten();
Test::unique_by_compare();

