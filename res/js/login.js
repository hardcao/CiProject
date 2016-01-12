$(document).ready(function(){

var username;
var password;




$("#btn_login").click(function(){
	

	username = $("#uname").val();
	password = $("#pass").val();

		if(username.length==0 || password.length==0){
			bootbox.alert("<strong style='text-align:center; color:maroon;'>Enter username or password</strong>");

		}else{
				
			$.ajax({
				url: window.location.origin+"/index.php/ajax/login",
				type: "post",
				data: "uname="+username+"&pass="+password,
				success: function(data){
					
					if(data==0){
						bootbox.alert("Invalid account");
					}else{
						window.location=window.location.origin+"/index.php/home";
					}

				},
			error : function(){
				bootbox.alert("Error");
				}

			});

		}
})


})

