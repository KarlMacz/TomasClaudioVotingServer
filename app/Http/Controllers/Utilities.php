<?php

namespace App\Http\Controllers;

trait Utilities
{
    public function ordinal($number) {
        $suffixes = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
        
        if($number % 100 >= 11 && $number % 100 <= 13) {
            return $number . 'th';
        } else {
            return $number . $suffixes[$number % 10];
        }
    }
}
