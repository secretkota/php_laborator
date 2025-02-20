<?php

$a = 0;
$b = 0;

for ($i = 0; $i <= 5; $i++) {
   $a += 10;
   echo $a."\n";
   $b += 5;
   echo $b."\n";
}

echo "End of the loop: a = $a, b = $b\n";

$c = 0;
$d = 0;
$i = 0;

while($i <= 5){
    $c += 10;
    $d += 5; 
    $i++;
}

echo "End of the loop: c = $c, d = $d\n";


$e = 0;
$f = 0;
$i = 0;

do {
    $e = $i * 2;
    $f = $i + 1; 
    echo "End of the loop: e = $e, f = $f\n";
    $i++;
} while ($i <= 5);