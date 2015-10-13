$(document).ready(function() {
	
	$('#cedula, #id_denunciado,#CIuserlogin').keypress(function(e){
		keynum = window.event ? window.event.keyCode : e.which;
		if ((keynum == 8) || (keynum == 13))
			return true;
		return /\d/.test(String.fromCharCode(keynum));
	});

	$('#cedula,#usuario,#password').on('focus', function(event) {
		$("#mensaje").css('display', 'none');
	});
});