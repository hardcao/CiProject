﻿<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>跟投项目信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<link href="<?php echo site_url('application/views/plugins/jquery.datetimepicker.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/public.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/header.css')?>">
<link rel="stylesheet" type="text/css" href="<?php echo site_url('application/views/front/css/projectList.css')?>">

<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.datetimepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/jquery.json-2.4.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/util.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/plugins/dateFormat.js')?>"></script>
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/header.js')?>"></script>

</head>

<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>

<div id="contentLayer">

	<input type="hidden" name="type" value="1">
	<div id="naviTitle"><a href="<?php echo site_url()?>">首页</a> > 认购项目列表</div>
	<div id="searchLayer">
		<div class="searSTY">
			项目认购开始时间:&nbsp;<input id="releaseSDate" name="releaseSDate" readonly class="dateSTY" />至<input id="releaseEDate" name="releaseEDate" readonly class="dateSTY" />
		</div>
		<div class="searSTY" style="display:none;">
			状态:&nbsp;<select id="proStatus" name="projectStatus">
				<option value="-1">全部</option>
				<option value="0">已结束</option>
				<option value="1">跟投中</option>
			</select>
		</div>
		<div class="searSTY floatR">
			<input id="searchText" type="search" placeholder="请输入项目名或公司名" value="" name="projectName" />&nbsp;
			<button id="searchBtn" type="button" class="btnSTY">搜索</button>
			<button id="clearBtn" type="button" class="btnSTY">清空</button>
		</div>
	</div>
	<div id="contentList">
	</div>
</div>

<div id="footer">中粮地产集团</div>
<script type="text/javascript">
	// 导航下标
var naviInd = "1";
var dataList;
// 保存当前页面已展示数据量
var lengVal = 0;

$(function(){
	initParams();
	initListeners();
	initPages();
});
function initParams(){
	var isPerson = getReqParam("isPerson");
	if(isPerson) $("#isPerson").val("yes");
}
function searchProject(){
	var ctx="<?php echo site_url();?>";
	var _sDate = $("#releaseSDate").val();
	var _eDate = $("#releaseEDate").val();
	var _searText = $("#searchText").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'project/getAllFollowProject',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			begin: 0,
			count: 2,
			uid: '1',
			searchname: _searText,
			subscribeStartDate: _sDate,
			subscribeEndDate:_eDate,
			queryType: getReqParam('query'),	
		},
		success:function(msg){
			if(msg.success){
				dataList=msg.data;
				loadData(dataList);
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})

	$("#contentList").empty();
}

function initListeners(){
	initHeaderListeners();

	$("#searchBtn").click(function(){
		searchProject();
	});

	$("#clearBtn").click(function(){
		$("#releaseSDate").val("");
		$("#releaseEDate").val("");
		$("#searchText").val("");
		searchProject();
	});

	$("#releaseSDate").datetimepicker({
		format:'Y-m-d',
		timepicker: false
	});
	$("#releaseEDate").datetimepicker({
		format:'Y-m-d',
		timepicker: false
	});
}

