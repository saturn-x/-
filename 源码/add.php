<!-- /*
*author:gzhu_ruiop
*date：2021-01-13
*des：会议管理系统···添加预定的房间模块
*/ -->
<?php
$time=$_POST['time'];
$username=$_POST['username'];
$date=$_POST['date'];
$building=$_POST['building'];
$room=$_POST['room'];
$time_arry = explode(',',$time); 

header("Content-Type: text/html;charset=utf-8");
$con = mysqli_connect("47.96.151.142","root","110124");
$select_db = mysqli_select_db($con,'using');
if (!$select_db) 
{
    die("could not connect to the db:\n" .  mysqli_error());
}
//时间数组，如果是morning 1
$time_num=array();
for($index=0;$index<count($time_arry);$index++)
{
    if($time_arry[$index]=="morning")
    {
        $time_num[]=1;
    }else if($time_arry[$index]=="afternoon")
    {
        $time_num[]=2;
    }else if($time_arry[$index]=="evening")
    {
        $time_num[]=3;
    }
}
for($index=0;$index<count($time_num);$index++)
{ 

    $sql = "INSERT INTO roomusing ".
        "(ID,roomnum, building,usingtime,usingdate,username) ".
        "VALUES ".
        "(NULL,'$room','$building','$time_num[$index]','$date','$username')";
    mysqli_query($con,"set names 'utf8'");
    $res = mysqli_query($con,$sql);


}


echo "OK";











?>