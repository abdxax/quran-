<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require 'header.php';?>
</head>
<body>
<?php require 'imd.php';?>

<div class="container">
<?php
if (isset($_GET['error'])){
	echo "<div class='alert alert-danger'> الرقم الوظيفي او الرقم السري غير صحيح</div>";
}
?>
<div class="col-sm-6 col-sm-offset-3" style="margin-top: 60px">
	<div class="panel panel-default">
		<div class="panel-heading text-center">
			<h3>تسجيل دخول</h3>
		</div>

		<div class="panel-body">
			<form class="form-horizontal" action="login_ck.php" method="POST">
				<div class="form-group">
					<label class="col-md-3 control-label">الرقم الوظيفي</label>
					<div class="col-md-5">
						<input type="number" name="id" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">الرقم السري</label>
					<div class="col-md-5">
						<input type="password" name="pass" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-3 control-label">
					</label>
					<div class="col-md-5">
						<input type="submit" name="log" class="btn btn-success btn-block" value="تسجيل دخول">
					</div>
				</div>
				
					
				
			</form>
		</div>
	</div>
</div>
	

</div>
</body>
</html>