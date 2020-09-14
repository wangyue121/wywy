<?php

//获取题库id
$id=$_GET['id'];
$name=$_GET['name'];
//寻找题库里题号是否对应，对应就返回对应的页面，不对应返回flase
function getDataById($id){
    //拼接data题库
    $a="data/$id.php";
    //进入题库
    return include $a;
};
//读取题库内容
$data=getDataById($id);
foreach ($data['data'] as $k=>$value){
    if ('single'==$k){
        foreach ($value['data'] as $k=>$val){
            //A选项
            $data['data']['single']['data'][$k]['option'][0]=htmlspecialchars($val['option'][0]);
            $data['data']['single']['data'][$k]['option'][1]=htmlspecialchars($val['option'][1]);
            $data['data']['single']['data'][$k]['option'][2]=htmlspecialchars($val['option'][2]);
            $data['data']['single']['data'][$k]['option'][3]=htmlspecialchars($val['option'][3]);
        }
    }elseif ('binary'==$k){
        //将判断题中的问题转义一下
    }elseif ('multiple'==$k){
        //将问题和选项转义一下
    }else{
        //填空题的问题转义一下
    }
};
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



list($count,$score)=getDataInfo($data['data']);
include 'view/test.html';
