// JavaScript Document

// JavaScript Document

var userUser = '';

$(document).ready(function() {
	$(function(){
		init();
	});
});


	function init(){
		LoadResources();
	}
	
	//load all resources logics
	function LoadResources(){
		loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
	}
	
	function checkAccount(userUser, nickUnit, key){
		userUser = userUser;
		if(nickUnit != ''){
			callService(true, _SERVER_MIDDLE_END_+'services/ServiceLogin.php', 'checkAccount', 'userUser='+ userUser +'&nickUnit='+ nickUnit +'&key='+ key, 'post', 'bs_checkAccount', 'callbackCheckAccount', 'errCallService');
		}	
	}
	
	
	function callbackCheckAccount(data){
		if(data.statusParam == true){
			if(data.isValidated == true){
					$('#checkAccount').html('<h1>Apreciado ' + data.name + ', Su Cuenta '+ userUser +' Fue Validada Correctamente. </h1><br /><br /><p><a href="#">Acceder A Mi Cuenta</a></p>');
			}else{
				$('#checkAccount').html('<h1>ERROR: Su Cuenta No Fue Validada ó No Existe! Verfique El Enlace Para Ingresar. </h1>');
			}
		}else{
			//params!
		}
		
	}
	
	function bs_checkAccount(){
		//
	}
	
	function errCallService(){
		alert('ERR');
	}