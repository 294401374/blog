<?php
include('./connectmysql.php');
// 获取分类路径
function getpath($cid,&$result=array()){
	$sql = "select * from category where id=$cid";
	$rs = mysql_query($sql);
	// $row是资源类型如果有数据的话就返回真
	$row = mysql_fetch_assoc($rs);
	if ($row) {
		$result[]=$row;
		getpath($row['pid'],$result);
	}
	// 这个函数对数组建明逆向排序
	krsort($result);
	return $result;
}
function displaypath($cid,$url='cate.php?cid='){
	$res = getpath($cid);
	$str = '';
	foreach ($res as $k => $v) {
		$str.="<a href='{$url}{$v['id']}'>{$v['catename']}</a>>>";
	}
	return $str;
}
echo displaypath(10,"cate.php?page=1&cid=");
