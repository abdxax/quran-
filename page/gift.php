<?php
require '../connection.php';
session_start();

$name="";
if (isset($_SESSION['id'])&& isset($_SESSION['pass'])==true){
$res=$res=$conn->prepare("SELECT * FROM admin WHERE id_gov=:id AND password=:pass");
if($res->execute(array(':id'=>$_SESSION['id'],':pass'=>$_SESSION['pass']))){
 foreach ($res as $row) {
 	if($row['role']=='admin'){
          $name=$row['name'];
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
$msg="";
if (isset($_GET['sub'])){
	$res=$conn->prepare("INSERT INTO gift (type,price) VALUES (?,?)");
	if ($res->execute(array($_GET['name'],$_GET['price']))){
$msg="<div class='alert alert-success'>تم الحفظ</div>";
	}
	else{
$msg="<div class='alert alert-danger'>تم الحفظ</div>'";
	}
}

if (isset($_GET['id'])){
	$res=$conn->prepare("DELETE FROM gift WHERE id=?");
	$res->execute(array($_GET['id']));
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require 'header.php'; ?>
</head>
<body>
<?php require 'nan.php';
     require 'asied.php';

     echo $msg;
 ?>

 <div class="container">
 <div class="col-md-5 ">
 	<form class="inline">
 		<div class="form-group">
 			<input type="text" name="name" class="form-control" placeholder="نوع الكفاله">
 			
 		</div>
 		<div class="form-group">
 			
 			<input type="number" name="price" class="form-control" placeholder="مبلغ الكفاله">
 		
 		</div>
 		<div class="form-group">
 			
 			<input type="submit" name="sub" class="btn btn-success" placeholder="حفظ">
 		</div>
 	</form>
 </div>

 <div class="col-md-5 col-md-offset-2">
 	<table class="table">
 		<thead>
 			<tr>
 				<th>نوع الكفاله</th>
 				<th>المبلغ</th>
 				<th>حذف</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php 
              $res=$conn->prepare("SELECT * FROM gift");
              $res->execute();
              foreach ($res as $row) {
              	echo '
                     <tr>
                       <th>'.$row['type'].'</th>
                       <th>'.$row['price'].'</th>
                       <th><a href="gift.php?id='.$row['id'].'" class="btn btn-danger">حذف </a></th>

                     </tr>

              	';
              }
 			?>
 		</tbody>
 	</table>
 </div>
 	
 </div>
</body>
</html>