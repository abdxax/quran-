<?php
require '../connection.php';
session_start();

$error="";
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

$name='';
$id='';
$phone='';
$type='';
$pass="";

if (isset($_GET['id'])){

	$res=$conn->prepare("SELECT * FROM admin WHERE id_gov=:id");
	$res->execute(array(':id'=>$_GET['id']));
	$type="";
	foreach ($res as $row) {
		$name=$row['name'];
		$id=$row['id_gov'];
		$phone=$row['phone'];
		if ($row['role']=='admin'){
              		$type="رئيس الجمعية";
              	}
              	else if ($row['role']=='adminsup1'){
              		$type="التبرعات";
              	}
              	else{
              		$type="الايجارات";
              	}
		$pass=$row['password'];
	}

}

$pr='';
if (isset($_GET['edit'])){
	$name=$_GET['name'];
	$id=$_GET['id'];
	$pr=$id;
	$phone=$_GET['phone'];
	$pass=$_GET['pass'];

	$res=$conn->prepare("UPDATE admin SET name=:name,phone=:phone,password=:pass WHERE id_gov=:id ");
	if ($res->execute(array(':name'=>$name,':phone'=>$phone,':pass'=>$pass,':id'=>$pr))){
		$error="<div class='alert alert-success'>تم التعديل </div>'";

		header("location:edit_account.php?msg=".$error."");
	}
	else{
		$error="<div class='alert alert-danger'>لم يتم التعديل حاول مره اخرى </div>'";
	}
}

if (isset($_GET['delet'])){
$id=$_GET['id'];
	$pr=$id;
	$res=$conn->prepare("DELETE FROM admin WHERE id_gov=:id");
	if ($res->execute(array(':id'=>$pr))){
		$error="<div class='alert alert-success'>تم الحذف</div>'";
		header("location:edit_account.php?msg=".$error."");
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
?>
	<div class="col-md-9">
	<?php echo $error;?>
	<form class="form-horizontal"> 
		<div class="form-group">
			<label class="col-md-2 control-label">الاسم </label>
			<div class="col-md-6">
				<input type="text" name="name" class="form-control" required value=<?php echo $name; ?>>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">الرقم الوظيفي </label>
			<div class="col-md-6">
				<input type="number" name="id" class="form-control"  readonly value=<?php echo $id; ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">رقم الجوال </label>
			<div class="col-md-6">
				<input type="number" name="phone" class="form-control" required value=<?php echo $phone; ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">الرقم السري </label>
			<div class="col-md-6">
				<input type="password" name="pass" class="form-control" required value=<?php echo $pass; ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">القسم </label>
			<div class="col-md-4">
				<label class="control-label"><?php echo $type; ?> </label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label"></label>
			<div class="col-md-6">
				<input type="submit" name="edit" class="btn btn-success btn-block" value="تعديل ">
			</div>
		</div>

				<div class="form-group">
			<label class="col-md-2 control-label"></label>
			<div class="col-md-6">
				<input type="submit" name="delet" class="btn btn-danger btn-block" value="حذف الحساب ">
			</div>
		</div>
	</form>

</div>

</div>


</body>
</html>