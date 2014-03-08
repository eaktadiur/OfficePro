<?php

function fibonacci($n,$first = 0,$second = 1)
{
    $fib = [$first,$second];
    for($i=1;$i<$n;$i++)
    {
        $fib[] = $fib[$i]+$fib[$i-1];
    }
    echo $fib[$n-1];
}

fibonacci(15);








$s1 = 'stsff';
$s2 = 'FF';

$length = strlen($s2);

$d = substr($s1, -$length);
echo strtolower($d) == strtolower($s2) ? 'true' : 'false';

$a = array("radar", "apple", "hello", "evitative");

foreach ($a as $key => $value) {
    echo '<br/>';
    $palindromes = strrev($value);
    echo $palindromes == $value ? 'true' : 'false';
}

