<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery-1.8.0.min.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.datetimepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.json-2.4.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>

<!-- <link rel="stylesheet" type="text/css" href="../plugins/jquery.datetimepicker.css">
<script type="text/javascript" src="application/views/plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="application/views/plugins/jquery.json-2.4.js"></script>
<script type="text/javascript" src="application/views/plugins/dateFormat.js"></script> -->
<style type="text/css">

.displayNone{display: none;}
.tip_STY{color: red;font-size: 1em;}
#rightLayer input[readonly='true']{background: #e8e8e8;border: 1px solid #BDBDBD;}
#rightLayer .editTitle{height: 30px;line-height: 30px;padding: 0px;/*background: #E0DBDB;border-bottom: 1px solid #949292;*/width: 15%;border-radius:4px 4px 2px 2px;margin:5px 0px 0px;cursor: pointer;font-weight: bold;}
#rightLayer .editTitle img{margin: 0px 10px;}
#rightLayer .editor{width:99%;min-height: 100px;margin: 0px auto;border: 1px solid #E0DBDB;overflow: hidden;padding: 5px;}
#rightLayer .editor .tdTitle{width: 13%;text-align: right;padding-right: 10px;font-size: 0.8em;}
#rightLayer .editor input{width: 45%;padding:0px 5px;margin: 3px 0px;}
#rightLayer .editor textarea{height:100px;width: 45%;resize:none;padding: 5px;margin: 3px 0px;}
#rightLayer .btnBox button{margin:10px 5px;}
#rightLayer #forceTable, #rightLayer #subTable{border-spacing: 1px; border-collapse: collapse;border:1px solid #C0BEBE;font-size: 0.9em;}
#rightLayer #forceTable .trTitle, #rightLayer #subTable .trTitle{background: url(application/views/back/images/thead_bg.png);color: #727070;}
#rightLayer #forceTable td, #rightLayer #subTable td{text-align: center;border:1px solid #C0BEBE;}
#rightLayer #forceTable tbody td, #rightLayer #subTable tbody td{height: 30px;border:1px solid #C0BEBE;}
#rightLayer #forceTable tbody input, #rightLayer #subTable tbody input{padding: 0px 3px;width: 70%;text-align: center;font-size: 1.1em;}

#forceDialogBgLayer{position: fixed;width: 100%;height: 100%;background: #000;opacity: 0.7;top: 0;left: 0;}
#forceDialogLayer{position: fixed;width: 100%;height: 100%;top: 0;left: 0;}
#forceDialogLayer .dialogSTY{background: #fff;border: 1px solid #e8e8e8;border-radius: 5px;width: 750px;height: 360px;margin: 70px auto;}
#forceDialogLayer .dialogSTY .tipTitle{float:left;padding: 8px 15px;}
#forceDialogLayer .dialogSTY .tipTitle #proName{font-size: 14px;font-weight: bold;color: #D94026;}
#forceDialogLayer .dialogSTY .searDiv{text-align: right;padding:10px 10px 0px;}
#forceDialogLayer .dialogSTY .contentDiv{width: 96%;height: 275px;margin: 3px auto;border: 0px solid #e8e8e8;overflow: hidden;}
#forceDialogLayer .dialogSTY .contentDiv table{width: 100%;border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;}
#forceDialogLayer .dialogSTY .contentDiv table thead{background: url(application/views/back/images/thead_bg.png);}
#forceDialogLayer .dialogSTY .contentDiv table td{padding: 3px 5px;text-align: center;border: 1px solid #e8e8e8;}
#forceDialogLayer .dialogSTY .contentDiv table input{padding: 0px 3px;margin: 0px;width: 70px;text-align: center;}
#forceDialogLayer .dialogSTY .btnDiv{width: 96%;text-align: right;margin: 0px auto;}
#forceDialogLayer .ckSTY{width: 15px;height: 15px;padding: 0px;margin: 3px;}
#forceDialogLayer button{width: 50px;height: 25px;margin: 0px 5px;}

#ul-pics li {
    width: 32%;
    float: left;
    /* height: 300px; */
    margin-right: 1%;
    border: 1px solid #CCCCCC;
    margin-top: 1%;
}

