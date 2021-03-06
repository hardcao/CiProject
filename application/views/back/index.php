﻿<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护平台</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="application/views/back/css/public.css">
<link rel="stylesheet" type="text/css" href="application/views/back/css/header.css">

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<style type="text/css">

.displayNone{display: none;}
#contentLayer{width: 1240px;}
#contentLayer #roleLayer{height: 40px; line-height: 40px;font-size: 1.2em;/*padding: 0px 40px;*/}
#contentLayer .frameSTY{float: left;border:1px solid #D8D5D5;min-height:400px;background: #FFF;}
#contentLayer #leftLayer{width: 200px;min-height:400px;background: #F0F0F0;margin: 0px -1px 0px 0px;position: relative;}
#contentLayer #leftLayer .leftTitle{text-align: center;height: 40px;line-height: 40px;color: #000;border-bottom: 1px solid #B4B4B4;font-weight: bold;font-size: 1.2em;
	/* Firefox */
	/*background-image: -moz-linear-gradient(top, #F8F5F3, #1255BB);*/
	/* Saf4+, Chrome */
	/*background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #F8F5F3), color-stop(1, #1255BB));*/
	/* IE*/
	/*filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#F8F5F3', endColorstr='#1255BB', GradientType='0');*/
}
#contentLayer #leftLayer .naviUl{width: 100%;list-style: none;margin: 0px 0%;padding: 0px;}
#contentLayer #leftLayer .naviUl li{text-align: center;height: 35px;line-height: 35px;border-bottom: 1px solid #E4E4E4;cursor: pointer;}
#contentLayer #leftLayer .naviUl .focusOn{background: #FFF;color: #D94026;width: 101%;font-weight: bold;}

#contentLayer #proManageLayer{min-height: 400px;width: 1030px;margin: 0px auto;border: 1px solid #e8e8e8;border-radius: 3px;/*border:none;*//*box-shadow: 5px 5px 15px #929292;*/}
#contentLayer #proManageLayer #searchLayer{text-align: right;width: 95%;margin: 10px auto 0px;}
#contentLayer #proManageLayer #proTable{border-spacing: 1px;border-collapse: collapse;width: 95%;margin: 5px auto;font-size: 1em;border: 1px solid #e8e8e8;}
#contentLayer #proManageLayer #proTable thead{background: url(application/views/back/images/thead_bg.png);}
#contentLayer #proManageLayer #proTable tbody{font-size: 1.2em;}
#contentLayer #proManageLayer #proTable td{text-align: center;border: 1px solid #e8e8e8;}
#contentLayer #proManageLayer #proTable td a{color: #21B4F6;}
#contentLayer #proManageLayer #proTable td a:hover{/*text-decoration: underline;*/color: #D94026;}

#contentLayer #sysManageLayer{min-height: 400px;width: 1030px;margin: 0px auto;border: 1px solid #e8e8e8;border-radius: 3px;/*border:none;*//*box-shadow: 5px 5px 15px #929292;*/}
#contentLayer #sysManageLayer .btnSTY{float:left;text-align: center;width: 150px; height: 60px;line-height:60px;border: 1px solid #CACACA;cursor: pointer;margin: 60px 80px;border-radius: 10px;color: #0066B3;font-size: 1.3em;}
#contentLayer #sysManageLayer .hover{background: #0066B3;color: #FFF;}
</style>
<script type="text/javascript">
var naviVal = "projectInfo";
var projectList = [];
var currUserAcc = null;
var username = "<?php echo $username ?>";
$(function(){
	initPageParams();
	initPageListeners();
	initialPages();
});
function initPageParams(){
	currUserAcc = $("#accountnameInp").val();
}
function initPageListeners(){
	$("#btnSerarch").click(function(){
		UserProjectList();
	});

	$("#leftLayer .naviUl li").hover(function(ev){
		$(this).addClass("focusOn");
	},function(ev){
		var v = $(this).attr("val");
		if(v != naviVal)
			$(this).removeClass("focusOn");
	}).click(function(){
		$("#leftLayer .naviUl li").removeClass("focusOn");
		$(this).addClass("focusOn");
		naviVal = $(this).attr("val");

		loadContentPage();
	});
}
function initialPages(){
	if(username == "admin"){
		$("#leftLayer .naviUl li[val!='projectInfo']").removeClass("displayNone");
	}
	UserProjectList();
}

/*
 * 输入数据：
 * begin=0&count=2&uid=test1&subscribeStartDate='2014-09-01 09:50:00'&subscribeEndDate='2014-09-01 09:50:00'&status=1
 * 访问接口：project/getProjectList
 * 
 * 输出数据：{"success":true,"errorCode":0,"error":0,"data":[{"projectName":"123","projectId":"123","HDAmount":3,"regioAmount":3,"HDAmountComplete":"test","regioAmountComplete":"test","picList":[]}]
 * 
     * */
