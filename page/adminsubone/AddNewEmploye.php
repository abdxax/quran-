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

if (isset($_GET['save'])){
$name=$_GET['name'];
$id=$_GET['id'];
$phone=$_GET['phone'];
$time=$_GET['time'];
$date=date("Y-m-d h:i:sa");


$res=$conn->prepare("INSERT INTO employess (name,id_gov,phone,tim) VALUES (:name,:id,:phone,:tim)");
if($res->execute(array(':name'=>$name,':id'=>$id,':phone'=>$phone,':tim'=>$time))){
	$emo=$conn->prepare("INSERT INTO byweek (id_gov,start,tims) VALUES (:id,:start,:ti)");
	if ($emo->execute(array(':id'=>$id,':start'=>$date,':ti'=>$time))){
		$error="<div class='alert alert-success'>تم انشاء الحساب </div>";
	}
	
}
else{
	$error="<div class='alert alert-danger'>لم يتم انشاء الحساب حاول مره اخرى </div>";
}

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
echo $error;
?>
	<div class="col-md-9">
	<form class="form-horizontal"> 
		<div class="form-group">
			<label class="col-md-2 control-label">الاسم </label>
			<div class="col-md-6">
				<input type="text" name="name" class="form-control" required>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">الرقم الوظيفي </label>
			<div class="col-md-6">
				<input type="number" name="id" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">رقم الجوال </label>
			<div class="col-md-6">
				<input type="number" name="phone" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">الفترة </label>
			<div class="col-md-6">
				<input type="text" name="time" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label"></label>
			<div class="col-md-6">
				<input type="submit" name="save" class="btn btn-success btn-block" value="حفظ">
			</div>
		</div>
	</form>

</div>
	
</div>


</body>
</html>