<!-- /*
*author:gzhu_ruiop
*date：2021-01-13
*des：会议管理系统···查询using表中已经存在的预定记录
*/ -->
<?php
//查询数据库
$select_time=$_POST['time'];
header("Content-Type: text/html;charset=utf-8");
$con = mysqli_connect("47.96.151.142","root","110124");
$select_db = mysqli_select_db($con,'using');
if (!$select_db)
{
    die("could not connect to the db:\n" .  mysqli_error());
}
//查询数据库
//查询代码
$sql = "select * from roomusing where usingdate='$select_time'";
mysqli_query($con,"set names 'utf8'");
$res = mysqli_query($con,$sql);
if (!$res) {
    die("could get the res:\n" . mysqli_error());
}

$json_string = json_encode($arr);
$arry=array();
while ($row = mysqli_fetch_assoc($res)) {
    $arry[]=$row;
}

//查询代码
echo json_encode($arry);
//关闭数据库连接

mysqli_close($con);

?>

