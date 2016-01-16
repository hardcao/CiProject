﻿<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>数据维护系统 - 分红明细列表</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../plugins/pagination.css" />
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="../plugins/jquery.pagination.js"></script>
<script type="text/javascript" src="../plugins/ajaxfileupload.js"></script>
<style type="text/css">
body{font-size: 12px;}
#rightLayer #searchLayer{text-align: right;margin:0px auto 10px;position: relative;}
#rightLayer #searchLayer .btnSTY{float: left;margin: 7px 5px 0px;}
#rightLayer #searchLayer input{width: 200px;height: 25px;padding:0px 5px;}
#rightLayer #searchLayer .dateSTY{width: 100px;}
#rightLayer #bonusTable{border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;font-size: 1em;}
#rightLayer #bonusTable thead{background: url(images/thead_bg.png);}
#rightLayer #bonusTable td{text-align: center;border: 1px solid #e8e8e8;}
#rightLayer #bonusTable input{width: 60px;height: 25px;}


#dialogBgLayer{position: fixed;width: 100%;height: 100%;background: #000;opacity: 0.7;top: 0;left: 0;}
#dialogLayer{position: fixed;width: 100%;height: 100%;top: 0;left: 0;}
#dialogLayer .dialogSTY{background: #fff;border: 1px solid #e8e8e8;border-radius: 5px;width: 1000px;height: 350px;margin: 100px auto;}
#dialogLayer .dialogSTY .tipTitle{padding: 14px 15px;float: left;}
#dialogLayer .dialogSTY .tipTitle #proName{font-size: 14px;font-weight: bold;color: #D94026;}
#dialogLayer .dialogSTY .searDiv{text-align: right;padding:10px 10px 0px;}
#dialogLayer .dialogSTY .contentDiv{width: 96%;height: 265px;margin: 3px auto;border: 0px solid #e8e8e8;clear: both;}
#dialogLayer .dialogSTY .contentDiv table{width: 100%;border: 1px solid #e8e8e8;border-spacing: 1px;border-collapse: collapse;}
#dialogLayer .dialogSTY .contentDiv table thead{background:url(images/thead_bg.png);;}
#dialogLayer .dialogSTY .contentDiv table td{padding: 1px 5px;text-align: center;border: 1px solid #e8e8e8;}
#dialogLayer .dialogSTY .contentDiv table input{width: 50px;text-align: center;padding: 0px 2px;height: 20px;line-height: 20px;}
#dialogLayer #bonusPagination{clear: both;margin-left: 20px;}
#dialogLayer .dialogSTY .btnDiv{width: 96%;text-align: right;margin: 0px auto;}
#dialogLayer .ckSTY{width: 15px;height: 15px;padding: 0px;margin: 3px;}
#dialogLayer .searDiv button{width: 50px;height: 25px;margin: 0px 5px;}
</style>
<script type="text/javascript">
var subscribeList = [];
var bonusList = [];
$(function(){
	getBonusList();
	initBonusListeners();
});

function initBonusListeners(){
	$("#sDateInp").datetimepicker({format:'Y-m-d',timepicker:false});
	$("#eDateInp").datetimepicker({format:'Y-m-d',timepicker:false});

	$("#searTextBtn").click(getBonusList);
	$("#clearTextBtn").click(function(){
		$("#sDateInp").val("");
		$("#eDateInp").val("");
		$("#searTextInp").val("");
		getBonusList();
	});
	$("#subscribeTbody .addBonusBtn").live("click",addBonusFunc);
	$("#bonusTbody .delBtn").live("click", delBonusFunc);

	$("#callBonusDialog").click(function(){
		getSubscribeList();
		callDialog();
	});
	$("#dialogLayer #okBonusBtn").click(function(){
		getBonusList();
		hideDialog();
	});
	// 导出分红模板
	$("#rightLayer #exportSubBtn").click(function(){
		location.href = "../subscribe/callSubscribeRecordExport.action?projectId="+projectId;
	});
	// 导入分红
	$("#rightLayer #importBtn").click(function(){
		$("#bonusFileUp").click();
	});
	// 导出分红
	$("#rightLayer #exportBonusBtn").click(function(){
		location.href = "../BonusDetailController/callBonusExport.action?projectId="+projectId+"&bonusIds=";
	});
	$("#bonusFileUp").live("change", importBonusFunc);
}

