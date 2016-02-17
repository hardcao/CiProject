<script>
function dialogAjaxDone(json){
	DWZ.ajaxDone(json);
	if (json.statusCode == DWZ.statusCode.ok){
		if (json.navTabId){
			alertMsg.correct('操作成功！');
			navTab.reload(json.forwardUrl, {}, json.navTabId);
		}
	}
}
function sConfirmMsg(){
	alertMsg.confirm("确认数据准确并继续提交吗？", {
		okCall: function(){
			$.post("<?php echo base_url();?>A03/form_submit", {postdata:$('form[name=group_form]').serialize()}, dialogAjaxDone, "json");
		}
	});

}
$(function(){
	$("#students_list_div").loadUrl("A02/students_grid");
	$("#search_btn").on("click",function(){
		var search_key = $("#search_key").val();
		if(search_key == ''){
			alertMsg.info("请输入关键字");
			$("#search_key").focus();
		}else{
			$("#jbsxBox").loadUrl("A02/memberlist?search_key=" + encodeURI(search_key));
		}
	});

});
</script>
<div class="pageContent">
	<form method="post" name="group_form">
		<div class="pageFormContent" layoutH="56">
			<div class="panel">
				<h1>基本信息</h1>
				<div>
				<label>群组名称：</label>
					<input type="text" name="name" ><span class="info"><font color="red">*</font></span>
				</div>
			</div>
			<div class="panel">
				<h1>选择学员</h1>
				<div>
					<div>
						<input type="text" id="search_key" style="width:120px" placeholder="用户编号或名称"><a class="button" href="javascript:;" id="search_btn">
							<span>检索</span>
							</a>
					</div>
					<div style="clear:both;width:100%"></div>
					<div style="float:left; display:block; overflow:auto; width:400px;height:403px; border:solid 1px #CCC; line-height:21px; background:#fff">
						
						<ul class="tree treeFolder collapse">
							
						</ul>

					</div>
					<div style="float:left;padding-left:10px;display:block;width:300px;">
						<div><a class="button" href="javascript:;" id="add_students_button">
							<span>添加选择</span>
							</a></div>
						<div id="jbsxBox" style="height:378px; overflow:auto;width:300px; border:solid 1px #CCC; line-height:21px; background:#fff">
							请先选择部门或检索
						</div>
					</div>
					<div style="float:left;padding-left:10px;display:block;width:300px;">
						<div><a class="button" href="javascript:;" id="remove_students_button">
							<span>移除选择</span>
							</a></div>
						<div id="students_list_div" style="height:378px; display:block; overflow:auto;width:300px; border:solid 1px #CCC; line-height:21px; background:#fff">
						loading...
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li><div class="buttonActive"><div class="buttonContent"><button type="button" onclick="sConfirmMsg();">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>

		<input type="hidden" name="group_id" />
	</form>
</div>
