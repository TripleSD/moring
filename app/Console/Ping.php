<?php


namespace App\Console;


class Ping
{
    protected const OS = PHP_OS;

    public static function pingTarget(string $host): array
    {
        if (self::OS !== 'WINNT') {
            exec("ping -c 3 $host", $output, $return_var);
        } else {
            exec("ping -n 3 $host", $output, $return_var);
        }

        if (count($output) > 3) {
            $filter =[];
            $pre_final = array_reduce($output, function ($filter, $string){
                preg_match("/[\d | \d.\d]{1,9}(?=ms| ms)/", $string, $matches);
                if (!empty($matches) && count($filter) < 3) {
                    $filter[] = floatval($matches[0]);
                }
                return $filter;
            }, $filter);
        } else {
            for ($i = 0; $i < 2; ++$i) {
                $pre_final[$i] = null;
            }
        }

        $keys = ['first', 'second', 'third'];
        array_map(function ($key, $value) use (&$final){
            $final[$key] = $value;
        }, $keys, $pre_final);

        return $final;
    }
}