function getBonusList(){
	var _sDate = $("#sDateInp").val();
	var _eDate = $("#eDateInp").val();
	var _searText = $("#searTextInp").val();

	$.ajax({
		type:'post',//可选get
		url:'../BonusDetailController/getBonusDetailList.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"projectId":projectId,
			"startPage":0,
			"endPage":999,
			"startDate":_sDate,
			"endDate":_eDate,
			"projectName":_searText,
			"userid":""
		},
		success:function(msg){
			if(msg.success){
				bonusList = msg.dataDto;
				loadBonusList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function loadBonusList(){
	$("#bonusTbody").empty();
	if(bonusList && bonusList.length > 0){
		var tempHtml = "";
		$.each(bonusList, function(ind, val){
			tempHtml +=
			'<tr><td height="35">'+(ind+1)+'</td>'+
			'<td>'+val.uname+'</td>'+
			'<td>'+(val.service||"")+'</td>'+
			'<td>'+val.subscribeType+'</td>'+
			'<td>'+formatMillions(val.subscribeAmount)+'</td>'+
			'<td>'+val.bonusTimes+'</td>'+
			'<td>'+(new Date(val.bonusDate)).format('yyyy-MM-dd')+'</td>'+
			'<td>'+formatMillions(val.bonusAmount)+'</td>'+
			'<td>'+(val.subscribePackageName||"")+'</td>'+
			'<td>'+(val.completeSubscribeRecord||"")+'</td>'+
			'<td><a class="delBtn" ind="'+ind+'" href="javascript:void(0)">删除</a></td></tr>';
		});
		$("#bonusTbody").html(tempHtml);
	}
}

function getSubscribeList(){	
	$.ajax({
		type:'get',//可选get
		url:'/investment/subscribe/queryAllUnComplete.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"projectId":projectId,
			"startPage":0,
			"endPage":999
		},
		success:function(msg){
			if(msg.success){
				subscribeList=msg.dataDto;
				loadSubList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadSubList(){
	if(subscribeList && subscribeList.length > 0){
		$("#bonusPagination").pagination(subscribeList.length, {
            items_per_page: 5,
            num_display_entries: 2,
            num_edge_entries: 2,
            callback: pageselectCallback,
            load_first_page: true,
            prev_text:"上一页",
            next_text:"下一页"
        });

	}
}

function pageselectCallback(v,d,s){
	$("#subscribeTbody").empty();
	var tempHtml = "";
	// $.each(subscribeList, function(ind,val){
	var sind = v*5;
	var leng = (sind+5)>subscribeList.length?subscribeList.length:sind+5;
	var val = null;
	for(var ind=sind;ind<leng;ind++){
		val = subscribeList[ind];
		tempHtml += 
		'<tr id="row_'+ind+'"><td height="35">'+(ind+1)+'</td>'+
		'<td>'+val.uName+'</td>'+
		'<td>'+val.projectName+'</td>'+
		'<td class="subInp">'+(val.contributiveConfirmAmount+val.contributiveConfirmAmount)+'</td>'+
		'<td><select class="typeInp"><option value="集团强投包">集团强投包</option><option value="集团选投包">集团选投包</option></select></td>'+
		'<td><input class="timesInp" value="1" /></td>'+
		'<td><input class="bonusamtInp" value="5" /></td>'+
		'<td><a class="addBonusBtn" ind="'+ind+'" href="javascript:void(0)">保存</a></td></tr>';
	// });
	}
	$("#subscribeTbody").html(tempHtml);
}

function addBonusFunc(){
	// debugger
	var _ind = $(this).attr("ind");
	var _dataObj = subscribeList[_ind];
	var _$rowObj = $("#row_"+_ind);

	var _typeVal = _$rowObj.find(".typeInp").val();
	var _subamtVal = _$rowObj.find(".subInp").text();
	var _timesVal = _$rowObj.find(".timesInp").val();
	var _bonusamtVal = _$rowObj.find(".bonusamtInp").val();

	// if(typeof(parseInt(_timesVal)) != "number" || _timesVal.length > 0){
	// 	alert("请输入有效的分红批次值!");
	// 	return false;
	// }else if(typeof(_bonusamtVal) != "number" || _bonusamtVal.length > 0){
	// 	alert("请输入有效的分红金额!");
	// 	return false;
	// }

	var _param = {
		"projectId":_dataObj.projectId,
		"userid":_dataObj.uid,
		"subscribeType":_typeVal,
		"subscribeAmount":_subamtVal,
		"bonusTimes":_timesVal,
		"bonusAmount":_bonusamtVal
	};
	// debugger;
	// return  false;
	$.ajax({
		type:'post',//可选get
		url:'../BonusDetailController/insert.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_param,
		success:function(msg){
			if(msg.success){
				alert("新增成功!");
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function delBonusFunc(){
	var _ind = $(this).attr("ind");
	var _dataObj = bonusList[_ind];

	$.ajax({
		type:'post',//可选get
		url:'../BonusDetailController/delete.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"bonusId": _dataObj.bonusId
		},
		success:function(msg){
			if(msg.success){
				alert("删除成功!");
				getBonusList();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function importBonusFunc(){
	$.ajaxFileUpload({
		url: '../BonusDetailController/callBonusImport.action', //用于文件上传的服务器端请求地址
		secureuri: false, //是否需要安全协议，一般设置为false
		fileElementId: 'bonusFileUp', //文件上传域的ID
		dataType: 'JSON', //返回值类型 一般设置为json
		data:{
			"filePath":"d://BonusDetail.xlsx"
		},
		success: function (data, status){  //服务器成功响应处理函数
			
			if(status == "success"){
				getBonusList();
				alert("导入成功!");
			}else{
				alert(data.error);
			}
		},
		error: function (data, status, e){//服务器响应失败处理函数		
			alert(e);
		}
	})

	/**
	var _filePath = $("#bonusFileUp").val();
	//var _realPath = getPath(_filePath,this);
	$.ajax({
		type:'post',//可选get
		url:'../BonusDetailController/callBonusImport.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"filePath":_filePath||"d://BonusDetail.xlsx"
		},
		success:function(msg){
			if(msg.success){
				alert("导入成功!");
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
	    	alert(errorThrown);       
	    }
	})
	
	**/
}
function callDialog(){
	$("#dialogBgLayer").show();
	$("#dialogLayer").show();
}
function hideDialog(){
	$("#dialogBgLayer").hide();
	$("#dialogLayer").hide();
	$("#searUserInp").val("");
}

function getPath(obj,fileQuery){ 
	if(window.navigator.userAgent.indexOf("MSIE")>=1){ 
		 obj.select();
		   return document.selection.createRange().text;
	} 
	else{ 
		var file =fileQuery.files[0];  
		var reader = new FileReader();  
		reader.onload = function(e){ 
		obj.setAttribute("src",e.target.result);
	   } 
	  return reader.readAsDataURL(file);  
	  } 
	} 

</script>
</head>
<body id="rightLayer">
<div id="searchLayer">
	<!-- <button id="callBonusDialog" class="btnSTY">新增分红</button> -->
	<button id="exportSubBtn" class="btnSTY">导出分红模板</button>
	<button id="importBtn" class="btnSTY">导入分红</button>
	<button id="exportBonusBtn" class="btnSTY">导出分红</button>
	<input type="file" id="bonusFileUp" name="bonusFileUp" style="left:90px;">
	分红日期：<input id="sDateInp" readonly class="dateSTY" />至<input id="eDateInp" readonly class="dateSTY" style="margin-right: 40px;" />
	<input id="searTextInp" placeholder="请输入项目名或认购人" />
	<button id="searTextBtn">搜索</button>
	<button id="clearTextBtn">清空</button>
</div>
<table id="bonusTable" border="1" width="100%"><thead><tr>
	<td height="34" width="40">序号</td>
	<td width="100">跟投人</td>
	<td width="100">部门</td>
	<td width="110">跟投类型</td>
	<td width="100">平衡额度<br>(不含杠杆)(万元)</td>
	<td width="70">分红批次</td>
	<td width="100">分红日期</td>
	<td width="80">分红金额<br>(万元)</td>
	<td width="150">分红帐号</td>
	<td width="70">备注</td>
	<td>操作</td>
</tr></thead>
<tbody id="bonusTbody">
	<!-- <tr><td height="35">1</td>
		<td>张三</td>
		<td>合肥高新项目</td>
		<td>集团强投包</td>
		<td>23</td>
		<td>1</td>
		<td>2014-09-01</td>
		<td>5</td>
		<td><a href="javascript:void(0)">删除</a></td></tr> -->
</tbody></table>
</body>
<div id="dialogBgLayer" style="display:none;"></div>
<div id="dialogLayer" style="display:none;">
	<div class="dialogSTY">
		<div class="tipTitle">
			<!-- <input type="file" id="bonusFileUp" name="bonusFileUp" onchange="importBonusFunc();" style="width: 0px;height: 0px;padding: 0px;margin: 0px;"> -->
			<!-- <button id="importBtn">批量导入分红</button> &nbsp;&nbsp;
			<button id="exportSubBtn">导出认购记录</button> &nbsp;&nbsp; -->
		</div>
		<div class="searDiv">
			<!-- <input id="searUserInp" placeholder="请输入项目名或认购人" />
			<button id="searUserBtn">搜索</button> -->
		</div>
		<div class="contentDiv"><table border="1"><thead><tr>
			<td width="30">序号</td>
			<td width="110">认购人</td>
			<td width="210">跟投项目</td>
			<td width="120">认购总额<br>(含杠杆)(万元)</td>
			<td width="120">认购类型</td>
			<td width="80">分红批次</td>
			<td width="100">分红金额(万元)</td>
			<td>操作</td>
		</tr></thead>
		<tbody id="subscribeTbody">
			<!-- <tr><td height="35">
				1
			</td><td>
				张三
			</td><td>
				合肥高新
			</td><td>
				23
			</td><td>
				<select><option>集团强投包</option><option>集团选投包</option></select>
			</td><td>
				<input value="1" />
			</td><td>
				<input value="5" />
			</td><td>
				<a href="javascript:void(0)">保存</a>
			</td></tr> -->
		</tbody></table></div>
		<div id="bonusPagination"></div>
		<div class="btnDiv"><button id="okBonusBtn">确定</button><button id="cancelBonusBtn" style="display:none;">取消</button></div>
	</div>
</html>