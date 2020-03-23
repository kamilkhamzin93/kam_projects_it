	
	function submit_ok() {
		
		let submit_btn	= document.getElementById('submit_btn');
		let agree 		= document.getElementById('agreement_check');

		submit_btn.disabled = !agree.checked;
			
/* 		let login 		= document.getElementById('login').value;
		let	last_name 	= document.getElementById('last_name').value;
		let first_name 	= document.getElementById('first_name').value;
		let age_date 	= document.getElementById('age_date').value;
		let email 		= document.getElementById('email').value;
		let habits 		= document.getElementById('habits').value;
		let picture 	= document.getElementById('picture');
		let agree 		= document.getElementById('agreement_check');	
			
		if (login == '' || first_name == '' || last_name == '' || 
			email == '' || age_date == '' || habits == '' || picture.src == '') { 
			alert('Заполните, пожалуйста, необходимые поля');
		}  */
	}