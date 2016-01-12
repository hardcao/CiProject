<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>认购申请</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/subscribeApply.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/subscribeApply.js"></script>
</head>
<body>
<!-- <div id="header">
	<div id="topLayer">
		<div id="logo"></div>
		<div id="loginer"><a href="#">登录后台</a> | <a href="#">当前登录人</a></div>
		<div id="navigation">
			<ul><li ind="4">帮助中心</li>
				<li ind="3">跟投制度</li>
				<li ind="2">个人中心</li>
				<li ind="1" class="focusOn">跟投项目信息</li>
				<li ind="0">首页</li></ul>
		</div>
		<ul id="personalSelector" style="display:none;">
			<li ind="5">我要认购</li>
			<li ind="6">未完成认购</li>
			<li ind="7">已完成认购</li>
			<li ind="8">分红明细</li>
			<li ind="9">个人信息</li>
		</ul>
	</div>
</div> -->
<jsp:include page="header.jsp"></jsp:include>
<div id="contentLayer">
	<div id="naviTitle"><a href="index.jsp">首页</a> > 认购申请</div>
	<div id="protocalView">协议内容请下载附件查看。</div>
	<div id="protocalOperate">
		<input id="agreeCK" type="checkbox" />
		<label for="agreeCK">同意协议</label>
		<a href="#" class="downProtocal" id="downLoadProtocal">下载协议</a>
	</div>
	<div id="projectInfo" style="display:none;">
		<table border="0" width="100%"><tr>
			<td class="titleTd" width="35%">项目名称:</td>
			<td id="proNameTd"></td>
		</tr><tr style="display:none;">
			<td class="titleTd">项目公司:</td>
			<td id="proCompayTd"></td>
		</tr><tr id="leverSelRow">
			<td class="titleTd">杠杆比例:</td>
			<td><select id="leverSel">
				<option value="4">4</option>
				<option value="0">0</option>
			</select></td>
		</tr><tr>
			<td class="titleTd">出资下限:</td>
			<td><span id="downLimitInp">0</span> (万元)</td>
		</tr><tr>
			<td class="titleTd">出资上限:</td>
			<td><span id="upLimitInp">0</span> (万元)</td>
		</tr><tr>
			<td class="titleTd">出资金额:</td>
			<td><input id="subMoneyInp" class="inpSTY" value="0" onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" />&nbsp;(万元)</td>
		</tr><tr id="leverageRow">
			<td class="titleTd">杠杆金额:</td>
			<td><input id="levMoneyInp" class="inpSTY readonly" value="0" readonly />&nbsp;(万元)</td>
		</tr>
		<tr>
			<td class="titleTd">分红账号:</td>
			<td><select id="bonusIdInp" class="selectSTY">
				<option value="6226 3654 1231 238">6226 3654 1231 238</option>
			</select></td>
		</tr>
		
		<tr id="remissionCountTr">
			<td class="titleTd">可用豁免次数:</td>
			<td>
				<input disabled="disabled" id="remissionCount" class="inpSTY readonly" />
			</td>
		</tr>
		
		<tr>
			<td></td>
			<td height="30" valign="top">
				<span style="font-size:0.9em;">请<a id="addBonusBtn" href="javascript:void(0)" style="font-size:0.9em;">点击这里</a>添加分红帐号</span>
			</td>
		</tr>
		<tr>
			<td colspan="2"  style="text-align: center;"> 
				<div style="height: 28px;">
					<button id="submitBtn"></button>
					<button id="remissionSumbitBtn">豁免认购</button>
				</div>
			</td>
			<!-- 
			<td style="text-align: right;"><button id="submitBtn"></button></td>
			<td style="text-align: left;"><button id="remissionSumbitBtn">豁免认购</button></td>
			 -->
		</tr>
		</table>
	</div>
</div>
<div id="footer">旭辉集团股份有限公司</div>
</body>
</html>