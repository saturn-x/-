<!-- /*
*author:gzhu_ruiop
*date：2021-01-13
*des：会议管理系统···登录模块，请求数据库查询用户以及密码
*/ -->
<?php
$style=$_POST['style'];
$username=$_POST['username'];
$password=$_POST['password'];
header("Content-Type: text/html;charset=utf-8");
$con = mysqli_connect("47.96.151.142","root","110124");
$select_db = mysqli_select_db($con,'user');
if (!$select_db)
{
    die("could not connect to the db:\n" .  mysqli_error());
}
if($style=="login")
{
    //查询语句
    $sql="select password from user where username='$username'";
    //设置utf-8编码
    mysqli_query($con,"set names 'utf8'");
    //查询语句
    $res = mysqli_query($con,$sql);
    if (!$res)
    {
        die("could get the res:\n" . mysqli_error());
    }
    $arry=array();
    $row=mysqli_fetch_array($res);
    if($password==$row['password'])
    {
        echo "OK";//成功输出OK
    }else
    {
        echo "FALSE";//失败输出FLASE
    }
}


?>


