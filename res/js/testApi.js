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
					FID:2,
					projectId:39,
					startDate:'2013-09-01 09:50:00',
					endDate:'2016-09-01 09:50:00',
					subscribeStartDate:'2013-09-01 09:50:00',
					subscribeEndDate:'2016-09-01 09:50:00',
					addUserId:"3335:11111,3581:11111,3843:11111",
					updUserId:"3354:11111,3530:11111,3842:11111",
					delUserId:"3336:11111,3580:11111,3844:11111",
					uname:'admin',
					uid:3895,
					newsId:124,
					username:'lichangtao',
					password:'asdfas',
					queryType:0,
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

