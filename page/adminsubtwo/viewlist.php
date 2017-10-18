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

$na='';
	$negh='';
	$val='';
	$waypay='';
	$dat='';
	$da2='';
	$name='';
	$reg='';
	$phone='';
	$date='';
	$id='';
	$msg='';
if (isset($_GET['item'])){

	$id=$_GET['item'];
	$ids=$_GET['item'];
	$sql=$conn->prepare("SELECT * FROM rent WHERE id=?");
if ($sql->execute(array($ids))){

	
	foreach ($sql as $row) {
	$na=$row['tyepofhouse'];
     $negh= $row['neighborhod'];
    $val = $row['valuerent'];
       	$waypay=$row['waypay'];
         $dat=$row['dates'];
         $da2 =$row['lease'];
         $name =$row['name'];
         $reg = $row['regularity'];
           $phone= $row['phone'];
           $id=$row['id'];
	}
}
}



if (isset($_GET['edit'])) {
	
	
	$na=$_GET['rentname'];
	$negh=$_GET['negh'];
	$val=$_GET['val'];
	$waypay=$_GET['waypay'];
	$dat=$_GET['dat'];
	$da2=$_GET['da2'];
	$name=$_GET['name'];
	$reg=$_GET['reg'];
	$phone=$_GET['phone'];
	$id=$_GET['id'];
	

	$res=$conn->prepare("UPDATE rent SET tyepofhouse=:na,neighborhod=:ne,valuerent=:r,waypay=:b,dates=:t,lease=:yt,name=:a,regularity=:vv,phone=:ba WHERE id=:id");
	if ($res->execute(array(':na'=>$na,':ne'=>$negh,':r'=>$val,':b'=>$waypay,':t'=>$dat,':yt'=>$da2,':a'=>$name,':vv'=>$reg,':ba'=>$phone,':id'=>$id))){
		$msg="<div class='alert alert-success'>تم الحفظ</div>";
		header("location:list.php?msg=".$msg."");
	}
	else{
		$msg="<div class='alert alert-danger'>لم يحفظ ح اول مرة اخرى</div>";
	}

}

if (isset($_GET['delet'])){
      $de=$id;
	$del=$conn->prepare("DELETE FROM rent WHERE id=:id");
	if ($del->execute(array(':id'=>$_GET['id']))){
		$msg="<div class='alert alert-success'>تم الحذف </div>";
		header("location:list.php?msg=".$msg."");
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
	
</head>
<body>
<div class="container">
	<?php require "nan.php";
          require "asied.php";
          echo $msg;
	?>
	<div class="col-md-8">
		<form class="form-horizontal">
			<div class="form-group">
				<label class="col-md-2">العقار</label>
				<div class="col-md-7">
					<input type="text" name="rentname" class="form-control" required  value=<?php echo $na; ?>>
			</div>
			</div>
			
				<div class="form-group">
				<label class="col-md-2">الحي</label>
				<div class="col-md-7">
					<input type="text" name="negh" class="form-control" required value=<?php echo $negh; ?>>
				</div>
				</div>
			<div class="form-group">
				<label class="col-md-2">قيمة الايجار</label>
				<div class="col-md-7">
					<input type="text" name="val" class="form-control" required value=<?php echo $val; ?>>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2">طلايقة الدفع</label>
				<div class="col-md-5">
					<select class="form-control" name="waypay" required >
						<option <?php if ($waypay=='سنوي')  ?> >سنوي</option>
						<option <?php if ($waypay=='نص سنوي') echo "selected"; ?> >نص سنوي</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2">تاريخ الاستحقاق</label>
				<div class="col-md-3  ">
					<input type="text" name="dat" class="form-control " required value=<?php echo $dat; ?>>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2">مدة الايجار</label>
				<div class="col-md-7">
					<input type="text" name="da2" class="form-control" required value=<?php echo $da2; ?>>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2">المستاجر</label>
				<div class="col-md-7">
					<input type="text" name="name" class="form-control" required value=<?php echo $name; ?>>
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
					<input type="number" name="phone" class="form-control" required value=<?php echo $phone; ?>>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2"></label>
				<div class="col-md-7">
					<input type="submit" name="edit" class="btn btn-success btn-block" value="تعديل">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2"></label>
				<div class="col-md-7">
					<input type="submit" name="delet" class="btn btn-danger btn-block" value="حذف">
				</div>
			</div>
			</div>

			<div class="form-group">
				
				<div class="col-md-7">
					<input type="hidden" name="id" class="form-control" required  value=<?php echo $id; ?>>
			</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>