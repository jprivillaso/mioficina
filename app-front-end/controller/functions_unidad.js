// JavaScript Document

var nickUnit = '';

$(document).ready(function() {
	
	$(function(){
		init();
	});
	
	$(window).load(function () {
		$("#loading").animate({"opacity":"0"},1000,function(){$("#loading").css("display","none");});
	});
	//$("#loading").click(function(){cerrar();});
	
});
	
	function init(){
		LoadResources();
		checkNickUnit();
	}
	
	//load all resources logics
	function LoadResources(){
		loadScript(_SERVER_FRONT_END_ + 'net/net_functions.js');
	}
	
	function checkNickUnit(){
		nickUnit = $('#paramNickUnit').text();
		if(nickUnit != ''){
                    callService(false, _SERVER_MIDDLE_END_+'services/ServiceRegister.php', 'checkNickUnit', 'nickUnit='+nickUnit, 'post', 'bs_checkNickUnit', 'callbackCheckNickUnit', 'errCallService');
		}
	}
	
	function callbackCheckNickUnit(data){
		if(data.isValid == false){
			$('#content #header-content h1').html(nickUnit.toUpperCase());
			$('#content #preNickUnit').html('@' + nickUnit);
		}else{
			redirect('http://mioficina.co/app-front-end/');
		}
	}
	
	function login(userUser, userPassword){
		if(nickUnit != ''){
			callService(true, _SERVER_MIDDLE_END_+'services/ServiceLogin.php', 'loginIn', 'userUser='+ userUser +'&nickUnit='+ nickUnit +'&userPassword='+ userPassword, 'post', 'bs_checkLogin', 'callbackLogin', 'errCallService');
		}	
	}
	
	
	function callbackLogin(data){
		if(data.statusParam == true){
			if(data.name != false){
				if(data.isValidated == "1"){
					$('#msgForm').html('Hola ' + data.name + ' Bienvenido A MiUnidad.Com');
					redirect('http://mioficina.co/@'+ _NICK_UNIT_ + '/home/');
				}else{
					$('#msgForm').html('Hola ' + data.name + '  Debes Validar Tu Cuenta');
				}
			}else{
				$('#msgForm').html('El Usuario y/o Contrase&ntilde;a  Incorrectas');
			}
		}else{
			$('#msgForm').html('Error! Contacte con soporte@miunidad.com ');
		}
	}
	
	function bs_checkLogin(){   }
	
	function bs_checkNickUnit(){    }
	
	function errCallService(jqXHR, textStatus, errorThrown){
            console.log('ERR ' + textStatus);
        }