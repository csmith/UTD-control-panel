<?PHP

$codes = array();

function randLetter($set) {
 global $codes;
 $num = rand(65,90);
 $codes[$set] += $num - 65;
 return chr($num);
}

for ($i = 0; $i < 4; $i++) {
 for ($j = 0; $j < 4; $j++) {
  echo randLetter($i);
 }
 echo '-';
}
for ($i = 0; $i < 4; $i++) {
 echo chr(($codes[$i] % 26) + 65);
}

?>
