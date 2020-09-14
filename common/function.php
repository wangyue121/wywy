<?php
//获取题库的全部信息
function getDataInfo($data){
    $count=[];//统计题库提的个数
    $score=[];//题库下每道题的分数
    foreach ($data as $k=>$v){
        $count[$k]=count($v['data']);//题目中的个数
        //计算每到题的分数
        $score[$k]=round($v['score']/$count[$k]);
    }
    return [$count,$score];
};