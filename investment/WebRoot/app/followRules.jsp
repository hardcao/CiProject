<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<title>制度说明</title>

<link rel="stylesheet" type="text/css" href="css/public.css">
<link rel="stylesheet" type="text/css" href="../plugins/jqm/jquery.mobile-1.4.4.css">
<script type="text/javascript" src="../plugins/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../plugins/jqm/jquery.mobile-1.4.4.js"></script>
<script type="text/javascript" src="../plugins/jQuery.fontFlex.js"></script>

<style type="text/css">
#header ul{border: none;}
#header li{border: none;text-align: center;background: #FFF;}
#header .borderR_STY{border-right: 1px solid lightgray;}
#header #posIcon{height: 3px;position: absolute;bottom: 0px;z-index: 10;background: #3388cc;width: 50%;left: 0%;}

#header .ui-header{border:none;border-bottom: 1px solid lightgray;}
#header .ui-navbar ul{padding: 10px 0;background: #FFF;}
.ui-page-theme-a #header .ui-btn, html .ui-bar-a .ui-btn, html .ui-body-a .ui-btn, html body .ui-group-theme-a #header .ui-btn, html head + body #header .ui-btn.ui-btn-a, .ui-page-theme-a #header .ui-btn:visited, html .ui-bar-a .ui-btn:visited, html .ui-body-a .ui-btn:visited, html body .ui-group-theme-a #header .ui-btn:visited, html head + body #header .ui-btn.ui-btn-a:visited{background: #FFFFFF;border: none;font-size: .8em;font-weight: 100;text-shadow:none;}
.ui-page-theme-a .ui-btn.ui-btn-active, html .ui-bar-a .ui-btn.ui-btn-active, html .ui-body-a .ui-btn.ui-btn-active, html body .ui-group-theme-a .ui-btn.ui-btn-active, html head + body .ui-btn.ui-btn-a.ui-btn-active, .ui-page-theme-a .ui-checkbox-on:after, html .ui-bar-a .ui-checkbox-on:after, html .ui-body-a .ui-checkbox-on:after, html body .ui-group-theme-a .ui-checkbox-on:after, .ui-btn.ui-checkbox-on.ui-btn-a:after, .ui-page-theme-a .ui-flipswitch-active, html .ui-bar-a .ui-flipswitch-active, html .ui-body-a .ui-flipswitch-active, html body .ui-group-theme-a .ui-flipswitch-active, html body .ui-flipswitch.ui-bar-a.ui-flipswitch-active, .ui-page-theme-a .ui-slider-track .ui-btn-active, html .ui-bar-a .ui-slider-track .ui-btn-active, html .ui-body-a .ui-slider-track .ui-btn-active, html body .ui-group-theme-a .ui-slider-track .ui-btn-active, html body div.ui-slider-track.ui-body-a .ui-btn-active{color: #3388cc;text-shadow:0 0px 0 #005599;font-weight:bold;}
</style>
<script type="text/javascript">
$(function(){
	$('body').fontFlex(14, 60, 40);

	initListeners();
	initPages();
});
function initListeners(){
	$(".navTab").click(switchTab);
}
function initPages(){
	$(".navTab").get(0).click();
}
function switchTab (argument) {
	var _ind = $(this).attr("ind");
	var _left = (parseInt(_ind)*50)+"%";
	$("#posIcon").animate({"left": _left});

	$(".content").each(function(){
		if($(this).attr("id") == ("content_"+_ind)){
			$(this).show();
		}else{
			$(this).hide();
		}
	});
}
</script>
</head>
<body>
<div data-role="page">
	<div id="header" data-role="header">
		<div data-role="navbar">
			<ul>
				<li class="borderR_STY"><a class="navTab" ind="0" href="">跟投方案提报要求</a></li>
				<li class=""><a class="navTab" ind="1" href="">跟投细则说明</a></li>
				<!-- <li><a class="navTab" ind="2" href="">跟投协议</a></li> -->
			</ul>
		</div>
		<div id="posIcon"></div>
	</div>
	<div data-role="content" id="content_0" class="content" style="display:none">
		<div>为进一步落实集团项目跟投规定，帮助各一线公司更明确制定具体项目跟投方案，特对项目跟投方案提报内容作出以下要求。各一线公司需按照跟投要求编写项目跟投方案，并报集团跟投工作小组审批。项目跟投提报详细方案中必须包括：<br>
		<b>1.跟投项目情况（需附带项目跟投测算表格）</b><br>
		  &nbsp;&nbsp;&nbsp;&nbsp;a) 项目基础信息；<br>
		  &nbsp;&nbsp;&nbsp;&nbsp;b) 项目资金解决方案、资金使用计划、资金峰值、股权比率和杠杆比率；<br>
		  &nbsp;&nbsp;&nbsp;&nbsp;c) 项目合作方简介及合作主要条款；<br>
		  &nbsp;&nbsp;&nbsp;&nbsp;d) 预计项目层面、旭辉权益层面和跟投权益层面回报预算，包括IRR和净利率、自有投资回报率<br>
		<b>2.跟投人员跟投额度比例及分配</b><br>
		  &nbsp;&nbsp;&nbsp;&nbsp;a) 包括跟投项目所在地公司跟投额度、集团的额度分配比例；（项目跟投额度上限为项目预测资金峰值的10%，且不超过跟投前旭辉占股的30%）；<br>
		  &nbsp;&nbsp;&nbsp;&nbsp;b) 项目强投包跟投人员范围及预计投资金额； <br>
		  &nbsp;&nbsp;&nbsp;&nbsp;c) 杠杆分配方式及杠杆资金利率<br>
		<b>3.跟投资金募集方式以及时间</b><br>
		  &nbsp;&nbsp;&nbsp;&nbsp;（一次跟投，分次募集，认购方案需提交集团跟投工作小组审批；在土地款支付前完成募集）<br>
		<b>4.本金及利润分配</b><br>
		  &nbsp;&nbsp;&nbsp;&nbsp;（制定本金及收益的分配方式：分配原则、分配时点；分配方式和比例应遵循与项目其他股东同股同权原则，分配方案需经总部认可后报项目董事会审批。对于项目潜在经营风险和交付后风险应在收益分配中予以考虑。）<br>
		<b>5.信息披露方案</b><br>
		  &nbsp;&nbsp;&nbsp;&nbsp;（信息披露的责任主体、方式、频率及内容。）<br>
		<b>6.跟投代持人员及权利义务</b><br>
		  &nbsp;&nbsp;&nbsp;&nbsp;（员工跟投通过有限合伙企业的方式进行，用于跟投的有限合伙企业B的GP（普通合伙人）由城市公司总经理担任，项目所在地公司自行推举有公信力、有专业判断能力的员工代持投资<br>
		  &nbsp;&nbsp;&nbsp;&nbsp;（每项目对应1人），作为有限合伙B的LP；有限合伙B与资管机构成立的有限合伙A作为直接投资主体）<br>
		<b>7.投资风险提示</b><br>
		  &nbsp;&nbsp;&nbsp;&nbsp;（说明项目跟投的风险：跟投人员与其他投资人共担风险，投资回报具有波动性和不确定性，跟投份额不可转让不可消灭）<br>
		</div>
	</div>
	<div data-role="content" id="content_1" class="content" style="display:none">
		<div>为帮助各一线公司更明确的制定项目跟投机制细则，特就部分关键准则进行说明，供各一线公司在制定细则时参照。<br>
