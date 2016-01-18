
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta name="copyright" content="" />

<?php require (dirname(dirname(__FILE__)).'/common/header_include.php'); ?>
<style type="text/css">
.float{float: left;}
.divide25{width: 25%}
.number{width:40px; margin-top:5px;}
.number_box{height:50px; line-height: 50px; font-size: 14px; font-family: 'Microsoft YaHei'; color: #2e2e2e}
.content{    width: 1024px;
    margin-top: 20px;
    left: 50%;
    position: relative;
    margin-left: -512px;}
.row{
	height: 200px;
	border-bottom: 1px dotted #FF9600;
}

.left_td
{
	width: 224px;
	text-align: left;
}

.right_td
{
	width: 800px;
	text-align: left;
}

h2
{
	font-size:20px;
	font-weight: 600;
}

.moreinfo
{
	background-color: #E5BE8F;
	color: #FFF;
	height: 40px;
	line-height: 40px;
	text-align: center;
}

</style>
</head>
<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>
<div style = "margin-top:-67px">
	<img src="application/views/front/img/title.jpg" width="100%">
	
	
	<img src="application/views/front/img/subtitle1.png" width="100%" style="margin-top:20px">
	<div class="content">
			<div class="float divide25 number_box">
				<div class="float number"><img src="application/views/front/img/gtzs.png" ></div>
				<div>项目跟投总数: <span id="gtzs"></span></div>
			</div>
			<div class="float divide25 number_box">
				<div class="float number"><span id="gtrc"></span><img src="application/views/front/img/gtrc.png"></div>
				<div>认购人次</div>
			</div>
			<div class="float divide25 number_box">
				<div class="float number"><span id="rgze"></span><img src="application/views/front/img/rgze.png"></div>
				<div>认购总额(含杠杆)</div>
			</div>
			<div class="float divide25 number_box">
				<div class="float number"><span id="fhze"></span><img src="application/views/front/img/fhze.png"></div>
				<div>分红总额</div>
			</div>
	</div>

	<img src="application/views/front/img/subtitle2.png" width="100%" style="margin-top:20px">
	<div class="content" style="clear:both; overflow:hidden">
		<table width="100%" class="pay_bill " id="projects">
	        <tbody>
	        <!--tr class="row">
	        	<td class="left_td"> 
	        		<img src="application/views/front/img/title.jpg" alt="1" width="200px" height="150px">
	        	</td>

	            <td class="right_td">
	            	<h2><a href="#" style="color:red">2015/12/23</a></h2>
	            	<br>
	                <h2><a href="#">养生餐</a></h2>
	                <br>
	                <h4>
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                </h4>
	                
	            </td>
	        </tr-->

	        </tbody>
		</table>
	</div>

	<div class="content moreinfo" style="clear:both; overflow:hidden">
		<div><a href="/home/index/projectList">查看更多</a></div>
	</div>

	<img src="application/views/front/img/subtitle3.png" width="100%" style="margin-top:20px">
	<div class="content" style="clear:both; overflow:hidden">
		<table width="100%" class="pay_bill " id="news">
	        <tbody>

	        </tbody>
		</table>
	</div>

	<div class="content moreinfo" style="clear:both; overflow:hidden">
		<div><a href="/home/index/newsList" >查看更多</a></div>
	</div>

	<div style="margin-bottom:80px"></div>

	<div class=" moreinfo" style="clear:both; overflow:hidden">
		
	</div>

</div>

<script type="text/javascript">
	// 导航下标
var naviInd = "0";
// 新闻列表内容
var newsList = [];
// 项目列表内容
var projectList = [];
// 系统概览内容
var systemInfo = {};

$(function(){
	initParams();
	//initListeners();
	initPages();
});

function initParams(){

	systemInfo = {
		proCount: "0",
		peopleCount: "0",
		subAmount: "0",
		bonusAmount: "0"
	};
}

function initListeners(){
	initHeaderListeners();
}

function initPages(){
	getProjectData();
	getNewsData();
	getSysInfo();
}
function getNewsData(){
	var ctx="<?php echo site_url();?>";
	//var userid=$("#userid").val();
	$.ajax({
		type:'post',//可选get
		url:ctx+'/news/getDynamicNews',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		//begin=0&count=2&uid=test&projectId=123
		data:{begin: 0,
			count:2,
		    uid: 'test',
		    pojectId: '123'},
		success:function(msg){
			if(msg.success){
				newsList=msg.data;
				loadNewsData();
			}else{
				alert(msg.error);
			}
		},
		error: function (XMLHttpRequest, textStatus, errorThrown) {
        	// sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getProjectData(){
	var ctx="<?php echo site_url();?>";
	$.ajax({
		type:'post',//可选get
		url:ctx+'Project/getProjectList',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{
			begin: 0,
			count: 2,
			uid: 'test1',
			subscribeStartDate: '2014-09-01 09:50:00',
			subscribeEndDate:'2016-09-01 09:50:00',
			status: 1		
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
        	sessionTimeout(XMLHttpRequest, textStatus, errorThrown);
        }
	})
}
function getSysInfo(){
	$.ajax({
		type:'post',//可选get
		url:'../subscribe/getSubscribeSummary.action',
		dataType:'Json',//服务器返回的数据类型 可选XML ,Json jsonp script html text等
		data:{},
		success:function(msg){
			if(msg.success){
				if(msg.dataDto && msg.dataDto.length > 0){
					systemInfo = msg.dataDto[0];
					loadSysInfo();
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
function loadSysInfo(){
	$("#projectCount").html(systemInfo.projectCount||0);
	$("#peopleCount").html(systemInfo.personCount||0);
	$("#subAmount").html(formatMillions(systemInfo.subscribeAmt));
	$("#bonusAmount").html((systemInfo.bonusAmt?systemInfo.bonusAmt/10000:0));
}
function formatDate(ss){
	var dt=new Date(ss);
	var dtstr=dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+dt.getDate();
	// dtstr=dtstr+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
	return dtstr;
}
function loadNewsData(){
	var tempHtml = "";
	// newsList = [{}];  // 测试数据
    /*
    	        <tr class="row">
	            <td class="">
	            	<h2><a href="#" style="color:red">2015/12/23</a></h2>
	            	<br>
	                <h2><a href="#">养生餐</a></h2>
	                <br>
	                <h4>
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                </h4>
	                
	            </td>
	        </tr>
    */
	//{"FID":"123","FPROJECTID":"123","FTITLE":"\u5408","FCREATORID":"123","FRELEASEDATE":"2014-09-01 09:53:00","FCONTENT":"\u5408\u80a5\u9ad8"}
	$.each(newsList, function(ind, val){
	    tempHtml += '<tr class="row"><td><h2><a style="color:red">'+val.FRELEASEDATE+'</a></h2><br>';
	    tempHtml += '<h4 style="font-weight:600"><a href="#">'+val.FTITLE+'</a></h2>';
		tempHtml += '<h4 style=""><a href="#">'+val.FCONTENT +'</a></h4><br></td></tr>';
	})
	$("#news tbody").html(tempHtml);
}
function loadProjectData(){
	var tempHtml = "";
	var tempImg = "images/254_142.png";
	var leng = 0;
	if(projectList && projectList.length > 3){
		leng = 3;
	}else{
		leng = projectList.length;
	}
	// $.each(projectList, function(ind, val){
	for(var ind=0;ind<leng;ind++){
		var val = projectList[ind];
		tempImg = "application/views/front/img/title.jpg";
		if(val.projectImages){
			tempImg = "../images/projectFiles/"+val.projectImages;
		}
	/*
		        <!--tr class="row">
	        	<td class="left_td"> 
	        		<img src="application/views/front/img/title.jpg" alt="1" width="200px" height="150px">
	        	</td>

	            <td class="right_td">
	            	<h2><a href="#" style="color:red">2015/12/23</a></h2>
	            	<br>
	                <h2><a href="#">养生餐</a></h2>
	                <br>
	                <h4>
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                	测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试测试
	                </h4>
	                
	            </td>
	        </tr-->
	*/
		tempHtml += '<tr class="row"><td class="left_td"><img src="' + tempImg + '" width="200px" height="150px"></td>';
		tempHtml += '<td class="right_td"><a href="home/index/projectDetail/?proId='+val.projectId+'"><h2 style="color:red">项目名称'+val.projectName +'</a></h2><br>';
		tempHtml += '<h4>总部最大可跟投总额（含杠杆）:'+val.HDAmount +'</a></h4><h4>区域最大可跟投总额（含杠杆）:'+val.regioAmount +'</a></h4><br></td></tr>';
		/*tempHtml += 
			'<div class="listSTY">'+
				'<div class="proPic"><a href="./projectDetail.jsp?proId='+val.projectId+'"><img width="100%" height="100%" src="'+tempImg+'" /></a></div>'+
				'<div class="proName"><a href="./projectDetail.jsp?proId='+val.projectId+'">'+val.projectName+'</a></div>'+
			'</div>';*/
	}
	// })
	//$("#projectListLayer .list").html(tempHtml);
	 $("#projects tbody").append(tempHtml);
}
</script>
</body>

