<?php
//app/Helpers/Envato/User.php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
 
class Utilities {
   
  	public static function debug($data,$die=false) {
        echo '<pre style="font-size:11px;">';print_r($data);echo '</pre>';if($die) die();
  	}

   public static function splitFullname($string) {

        $arr = explode(', ', $string);
        $num = count($arr);

        if ($num == 1) {
            return $string;
        }
        elseif ($num == 2) {
          list($first_name, $last_name) = $arr;
        } else {
          list($first_name, $middle_name, $last_name) = $arr;
        }

        return (empty($first_name) || $num > 3) ? false : array(
            'first_name' => $first_name,
            'last_name' => $last_name,
        );

    }

}