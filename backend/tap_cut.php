<?php
function tapcalc($function, $hittaps) {
    $user = $function->userinfo();
    $totaltaps = $user->total_points;
    $lefttaps = $user->left_point;
    if ($lefttaps <= 0) {
        return "No taps available";
    }

    $claimed_taps = 0;
    $unclaimed_taps = 0;
    if ($hittaps > $lefttaps) {
        $claimed_taps = $lefttaps; 
        $unclaimed_taps = $hittaps - $lefttaps; 
        $lefttaps = 0; 
    } else {
        $claimed_taps = $hittaps;
        $lefttaps -= $hittaps;
    }
    $function->minusamounts("left_point", $claimed_taps);
    return [
        'claimed_taps' => $claimed_taps,
        'unclaimed_taps' => $unclaimed_taps,
        'remaining_taps' => $lefttaps
    ];
}
?>
