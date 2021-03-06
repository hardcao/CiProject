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
	var ctx=$("#ctx").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/ProjectBasicController/getProjectList.action',
		contentType: "application/json; charset=utf-8", 
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:$.toJSON($("#listform").serializeArray()),
		success:function(msg){
			if(msg.success){
				dataList=msg.dataDto;
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
		if(tempObj.projectName.indexOf("合肥")){
			amm1 = 6650;
			amm2 = 55;
			amm3 = 3658;
			amm4 = 45;
		}else if(tempObj.projectName.indexOf("苏州")){
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
				'<div class="proTitle"><a href="./projectDetail.jsp?proId='+tempObj.projectId+'">项目名称：'+tempObj.projectName+'</a></div>'+
				'<div class="proInfo">'+
					'<table class="proInfoTable" height="100%" width="100%" border="0"><tr>'+
						'<td class="titleTd">项目认购开始时间:</td>'+
						'<td class=""><span>'+(new Date(tempObj.subscribeStartDate)).format('yyyy-MM-dd')+'</span> 至 <span>'+(new Date(tempObj.subscribeEndDate)).format('yyyy-MM-dd')+'</span></td>'+
						'<td class="titleTd">资金募集时间:</td>'+
						'<td class=""><span>'+(new Date(tempObj.payStartDate)).format('yyyy-MM-dd')+'</span> 至 <span>'+(new Date(tempObj.payEndDate)).format('yyyy-MM-dd')+'</span></td>'+
						/*'<td class="titleTd">跟投总额(含杠杆):</td>'+
						'<td>'+amm1+' 万元</td>'+*/
					'</tr><tr>'+
						'<td class="titleTd">强投包总额(含杠杆):</td>'+
						'<td class=""><span>'+formatMillions(tempObj.groupForceAmount+tempObj.compForceAmount)+'</span> 万元</td>'+
						'<td class="titleTd">选投包总额(无杠杆):</td>'+
						'<td class=""><span>'+formatMillions(tempObj.compChoiceAmount)+'</span> 万元</td>'+
						/*'<td class="titleTd">已认购总额(含杠杆):</td>'+
						'<td>'+0+' 万元</td>'+*/
					'</tr><tr>'+
						'<td class="titleTd">可跟投总额(含杠杆):</td>'+/*强投包比例(含杠杆)*/
						'<td id="groupForceAmount"><span>'+formatMillions(tempObj.followAmount)+'</span> 万元</td>'+
						'<td class="titleTd">已认购总额(含杠杆):</td>'+/*强投包总额*/
						'<td id="compForceAmount"><span>'+formatMillions(tempObj.subscribeAmt)+'</span> 万元</td>'+
						/*'<td class="titleTd">选投包比例(无杠杆):</td>'+
						'<td id="compChoiceAmount">'+amm4+' %</td>'+*/
					'</tr></table>'+
				'</div>'+
				'<div class="buttonLayer">'+
					'<div class="forumBtn"><a target="_blank" href="http://ekp.cifi.com.cn/moduleindex.jsp?nav=/km/forum/tree.jsp&main=/km/forum/km_forum_cate/kmForumCategory.do?method=main">答疑讨论区</a></div>';
				if((tempObj.isPurchase=="" || tempObj.isPurchase==null || tempObj.isPurchase=="null") && new Date(tempObj.subscribeStartDate)<new Date() && new Date(tempObj.subscribeEndDate)>new Date()){
					tempHtml+='<div class="subscribeBtn"><a href="subscribeApply.jsp?proId='+tempObj.projectId+'">我要认购</a></div>';
				}
				tempHtml+='</div>'+ 
			'</div>'+
		'</div>';
		$("#contentList").append(tempHtml);
	}
	lengVal = dataList.length;
}