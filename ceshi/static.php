<?php
// $count = 5;
// function get_count(){
// 	static $count = 0;
// 	return $count++;
// }
// ++$count;
// get_count();
// get_count();
// echo get_count();
// echo '<hr/>';
// $arr = array(
// 			0=>1,'aa'=>2,3,'bb'=>4,5,'aa','bb','cc'
// 	);
// print (45654)*pow(2,32);
// print_r($arr) ;
// echo count(null);
echo '<hr/>';
$array =array(
			1,2,3
	);
print_r($array);
foreach ($array as  &$val) {
	$val += $val%2?$val++:$val--;
	echo $val.'+';
}
print_r($array);
$val=0;
print_r($array);
print(join('',$array));
echo '<hr/>';
echo(1%2);
// print_r($val);
// echo intval((0.1+0.7)*10);
echo '<hr/>';
// echo 2%2;
$a = true || false;
var_dump($a);