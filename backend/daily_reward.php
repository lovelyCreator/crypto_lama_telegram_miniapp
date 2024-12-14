<?php

function ClaimDailyReward($function) {
    $daily_reward_info = $function->daily_reward();
    $claimable_days = $function->getClaimableDays(); 

    if ($daily_reward_info['last_reward_date'] === NULL) {
        
        updateUserRecord('NOW()', 'last_reward_date');
        updateUserRecord(1, 'current_day'); 
        return "First Claimed - Day 1";
    } else {
        $current_date = new DateTime();
        $last_reward_date = new DateTime($daily_reward_info['last_reward_date']); 
        
        $interval = $last_reward_date->diff($current_date);

        if ($interval->days >= 1) {
            $current_day = $daily_reward_info['current_day'];

            if ($current_day >= $claimable_days) {
              
                updateUserRecord('NOW()', 'last_reward_date');
                updateUserRecord(1, 'current_day'); 
                return "Claimed - Reset to Day 1";
            } else {
                updateUserRecord('NOW()', 'last_reward_date');
                updateUserRecord($current_day + 1, 'current_day'); 
                return "Claimed - Day " . ($current_day + 1);
            }
        } else {
            return "Already Claimed";
        }
    }
}

?>
