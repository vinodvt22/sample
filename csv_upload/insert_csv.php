<?php 
$d=1;
if($_POST){
	$type=$_POST['csv_type'];
	$count=$_POST['count'];
	$con = mysql_connect("localhost","root","");
		if (!$con){
	  		die('Could not connect: ' . mysql_error());
		}
		mysql_select_db("csvdata", $con);
	  			if($type=='email'){
	  				for($i=0;$i<$count;$i++){
	  					if( isset($_POST['email'.$i]) && $_POST['email'.$i] !=''){
	  						$email =$_POST['email'.$i];
	  						$s=mysql_query("select count(*) from users where email='$email'");
		  					$num=mysql_fetch_array($s);
		  					if($num[0]==0){
		  						$sql=("insert into users(email)values('$email')");
		  						if (!mysql_query($sql,$con)){
			  						die('Error: ' . mysql_error());
		        				}
		        				else{
		        					$d=0;
		        				}
		  					}
	  					}
	  				}
	  		}
	  		if($type=='email_name'){
	  			for($i=0;$i<$count;$i++){
	  				if( isset($_POST['email'.$i]) && $_POST['email'.$i] !='' || isset($_POST['name'.$i]) && $_POST['name'.$i]!='' ){
	  					$name =$_POST['name'.$i];
	  					$email =$_POST['email'.$i];
	  					$s=mysql_query("select count(*) from users where email='$email'");
		  				$num=mysql_fetch_array($s);
		  				if($num[0]==0){
			  				$sql=("insert into users(name,email)values('$name','$email')");
			  				if (!mysql_query($sql,$con)){
				  				die('Error: ' . mysql_error());
			        		}
			        		else{
			        			$d=0;
			        		}
		  				}
	  				}
	        			
	  			}
	  		}
	  		if($type=='name'){
	  			for($i=0;$i<$count;$i++){
	  				if(isset($_POST['name'.$i]) && $_POST['name'.$i]!='' ){
	  					$name =$_POST['name'.$i];
		  				$sql=("insert into users(name)values('$name')");
		  				if (!mysql_query($sql,$con)){
			  				die('Error: ' . mysql_error());
		        		}
		        		else{
		        			$d=0;
		        		}
	  				}
	  			}
	  		}
	  		if($d==0){
	  			echo "Inserted!!!";
	  		}
	  		else{
	  			echo "Trying to Insert Same Email Id!!!";
	  		}
}
?>