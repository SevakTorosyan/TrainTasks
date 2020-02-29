<?php
/**
 * Created by PhpStorm.
 * User: sevak
 * Date: 2020-02-28
 * Time: 09:41
 */
$input = fopen("input.txt",'r');
$output = fopen("output.txt", 'w');

$string = fgets($input);
$isBegin = true; //если будет более двух байт становится false для проверки на 1 0 в начале байта
// Т.к гарантировано что количество 0 и 1 будет кратно 8, то изначально делаем предположение, что строка верна
// Задача строки пройти через все условия оставаясь истиной.
$isUTF8 = true;
$counter = 0;
$matchCounter = 0;
 for($i = 0;$i<strlen($string)/8;$i++){
     for ($j = 0; $j < 8; $j++) {
         if ($isBegin) {
             if ($string[$i*8+$j] == 1){
                 $counter++;
             }
             else {
                 if ($counter!=0){
                     $isBegin = false;
                 }
                 break;
             }
         }
         elseif ($counter == 1){ //если не выявлен первый ведущий байт, но уже встречен 1 0 то строка уже не верна
             $isUTF8 = false;
             break;
         }
         else{
             if(($string[$i*8+$j]==1) && ($string[$i*8+$j+1]==0)){
                 $matchCounter++;
                 if($matchCounter==($counter-1)){  //условие подсчитывающее количество правильных вхождений
                     $isBegin = true;
                     $counter = 0;
                     $matchCounter = 0;
                 }
             }
             else{
                 $isUTF8 = false;
             }
             break;
         }
     }
     if (!$isUTF8){
         break;
     }
 }
if($isUTF8){
    fputs($output,"Y");
}
else fputs($output,'N');
fclose($input);
fclose($output);
echo "Загляните в output.txt";