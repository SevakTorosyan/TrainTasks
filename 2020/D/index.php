<?php
/**
 * Created by PhpStorm.
 * User: sevak
 * Date: 2020-02-29
 * Time: 14:57
 */
$input = fopen("input.txt", "r");
$nodesNumber = 0;
$relationMatrix = [5][5];
while (!feof($input)){
    $string = fgets($input);
    $delimiterArray = explode(":",$string);
    if ($delimiterArray[1] != "") {
        $neighboursArray = explode(",", $delimiterArray[1]);
        foreach ($neighboursArray as $v){
            $relationMatrix[((int)$delimiterArray[0])-1][(int)$v-1] = 1;
        }
    }
    $nodesNumber++;
}

for ($i = 0;$i<$nodesNumber;$i++){
    for($j=0;$j<$nodesNumber;$j++){
        if(!isset($relationMatrix[$i][$j])){
            $relationMatrix[$i][$j] = 0;
        }
        echo $relationMatrix[$i][$j]." ";
    }
    echo "</br>";
}
