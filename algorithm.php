<?php

// Copyright Akira Takahashi 2012.
// Use, modification and distribution is subject to the Boost Software License,
// Version 1.0. (See accompanying file LICENSE_1_0.txt or copy at
// http://www.boost.org/LICENSE_1_0.txt)

class Algo {
    // 配列に対し、1引数をとる述語を満たす要素の数を取得する
    public static function countIf($ar, $unaryPred) {
        $count = 0;
        foreach ($ar as $x) {
            if ($unaryPred($x))
                $count++;
        }
        return $count;
    }

    // 引数が述語リストを全て満たすかどうかを判定
    public static function predAll($predList, $arg) {
        foreach ($predList as $pred) {
            if (!$pred($arg))
                return false;
        }
        return true;
    }

    // 最小要素を取得
    public static function minElement($ar, $getKey) {
        $elem = null;
        foreach ($ar as $x) {
            if (empty($elem) || ($getKey($x) < $getKey($elem))) {
                $elem = $x;
            }
        }
        return $elem;
    }

    // 述語を満たす要素があるか判定
    public static function containIf($ar, $unaryPred) {
        foreach ($ar as $x) {
            if ($unaryPred($x)) {
                return true;
            }
        }
        return false;
    }

    // 述語を満たす要素を探す
    public static function findIf($ar, $unaryPred) {
        foreach ($ar as $x) {
            if ($unaryPred($x))
                return $x;
        }
        return null;
    }

    // 配列の配列を平坦化する
    public static function flatten($ar) {
        $result = array();

        array_walk_recursive($ar, function($v) use (&$result){
            $result[] = $v;
        });

        return $result;
    }

    // 比較関数をとるarray_unique
    // 事前条件 : $arがソート済みであること
    public static function unique_by_compare($ar, $equalPred) {
        $last = null;
        $result = array();
        foreach ($ar as $x) {
            if (empty($last) || !$equalPred($last, $x)) {
                $last = $x;
                $result[] = $x;
            }
        }
        return $result;
    }
}

