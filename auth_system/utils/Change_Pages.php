<?php

	define("MAIN_PAGE_TITLE", "Главная страница сайта");
	define("REG_PAGE_TITLE", "Регистрация нового пользователя");
	define("AUTH_PAGE_TITLE", "Авторизация пользователя");
	define("ERR_PAGE_TITLE", "Упс.. Что-то произошло");
	define("AGREE_PAGE_TITLE", "Лицензионное соглашение");
	define("CHECKING_PAGE_TITLE", "Проверка данных пользователя");
	define("PROFILE_PAGE_TITLE", "Профиль пользователя");
	define("EDIT_PROFILE_PAGE_TITLE", "Редактирование профиля");
	define("FORGOT_PASSWORD_TITLE", "Восстановление пароля");
	
		
	if (isset($_GET)) {
	
		if (!($page) or $page == "" or  $page == "main") { // main page
		

			loadHead();
			loadContent();
			
		} else if ($page == "reg") { // registration page
			$act = isset($_GET['act']) ? $_GET['act'] : null;
			$act = correct_data($act);
			
			if ($act == 'reg') {
				reg_profile();
			} else {
				loadHead('reg');
				loadContent('reg');
			}
			
		} else if ($page == "auth") { // authentification page
 			
			if (isset($_SESSION['login'])) {
				
				echo "<meta http-equiv='Refresh' content='0; ?page=profile' />";
				
			} else {
				loadHead('auth');
				include ("utils/Authentification.php");
				loadContent('auth');
			}
			
		} else if ($page == "agree") { // agreement page
		
			loadHead('agree');
			loadContent('agree');
			
		} else if ($page == "edit") { // edit page
		
			if (isset($_GET['act']) and $_GET['act'] == 'update' and $_GET['id'] != null) {
				
				update_fields_in_db($_GET['id']);
				
			} else {
				loadHead('edit');
				loadContent('edit');
			}
			
		} else if ($page == "profile") { // profile page
		
			loadHead('logon');
			loadContent('logon');
			
		} else if ($page == "forgot") { // password forgot page
		
			if (isset($_GET['act']) and $_GET['act'] == 'recover') {
				
				recover_password();
				
			} else {
				loadHead('forgot');
				loadContent('forgot');
			}
			
		} else if ($page == "close") {
			
			$_SESSION['login'] = null;
			echo "<meta http-equiv='Refresh' content='0; ?page=auth' />";
			
		} else { // error page
			
				
			if (isset($_SESSION['login'])) loadHead("logon");
			else loadHead('error');
			
			loadContent('error');
			
		}
		
	} 
	

?>