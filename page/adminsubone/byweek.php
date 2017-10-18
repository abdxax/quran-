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


 if (isset($_GET['sun'])){
  $re=$conn->prepare("DELETE FROM byweek");
  $re->execute();
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
<?php  if (isset($_GET['msg'])){
	echo $_GET['msg'];
}

?>
	<img src="../../gm.png" class="img-responsire center-block visible-print">
  <span class="h3 text-center visible-print "> كشف ايرداة الموظف الاسبوعية</span>

<div class="col-sm-6 col-sm-offset-3 hidden-print ">
  <div class="panel panel-default">
    <div class="panel panel-heading">
     <span class="h4">بحث</span> 
    </div>
    <div class="panel-body">
      <form class="inline" action="ach.php" >
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
        <th>بداية الدورة</th>
        <th>نهاية الدورة</th>
        <th>المجموع</th>
        

      </tr>
    </thead>
    <tbody>
      <?php
              $res=$conn->prepare("SELECT * FROM employess,byweek WHERE employess.id_gov=byweek.id_gov AND byweek.ends!=? ORDER BY byweek.id_gov ASC");
              $res->execute(array('0000-00-00'));
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
              $res=$conn->prepare("SELECT * FROM employess,byweek WHERE employess.id_gov=byweek.id_gov AND byweek.ends!=? ORDER BY byweek.id_gov ASC");
              $res->execute(array('0000-00-00'));
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
<div class="col-md-5 col-md-offset-4 hidden-print">
   <form>
     
       <input type="submit" name="sun" class="btn btn-danger btn-block" value="مسح دورة الاسبوع الماضي">
    
   </form>
    </div>
</body>
</html>