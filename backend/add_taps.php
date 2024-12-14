<?php

function addtaps($function, $gettaps) {
    $user = $function->userinfo();
    $totaltaps = $user->total_points;
    $lefttaps = $user->left_point;

    if ($totaltaps == $lefttaps) {
        return 0;
    }

    $maxAddableTaps = $totaltaps - $lefttaps;

    $tapsToAdd = min($gettaps, $maxAddableTaps);

    if ($tapsToAdd > 0) {
        $newLeftTaps = $lefttaps + $tapsToAdd;
        $function->plusamounts("left_point", $newLeftTaps);
    }

    return $tapsToAdd; 
}



?>