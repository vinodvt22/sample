<!-- This is a test for git-->
<html>
	<head>
		<title>
			Upoad CSV
		</title>
		<script type="text/javascript">
			function validate(){
				if(document.getElementById('sel_type').value == ""){
					alert("Select Any Option!!!");
					document.getElementById('sel_type').focus();
					return false;
				}
				else if(document.getElementById('file_csv').value == ""){
					alert("Select a File!!!");
					document.getElementById('file_csv').focus();
					return false;
				}
				else{
					return true;
				}
			}
		</script>
	</head>
	<body>
		<center>
			<h1>Upload CSV</h1>
			<form action="csv_upload_action.php" method="post" enctype="multipart/form-data">
				<table>
					<tr>
						<td>CSV File Type</td>
						<td><select name="sel_type" id="sel_type">
							<option value="" selected>--Select--</option>
							<option value="email">Emails Only</option>
							<option value="name">Names Only</option>
							<option value="email_name">Emails and Names</option>	
						</select></td>
					</tr>
					<tr>
						<td>Select</td>
						<td><input type="file" name="file_csv" id="file_csv"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="bt_sub" value="Submit" onclick="return validate();"></td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>