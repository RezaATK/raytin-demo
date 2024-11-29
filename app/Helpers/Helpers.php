<?php
function getArrayOfTags(string|null $tags): array
{
    $arrayOfTags = [];

    if (!$tags) {
        return $arrayOfTags;
    }

    foreach (json_decode($tags) as $tag) {
        $arrayOfTags[] = $tag->value;
    }
    return $arrayOfTags;
}


function getStringOfTags(string|null $tags, bool $fromDB = false): string
{

    $stringOfTags = "";

    if (!$tags) {
        return $stringOfTags;
    }

    $property = $fromDB ? "name" : "value";

    $char = ',';

    for($i = 0; $i < $count = count($allTags = json_decode($tags)); $i++){
        if($i == ($count - 1)){
            $char = '';
        }
        $stringOfTags .= $allTags[$i]->{$property} . $char;
    }
    return $stringOfTags;
}


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

