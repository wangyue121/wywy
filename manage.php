<?php

require 'common/consql.php';
if($_POST['key']){
	$key=$_POST['key'];
	$sql="select * from `user` where name like '%".$key."%' order by sub_time desc";
}else{
	$sql = "select * from `user` order by sub_time desc limit 50";
}

session_start();
if($_POST['user_id']){
	$_SESSION['name']=$_POST['user_id'];
}
if($_POST['user_pwd']){
	$_SESSION['pwd']=$_POST['user_pwd'];
}


$query = mysqli_query($con,$sql);
$data=[];
while ($row = mysqli_fetch_row($query)) {
	$tmp = array();//临时数组整合信息 
    $tmp['name'] = $row[1];
    $tmp['score_c'] = $row[2];
    $tmp['score_m'] = $row[3];
    $tmp['score_p'] = $row[4];
    $tmp['score_s'] = $row[5];
    $tmp['sub_time'] = $row[6];
    $data[] = $tmp; // 自增
 }
 $name=$_SESSION['name'];
 $pwd=$_SESSION['pwd'];
 if($name=="admin"&&$pwd=="admin666"){
 	require 'view/total.html';
 }else{
 	echo "<script>alert('用户名密码错误');</script>";
 	require 'view/admin.html';
 }
?>