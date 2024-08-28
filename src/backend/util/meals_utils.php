<?php 

class MealsUtils {
    public static function mealsArrayToString(array $meals): string {
        $output = "[";
        foreach ($meals as $meal) {
            $output .= strval($meal) . ",";
        }
        $output .= "]";
        return $output;
    }
}