
<?php

require 'common/function.php';

require 'common/consql.php';
$id=$_REQUEST['id'];//获得相应题库的序号
$data=require  "data/$id.php";//根据序号找题库
list($count,$score)=getDataInfo($data['data']);
$sum=0;//定义两个变量：保存总分sum；保存结果total
$total=[];
$result_c=$result_m=$result_p=$result_s=0;
$k_name=$_REQUEST['name'];
foreach ($data['data'] as $type=>$each){//阅卷	
    foreach ($each['data'] as $k=>$v){
        $answer=$_REQUEST[$type][$k];//取出用户提交的答案
		if($v['id']=="1"){
			if($answer=="A"){
				$result_c=$result_c+1;
			}elseif ($answer=="B") {
				$result_p=$result_p+1;
			}elseif ($answer=="C") {
				$result_s=$result_s+1;
			}else{
				$result_m=$result_m+1;
			}
		}elseif ($v['id']==2) {
			if($answer=="A"){
				$result_m=$result_m+1;
			}elseif ($answer=="B") {
				$result_s=$result_s+1;
			}elseif ($answer=="C") {
				$result_c=$result_c+1;
			}else{
				$result_p=$result_p+1;
			}
		}elseif ($v['id']==3||$v['id']==10||$v['id']==21||$v['id']==24||$v['id']==27||$v['id']==39) {
			if($answer=="A"){
				$result_p=$result_p+1;
			}elseif ($answer=="B") {
				$result_m=$result_m+1;
			}elseif ($answer=="C") {
				$result_s=$result_s+1;
			}else{
				$result_c=$result_c+1;
			}
		}elseif ($v['id']==4||$v['id']==7||$v['id']==9||$v['id']==19||$v['id']==34) {
			if($answer=="A"){
				$result_m=$result_m+1;
			}elseif ($answer=="B") {
				$result_p=$result_p+1;
			}elseif ($answer=="C") {
				$result_c=$result_c+1;
			}else{
				$result_s=$result_s+1;
			}
		}elseif ($v['id']==5||$v['id']==35) {
			if($answer=="A"){
				$result_s=$result_s+1;
			}elseif ($answer=="B") {
				$result_m=$result_m+1;
			}elseif ($answer=="C") {
				$result_p=$result_p+1;
			}else{
				$result_c=$result_c+1;
			}
		}elseif ($v['id']==6||$v['id']==15||$v['id']==17||$v['id']==29||$v['id']==32||$v['id']==36||$v['id']==40) {
			if($answer=="A"){
				$result_p=$result_p+1;
			}elseif ($answer=="B") {
				$result_m=$result_m+1;
			}elseif ($answer=="C") {
				$result_c=$result_c+1;
			}else{
				$result_s=$result_s+1;
			}
		}elseif ($v['id']==8) {
			if($answer=="A"){
				$result_c=$result_c+1;
			}elseif ($answer=="B") {
				$result_s=$result_s+1;
			}elseif ($answer=="C") {
				$result_m=$result_m+1;
			}else{
				$result_p=$result_p+1;
			}
		}elseif ($v['id']==11) {
			if($answer=="A"){
				$result_c=$result_c+1;
			}elseif ($answer=="B") {
				$result_s=$result_s+1;
			}elseif ($answer=="C") {
				$result_p=$result_p+1;
			}else{
				$result_m=$result_m+1;
			}
		}elseif ($v['id']==12) {
			if($answer=="A"){
				$result_s=$result_s+1;
			}elseif ($answer=="B") {
				$result_p=$result_p+1;
			}elseif ($answer=="C") {
				$result_m=$result_m+1;
			}else{
				$result_c=$result_c+1;
			}
		}elseif ($v['id']==13) {
			if($answer=="A"){
				$result_m=$result_m+1;
			}elseif ($answer=="B") {
				$result_c=$result_c+1;
			}elseif ($answer=="C") {
				$result_p=$result_p+1;
			}else{
				$result_s=$result_s+1;
			}
		}elseif ($v['id']==14||$v['id']==20||$v['id']==22||$v['id']==25||$v['id']==37) {
			if($answer=="A"){
				$result_s=$result_s+1;
			}elseif ($answer=="B") {
				$result_c=$result_c+1;
			}elseif ($answer=="C") {
				$result_p=$result_p+1;
			}else{
				$result_m=$result_m+1;
			}
		}elseif ($v['id']==16||$v['id']==28||$v['id']==31) {
			if($answer=="A"){
				$result_m=$result_m+1;
			}elseif ($answer=="B") {
				$result_c=$result_c+1;
			}elseif ($answer=="C") {
				$result_s=$result_s+1;
			}else{
				$result_p=$result_p+1;
			}
		}elseif ($v['id']==18||$v['id']==30||$v['id']==33) {
			if($answer=="A"){
				$result_p=$result_p+1;
			}elseif ($answer=="B") {
				$result_c=$result_c+1;
			}elseif ($answer=="C") {
				$result_m=$result_m+1;
			}else{
				$result_s=$result_s+1;
			}
		}elseif ($v['id']==23||$v['id']==26||$v['id']==38) {
			if($answer=="A"){
				$result_c=$result_c+1;
			}elseif ($answer=="B") {
				$result_p=$result_p+1;
			}elseif ($answer=="C") {
				$result_m=$result_m+1;
			}else{
				$result_s=$result_s+1;
			}
		}else{
			$result_c=$result_m=$result_p=$result_s=0;
		}       
    }
}

//require 'view/total.html';



$sql = "insert into user(`name`,`score_c`,`score_m`,`score_p`,`score_s`) values ('".$k_name."','".$result_c."','".$result_m."','".$result_p."','".$result_s."')";
$res=mysqli_query($con,$sql);
if(!$res){
    echo "提交失败";
}else{
    require 'view/save.html';
}



?>

