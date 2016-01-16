﻿<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>跟投项目信息</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../plugins/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css" href="css/projectList.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jquery.datetimepicker.js"></script>
<script type="text/javascript" src="../plugins/jquery.json-2.4.js"></script>
<script type="text/javascript" src="../plugins/util.js"></script>
<script type="text/javascript" src="../plugins/dateFormat.js"></script>
<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript" src="js/projectList.js"></script>
<script type="text/javascript">
	 
</script>
</head>

<body>
<form id="listform" >
<jsp:include page="header.jsp"></jsp:include>
<div id="contentLayer">
	<input type="hidden" name="type" value="1">
	<div id="naviTitle"><a href="index.jsp">首页</a> > 认购项目列表</div>
	<div id="searchLayer">
		<div class="searSTY">
			项目认购开始时间:&nbsp;<input id="releaseSDate" name="releaseStartDate" readonly class="dateSTY" />至<input id="releaseEDate" name="releaseEndDate" readonly class="dateSTY" />
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
</form>
<div id="footer">旭辉集团股份有限公司</div>

</body>
</html>