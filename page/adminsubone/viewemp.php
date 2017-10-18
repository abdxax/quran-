<?php
require 'connection.php';
session_start();

$error='';
if (isset($_SESSION['id'])&& isset($_SESSION['pass'])==true){
$res=$res=$conn->prepare("SELECT * FROM admin WHERE id_gov=:id AND password=:pass");
if($res->execute(array(':id'=>$_SESSION['id'],':pass'=>$_SESSION['pass']))){
 foreach ($res as $row) {
 	if($row['role']=='adminsup1'){
          
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
$name='';
$id='';
$phone='';
$tim='';


i
if (isset($_GET['ids'])){

	$res=$conn->prepare("SELECT * FROM employess WHERE id_gov=:id");
	$res->execute(array(':id'=>$_GET['ids']));
	$type="";
	foreach ($res as $row) {
		$name=$row['name'];
		$id=$row['id_gov'];
		$phone=$row['phone'];
		
		$tim=$row['tim'];
		$to=$row['toends'];
	}

}
$pr='';
if (isset($_GET['edit'])){
	$name=$_GET['name'];
	$id=$_GET['id'];
	$pr=$id;
	$phone=$_GET['phone'];
	$tim=$_GET['time'];
	$total=0;
	$date=date("Y-m-d h:i:sa");
	$toe=$_GET['to'];
	$start='';

	$res=$conn->prepare("UPDATE employess SET name=:name,phone=:phone,tim=:tim,toends=:to WHERE id_gov=:id ");
	if ($res->execute(array(':name'=>$name,':phone'=>$phone,':tim'=>$tim,':to'=>$toe,':id'=>$pr))){
          $emo=$conn->prepare("SELECT * FROM byday WHERE id_gov=:id");
          if ($emo->execute(array(':id'=>$pr))){
               foreach ($emo as $row) {
               	$total+=$row['total'];
               }
               $emo1=$conn->prepare("UPDATE  byweek SET total=:tot,ends=:en WHERE id_gov=:id");
               if($emo1->execute(array(':tot'=>$total,':en'=>$date,':id'=>$pr))){
                        $emp=$conn->prepare("SELECT * FROM byweek WHERE id_gov=?");
                        $emp->execute(array($id));
                        foreach ($emp as $row) {
                        	$start=$row['start'];
                        }

               	$emo4=$conn->prepare("INSERT INTO endweek (name,id_gov,start,ends,total,phone)VALUES (:name,:id,:start,:ends,:total,:phone)");
               	if ($emo4->execute(array(':name'=>$name,':id'=>$id,':start'=>$start,':ends'=>$date,':total'=>$total,':phone'=>$phone))){

               		$emo2=$conn->prepare("INSERT INTO byweek (id_gov,start,tims)VALUES (?,?,?)");
               	if($emo2->execute(array($pr,$date,$tim))){
                   $emo3=$conn->prepare("DELETE FROM byday WHERE id_gov=?");
                   if($emo3->execute(array($pr))){
                   	$error="<div class='alert alert-success'>تم التعديل </div>'";
		header("location:edit_empl.php?msg=".$error."");
                   }
               	}
               	

               	}
               }
          }




		//$error="<div class='alert alert-success'>تم التعديل </div>'";
		//header("location:edit_empl.php?msg=".$error."");
	}
	else{
		$error="<div class='alert alert-danger'>لم يتم التعديل حاول مره اخرى </div>'";
	}
}

if (isset($_GET['delet'])){
$id=$_GET['id'];
	$pr=$id;
	$res=$conn->prepare("DELETE FROM employess WHERE id_gov=:id");
	if ($res->execute(array(':id'=>$pr))){
		$error="<div class='alert alert-success'>تم التعديل </div>'";
		header("location:edit_empl.php?msg=".$error."");
	}
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
	<div class="col-md-8">
	<?php echo $error; ?>
	<form class="form-horizontal"> 
		<div class="form-group">
			<label class="col-md-2 control-label">الاسم </label>
			<div class="col-md-6">
				<input type="text" name="name" class="form-control" required value=<?php echo $name; ?>>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-2 control-label">الرقم الوظيفي </label>
			<div class="col-md-6">
				<input type="number" name="id" class="form-control" readonly value=<?php echo $id; ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">رقم الجوال </label>
			<div class="col-md-6">
				<input type="number" name="phone" class="form-control"  value=<?php echo $phone; ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">الفترة </label>
			<div class="col-md-6">
				<input type="text" name="time" class="form-control" required value=<?php echo $tim; ?>>
			</div>
			<div class="col-md-6 col-md-offset-2">
				<input type="text" name="to" class="form-control" required value=<?php echo $to; ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label"></label>
			<div class="col-md-6">
				<input type="submit" name="edit" class="btn btn-success btn-block" value="تعديل">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label"></label>
			<div class="col-md-6">
				<input type="submit" name="delet" class="btn btn-danger btn-block" value="حذف">
			</div>
		</div>
	</form>

</div>
	
</div>


</body>
</html>