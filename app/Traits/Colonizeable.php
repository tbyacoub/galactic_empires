<?php
/**
 * Created by PhpStorm.
 * User: anegrete
 * Date: 3/7/2017
 * Time: 3:16 PM
 */

namespace App\Traits;

trait Colonizeable
{
    public static function metalCost(){
        return 5000;
    }

    public static function crystalCost(){
        return 5000;
    }

    public static function energyCost(){
        return 5000;
    }
}