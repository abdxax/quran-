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
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require "header.php";?>
</head>
<body>
<div class="container">
	<?php require 'nan.php';
          require 'asied.php';
	 ?>
<div class="col-md-8">
<?php  if (isset($_GET['msg'])){
	echo $_GET['msg'];
}

?>
<img src="../gm.png" class="img-responsire center-block visible-print">
  <span class="h3 text-center visible-print ">كشف الايجارات </span>

	<table class="table hidden-print">
	 	<thead>
	 		<tr>
	 			<th>العقار</th>
	 			<th>الحي</th>
	 			<th>قيمة الايجار</th>
	 			<th>طريقة الدفع</th>

	 			<th>تاريخ الاستحقاق</th>
	 			<th>مدة الايجار</th>
	 			<th>المستاجر</th>
	 			<th>الانتظام</th>
	 			<th>رقم الجوال</th>
	 		</tr>
	 	</thead>
	 	<tbody>
	 		<?php
              $res=$conn->prepare("SELECT * FROM rent ORDER BY id DESC");
              $res->execute();
              
              foreach ($res as $row) {
              	
              	 echo'
                  <tr>
                    <td><a href="viewlist.php?item='.$row['id'].'">'.$row['tyepofhouse'].'</a></td>
                    <td>'.$row['neighborhod'].'</td>
                    <td>'.$row['valuerent'].'</td>
                    <td>'.$row['waypay'].'</td>
                    <td>'.$row['dates'].'</td>
                    <td>'.$row['lease'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['regularity'].'</td>
                    <td>'.$row['phone'].'</td>
                  


                  </tr>


              	';
              }


	 		?>
	 	</tbody>
	 </table>


<div class="table-responsive">
	<table class="table table-bordered visible-print">
	 	<thead>
	 		<tr>
	 			<th>العقار</th>
	 			<th>الحي</th>
	 			<th>قيمة الايجار</th>
	 			<th>طريقة الدفع</th>

	 			<th>تاريخ الاستحقاق</th>
	 			<th>مدة الايجار</th>
	 			<th>المستاجر</th>
	 			<th>الانتظام</th>
	 			<th>رقم الجوال</th>
	 		</tr>
	 	</thead>
	 	<tbody>
	 		<?php
              $res=$conn->prepare("SELECT * FROM rent ORDER BY id DESC");
              $res->execute();
              
              foreach ($res as $row) {
              	
              	 echo'
                  <tr>
                    <td>'.$row['tyepofhouse'].'</td>
                    <td>'.$row['neighborhod'].'</td>
                    <td>'.$row['valuerent'].'</td>
                    <td>'.$row['waypay'].'</td>
                    <td>'.$row['dates'].'</td>
                    <td>'.$row['lease'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['regularity'].'</td>
                    <td>'.$row['phone'].'</td>
                  


                  </tr>


              	';
              }


	 		?>
	 	</tbody>
	 </table>
</div>
	 
</div>
	 
</div>
</body>
</html>