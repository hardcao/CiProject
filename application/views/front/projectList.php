<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
<script type="text/javascript" src="<?php echo site_url('application/views/front/js/projectList.js')?>"></script>

</head>

<body>
<?php require (dirname(dirname(__FILE__)).'/common/header.php'); ?>

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

<div id="footer">中粮地产集团</div>

</body>
</html>