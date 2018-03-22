<?php 
require 'MyDb.php';
$db = new MyDb();
$error='';
if (isset($_POST['type'])) {
	$error="detrmine the type";


 	 $type=$_POST['type'];
 	 $username = $_POST['username'];
     $password =md5($_POST['password']);
     if ($type =='user') {
     	if($db->login($username,$password)){
 			// echo "USER";
 			setcookie("username",$username,time()+ 10000);
 			setcookie("type",$type,time()+ 10000);

 			$rows = $db->getUser($username,$password);
 			foreach ($rows as $row ) {
 				
 				header("location:userprofile.php?id=" . $row['id']  ); 
 				 			}
 			//echo $rows['id'];
 			//header("location:userP.php?id="   );
 		}
 	}
 		else if ($type=='trainer') {
 	 		// echo "trainer";
 			setcookie("username",$username,time()+ 10000);
 			
 			setcookie("type",$type,time()+ 10000);

 			$rows = $db->getTr($username,$password);
 			
 			foreach ($rows as $row ) {
 			    
 			    $userid = $row['id'];
 		        setcookie("cookieid",$row['id'],time()+ 10000);
 		    
 			
				}
				$us = $db->gettrbyid($row['id']);
				foreach ($us as $u){
				    if($u['type'] == "admin")
				        header("location:admin.php");
				    else
				    	header("location:trainer.php?id=" . $userid);
				}
			
 	 	}
 		else{
 			header("location:login.php?error=1");
 		}
 	 
     }
 
     




 ?>