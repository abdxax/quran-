<?php
require '../connection.php' ;
session_start();
$error='';
if (isset($_POST['submit'])){
	$id_g=$_POST['id'];
//$res=$conn->query("SELECT * FROM employess WHERE id_gov='$id_g'");
$res=$conn->prepare("SELECT * FROM employess WHERE id_gov=:id");
$res->execute(array(':id'=>$id_g));
//$num=$resu->rowCount();
if($res->rowCount()==1 ){
	foreach ($res as $row) {
		$_SESSION['id']= $row['id_gov'];
		header("location:insert.php");
	}
}
else{
	$error="<div class='alert alert-danger text-right'>
         لا يوجد موظف يحمل الرقم الوظيفي المدخل ارجو التاكد
	</div>";
}

}



?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require 'header.php'; ?>
</head>
<body>
<div class="container">
<?php require 'imd.php'; 
echo $error;
?>

<div class="col-md-6 col-md-offset-5">
	<form class="form-inline" method="POST" >
		
<input type="number" name="id" class="form-control " placeholder="ادخل الرقم الوظيفي">
<input type="submit" name="submit" class="btn btn-success " value="ابحث">

	</form>
</div>
	
</div>
</body>
</html>