input#item_pic {
	width: 200px;
}

</style>
<script type="text/javascript">
var allUserList = [];
var forceObj = {};
var tempForceObj = {};
var tempAddForceObj = {};
var i=0;
var schemeLinkArr = [];
var protocalArr = [];
$(function(){
	$("#uploadProtocalForm .delProtocalLink").live("click", deleteSchemeProtocalFunc);
	$("#uploadForm .delSchemeLink").live("click", deleteSchemeLinkFunc);
	$("#rightLayer .editTitle").click(function(){
		var _editor = $("#"+$(this).attr("id")+"_editor");
		var isDis = _editor.hasClass("displayNone");
		if(isDis) _editor.removeClass("displayNone");
		else _editor.addClass("displayNone");
	})
	$("#addForceRecord").click(function(ev){
		callForceDialog();
	});
	$("#forceDialogLayer #allUserTbody input[name=userCk]").live("click",function(){
		var _cked = $(this).attr("checked");
		var _uid = $(this).attr("uid");
		var _ind = $(this).attr("ind");
		if(_cked){
			$(this).attr("checked","checked");
			if(!tempAddForceObj[_uid]){
				tempAddForceObj[_uid] = allUserList[_ind];
			}
		}else{
			$(this).removeAttr("checked");
			if(tempAddForceObj[_uid]){
				delete tempAddForceObj[_uid];
			}
		}
	});
	$("#forceDialogLayer #searUserBtn").click(getAllUserData);
	$("#forceDialogLayer #okBtn").click(addRows);
	$("#forceDialogLayer #cancelBtn").click(hideForceDialog);

	$("#addSubPackage").click(function(ev){
		var leng = $("#subTbody").children().length;
		var tempHtml = '<tr><td>'+(leng+1)+'</td>'+
				'<td><input /></td>'+
				'<td><input /></td>'+
				'<td><input /></td>'+
				'<td><input /></td>'+
				'<td><input /></td>'+
				'<td><input /></td></tr>';
		$("#subTbody").append(tempHtml);
	});
	$("#forceTbody .forceDelBtn").live("click",forceDelFunc);
	$("#groundInp").datetimepicker(/*{format:'Y-m-d',timepicker: false}*/);
	$("#stageStartInp").datetimepicker();
	$("#stageOpenInp").datetimepicker();
	// $("#peakInp").datetimepicker();
	// $("#cashflowReturnInp").datetimepicker();
	$("#deliverInp").datetimepicker();
	$("#carryoverInp").datetimepicker();
	$("#liquidateInp").datetimepicker();
	$("#subscribeStartInp").datetimepicker();
	$("#subscribeEndtInp").datetimepicker();
	$("#payStartInp").datetimepicker();
	$("#payEndInp").datetimepicker();
	$("#payReleaseDateInp").datetimepicker();
	var projectId= getReqParam('projectid');//$("#projectid").val();
	if(projectId!="" && projectId!=null){
		//此id是做修改的时候 form表单的id 跟head.jsp里面的projectid 一样
		$("#newprojectId").val(projectId);
		$("#schemeProjectid").val(projectId);
		$("#forceProjectId").val(projectId);
		$("#subProjectId").val(projectId);
		$("#uploadProId").val(projectId);
		$("#uploadProId_1").val(projectId);
		getProjectDetail();
		getSchemeByProjectid();
		getForceFollowByProjectid();
		getSubscribeByProjectid();
	}
});
function getSubscribeByProjectid(){
	var ctx=$("#ctx").val();
	var projectId=getReqParam('projectid');;
	$.ajax({
		type:'post',//可选get
		url:ctx+'/subscribe/getSubscribeyProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{'projectId':projectId},
		success:function(msg){
			if(msg.success){
				for(var m=0;m<msg.dataDto.length;m++){
					 $("#sub"+m+"subscribeId").val((msg.dataDto)[m].subscribeId);
					 $("#sub"+m+"followNature").val((msg.dataDto)[m].followNature);
					 $("#sub"+m+"followStaff").val((msg.dataDto)[m].followStaff);
					 $("#sub"+m+"amountToplimit").val((msg.dataDto)[m].amountToplimit);
					 $("#sub"+m+"contributiveSubscribe").val((msg.dataDto)[m].contributiveSubscribe);
					 $("#sub"+m+"leverageSubscribe").val((msg.dataDto)[m].leverageSubscribe);
					 $("#sub"+m+"subscribeAmountTotal").val((msg.dataDto)[m].subscribeAmountTotal);
				}
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getForceFollowByProjectid(){
	var ctx="<?php echo site_url();?>";
	var projectId=getReqParam('projectid');
	$.ajax({
		type:'post',//可选get
		url:ctx+'/ForceFollowController/getForceByProjectId.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			'projectId':projectId,
			'forceType':"1"
		},
		success:function(msg){
			if(msg.success){
				i=msg.data.length;
				var _obj = null;
				var tempSel = "";
				for(var m=0;m<msg.dataDto.length;m++){
					_obj = (msg.dataDto)[m];
					forceObj[_obj.uid] = _obj;
					if(_obj.company == "集团强投包"){
						tempSel = '<select name="forceFollList['+m+'].company" ><option value="集团强投包" selected="selected">集团强投包</option><option value="城市强投包">城市强投包</option></select>';
					}else{
						tempSel = '<select name="forceFollList['+m+'].company" ><option value="集团强投包">集团强投包</option><option value="城市强投包" selected="selected">城市强投包</option></select>';
					}
					var tempHtml = 
					'<tr id="force_row_'+m+'">'+
						/*'<td>'+(m+1)+'</td>'+*/
						'<td><input type="hidden" name="forceFollList['+m+'].forceFollowId" value="'+_obj.forceFollowId+'" />'+
						'<input type="hidden" name="forceFollList['+m+'].forceType" value="'+_obj.forceType+'" />'+
						'<input type="hidden" name="forceFollList['+m+'].name" value="'+_obj.uid+'" />'+
						'<input value="'+_obj.name+'" readonly="true" /></td>'+
						'<td>'+tempSel+'</td>'+
						'<td><input name="forceFollList['+m+'].department" value="'+_obj.department+'" /></td>'+
						'<td><input name="forceFollList['+m+'].duty" value="'+(_obj.duty||"")+'" /></td>'+
						'<td><input name="forceFollList['+m+'].downlimit" value="'+formatMillions(_obj.downlimit)+'" type="number" /></td>'+
						'<td><input name="forceFollList['+m+'].toplimit" value="'+formatMillions(_obj.toplimit)+'" type="number" /></td>'+
						'<td><input name="forceFollList['+m+'].remark" value="'+_obj.remark+'" readonly="true" /></td>'+
						'<td><a class="forceDelBtn" ind="'+m+'" uid="'+_obj.uid+'" fid="'+_obj.forceFollowId+'" href="javascript:void(0)" >删除</a></td></tr>';
				 $("#forceTbody").append(tempHtml);
				}	
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

</script>
</head>
<body id="rightLayer">
<div id="basic" class="editTitle"><img src="../../application/views/back/images/arrow_down.png" />项目封面图</div>
		<div><img src="http://localhost/application/views/front/img/title.jpg" width="600px"></div>
		<div><p>删除</p></div>
		<form method="post" action="<?=site_url()?>files/img/" enctype="multipart/form-data" />
		    <div style="margin:0 0 0.5em 0em;">
		        <input type="file" name="userfile" size="20" class="button" />
		        <input type="submit" value=" 上传 " class="button" />
		    </div>
		</form>


<div id="basic" class="editTitle"><img src="../../application/views/back/images/arrow_down.png" />项目图库</div>
<ul id="ul-pics">
	<li>
		<div><img src="http://localhost/application/views/front/img/title.jpg" width="100%"></div>
		<div><p>删除</p></div>
	</li>
	<li>
		<div><img src="http://localhost/application/views/front/img/title.jpg" width="100%"></div>
		<div><p>删除</p></div>
	</li>
	<li>
		<div><img src="http://localhost/application/views/front/img/title.jpg" width="100%"></div>
		<div><p>删除</p></div>
	</li>
</ul>
<div><input class="file" type="file" value="更改封面图片" id="item_pic" placeholder="上传封面图片"></div>
</html>