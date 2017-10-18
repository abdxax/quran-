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




?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require 'header.php' ?>
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
  <span class="h3 text-center visible-print "> كشف ايرداة الموظف الاسبوعية</span>
<?php 
 



?>

	<table class="table hidden-print">
	 	<thead>
	 		<tr>
	 			<th>الاسم</th>
	 			<th>الرقم الوظيفي</th>
	 			<th>رقم الجوال</th>
	 			<th>الفتره</th>
        <th>بداية الدورة</th>
        <th>نهاية الدورة</th>
        <th>المجموع</th>
        

	 		</tr>
	 	</thead>
	 	<tbody>
	 		<?php
              $res=$conn->prepare("SELECT * FROM employess,bydweek WHERE employess.id_gov=bydweek.id_gov AND bydweek.ends!=? AND bydweek.id_gov=? ORDER BY bydweek.id_gov ASC");
              $res->execute(array('0000-00-00',$_GET['id']));
             foreach ($res as $row) {
              echo'
                  <tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['id_gov'].'</td>
                    <td>'.$row['phone'].'</td>
                     <td>'.$row['tims'].'</td>
                     <td>'.$row['start'].'</td>
                     <td>'.$row['ends'].'</td>
                     <td>'.$row['total'].'</td>
                     

                  </tr>

 

                ';
             }
              	 
              


	 		?>
	 	</tbody>
	 </table>
</div>
	 
</div>
<div class="table-responsive">

  <table class="table table-bordered visible-print">
    <thead>
      <tr>
        <th>الاسم</th>
        <th>الرقم الوظيفي</th>
        <th>رقم الجوال</th>
        <th>الفتره</th>
        <th>بداية الدورة</th>
        <th>نهاية الدورة</th>
        <th>المجموع</th>
        

      </tr>
    </thead>
    <tbody>
      <?php
              $res=$conn->prepare("SELECT * FROM employess,byweek WHERE employess.id_gov=byweek.id_gov AND byweek.ends!=? AND byweek.id_gov=? ORDER BY byweek.id_gov ASC");
              $res->execute(array('0000-00-00',$_GET['id']));
             foreach ($res as $row) {
              echo'
                  <tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['id_gov'].'</td>
                    <td>'.$row['phone'].'</td>
                     <td>'.$row['tims'].'</td>
                     <td>'.$row['start'].'</td>
                     <td>'.$row['ends'].'</td>
                     <td>'.$row['total'].'</td>
                     

                  </tr>

 

                ';
             }
                 
              


      ?>
    </tbody>
   </table>
</div>

</body>
</html>