<!-- /*
*author:gzhu_ruiop
*date：2021-01-13
*des：会议管理系统···管理会议室模块
*维护数据库中的会议室表、对会议室的属性进行增删改查
*/ -->
<?php
$style=$_GET['style'];
$add_building=$_GET['add_building'];
header("Content-Type: text/html;charset=utf-8");
$con = mysqli_connect("47.96.151.142","root","110124");
$select_db = mysqli_select_db($con,'meeting_room');
if (!$select_db)
{
    die("could not connect to the db:\n" .  mysqli_error());
}
// 新建一个数据库表
if($style=="add_building")
{
   $sql=" CREATE TABLE IF NOT EXISTS `$add_building`(
        `ID` INT UNSIGNED AUTO_INCREMENT,
        `capacity` INT NOT NULL,
        `attribute` VARCHAR(255) NOT NULL,
        PRIMARY KEY ( `ID` )
        )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
     mysqli_query($con,"set names 'utf8'");
     $res = mysqli_query($con,$sql);
     if (!$res) {
         die("could get the res:\n" . mysqli_error());
     }
    echo "OK";
}elseif($style=="find_tables")
{
    //输入所有的表
    $sql="show tables;";
    mysqli_query($con,"set names 'utf8'");
    $res = mysqli_query($con,$sql);
    if (!$res)
    {
        die("could get the res:\n" . mysqli_error());
    }
    $arry=array();
    while ($row = mysqli_fetch_assoc($res))
    {
        $arry[]=$row;
    }
    echo json_encode($arry);   //"Tables_in_meeting_room":"first"

}elseif($style=="del_room")
{
    //删除一个房间也就是删除一个行
    $building_room=$_GET['building_room']; //可能为first_1
    $temp= explode('_',$building_room); 
    $building=$temp[0];
    $room_id=$temp[1];
    $sql="DELETE FROM $building WHERE ID=$room_id;";
    mysqli_query($con,"set names 'utf8'");
    mysqli_query($con,$sql);
    echo "执行删除";

}elseif($style=="update_room")
{
    $building_room=$_GET['building_room'];
    $temp= explode('_',$building_room); 
    $building=$temp[0];
    $room_id=$temp[1];
    // capacity:arr[0],
    // attributes:arr[1]
    $capacity=$_GET['capacity'];
    $attribute=$_GET['attribute'];
    $sql = "UPDATE $building
        SET capacity='$capacity',attribute='$attribute'
        WHERE ID='$room_id';";
    mysqli_query($con,"set names 'utf8'");
    mysqli_query($con,$sql);
    echo "执行修改";

}elseif($style=="add_room")
{
    //设置一次增加两个房间
    $building=$_GET['building'];
    for($a=1;$a<=2;$a++){
        $ID=$_GET['id'.$a];
        $capacity=$_GET['capacity'.$a];
        $attribute=$_GET['attribute'.$a];
        $sql = "INSERT INTO $building ".
        "(id,capacity, attribute) ".
        "VALUES ".
        "('$ID','$capacity','$attribute');";
        mysqli_query($con,"set names 'utf8'");
        mysqli_query($con,$sql);
        echo "增加成功";
    }   
}elseif($style=='del_building')
{
    $building=$_GET['building'];
    $temp=explode(',',$building);
    $len=count($temp);//因为是 first,second, 所以数组长度+1
    for($i=0;$i<$len-1;$i++){
        $sql = "DROP TABLE  $temp[$i]";
        mysqli_query($con,"set names 'utf8'");
        mysqli_query($con,$sql);
        echo "删除成功";
    }

    

}






?>