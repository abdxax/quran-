<?php

try{

	$conn=new PDO('mysql:host=localhost;dbname=quran;charset=utf8','root','');
	
}
catch(Exception $e){
	echo $e->getMessage();
}


?>