<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>押金处理</title>
		<link rel="stylesheet" href="<?php echo ($BASEPATH); ?>Public/bootstrap/css/bootstrap.css" />
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/jquery-1.9.1.min.js" ></script>
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/bootstrap.min.js" ></script>
		<style type="text/css">
			#mytable td,th{text-align:center;}
		</style>
		<script type="text/javascript">
			$(function(){
				$("#uAccount").val("<?php echo ($uAccount); ?>");
				$("#upledge").val("<?php echo ($upledge); ?>");
				$("#uisbackpledge").val("<?php echo ($uisbackpledge); ?>");
				$("#ptime").val("<?php echo ($ptime); ?>");
			});
			//跳转页面，type=0表示按值跳转，type=1表示向前跳转，type=2表示向后跳转
			function turnPage(pageNo,pageSize,type=0){
				if(type == 2){
					window.location.href="<?php echo ($BASEPATH); ?>index.php/Home/Finance/pledgeList?pageNo="+(pageNo+1);
				}else if(type == 1){
					if(pageNo == 1){
						alert("当前已经是第一页了");
					}else{
						window.location.href="<?php echo ($BASEPATH); ?>index.php/Home/Finance/pledgeList?pageNo="+(pageNo-1);
					}
				}else{
					window.location.href="<?php echo ($BASEPATH); ?>index.php/Home/Finance/pledgeList?pageNo="+pageNo;
				}
			}
			/**
			*获取当前时间
			*/
			function getNowFormatDate() { 
			    var date = new Date(); 
			    var seperator1 = "-"; 
			    var seperator2 = ":"; 
			    var month = date.getMonth() + 1; 
			    var strDate = date.getDate(); 
			    if (month >= 1 && month <= 9) { 
			        month = "0" + month; 
			    } 
			    if (strDate >= 0 && strDate <= 9) { 
			        strDate = "0" + strDate; 
			    } 
			    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate 
			            + " " + date.getHours() + seperator2 + date.getMinutes() 
			            + seperator2 + date.getSeconds(); 
			    return currentdate; 
			} 
			//批量退回押金
			function backpledge(){
				var hid = $("#mytable input:checked");
				if(hid.length == 0){
					alert("对不起，请先选择一行进行编辑！！！");
					return;
				}
				
				var selectedUser = Array();
				for(var i = 0; i<hid.length; i++){
					if(hid.eq(i).val() != null && hid.eq(i).val() != ""){
						selectedUser.push(hid.eq(i).val());
					}
				}
				$("#selectedUser").val(selectedUser);
				
				$.post("<?php echo ($BASEPATH); ?>index.php/Home/Finance/checkPledge",$("#backPledge").serialize(),function(data){
					if(data.length > 0){
						alert("对不起！你选中的用户存在已退还押金，请重新选择！");
						return;
					}
					$("#ptime2").val(getNowFormatDate());
					$("#backPledge").submit();
				},"json");
			}
		</script>
	</head>
	<body>
		<div style="margin:1%;">
			<div >
				<form action = "<?php echo ($BASEPATH); ?>index.php/Home/Finance/pledgeList" method="post">
					<label>快速检索：</label>
					<span>
						<label>用户账号:</label>
	            		<input type="text" style="width:7%" id="uAccount" name = "uAccount"/>
					</span>
					&nbsp;&nbsp;
					<span>
						<label>是否缴纳押金:</label>
	            		<select id="upledge" name = "upledge">
	            			<option value="">请选择</option>
	            			<option value="1">是</option>
	            			<option value="0">否</option>
	            		</select>
					</span>
					&nbsp;&nbsp;
					<span>
						<label>是否退还押金:</label>
	            		<select id="uisbackpledge" name = "uisbackpledge">
	            			<option value="">请选择</option>
	            			<option value="1">是</option>
	            			<option value="0">否</option>
	            		</select>
					</span>
					&nbsp;&nbsp;
					<span>
						<label>退还押金时间:</label>
	            		<input type="text" style="width:10%" id="ptime" name = "ptime"/>
					</span>
					<input type="submit" value="搜索"/>
					<input type="reset" value="重置"/>
				</form>
			</div>
			<div style="margin-bottom:7px;">
				<form id="backPledge" action="<?php echo ($BASEPATH); ?>index.php/Home/Finance/backPledge" method="post">
					<input type="hidden" id="selectedUser" name="selectedUser"/>
					<input type="hidden" id="ptime2" name="ptime2"/>
					<label>操作：</label>
					<button type="button" onclick="backpledge();">批量退还押金</button>
				</form>
			</div>
			<button type="button" onclick="" class="btn btn-sm-info"><span class="glyphicon glyphicon-floppy-save"></span>导出Excel</button>
			
		</div>
		<table id="mytable" class ="table table-hover table-bordered table-striped" style = "width: 98%;margin:1%">
			<tr>
				<th><input type="checkbox" value=""/>多选框</th>
				<th>用户账号</th>
				<th>是否缴纳押金</th>
				<th>是否退还押金</th>
				<th>退还押金时间</th>
			</tr>
			<?php if(is_array($page["rows"])): $i = 0; $__LIST__ = $page["rows"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m1): $mod = ($i % 2 );++$i;?><tr>
					<td><input type="checkbox" value="<?php echo ($m1["uid"]); ?>"/></td>
					<td><?php echo ($m1["uaccount"]); ?></td>
					<td>
						<?php if(($m1["upledge"] == 0)): ?>否
						<?php else: ?>是<?php endif; ?>
					</td>
					<td>
						<?php if(($m1["uisbackpledge"] == 0)): ?>否
						<?php else: ?>是<?php endif; ?>
					</td>
					<td><?php echo ($m1["ptime"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		<div style="margin-top:20px;" class="text-center">
			<ul class="pagination" style="margin-top: -10px;">
				<li><a href="javascript:void(0);">当前第<span style="color:red;"><?php echo ($page["pageNo"]); ?></span>页</a></li>
                <li><a href="javascript:turnPage(<?php echo ($page["pageNo"]); ?>,2,1);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <li class="active"><a href="javascript:turnPage(1,2);">1</a></li>
                <li><a href="javascript:turnPage(2,2);">2</a></li>
                <li><a href="javascript:turnPage(3,2);">3</a></li>
                <li><a href="javascript:turnPage(4,2);">4</a></li>
                <li><a href="javascript:turnPage(5,2);">5</a></li>
                <li><a href="javascript:turnPage(<?php echo ($page["pageNo"]); ?>,2,2);" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                <li><a href="javascript:void(0);">共<span style="color:red;"><?php echo ($page["total"]); ?></span>条记录</a></li>
           	</ul>
		</div>
	</body>
</html>