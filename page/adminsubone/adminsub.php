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
 	<?php
require 'nan.php';
require 'asied.php';

if (isset($_GET['msg'])){
	echo $_GET['msg'];
}
?>


<div class="col-md-6 col-md-offset-2">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo "<h3>"."مرحبا ".$name."</h3>"; ?>
		</div>
	</div>
</div>
 

 </div>
</body>
</html>