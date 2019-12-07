<?php

//获取数据库连接
function mysqlInit()
{
    $url = '127.0.0.1:3306';
    
    $username ='root';
    
//    $password = 'root';
    $password = '123456';

    $dbName ='shopping_db';
    
    //设置数据库连接
    $conn = mysqli_connect($url,$username,$password,$dbName);
    
    //设置数据库字符集
    mysqli_query($conn, 'set names utf8');

    return $conn;

}

//关闭数据库连接
function mysqlCLose($conn){
    
    mysqli_close($conn);
}


//用于执行读的sql语句，(即查询的sql语句)返回值为数组
function exeRead($sql){
    
    $conn = mysqlInit();
    
    $result = mysqli_query($conn,$sql);
    
    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
    mysqli_close($conn);
    
    return $data;
    
}


//用于执行写的sql语句，(即添加，更新，删除的sql语句)，操作成功返回true.操作失败返回false
function exeWrite($sql){

    $conn = mysqlInit();

    $result = mysqli_query($conn,$sql);

    if (!$result) {
//        throw new Exception("错误描述: " . mysqli_error($conn));
    }

    mysqli_close($conn);

    return $result;

}


//检查用户是否登录
function checkLogin()
{
    
    //用户未登录
    if(!isset($_SESSION['user']) || empty($_SESSION['user']))
    {
        return false;
    }
    return true;

}





/**
 * 分页显示
 * @param  int $total 数据总数
 * @param  int $pagenum 当前页
 * @param  int $pagesize 每页显示条数
 * @param  string $pageurl 点击分页的访问地址
 * @param  string $info 显示信息
 * @return string
 */
function pages($total, $pagesize,$pagenum,$pageurl,$info)
{
    $count = (int)($total / $pagesize);
    if ($total % $pagesize > 0) {
        $count++;
    }
    if(strpos($pageurl,'?')>-1){
        $pageurl = $pageurl . "&";
    }else{
        $pageurl = $pageurl . "?";
    }
    
    $pageinfo ="";
    
    $pageinfo = $pageinfo.$info."&nbsp;&nbsp;";
    
    
    $pageinfo = $pageinfo.$pagenum."/".$count ."&nbsp;&nbsp;";
 
    
    
    if ($pagenum == 1) {
        
        $pageinfo =  $pageinfo."<SPAN style='color:#CCCCCC'>【首页】</SPAN><SPAN style='color:#CCCCCC'>【上一页】</SPAN>&nbsp;&nbsp;";

    } else {
        $pageinfo =  $pageinfo."【<a href='" . $pageurl . "pagenum=1'>首页</a>】【<a href='" . $pageurl . "pagenum=" . ($pagenum - 1)
            . "' >上一页</a>】";
    }
    
    $bound1 = (($pagenum - 2) <= 0) ? 1 : ($pagenum - 2);
    $bound2 = (($pagenum + 2) >= $count) ? $count : ($pagenum + 2);
    
    for ($i = $bound1; $i <= $bound2; $i++) {
        if ($i == $pagenum) {
            $pageinfo =  $pageinfo."<SPAN style='color:#FF0000'>".$i."</SPAN>&nbsp;&nbsp;";
        } else {
            $pageinfo =  $pageinfo."<a href='" .$pageurl . "pagenum=" . $i . "'>" . $i. "</a>&nbsp;&nbsp;";
        }
    }
    
    
    if ($bound2 < $count) {
       $pageinfo =  $pageinfo."<SPAN>...</SPAN>";
    }
    
    if ($pagenum == $count|| $count==0) {
        $pageinfo =  $pageinfo."<SPAN style='color:#CCCCCC'>【下一页】</SPAN><SPAN style='color:#CCCCCC'>【尾页】</SPAN>";
    } else {
        $pageinfo =  $pageinfo."【<a href='" . $pageurl . "pagenum=" . ($pagenum + 1)
            . "'>下一页</a>】【<a href='" . $pageurl . "pagenum=" . $count
            . "'>尾页</a>】";
    }
    
   
    
    return $pageinfo;

}





/**
 * 图片上传
 * @param $uploadPath 图片保存的目录
 * @param $file 上传的图片对象
 * @return string 图片的名称
 */
function imgUpload($uploadPath,$file)
{
    //检查上传文件是否合法

    if(!is_uploaded_file($file['tmp_name']))
    {
        return "检查上传文件不合法";
    }
    //图像类型验证
    $type = $file['type'];
    if(!in_array($type, array("image/x-png", "image/gif", "image/jpeg", "image/pjpeg")))
    {
       return "图片类型验证错误,请上传png或者gif或者jpg格式";
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    //上传图像名称
    $img = uniqid() . mt_rand(1000, 9999) . '.' . $ext;
    //物理地址
    $imgPath = $uploadPath . $img;
     
    //操作失败 查看上传目录的权限
    if(!move_uploaded_file($file['tmp_name'], $imgPath))
    {
       return "上传目录权限不够";
    }

    return $img;


}

//获取当前时间
function getTime(){
    date_default_timezone_set('Asia/Shanghai');
    return @date('Y-m-d H:i:s',time());
}

//获取当前日期
function getRiqi(){
    date_default_timezone_set('Asia/Shanghai');
    return @date('Y-m-d',time());
}

//获取编号
function getBianhao(){
    date_default_timezone_set('Asia/Shanghai');
    return @date('YmdHis',time());
}



