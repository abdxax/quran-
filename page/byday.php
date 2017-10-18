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
<
<span class="h3 text-center visible-print"> كشف ايردات الموظف اليومية</span>

  <div class="col-sm-6 col-sm-offset-3 hidden-print ">
  <div class="panel panel-default">
    <div class="panel panel-heading">
     <span class="h4">بحث</span> 
    </div>
    <div class="panel-body">
      <form class="inline" action="achem.php" >
        <input type="text" name="id" placeholder="رقم الوظيفي" class="col-md-8 form-control">
        <input type="submit" name="sub" class="btn btn-success " value="بحث">
      </form>
    </div>
  </div>
</div>

	<table class="table hidden-print">
	 	<thead>
	 		<tr>
	 			<th>الاسم</th>
	 			<th>الرقم الوظيفي</th>
	 			<th>رقم الجوال</th>
	 			<th>الفتره</th>
        <th>التاريخ</th>
        <th>نقاط البيع</th>
        <th>الاستقطاع</th>
        <th>الصدقة الالكتروانية</th>
        <th>هدية كفالة حلقات</th>
        <th>المجموع</th>

	 		</tr>
	 	</thead>
	 	<tbody>
	 		<?php
              $res=$conn->prepare("SELECT * FROM employess,program WHERE employess.id_gov=program.id_gov ORDER BY program.id_gov ASC");
              $res->execute();
             foreach ($res as $row) {
              echo'
                  <tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['id_gov'].'</td>
                    <td>'.$row['phone'].'</td>
                     <td>'.$row['tim'].'</td>
                     <td>'.$row['da'].'</td>
                     <td>'.$row['sellinpoint'].'</td>
                     <td>'.$row['STA'].'</td>
                     <td>'.$row['SF'].'</td>
                     <td>'.$row['GIFT'].'</td>
                     <td>'.$row['total'].'</td>


                  </tr>

 

                ';
             }
              	 
              


	 		?>
	 	</tbody>
	 </table>


 
<div class="table-condensed ">
  
<table class="table table-bordered visible-print">
    <thead>
      <tr>
        <th>الاسم</th>
        <th>الرقم الوظيفي</th>
        <th>رقم الجوال</th>
        <th>الفتره</th>
        <th>التاريخ</th>
        <th>نقاط البيع</th>
        <th>الاستقطاع</th>
        <th>الصدقة الالكتروانية</th>
        <th>هدية كفالة حلقات</th>
        <th>المجموع</th>

      </tr>
    </thead>
    <tbody>
      <?php
              $res=$conn->prepare("SELECT * FROM employess,program WHERE employess.id_gov=program.id_gov ORDER BY program.id_gov ASC");
              $res->execute();
             foreach ($res as $row) {
              echo'
                  <tr>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['id_gov'].'</td>
                    <td>'.$row['phone'].'</td>
                     <td>'.$row['tim'].'</td>
                     <td>'.$row['da'].'</td>
                     <td>'.$row['sellinpoint'].'</td>
                     <td>'.$row['STA'].'</td>
                     <td>'.$row['SF'].'</td>
                     <td>'.$row['GIFT'].'</td>
                     <td>'.$row['total'].'</td>


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