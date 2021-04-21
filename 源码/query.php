<!-- /*
*author:gzhu_ruiop
*date：2021-01-13
*des：会议管理系统···查询或删除以预定记录
*根据传入进来的username查询数据库的的会议室使用表中已经使用的房
*间，然后返回到界面渲染还有删除里面的预定记录，style有两种模式，
*一是find用于查已经预定的记录；delete是去删除选中的记录，根据
*传入的id找到要删除的记录，成功删除返回OK
*/ -->
<?php
$style=$_POST['style'];
$username=$_POST['username'];

#设置编码格式为utf-8
header("Content-Type: text/html;charset=utf-8");
#根据公网ip连接数据库，参数1是ip，参数2是用户，参数3是密码
$con = mysqli_connect("47.96.151.142","root","110124");
#用户表存在数据using中，连接using
$select_db = mysqli_select_db($con,'using');
#连接不成功 结束进程
if (!$select_db) {
    die("could not connect to the db:\n" .  mysqli_error());
}
#根据传入的style决定哪种方式 查询还是删除
if($style=="find")
{
    //查询代码
    $sql = "select * from roomusing where username='$username'";
    //查询使用utf-8编码方式
    mysqli_query($con,"set names 'utf8'");
    //使用sql语句进行查询
    $res = mysqli_query($con,$sql);
    //查询失败结束进程
    if (!$res) 
    {
        die("could get the res:\n" . mysqli_error());
    }
    //创建一个数组拿到每一行的数据
    $arry=array();
    while ($row = mysqli_fetch_assoc($res)) 
    {
        $arry[]=$row;
    }

    //将数组最后以json格式输出
    echo json_encode($arry);
    //关闭数据库连接
}else if($style=="delete"){
    //通过post拿到删除的id号
    $ID=$_POST['id'];
    //删除语句
    $sql="DELETE FROM roomusing WHERE ID=$ID";
    //设置utf8编码
    mysqli_query($con,"set names 'utf8'");
    //执行sql语句
    $res = mysqli_query($con,$sql);
    if (!$res) {
        die("could get the res:\n" . mysqli_error());
    }else{
        echo "OK";
    }

}
//关闭数据库连接
mysqli_close($con);






?>