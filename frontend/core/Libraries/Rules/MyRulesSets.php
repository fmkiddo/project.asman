<?php
namespace App\Libraries\Rules;


class MyRuleSets {
    
    public function startwithalpha (string $str = null) : bool {
        return (bool) preg_match('/^([a-zA-Z]).[a-zA-Z\d]*$/', $str);
    }
}