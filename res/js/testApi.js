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
					projectId:42,
					startDate:'2013-09-01 09:50:00',
					endDate:'2016-09-01 09:50:00',
					subscribeStartDate:'2013-09-01 09:50:00',
					subscribeEndDate:'2016-09-01 09:50:00',
					uname:'',
					uid:1368,

					addUserId:"3328:11111",
					updUserId:"",
					delUserId:"",
					uname:'admin',
					uid:5517,

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

