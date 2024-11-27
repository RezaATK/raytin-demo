<?php


function isActiveRoute(array $route): bool
{
    for ($i = 0; $i < count($route); $i++) {
        if (request()->route()->getName() == $route[$i]) {
            return true;
        }
    }
    return false;
}


function jalaliToGregorian(string|array $date, string $separator = '-'): string
{
    if(is_string($date)){
        $date = explode($separator, $date);
    }
    if(count($date) != 3){
        throw new \Exception('invalid date format');
    }

    $date = \Hekmatinasser\Verta\Verta::jalaliToGregorian($date[0], $date[1], $date[2]);

    return implode('-', $date);

}