function UserProjectList(){
	var ctx="<?php echo site_url();?>";
	var projectName=$("#projectName").val();
	var uid = "<?php echo $uid;?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'project/getAllFollowProjectWithUserID',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{	
			'uid': uid,
		},
		success:function(msg){
			if(msg.success){
				projectList=msg.data;
				loadProjectData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	 //sessionTimeout(XMLHttpRequest,  textStatus, errorThrown);
        }
	})
}

function catPermissionArr(val)
{
	/*FBASICS: false
FBONUSDETAIL: false
FID: "3"
FNEWS: false
FPAYCONFIRM: false
FSTATUS: false
FSUBSCRIPTION: false
FUSERNAME: "test1"
	"基础信息",
	"动态新闻",
	"认购核准",
	"缴款确认",
	"分红明细",*/
	return new Array(val.FBASICS, val.FNEWS, val.FSUBSCRIPTION, val.FSUBSCRIPTION, val.FBONUSDETAIL);
}

function loadProjectData () {
	$("#projectTbody").empty();
	if(projectList && projectList.length > 0){
		var tempHtml = "";
		var perArr = [];
		var tempUrl = "";
		$.each(projectList, function(ind,val){
		    perArr = catPermissionArr(val);//val.permissionFlag.split("");
		    if ((perArr[0] || perArr[1] || perArr[2] || perArr[3] || perArr[4] || perArr[5] || username == 'admin') ) 
		    {
			tempUrl = "back/index/projectManage?projectId="+val.FPROJECTID+"&projectName="+escape(val.FPROJECTNAME);
			tempHtml +=
			'<tr><td height="40">'+(ind+1)+'</td>'+
				'<td>'+val.FPROJECTNAME+'</td>'+
				'<td><a href="'+tempUrl+'#projectBasicInfo" class="'+(isPermission(perArr,0)?"":"displayNone")+'">基础信息</a>'+
				'<a href="'+tempUrl+'#projectNewsInfo" class="'+(isPermission(perArr,1)?"":"displayNone")+'">&nbsp;&nbsp;动态新闻</a>'+
				'<a href="'+tempUrl+'#subscribeConfirm" class="'+(isPermission(perArr,2)?"":"displayNone")+'">&nbsp;&nbsp;认购核准</a>'+
				'<a href="'+tempUrl+'#payInConfirm" class="'+(isPermission(perArr,3)?"":"displayNone")+'">&nbsp;&nbsp;缴款确认</a><br>'+
				'<a href="'+tempUrl+'#projectBonusInfo" class="'+(isPermission(perArr,4)?"":"displayNone")+'">&nbsp;&nbsp;分红明细</a>'+
			'</tr>';
			}
		});
		$("#projectTbody").html(tempHtml);
	}
}
function isPermission(_arr,_ind){
	var username = "<?php echo $username;?>";
	if (username == 'admin') 
	{
		return true;
	};
	if(!_arr){
		return false;
	}else if(_ind >= _arr.length){
		return false;
	}else if(_arr[_ind] != "0"){
		return true;
	}
	return false;
	//return true;
}
function projectRedirect(projectId){
	//javascript:projectRedirect('+val.projectId+')
	location.href="<?php echo site_url();?>back/projectManage?projectId="+projectId;
}
function loadContentPage () {
	if(naviVal == "projectInfo"){
		$("#proManageLayer").show();
		$("#sysManageLayer").hide();
		UserProjectList();
	}else{
		var ctx="<?php echo site_url();?>";
		$("#proManageLayer").hide();
		if(naviVal == "paramsSetting")
		{
			window.location.href=ctx+"back/index/paramsSetting";
		}
		else
		{
			$("#sysManageLayer").show().load('/back/index/'+naviVal);
		}
	}
}
</script>
</head>
<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<div id="contentLayer">
	<div id="roleLayer"><!-- 当前用户角色：系统管理员 -->您好，欢迎使用中粱地产跟投内容管理系统！</div>
	<div id="leftLayer" class="frameSTY">
		<div class="leftTitle">
			<img src="application/views/back/images/menu_0.png" style="vertical-align:middle;" />&nbsp;&nbsp;管理菜单 
		</div>
		<ul class="naviUl">
			<li val="projectInfo" class="focusOn">项目信息维护</li>
			<li val="proListManage" class="displayNone">项目列表管理</li>
			<li val="permissionSet" class="displayNone">项目权限分配</li>
			<li val="paramsSetting" class="displayNone">跟投制度</li>
			<!--li val="orgzInfo">组织架构维护</li>
			<li val="remissionSetting">豁免设置</li-->
		</ul>
	</div>
	<div id="proManageLayer" class="frameSTY" style="display:block">
		<div id="searchLayer">
			<input placeholder="请输入项目名" id="projectName"/><button type="button" id="btnSerarch">搜索</button>
		</div>
		<table id="proTable" border="1"><thead><tr>
			<td width="50" height="34">序号</td>
			<td width="500">项目名称</td>
			<td>操作</td>
		</tr></thead>
		<tbody id="projectTbody">
		</tbody></table>
	</div>
	<div id="sysManageLayer" class="frameSTY" style="display:none;">
	</div>
</div>
<div id="footer">中梁地产集团</div>
</body>
</html>