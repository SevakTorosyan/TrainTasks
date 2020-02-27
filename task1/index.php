<?php
DEFINE("ARRIVAL",1);
DEFINE("DEPARTURE",0);
$input = fopen("input.txt",'r');
$output = fopen("output.txt", 'w');
$flightsCount = fgets($input);
for($i=0; $i<$flightsCount; $i++){
    $currentFlight = fgets($input);
    $unixFlightTime = [];
    $infoAboutFlight = explode(" ", $currentFlight);
    for($j=0;$j<count($infoAboutFlight);$j=$j+2) {
        $date = DateTime::createFromFormat('d.m.Y_H:i:sT',
                                             $infoAboutFlight[$j] . parseToStandartForm($infoAboutFlight[$j+1]),
                                                   new DateTimeZone('UTC'));
        //echo $date->format("d.m.Y_H:i:sT U") . "<br>";
        array_push($unixFlightTime, $date->format("U"));
    }
    fwrite($output,$unixFlightTime[ARRIVAL]-$unixFlightTime[DEPARTURE]."\n");
}
fclose($input);
fclose($output);
echo "<h1>Загляните в файл output.txt</h1>";

function parseToStandartForm($timezone){
    if ($timezone>0){
        return "+".(int)$timezone;
    }
    else
        return (int)$timezone;
}