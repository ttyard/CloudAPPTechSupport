<?php

include 'include/db_mysql.class.php';
include 'include/config.inc.php';


$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
$DBLINK->set_charset(DBCHARSET);

if (!$DBLINK) {
	die("数据库连接失败！".$DBLINK->connect_error);
}

if ($action="edit") {
//$UserEditSQL=sprintf("UPDATE user set `Name`='%s',`Telephone`='%s',`Mobilephone`='%s',`Address`='%s',`Type`='%s' WHERE `uid`='%s'",htmlspecialchars($_POST['Name']),htmlspecialchars($_POST['Telephone']),htmlspecialchars($_POST['Mobilephone']),htmlspecialchars($_POST['Address'],htmlspecialchars($_POST['Type']),(int)$_POST['uid']));
$UserEditSQL=sprintf("UPDATE `user` set `Name`='%s',`Telephone`='%s',`Mobilephone`='%s',`Address`='%s',`Type`='%s' WHERE `uid`='%s'",$_POST['Name'],$_POST['Telephone'],$_POST['Mobilephone'],$_POST['Address'],$_POST['Type'],$_POST['uid']);

$UpdateUserInfo=$DBLINK->query($UserEditSQL);

header("Location:user.php");
} else if (action="add") {
	;
} else {
	header("Locaton:error.php");
}

?>