<?php
require 'connection.php';
session_start();

$error='';
if (isset($_SESSION['id'])&& isset($_SESSION['pass'])==true){
$res=$res=$conn->prepare("SELECT * FROM admin WHERE id_gov=:id AND password=:pass");
if($res->execute(array(':id'=>$_SESSION['id'],':pass'=>$_SESSION['pass']))){
 foreach ($res as $row) {
 	if($row['role']=='adminsup1'){
          
 	}
 	else{
 		header("location:../index.php");
 	}
 }
}
else{
header("location:index.php");
}
}
else{
header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
<link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
<script src='../../js/jquery.js'></script>
<script src='../../js/bootstrap.js'></script>

</head>
<body>
       <div class="container">
       	<?php require 'nan.php';
       require 'asied.php';
       ?>
           
           	

           	<div class="col-md-3">
           		<a href="edit_empl.php">
           			<div class="panel panel-default">
           				<div class="panel-heading text-center">
           					<div class="row">
           						<i class="glyphicon glyphicon-usd" style="font-size: 2.5em"></i>
           						<div style="font-size:1.2em ">
           							تعديل بيانات موظفين التبرعات
           						</div>
           					</div>
           				</div>
           				
           			</div>
           		</a>
           	</div>
           </div>

       </div>
</body>
</html>