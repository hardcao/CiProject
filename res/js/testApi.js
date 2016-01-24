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
				url: window.location.origin+"/"+password,
				type: "post",
				data:{
					FID:17,
					projectId:27,
					startDate:'2013-09-01 09:50:00',
					endDate:'2016-09-01 09:50:00',
					uname:'',
					userId:1,

				},
				success: function(data){
					bootbox.alert(data);

				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
					bootbox.alert(XMLHttpRequest.responseText);
		        }

			});

		}
})


})

