
	function validateForm() {
		
		var login	= document.getElementById('user_login').value;
		var pass	= document.getElementById('user_password').value;
		var hint	= document.getElementById('hint');
		
		var login_expr	= /^[A-Za-z]+$/;
		
		if (login_expr.exec(login) == null) 
			hint.innerHTML = 'Убедитесь, пожалуйста, что раскладка на Вашей клавиатуре соответствует латинице.';
			
		if (pass.length < 10) 
			hint.innerHTML = 'Введите, пожалуйста, корректный пароль.';
	} 
	
