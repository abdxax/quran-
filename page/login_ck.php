<?php
require '../connection.php';
session_start();
$id=$_POST['id'];
$id=strip_tags(trim($id));
$pass=$_POST['pass'];
$pass=md5($pass);
$error='';

$res=$conn->prepare("SELECT * FROM admin WHERE id_gov=:id AND password=:pass");
$res->execute(array(':id'=>$id,':pass'=>$pass));
if ($res->rowCount()==1){
 foreach ($res as $row) {
 	if ($row['role']=='admin'){
 	$_SESSION['id']=$row['id_gov'];
 	$_SESSION['pass']=$row['password'];
 	header("location:admin.php");
 }
 else if ($row['role']=='adminsup1'){
 	$_SESSION['id']=$row['id_gov'];
 	$_SESSION['pass']=$row['password'];
 	header("location:adminsubone/adminsub.php");
 }
 else if ($row['role']=='adminsup2'){
 	$_SESSION['id']=$row['id_gov'];
 	$_SESSION['pass']=$row['password'];
 	header("location:adminsubtwo/adminsub.php");
 }
 	
 }
}
else{
header("location:login.php?error=e1");
}






?>