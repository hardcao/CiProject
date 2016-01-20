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
				data:{"data":[{ "FSUBSCRIBECONFIGRMRECORDID":1,
			    	"FBONUSTIMES":"12333",
			    	"FBONUSAMOUNT":"121120",
			    	"FBONUSDATE":"2014-09-01 09:50:00",
			    	"FID":1}]},
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

