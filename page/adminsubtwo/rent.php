<?php
require 'connection.php';
session_start();

$error='';
if (isset($_SESSION['id'])&& isset($_SESSION['pass'])==true){
$res=$res=$conn->prepare("SELECT * FROM admin WHERE id_gov=:id AND password=:pass");
if($res->execute(array(':id'=>$_SESSION['id'],':pass'=>$_SESSION['pass']))){
 foreach ($res as $row) {
 	if($row['role']=='adminsup2'){
          
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

if (isset($_GET['save'])) {
	$na=$_GET['rentname'];
	$negh=$_GET['negh'];
	$val=$_GET['val'];
	$waypay=$_GET['waypay'];
	$dat=$_GET['dat'];
	$da2=$_GET['da2'];
	$name=$_GET['name'];
	$reg=$_GET['reg'];
	$phone=$_GET['phone'];
	$date=date("Y-m-d h:i:sa");

	$res=$conn->prepare("INSERT INTO rent(tyepofhouse,neighborhod,valuerent,waypay,dates,lease,name,regularity,phone)VALUES(:na,:ne,:r,:b,:t,:yt,:a,:vv,:ba)");
	if ($res->execute(array(':na'=>$na,':ne'=>$negh,':r'=>$val,':b'=>$waypay,':t'=>$dat,':yt'=>$da2,':a'=>$name,':vv'=>$reg,':ba'=>$phone))){
		$error="<div class='alert alert-success'>تم الحفظ</div>";
		header("location:adminsub.php?msg=".$error."");
	}

}

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require "header.php"; ?>
	<link rel="stylesheet" type="text/css" href="../datepicker/css/datepickerdatepicker.css">
	<script src="../datepicker/js/bootstrap-datepicker.js"></script>
	<script >
		$(function(){
           $('#datepicker').datepicker();
		});
	</script>
</head>
<body>
<div class="container">
	<?php require "nan.php";
          require "asied.php";
	?>
	<div class="col-md-8">
		<form class="form-horizontal">
			<div class="form-group">
				<label class="col-md-2">العقار</label>
				<div class="col-md-7">
					<input type="text" name="rentname" class="form-control" required>
			</div>
			</div>
				<div class="form-group">
				<label class="col-md-2">الحي</label>
				<div class="col-md-7">
					<input type="text" name="negh" class="form-control" required>
				</div>
				</div>
			<div class="form-group">
				<label class="col-md-2">قيمة الايجار</label>
				<div class="col-md-7">
					<input type="text" name="val" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2">طلايقة الدفع</label>
				<div class="col-md-5">
					<select class="form-control" name="waypay" required>
						<option>سنوي</option>
						<option>نص سنوي</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2">تاريخ الاستحقاق</label>
				<div class="col-md-3  ">
					<input type="text" name="dat" class="form-control " required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2">مدة الايجار</label>
				<div class="col-md-7">
					<input type="text" name="da2" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2">المستاجر</label>
				<div class="col-md-7">
					<input type="text" name="name" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2">الانتظام</label>
				<div class="col-md-5">
					<select class="form-control" name="reg" required>
						<option>منتظم</option>
						<option>غير منتظم</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2">الجوال</label>
				<div class="col-md-7">
					<input type="number" name="phone" class="form-control" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2"></label>
				<div class="col-md-7">
					<input type="submit" name="save" class="btn btn-success btn-block" value="حفظ">
				</div>
			</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>