<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>优惠券一览</title>
		<link rel="stylesheet" href="<?php echo ($BASEPATH); ?>Public/bootstrap/css/bootstrap.css" />
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/jquery-1.9.1.min.js" ></script>
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/bootstrap.min.js" ></script>
		<style type="text/css">
			#mytable td,th{text-align:center;}
		</style>
		<script type="text/javascript">
			$(function(){
				$("#dLimit").val("<?php echo ($dLimit); ?>");
				$("#dGive").val("<?php echo ($dGive); ?>");
				if(<?php echo ($searchRelation); ?>==0){
					$("#eq").prop("checked",true);
				}else if(<?php echo ($searchRelation); ?>==1){
					$("#gt").prop("checked",true);
				}else{
					$("#lt").prop("checked",true);
				}
			});
			
			//跳转页面，type=0表示按值跳转，type=1表示向前跳转，type=2表示向后跳转
			function turnPage(pageNo,pageSize,type=0){
				if(type == 2){
					window.location.href="<?php echo ($BASEPATH); ?>index.php/Home/Discount/discountListByPage?pageNo="+(pageNo+1);
				}else if(type == 1){
					if(pageNo == 1){
						alert("当前已经是第一页了");
					}else{
						window.location.href="<?php echo ($BASEPATH); ?>index.php/Home/Discount/discountListByPage?pageNo="+(pageNo-1);
					}
				}else{
					window.location.href="<?php echo ($BASEPATH); ?>index.php/Home/Discount/discountListByPage?pageNo="+pageNo;
				}
			}
			function updateDiscount(){
				did = $("#mytable input:checked");
				$("#cancel").click();
				if(did.length == 0){
					alert("对不起，请先选择一行进行编辑！！！");
					return;
				}
				if(did.length > 1){
					alert("对不起，您只能选择一行进行编辑！！！");
					return;
				}
				if (confirm("你确定修改吗？")) {
					var did = did.eq(0).val();
					$("#dId").val(did);
					$.post("<?php echo ($BASEPATH); ?>index.php/Home/Discount/loadPickPickDiscount?dId="+did,function(data){
						$("#dCount2").val(data[0]["dcount"]);
						$("#dLimit2").val(data[0]["dlimit"]);
						$("#dGive2").val(data[0]["dgive"]);
                   	},"json");
					$("#openWin").click();
		        }
			}
		</script>
	</head>
	<body>
		<div style="margin:1%;">
			<div >
				<form action = "<?php echo ($BASEPATH); ?>index.php/Home/Discount/discountListByPage" method="post">
					<span>快速检索：</span>
					<span>
						<label>优惠券限制充值金额:</label>
	            		<input type="text" style="width:7%" id="dLimit" name = "dLimit"/>
					</span>
					&nbsp;&nbsp;
					<span>
						<label>优惠券赠送金额:</label>
	            		<input type="text" style="width:7%" id="dGive" name = "dGive"/>
					</span>
					&nbsp;&nbsp;
					<input type="radio" id="eq" name="searchRelation" checked="checked" value="0"/>等于
					<input type="radio" id="gt" name="searchRelation" value="1"/>大于
					<input type="radio" id="lt" name="searchRelation" value="2"/>小于
					<input type="submit" value="搜索"/>
					<input type="reset" value="重置"/>
				</form>
			</div>
			<button style="display:none;" "button" data-toggle="modal" data-target="#myModal" id="openWin">
			<button type="button" onclick="updateDiscount()" class="btn btn-sm-info"><span class="glyphicon glyphicon-pencil"></span>修改</button>
			<button type="button" class="btn btn-sm-info"><span class="glyphicon glyphicon-trash"></span>删除</button>
		</div>
		<table id="mytable" class ="table table-hover table-bordered table-striped" style = "width: 98%;margin:1%">
			<tr>
				<th><input type="checkbox"/>多选框</th>
				<th>优惠券详细信息</th>
				<th>优惠券限制充值金额</th>
				<th>优惠券赠送金额</th>
			</tr>
			<?php if(is_array($page["rows"])): $i = 0; $__LIST__ = $page["rows"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m1): $mod = ($i % 2 );++$i;?><tr>
					<td><input type="checkbox" value="<?php echo ($m1["did"]); ?>"/></td>
					<td><?php echo ($m1["dcount"]); ?></td>
					<td><?php echo ($m1["dlimit"]); ?></td>
					<td><?php echo ($m1["dgive"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		<div style="margin-top:20px;" class="text-center">
			<ul class="pagination" style="margin-top: -10px;">
				<li><a href="javascript:void(0);">当前第<span style="color:red;"><?php echo ($page["pageNo"]); ?></span>页</a></li>
                <li><a href="javascript:turnPage(<?php echo ($page["pageNo"]); ?>,2,1);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <li><a href="javascript:turnPage(1,2);">1</a></li>
                <li><a href="javascript:turnPage(2,2);">2</a></li>
                <li><a href="javascript:turnPage(3,2);">3</a></li>
                <li><a href="javascript:turnPage(4,2);">4</a></li>
                <li><a href="javascript:turnPage(5,2);">5</a></li>
                <li><a href="javascript:turnPage(<?php echo ($page["pageNo"]); ?>,2,2);" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                <li><a href="javascript:void(0);">共<span style="color:red;"><?php echo ($page["total"]); ?></span>条记录</a></li>
           	</ul>
		</div>
		<div class="modal fade" tabindex="-1" id="myModal" role="dialog">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			    	<div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title">修改优惠券信息</h4>
			    	</div>
			        <form id="myform" method="post" action="<?php echo ($BASEPATH); ?>index.php/Home/Discount/updateDiscount">
				    	<div class="modal-body">
				    		<input type="hidden" id = "dId" name = "dId" value=""/>
			            	<div style="width:100%; text-align:center;" class="form-group">
			            		<label for="dCount2" style="width:30%">优惠券详细信息：</label>
			            		<input type="text" id="dCount2" name="dCount" style="width:68%"/> 		
			            	</div>
			            	<div style="width:100%; text-align:center;" class="form-group">
			            		<label for="dLimit2" style="width:30%">优惠券限制充值金额：</label>
			            		<input type="text" id="dLimit2" name="dLimit" style="width:68%"/> 		
			            	</div>
			            	<div style="width:100%; text-align:center;" class="form-group">
			            		<label for="dGive2" style="width:30%">优惠券赠送金额：</label>
			            		<input type="text" id="dGive2" name="dGive" style="width:68%" /> 		
			            	</div>
				    	</div>
				    	<div class="modal-footer">
					        <button type="submit" class="btn btn-primary">确认</button>
					        <button type="reset" id="cancel" class="btn btn-default" data-dismiss="modal">取消</button>
				    	</div>
				    </form>
			    </div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</body>
</html>