&nbsp;&nbsp;&nbsp;&nbsp;1.坚持公开、公正的原则，对项目所在地公司和集团正式员工开放，原则上各项目跟投上限额度中须设定不低于50%的额度作为选投包额度。  <br>
&nbsp;&nbsp;&nbsp;&nbsp;2.可跟投项目为2014年5月15日之后获取的旭辉操盘的新项目（特殊项目，如全持有商办项目、战略储备型项目、旧城改造型项目等除外）<br>
&nbsp;&nbsp;&nbsp;&nbsp;3.跟投者必须与项目其他股东“同股同权,同责同利”。<br>
&nbsp;&nbsp;&nbsp;&nbsp;4.项目跟投额度上限为项目预测资金峰值的10%，且不超过跟投前旭辉占股的30%。<br>
&nbsp;&nbsp;&nbsp;&nbsp;5.对于新获取的项目，所有跟投资金须与其他股东同步到位。<br>
&nbsp;&nbsp;&nbsp;&nbsp;6.员工跟投通过有限合伙企业的方式进行，用于跟投的有限合伙企业A（“直接投资主体”）的GP（普通合伙人）由集团选定的资管公司担任。 <br>
&nbsp;&nbsp;&nbsp;&nbsp;7.项目所在地公司自行推举有公信力、有专业判断能力的员工代持投资（每项目对应1人），作为有限合伙企业B的LP，项目所在地公司总经理作为作为有限合伙企业B的GP签署投资相关文件。<br>
&nbsp;&nbsp;&nbsp;&nbsp;8.城市公司跟投工作小组将根据员工投资总额平衡认购额度，上报集团跟投工作小组审批，完成资金募集后上报集团跟投工作小组审批；城市公司跟投工作小组制定跟投项目本金、利润分配方案，并
  报集团审批。<br>
&nbsp;&nbsp;&nbsp;&nbsp;9.新项目获取后1周内，城市公司跟投工作小组按土地实际成交情况制定《项目跟投方案》，经集团跟投工作小组审批后发布，发布后2周内，完成资金募集工作。<br>
&nbsp;&nbsp;&nbsp;&nbsp;10. 员工投资所得应按规定缴纳个人所得税，可由有限合伙B代缴</div>
	</div>
	<div data-role="content" id="content_2" class="content" style="display:none">
		<div data-role="collapsible-set" data-inset="false">
			<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u" data-collapsed="true">
				<h3>协议1</h3>
				<p>内容一</p>
			</div>
			<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
				<h3>协议2</h3>
				<p>内容2</p>
			</div>
			<div data-role="collapsible" data-collapsed-icon="arrow-d" data-expanded-icon="arrow-u">
				<h3>协议3</h3>
				<p>内容3</p>
			</div>
		</div>
	</div>
</div>
</body>
</html>