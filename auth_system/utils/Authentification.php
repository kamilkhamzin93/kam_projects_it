<?php

	$user_login = isset($_POST['user_login']) ? $_POST['user_login'] : null;	
	$user_password = isset($_POST['user_password']) ? $_POST['user_password'] : null;

	function destroy_vars() {
		unset($user_login);
		unset($user_password);
		unset($auth_submit);
		echo "<meta http-equiv='Refresh' content='3; ?page=auth' />";
	}
	
	
	$user_login = correct_data($user_login);
	echo $user_login."<br />";
	
	$user_password = correct_data($user_password);
	echo $user_password;
	
	$auth_submit = isset($_POST['auth_submit']) ? $_POST['auth_submit'] : null;

	if ($auth_submit) {
		
		if ($user_login == '' and $user_password == '') { 
			destroy_vars();			
		} else {
			$user_password = base64_encode($user_password);
			$get_fields_query = "SELECT * FROM `users` WHERE `login`='$user_login' AND `password`='$user_password'"; 
			$result = @mysql_query($get_fields_query);
		
			$rows = @mysql_fetch_array($result);
			
			if ($rows) {
				$_SESSION['login'] = $user_login;
				$_SESSION['password'] = $user_password;
				$_SESSION['id'] = correct_data($rows['id']);
				echo "<meta http-equiv='Refresh' content='0; ?page=auth&act=logon' />";
				
			} else {
				destroy_vars();
				echo "<meta http-equiv='Refresh' content='0; ?page=auth' />";
			}
		}
		
	}	

?>