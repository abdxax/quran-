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
	<?php require 'header.php';?>
</head>
<body>
       <div class="container">
       	<?php require 'nan.php';
       require 'asied.php';
       ?>
           
           	<div class="col-md-3">
           		<a href="byday.php">
           			<div class="panel panel-default">
           				<div class="panel-heading text-center" >
           				<div class="row">
           				<i class="glyphicon glyphicon-euro" style="font-size: 2.5em"></i>
           				<div style="font-size: 1.2em">
           					الدخل اليومي
           				</div>
           				</div>
           				
           				</div>
           					
           			</div>
           		</a>
           	</div>

           	<div class="col-md-3">
           		<a href="byweek.php">
           			<div class="panel panel-default">
           				<div class="panel-heading text-center">
           					<div class="row">
           						<i class="glyphicon glyphicon-calendar" style="font-size: 2.5em"></i>
           						<div style="font-size:1.2em ">
           							نهاية الدورة 
           						</div>
           					</div>
           				</div>
           				
           			</div>
           		</a>
           	</div>

            <div class="col-md-3">
              <a href="hostry.php">
                <div class="panel panel-default">
                  <div class="panel-heading text-center">
                    <div class="row">
                      <i class="glyphicon glyphicon-calendar" style="font-size: 2.5em"></i>
                      <div style="font-size:1.2em ">
                        جميع الدورات 
                      </div>
                    </div>
                  </div>
                  
                </div>
              </a>
            </div>
           </div>

       </div>
</body>
</html>