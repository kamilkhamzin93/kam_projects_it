<?php
	
	define ('JS_FOLDER', 'js');
	define ('REG_FOLDER', 'reg');
	define ('AUTH_FOLDER', 'auth');
	define ('SEPARATOR', '/');
	define ('SCRIPT_NAME', 'script');
	define ('DOT', '.');
	define ('SCRIPT_EXT', 'js');
	
	define ('IMG_FOLDER', 'img/profile/');
	
	define ('TPLS_FOLDER', 'tpls');
	define ('NAV_FOLDER', 'nav');
	define ('LOGON_FOLDER', 'logon');
	define ('SEPARATOR', '/');
	define ('FILE_NAME', 'content');
	define ('DOT', '.');
	define ('EXTENSION', 'html');
	
	function load_navigation ($path) {
		
		if ($path == '') return;
		
		return include ($path);
		
	}
			
	function loadHead($title="main") {
		if ($title != '') $page_title = $title;
		else $page_title = "main";
		
		include ("tpls/head.html");
	}
	
	function loadContent($type="main") {
		if ($type != '') {
			include ("tpls/$type/content.html");
		} else return;
	}

	
	function get_navigation() {

		$logon = isset($_SESSION['login']) ? $_SESSION['login'] : null;
		
		if ($action != "logon" and $logon == '') {
			
			$file_path = TPLS_FOLDER . SEPARATOR . NAV_FOLDER . SEPARATOR . FILE_NAME . DOT . EXTENSION;
			$nav_result = load_navigation($file_path);
			
		} else {
			$file_path = TPLS_FOLDER . SEPARATOR . NAV_FOLDER . SEPARATOR . LOGON_FOLDER . SEPARATOR . FILE_NAME . DOT . EXTENSION;			
			$nav_result = load_navigation($file_path);
		}

		return $nav_result;
	}
	

	function correct_data($data) {
		$result = stripslashes($data);
		$result = htmlspecialchars($result);
		$result = trim($result);
		return $result;
	}

	
	function get_scripts() {
		
		$page = correct_data($_GET['page']);
		
		if ($page) {
			if ($page == "reg") {
				$file_path = JS_FOLDER . SEPARATOR . REG_FOLDER . SEPARATOR . SCRIPT_NAME . DOT . SCRIPT_EXT;

				$page_result = "<script src='" . $file_path ."' type='text/javascript'></script>";
			} else if ($page == "auth") {
				$file_path = JS_FOLDER . SEPARATOR . AUTH_FOLDER . SEPARATOR . SCRIPT_NAME . DOT . SCRIPT_EXT;

				$page_result = "<script src='" . $file_path ."' type='text/javascript'></script>";
			}
			
		} else return;
		
		echo $page_result;
		
	}
	
	$page = isset($_GET['page']) ? $_GET['page'] : null;	
	$act = isset($_GET['act']) ? $_GET['act'] : null;
	$page = correct_data($page);
	$act = correct_data($act);
	
	function get_title() {
		if (empty($_GET['page'])) $title = 'main';
		else $title = correct_data($_GET['page']);
		
		if ($title != '') {
			if ($title == 'main')
				$page_title = MAIN_PAGE_TITLE;
			else if ($title == 'reg') 
				$page_title = REG_PAGE_TITLE;
			else if ($title == 'auth')
				$page_title = AUTH_PAGE_TITLE;
			else if ($title == 'error')
				$page_title = ERR_PAGE_TITLE;
			else if ($title == 'agree')
				$page_title = AGREE_PAGE_TITLE;
			else if ($title == 'profile' or $title == 'logon')
				$page_title = PROFILE_PAGE_TITLE;
			else if ($title == 'edit')
				$page_title = EDIT_PROFILE_PAGE_TITLE;
			else if ($title == 'forgot')
				$page_title = FORGOT_PASSWORD_TITLE;
			else return;
		} 
		else return;
		
		echo $page_title;
	}
	
	function get_data_from_db($login) {
		$query = "SELECT * FROM `users` WHERE `login`='$login'";
		
		$result = @mysql_query($query);
		$rows = @mysql_fetch_array($result);

		return $rows;
	}	
	
	function correct_date($date) {
		
		return date("d.m.Y", strtotime($date));
		
	}
	
	function correct_date_in_db_time($date) {
		
		return date("Y-m-d", strtotime($date));
		
	}
	
	function upload_file($file) {
		
		
		
	}
	
	function update_fields_in_db($id) {
		$first_name = isset($_POST['first_name']) ? correct_data($_POST['first_name']) : null;
		$last_name = isset($_POST['last_name']) ? correct_data($_POST['last_name']) : null;
		$email = isset($_POST['email']) ? correct_data($_POST['email']) : null;
		$habits = isset($_POST['habits']) ? correct_data($_POST['habits']) : null;
		$age = isset($_POST['age']) ? correct_data($_POST['age']) : null;
		$picture = isset($_FILES['picture']['name']) ? $_FILES['picture']['name'] : null;
		$password = isset($_POST['user_password']) ? $_POST['user_password'] : null;
		
		$query = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `habits` = '$habits' WHERE `id`='$id'";		
		@mysql_query($query);
		
		
		if ($age != '') {
			$age = correct_date_in_db_time($age);		
			$query = "UPDATE `users` SET `age` = '$age' WHERE `id`='$id'";		
			@mysql_query($query);
		} 
		
		if ($_FILES['picture']['size'] != 0) {
			
			$query = "SELECT `picture` FROM `users` WHERE `id`='$id'";
			$row = mysql_fetch_array(mysql_query($query));
			if ($row['picture'] != '')
				unlink(IMG_FOLDER . basename(base64_decode($row['picture'])));
			
			$picture = base64_encode($picture);
			$tmp_pict = $_FILES['picture']['tmp_name'];
			
			$query = "UPDATE `users` SET `picture` = '$picture' WHERE `id` = '$id'";
			@mysql_query($query);
			
			$uploaddir = IMG_FOLDER . basename($_FILES['picture']['name']);
			
			if (!move_uploaded_file($tmp_pict, $uploaddir)) return;
		}
		
		if (StrLen($password) >= 8) {
			
			$query = "SELECT `password` FROM `users` WHERE `id`='$id'";
			$row = mysql_fetch_array(mysql_query($query));
			if (base64_decode($row['password']) == base64_encode($password)) {
				echo "Выберите, пожалуйста, другой пароль<br />";
				return;
			}
			
			$password = base64_encode($password);
			
			$query = "UPDATE `users` SET `password` = '$password'";
			mysql_query($query);
			
		}
		echo "<meta http-equiv='Refresh' content='0; ?page=profile' />";
		
	}
	
	function generate_password() {
		
		$chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
		$max = 10;
		$size = StrLen($chars)-1;
		
		$password = null;
		
		while ($max--)
			$password .= $chars[rand(0,$size)];
		
		return $password;
		
	}
	
	function reg_profile() {
		
		$login = isset($_POST['login']) ? correct_data($_POST['login']) : null;
		$first_name = isset($_POST['first_name']) ? correct_data($_POST['first_name']) : null;
		$last_name = isset($_POST['last_name']) ? correct_data($_POST['last_name']) : null;
		$email = isset($_POST['email']) ? correct_data($_POST['email']) : null;
		$habits = isset($_POST['habits']) ? correct_data($_POST['habits']) : null;
		$age = isset($_POST['age']) ? correct_data($_POST['age']) : null;
		$picture = isset($_FILES['picture']['name']) ? correct_data($_FILES['picture']['name']) : null;
		$age = correct_date_in_db_time($age);
		
		$files = $_FILES['picture'];
		$message = '';
				
		if ($login != '' and $first_name != '' and $last_name != '') {
			
			$count_query = "SELECT COUNT(`id`), `login` FROM `users` WHERE `login`='$login'";
			$result = mysql_fetch_assoc(mysql_query($count_query));
			if ($result['id'] > 0) {
				echo "Выберите, пожалуйста, другой логин<br /><br />";
				echo "<a href='?page=reg'>Назад</a>";
				return;
			}				

			$password = generate_password();
			
			echo "Ваш пароль - $password<br /><br />";
			
			$password = base64_encode($password);
			
			$reg_query = "INSERT INTO `users` (`first_name`, `last_name`, `age`, `email`, `habits`, `picture`, `login`, `password`, `time`) VALUES ('$first_name', '$last_name', '$age', '$email', '$habits', '$picture', '$login', '$password', NOW())";	
			
			mysql_query($reg_query);
						
			$uploaddir = IMG_FOLDER . basename($_FILES['picture']['name']);
		
			if (!move_uploaded_file($_FILES['picture']['tmp_name'], $uploaddir)) return;
						
			echo "<a href='?page=main'>Back</a>";
			
			
		} else { 
			echo "Заполните, пожалуйста, все поля<br /><br />";
			echo "<a href='?page=reg'>Назад</a>";
		} 
		
	}
	
	function recover_password() {
		
		$email_string = isset($_POST['email']) ? correct_data($_POST['email']) : null;
		
		$get_query = "SELECT * FROM `users` WHERE `email` = '$email_string'";
		if (mysql_num_rows(mysql_query($get_query)) == 1) {
			$rows = mysql_fetch_array(mysql_query($get_query));	
			
			$to = $rows['email'];
			$subject = 'Восстановление пароля';
			$message = 	"Ваш логин: " . $rows['login'] . '<br />';
			$message .=	"Ваш пароль - " . base64_decode($rows['password']);
			$headers = 'From: noreply@itprojects.localhost' . "\r\n".
					'Reply-To: noreply@itprojects.localohost' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
					
			mail($to, $subject, $message, $headers);
			
			echo "<h4>Всю необходимую информацию для восстановления аккаунта мы отправили по указанному e-mail.</h4>";
			
			echo "<meta http-equiv='Refresh' content='10; ?page=auth' />";
			

		} else {
			echo "К сожалению, на нашем сайте пользователь с таким e-mail не регистрировался.";
		}
			

		echo "<br /><br /><a href='?page=forgot'>Back</a>";
		return;
		
	}
	
	function get_users_data() {
		$get_query = "SELECT * FROM `users` LIMIT 10";
		$result = mysql_query($get_query);
		$rows = mysql_fetch_assoc($result);
		return $rows;
	}
	
	
?>