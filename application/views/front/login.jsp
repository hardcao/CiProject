<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<style type="text/css">
body{font-size: 16px;font-family: "黑体"; background: url(./../images/login_bg.png);background-size: cover;}
#loginBg{background: #fff;opacity: 0.8;border:1px solid #e8e8e8;border-radius: 5px;box-shadow: 5px 5px 15px #B6B4B4;width: 380px;height: 220px;position: absolute;left: 550px;top: 250px;}
#loginLayer{width: 380px;height: 220px;position: absolute;left: 550px;top: 250px;}
#loginLayer table{width: 90%;height: 100%;margin:0px auto;}
#loginLayer table input{padding: 3px 5px;}
#loginLayer table .titleTd{font-size: 1.6em;font-weight: bold;color:#0066B3; }
#loginLayer table .tipsTd{font-size: 0.8em;color: #ff4747;height: 30px;}
#loginLayer table #submitBtn{width: 100px;text-align: center;border:1px solid #FF5B21;height: 30px;line-height: 30px;border-radius: 3px;cursor: pointer;font-size: 0.8em;}
#loginLayer table .btnFocus{background: #FF5B21;color: #FFF;}
</style>
<script type="text/javascript">
$(function(){
	$("#submitBtn").hover(function(){
		$(this).addClass("btnFocus");
	},function(){
		$(this).removeClass("btnFocus");
	}).click(checkSubmit);

	$("#uidInp").focus(removeTips);
	$("#pwdInp").focus(removeTips);

	$(document).keypress(function(e){
		switch(e.which){
			case 13:
				checkSubmit();
				break;
		}
	});

	$("#uidInp").focus();
})
function checkSubmit(){
	var uid = $.trim($("#uidInp").val());
	var pwd = $.trim($("#pwdInp").val());
	var data = '{"loginId":"'+uid+'","password":"'+pwd+'"}';
	/*if(uid != "admin" || pwd != "admin"){
		$(".tipsTd").text("用户与密码不匹配!");
	}else*/ if(uid.length <= 0 || pwd.length <= 0){
		$(".tipsTd").text("用户与密码不能为空!");
		
	}else{
		$.ajax({
			type:'post',
			url:'../userController/login.action',
			contentType: "application/json; charset=utf-8", 
			dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
			data:data,
			success:function(msg){
				if(msg.success) location.href = "<?php echo site_url()?>";
				else $(".tipsTd").text("用户与密码不匹配!");
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
	        	alert(errorThrown); 
	        }
		});
	}
}
function removeTips() {
	$(".tipsTd").empty();
}
</script>
</head>
<body>
<div id="loginBg"></div>
<div id="loginLayer">
	<table border="0">
		<tr>
			<td colspan="2" class="titleTd">中梁地产项目跟投平台</td>
		</tr>
		<tr>
			<td width="60">用户名</td>
			<td><input id="uidInp" value="" /></td>
		</tr>
		<tr>
			<td>密码</td>
			<td><input id="pwdInp" type="password" value="" /></td>
		</tr>
		<tr>
			<td></td>
			<td><div id="submitBtn">登&nbsp;&nbsp;录</div></td>
		</tr>
		<tr>
			<td></td>
			<td class="tipsTd"></td>
		</tr>
	</table>
</div>
</body>
</html>