<html>
	<head>
		<title>
			Upoad CSV
		</title>
		<script src="jquery.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$('.email_class').each(function(){
				 var email_id = $(this).attr('id');
				 var email=$('#'+email_id).val();
				 var val=IsEmail(email);
				 if(!val){
					 $("#"+email_id).focus();
					 $("#"+email_id).css("background-color", "yellow");
					 //return false;
				 }	
			});
			function IsEmail(email) {
				  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				  return regex.test(email);
			}
			 $('.rem_button').click(function(){
		          var id = $(this).attr('id');
		          $('#email'+id).remove();
		          $('#name'+id).remove();
		          $(this).remove();
		          $('#email'+id).val()=='';
		          $('#email'+id).val()=='';
		      });
		      $('#save').click(function(){
			      var v=0;
		    	  $('.email_class').each(function(){
						 var email_id = $(this).attr('id');
						 var email=$('#'+email_id).val();
						 var val=IsEmail(email);
						 if(!val){
							 $("#"+email_id).focus();
							 $("#"+email_id).css("background-color", "yellow");
							 v++;
							 return false;
						 }
					});
					if(v==0){
						var type=$('#csv_type').val();
						if(type=='name'){
							var res=confirm("Do You Want To Add Domain ?");
							if(res){
								}
							else{
								$('#frm').submit();
							}
						}
						else{
							$('#frm').submit();
						}
					}
			  });
		});
		</script>
	</head>
	<body>
		<form action="insert_csv.php" method="post" id="frm">
			<table>
				<?php 
				if($_POST){
					$i=0;
					if(!empty($_FILES)){
						$filename=$_FILES['file_csv']['tmp_name'];
						$filetype=$_FILES['file_csv']['type'];
						if($filetype!="application/vnd.ms-excel"){
							echo "Invalid File Type!!!";
							exit;
						} 
						//copy($_FILES["file_csv"]["tmp_name"],$_FILES["file_csv"]["name"]);
						$row = 1;
						$type=$_POST['sel_type'];
						if (($handle = fopen($filename, "r")) !== FALSE){
							$c=0;
							
					    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
					  			if($c!=0){
					  						if($data!=''){
					  								?>
						  							<tr>
						  								<td id="row_value">
						  									<?php 
						  										if($type=='name'){
						  									?>
						  									<input type="text" class="name_class" name="name<?php echo $i; ?>" id="name<?php echo $i; ?>" value="<?php echo $data[0];?>">
						  									<?php }
						  									if($type=='email'){
						  									?>
						  									<input type="text" class="email_class" name="email<?php echo $i; ?>" id="email<?php echo $i; ?>" value="<?php echo $data[0];?>">
						  									<?php }
						  									if($type=='email_name'){
						  									?>
						  									<input type="text" name="name<?php echo $i; ?>" id="name<?php echo $i; ?>" value="<?php echo $data[0];?>">
						  									<input type="text" class="email_class" name="email<?php echo $i; ?>" id="email<?php echo $i; ?>" value="<?php echo $data[1];?>">
						  									<?php }?>
						  									<input class="rem_button" type="button" id="<?php echo $i;?>" value="Remove">
						  								</td>
						  							</tr>
						  							<?php
						  							$i++;
					  					}
					  			}
					        	$c++;
							}
							
							fclose($handle);
						}
						
					}
				}
				?>
				<tr>
					<td><input type="button" id="save" value="Save"></td>
				</tr>
			</table>
			<input type="hidden" name="csv_type" id="csv_type" value=<?php echo $type; ?>>
			<input type="hidden" name="count" value=<?php echo $i; ?>>
		</form>
	</body>
</html>