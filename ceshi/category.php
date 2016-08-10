<?php
include('./connectmysql.php');
function getlist($pid=0,&$result=array(),$space=0){
	$space = $space+2;
	$sql = "SELECT * FROM category where pid=$pid";
	$rs = mysql_query($sql);
	// static $result = array();
	while($row=mysql_fetch_assoc($rs)){
		$row['catename']= str_repeat('&nbsp;&nbsp;',$space).'|--'.$row['catename'];  
		$result[]=$row;
		getlist($row['id'],$result,$space);
	}
	return $result;
}
// print_r(getlist());
	
function displayCate($pid=0,$selected=0){
	$res = getlist($pid);
	$str = '';
	$str .= '<select name="cate">';
	foreach($res as $k=>$v){
		$selectedstr='';
		if ($v['id']==$selected) {
			$selectedstr = 'selected';
		}
		$str .= '<option '.$selectedstr.'>'.$v['catename'].'</option>';
		// $str .= "<option {$selectedstr}>{$v['catename']}</option>";
	}
	$str .= '</select>';
	return $str;
}
echo displayCate(0,3);
