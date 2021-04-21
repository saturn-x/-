<!-- /*
*author:gzhu_ruiop
*date：2021-01-13
*des：会议管理系统···初始化模块读取会议室meeting_room所有信息
*/ -->
<?php
header("Content-Type: text/html;charset=utf-8");
$con = mysqli_connect("47.96.151.142","root","110124");
$select_db = mysqli_select_db($con,'meeting_room');
if (!$select_db) 
{
    die("could not connect to the db:\n" .  mysqli_error());
}
mysqli_query($con,"set names 'utf8'");
$result = mysqli_query($con,"SHOW TABLES");
$arry=array();
while($row = mysqli_fetch_array($result))
{
    //这里的row(0)代表每个元素
    //查询代码
    $sql = "select * from ".$row[0];
    $building=$row[0];
    mysqli_query($con,"set names 'utf8'");
    $res = mysqli_query($con,$sql);
    if (!$res) 
    {
        continue;
        die("could get the res:\n" . mysqli_error());
    }
    while ($row = mysqli_fetch_assoc($res)) 
    {
       $row['building']=$building;
        $arry[]=$row;
        
    }
    //关闭数据库连接
}
echo json_encode($arry);
mysqli_close($con);

?>

