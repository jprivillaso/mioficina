// JavaScript Document

	function clearForm(form){
		$(form + ' [type=text]').attr('value','');
		$(form + ' [type=password]').attr('value','');
		$(form + ' [type=checkbox]').attr('checked', false); 
	}