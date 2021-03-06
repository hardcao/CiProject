﻿var dataList = [];

$(function(){
	initParams();
	initListeners();
	initPages();
});

function initParams(){
	dataList = [];
}

function initListeners(){
	initHeaderListeners();
	$("#searchBtn").click(getData);
	$("#dimissionBtn").click(setDimission);
}

function initPages(){
	getData();
}

function getData(){
	var _searText = $("#searTextInp").val();
	var _obj = '{'+
			//"projectId":"'+projectId+'",'+
			'"projectName":"'+_searText+'",'+
			// '"startDate":'+_sDate+','+
			// '"endDate":'+_eDate+','+
			// '"piId":"",'+
			// '"piTimes":0,'+
			// '"subscribeAmt":0,'+
			// '"piDate":"",'+
			// '"piAmt":0,'+
			// '"numberCode":"",'+
			// '"uname":"'+_searText+'",'+
			'"userId":"'+currUser+'",'+
			'"startPage":"'+0+'",'+
			'"endPage":"'+999+'"'+
			'}';
	$.ajax({
		type:'post',//可选get
		url:'../PayInDetailController/selectListByDetail.action',
		contentType: "application/json; charset=utf-8",
		dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:_obj,
		success:function(msg){
			if(msg.success){
				dataList = msg.dataDto;
				loadData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}

function loadData(){
	$("#payInTbody").empty();
	if(dataList && dataList.length > 0){
		if($(".dimissionSTY").hasClass("displayNone")) $(".dimissionSTY").removeClass("displayNone");

		var tempHtml = "";
		$.each(dataList, function(ind, val){
			tempHtml +=
			'<tr><td width="50" height="35">'+(ind+1)+'</td>'+
			'<td>'+(val.projectName||"")+'</td>'+
			'<td>'+(val.subType)+'</td>'+
			'<td>'+formatMillions(val.subscribeAmt)+'</td>'+
			'<td>'+val.piTimes+'</td>'+
			'<td>'+(new Date(val.piDate)).format('yyyy-MM-dd')+'</td>'+
			'<td>'+formatMillions(val.piAmt)+'</td></tr>';

				// tempHtml += '<tr><td height="35">'+(ind+1)+'</td>'+
				// '<td>'+val.uname+'</td>'+
				// '<td>'+(val.service||"")+'</td>'+
				// '<td>'+val.subType+'</td>'+
				// '<td>'+formatMillions(val.subscribeAmt)+'</td>'+
				// '<td>'+val.piTimes+'</td>'+
				// '<td>'+(new Date(val.piDate)).format('yyyy-MM-dd')+'</td>'+
				// '<td>'+formatMillions(val.piAmt)+'</td>'+
				// '<td><a class="delBtn" ind="'+ind+'" href="javascript:void(0)">删除</a></td></tr>';
		});
		$("#payInTbody").html(tempHtml);
	}
}

function setDimission(){
	/*$.ajax({
		type:'post',//可选get
		url:'../subscribe/updateDimissionByUid.action',
		// contentType: "application/json; charset=utf-8",
		// dataType:'json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			"uid": $("#loginInp").val(),
			"isDimission": "1"
		},
		success:function(msg){
			if(msg.success){
				alert("离职申请成功! 请等待管理员进行退款处理。")
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})*/
}