function initPages(){
	searchProject();
}
function formatDate(ss){
	var dt=new Date(ss);
	var dtstr=dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+dt.getDate();
	dtstr=dtstr+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
	return dtstr;
}
function clearNull(str){
	if(str=="null" ||str==null){
		return "";
	}else{
		return str;
	}
}
function loadData(dataList){
	/*
	FNAME: "project27"
FPAYENDDATE: "2016-01-22"
FPAYSTARTDATE: "2016-01-22"
FSUBSCRIBEENDDATE: "2016-01-22"
FSUBSCRIBESTARTDATE: "2016-01-22"
HDAmount: 3
HDAmountComplete: "test"
regioAmount: 3
regioAmountComplete: "test"
	*/
	var tempHtml = "";
	var tempObj = null;
	var tempImg = "./images/254_142.png";
	var amm1 = 0;
	var amm2 = 0;
	var amm3 = 0;
	var amm4 = 0;
	for(var i=0; i<dataList.length; i++){
		tempObj = dataList[i];
		tempImg = "./images/254_142.png";
		if(tempObj.projectImages){
			tempImg = "../images/projectFiles/"+tempObj.projectImages;
		}
		/*测试数据 begin*/
		if(tempObj.FNAME.indexOf("合肥")){
			amm1 = 6650;
			amm2 = 55;
			amm3 = 3658;
			amm4 = 45;
		}else if(tempObj.FNAME.indexOf("苏州")){
			amm1 = 7436;
			amm2 = 55;
			amm3 = 4089;
			amm4 = 45;
		}
		/* end */
		tempHtml = 
		'<div class="listSTY">'+
			'<div class="imgLayer"><img src="'+tempImg+'" width="100%" height="100%"></div>'+
			'<div class="textLayer">'+
				'<div class="proTitle"><a href="./projectDetail?projectId='+tempObj.FID+'">项目名称：'+tempObj.FNAME+'</a></div>'+
				'<div class="proInfo">'+
					'<table class="proInfoTable" height="100%" width="100%" border="0"><tr>'+
						'<td class="titleTd">项目认购开始时间:</td>'+
						'<td class=""><span>'+(new Date(tempObj.FSUBSCRIBEENDDATE)).format('yyyy-MM-dd')+'</span> 至 <span>'
						+(new Date(tempObj.FSUBSCRIBEENDDATE)).format('yyyy-MM-dd')+'</span></td>'+
						'<td class="titleTd">资金募集时间:</td>'+
						'<td class=""><span>'+(new Date(tempObj.FPAYSTARTDATE)).format('yyyy-MM-dd')+'</span> 至 <span>'
						+(new Date(tempObj.FPAYENDDATE)).format('yyyy-MM-dd')+'</span></td>'+
						/*'<td class="titleTd">跟投总额(含杠杆):</td>'+
						'<td>'+amm1+' 万元</td>'+*/
					'</tr><tr>'+
						'<td class="titleTd">强投包总额(含杠杆):</td>'+
						'<td class=""><span>'+'(tempObj.groupForceAmount)'+'</span> 万元</td>'+
						'<td class="titleTd">选投包总额(无杠杆):</td>'+
						'<td class=""><span>'+'(tempObj.compChoiceAmount)'+'</span> 万元</td>'+
						/*'<td class="titleTd">已认购总额(含杠杆):</td>'+
						'<td>'+0+' 万元</td>'+*/
					'</tr><tr>'+
						'<td class="titleTd">可跟投总额(含杠杆):</td>'+/*强投包比例(含杠杆)*/
						'<td id="groupForceAmount"><span>'+'(tempObj.followAmount)'+'</span> 万元</td>'+
						'<td class="titleTd">已认购总额(含杠杆):</td>'+/*强投包总额*/
						'<td id="compForceAmount"><span>'+'(tempObj.subscribeAmt)'+'</span> 万元</td>'+
						/*'<td class="titleTd">选投包比例(无杠杆):</td>'+
						'<td id="compChoiceAmount">'+amm4+' %</td>'+*/
					'</tr></table>'+
				'</div>'+
				'<div class="buttonLayer">';
					//+'<div class="forumBtn"><a target="_blank" href="http://ekp.cifi.com.cn/module<?php echo site_url()?>?nav=/km/forum/tree.jsp&main=/km/forum/km_forum_cate/kmForumCategory.do?method=main">答疑讨论区</a></div>';
				//if((tempObj.isPurchase=="" || tempObj.isPurchase==null || tempObj.isPurchase=="null") && new Date(tempObj.subscribeStartDate)<new Date() && new Date(tempObj.subscribeEndDate)>new Date()){
					tempHtml+='<div class="subscribeBtn"><a href="./subscribeApply?projectId='+tempObj.FID+'">我要认购</a></div>';
				//}
				tempHtml+='</div>'+ 
			'</div>'+
		'</div>';
		$("#contentList").append(tempHtml);
	}
	lengVal = dataList.length;
}
</script>
</body>
</html>