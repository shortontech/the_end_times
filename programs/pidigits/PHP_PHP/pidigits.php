<?php
/**
 * The Computer Language Benchmarks Game
 * http://benchmarksgame.alioth.debian.org/
 * 
 * transliterated from Mike Pall'$s Lua program
 * contributed by Mario Pernici
 */

if(isset($argv[1]) && is_numeric($argv[1])) {
  $last = (int) $argv[1];
} else {
  $last = 100;
}

$i = $k = $ns = 0;
$k1 = 1;
[$n,$a,$d,$t,$u] = [1,0,1,0,0];
while ($i!=$last) {
  $k = gmp_add($k, 1);
  $t = gmp_mul($n, 2);
  $n = gmp_mul($n, $k);
  $a = gmp_add($a, $t);
  $k1 = gmp_add($k1, 2);
  $a = gmp_mul($a, $k1);
  $d = gmp_mul($d, $k1);
  if (gmp_cmp($a, $n)!=-1) {
    [$t, $u] = gmp_div_qr(gmp_add(gmp_mul($n, 3), $a), $d);
    $u = gmp_add($u, $n);
    if ($d > $u) {
      $ns = gmp_add(gmp_mul($ns, 10), $t);
      if ((++$i % 10) == 0) {
        printf("%s\t:%d%s", str_pad(gmp_strval($ns), 10, '0'), $i, PHP_EOL);
        $ns = 0;
      }
      $a = gmp_sub($a, gmp_mul($d, $t));
      $a = gmp_mul($a, 10);
      $n = gmp_mul($n, 10);
      }
   }
}