<?php
require '../connection.php';
session_start();

$error='';
if (isset($_SESSION['id'])&& isset($_SESSION['pass'])==true){
$res=$res=$conn->prepare("SELECT * FROM admin WHERE id_gov=:id AND password=:pass");
if($res->execute(array(':id'=>$_SESSION['id'],':pass'=>$_SESSION['pass']))){
 foreach ($res as $row) {
 	if($row['role']=='admin'){
          
 	}
 	else{
 		header("location:index.php");
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
$pass=md5($_GET['pass']);
$dep=$_GET['depa'];

$res=$conn->prepare("INSERT INTO admin (name,id_gov,phone,password,role) VALUES (:name,:id,:phone,:pass,:role)");
if($res->execute(array(':name'=>$name,':id'=>$id,':phone'=>$phone,':pass'=>$pass,':role'=>$dep))){
	$error="<div class='alert alert-success'>تم انشاء الحساب </div>";
}
else{
	$error="<div class='alert alert-success'>لم يتم انشاء الحساب حاول مره اخرى </div>";
}

}


?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require 'header.php';?>
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
			<label class="col-md-2 control-label">الرقم السري </label>
			<div class="col-md-6">
				<input type="password" name="pass" class="form-control" required>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">القسم </label>
			<div class="col-md-4">
				<select class="form-control" name="depa" required>
					<option value="adminsup1">التبرعات</option>
					<option value="adminsup2">الايجارات</option>
				</select>
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