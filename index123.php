<?php
$count = count(glob('data/*.php'));             //统计题库data文件夹中“PHP”文件个数，题库要求文件名必须是连续的数字；
//读取题库
$info=[];                                               //设一个空值，里面保存题库信息

for($i=1;$i<=$count;$i++){
    //获取题库
    $data=require "data/$i.php";
    $info[$i]=[
        'title'=>$data['title'],
        'time'=>round($data['timeout']/60),         //把秒变成分，round（）函数四舍五入，
        'score'=>getDataTotal($data['data'])            //获取单个的分数
    ];
}

//获取总分
function getDataTotal($data){
    $sum='';
    foreach ($data as $v){
        $sum+=$v['score'];
    };

    return $sum;
};
//引用HTML
include 'view/index.html';
?>