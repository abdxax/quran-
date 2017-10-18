
<?php require '../connection.php';
         session_start();
         $id=$_SESSION['id'];
         $name='';
         $time='';
         $phone='';
         $msg='';
         $to='';
         $date=date("Y-m-d h:i:sa");
         $res=$conn->prepare("SELECT * FROM employess WHERE id_gov=?");
         $res->execute(array($id));
         foreach ($res as $s) {
         	$name=$s['name'];
         	$time=$s['tim'];
         	$phone=$s['phone'];
            $to=$s['toends'];
         }

            if (isset($_POST['save'])){
            	$sell=$_POST['selling'];
            	$sta=$_POST['sta'];
            	$sf=$_POST['sf'];
            	$gift=$_POST['gift'];
                $total=$sell+$sta+$sf+$gift;

                $inst=$conn->prepare("INSERT INTO program (id_gov,sellinpoint,STA,SF,GIFT,total,da)VALUES (:id,:sell,:sta,:sf,:gift,:total,:da)");
               if($inst->execute(array(':id'=>$id,
                                     ':sell'=>$sell,
                                     ':sta'=>$sta,
                                     ':sf'=>$sf,
                                     ':gift'=>$gift,
                                     ':total'=>$total,
                                     ':da'=>$date
                	                   ))) {
                $res=$conn->prepare("INSERT INTO byday (id_gov,day,total)VALUES(:id,:day,:total)");
            if ($res->execute(array('id'=>$id,':day'=>$date,':total'=>$total))){
                $msg="<div class='alert alert-success'> 
                  تم الحفظ 
               </div>";
            }
               	
               }
              else{
              	$msg="<div class='alert alert-danger'> 
                  لم يحفظ
               </div>";
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
<?php require 'imd.php';?>
<div class="container">
	<div class="text-center">
		<span class="h4">
			معلومات الموظف 
		</span>
	</div>
<?php echo $msg;?>
	<div class="col-md-7  col-md-offset-2">
		<table class="table">
			
				<tr>
				    <th>الاسم </th>
					<td><?php echo $name;?></td>
                    <td></td>
					
				</tr>
				<tr>
				    <th>الرقم الوظيفي </th>
					<td><?php echo $id?></td>
                    <td></td>
					
				</tr>
				<tr>
				     <th>الفترة </th>
					<td><?php echo 'من '. $time;?></td>
                    <td><?php echo 'الى '. $to;?></td>
					
				</tr>
				<tr>
				    <th>رقم الجوال </th>
					<td><?php echo $phone;?></td>
                    <td></td>
					
				</tr>
			
		</table>
	</div>

<div class="clearfix" style="margin-top: 100px"></div>
	<div class="col-md-9 col-md-offset-1">
		<div class="panel panel-default ">
			<div class="panel-heading text-center">
				<h4>معلومات التبرعات </h4>
			</div>
             <div class="panel-body">
             	<form class="form-horizontal" method="POST">
             	<div class="form-group">
             		<label class="col-md-2 control-label">مبلغ نقاط البيع</label>
             		<div class="col-md-7">
             			<input type="number" step="0.01" name="selling" class="form-control" required>
             		</div>
             	</div>

             	<div class="form-group">
             		<label class="col-md-2 control-label">مبلغ الاستقطاع</label>
             		<div class="col-md-7">
             			<input type="number" step="0.01" name="sta" class="form-control" required >
             		</div>
             	</div>

             	<div class="form-group">
             		<label class="col-md-2 control-label">مبلغ الصدقة الاكتروانية</label>
             		<div class="col-md-7">
             			<input type="number" step="0.01" name="sf" class="form-control" required>
             		</div>
             	</div>

             	<div class="form-group">
             		<label class="col-md-2 control-label">هدية كفالة حلقات</label>
             		<div class="col-md-5">
             			<select name="gift" class="form-control">
                    <?php
                        $res=$conn->prepare("SELECT * FROM gift");
                        $res->execute();
                        foreach ($res as $row) {
                            echo"
                             <option value=".$row['price'].">".$row['type']."</option>

                            ";
                        }
                     ?>        
                        </select>
             		</div>
             	</div>
             	<div class="form-group">
             		<label class="col-md-2 control-label"></label>
             		<div class="col-md-7">
             			<input type="submit" name="save" class="btn btn-success btn-block" value="حفظ" >
             		</div>
             	</div>

             		
             	</form>
             </div>
		</div>
	</div>
</div>
</body>
</html>