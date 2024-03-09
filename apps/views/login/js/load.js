$(function() {
		

	$('.pass_show').append('<i class="fa fa-eye-slash ptxt" title="Show password"></i>'); 
	
	$(".username").focus();
	$("#runLogin").submit(function(e) {
		e.preventDefault();
		$.ajax({
			url: URL + "login/runLogin",
			type: "POST",
			data: $("#runLogin").serialize(),
			cache: false,
			beforeSend: function(){ $(".signIn").val('Connecting...');},
			success: function(html){
				var json = JSON.parse(html);
				if(json.success == true){
					window.setTimeout(function(){
						window.location.href = URL + "home";
					}, 1000);
					toastr.success(json.message, 'Success');
				}
				else{
					$(".signIn").val('Sign In');
					toastr.error(json.message, 'Warning');
				}
			},
			error:function(xhr, status, error){
				toastr.error(error, 'Warning');
			}
		});
	});
});

$(document).on('click','.pass_show .ptxt', function(){ 
	$(this).toggleClass("fa fa-eye-slash fa fa-eye").prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
});