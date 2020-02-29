<?php
    $input = fopen("input.txt","r");
    $output = fopen("output.txt", 'w');

    $format = 'd.m.Y';

    $currentDate = fgets($input);
    $currentDate = preg_replace("/\s+/", "", $currentDate); //избавляемся от пробелов
    $date = DateTime::createFromFormat($format,$currentDate);
    $currentDateUnix = $date->format('U'); //перевод в UNIX время
    while (!feof($input)){
        $newString = fgets($input);
        $infoAboutCourse = explode(" ",$newString);
        foreach ($infoAboutCourse as $k=>$v){
            $infoAboutCourse[$k] = preg_replace("/\s+/", "", $v); //избавляемся от пробелов
        }
        $startDate = DateTime::createFromFormat($format,$infoAboutCourse[1]);
        $finishDate = DateTime::createFromFormat($format,$infoAboutCourse[2]);
        $startDateUnix = $startDate->format('U'); //перевод в UNIX время
        $finishDateUnix = $finishDate->format("U");
        if (($currentDateUnix>=$startDateUnix)&&($currentDateUnix<=$finishDateUnix)){
            fwrite($output,$infoAboutCourse[0]."\n");
        }
    }
    echo '<h1>Загляните в output.txt</h1>';

    fclose($input);
    fclose($output);