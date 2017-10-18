<?php
require 'connection.php';
session_start();

$name="";
if (isset($_SESSION['id'])&& isset($_SESSION['pass'])==true){
$res=$res=$conn->prepare("SELECT * FROM admin WHERE id_gov=:id AND password=:pass");
if($res->execute(array(':id'=>$_SESSION['id'],':pass'=>$_SESSION['pass']))){
 foreach ($res as $row) {
 	if($row['role']=='adminsup1'){
          $name=$row['name'];
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
<div class="col-md-8">
<?php
if (isset($_GET['msg'])){
  echo $_GET['msg'];
}
?>
	<table class="table">
	 	<thead>
	 		<tr>
	 			<th>الاسم</th>
	 			<th>الرقم الوظيفي</th>
	 			<th>رقم الجوال </th>
	 			<th>الفتره</th>
	 		</tr>
	 	</thead>
	 	<tbody>
	 		<?php
              $res=$conn->prepare("SELECT * FROM employess ORDER BY id_gov ASC");
              $res->execute();
             
              foreach ($res as $row) {
              	
              	 echo'
                  <tr>
                    <td><a href="viewemp.php?ids='.$row['id_gov'].'">'.$row['name'].'</a></td>
                    <td>'.$row['id_gov'].'</td>
                    <td>'.$row['phone'].'</td>
                     <td>'.$row['tim'].'</td>


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