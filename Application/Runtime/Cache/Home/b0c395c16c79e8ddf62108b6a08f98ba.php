<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>充值一览</title>
		<link rel="stylesheet" href="<?php echo ($BASEPATH); ?>Public/bootstrap/css/bootstrap.css" />
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/jquery-1.9.1.min.js" ></script>
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/bootstrap.min.js" ></script>
		<style type="text/css">
			#mytable td,th{text-align:center;}
		</style>
		<script type="text/javascript">
			$(function(){
				$("#uAccount").val("<?php echo ($uAccount); ?>");
				$("#rmoney").val("<?php echo ($rmoney); ?>");
				$("#rTime").val("<?php echo ($rTime); ?>");
			});
			//跳转页面，type=0表示按值跳转，type=1表示向前跳转，type=2表示向后跳转
			function turnPage(pageNo,pageSize,type=0){
				if(type == 2){
					window.location.href="<?php echo ($BASEPATH); ?>index.php/Home/Finance/rechargeList?pageNo="+(pageNo+1);
				}else if(type == 1){
					if(pageNo == 1){
						alert("当前已经是第一页了");
					}else{
						window.location.href="<?php echo ($BASEPATH); ?>index.php/Home/Finance/rechargeList?pageNo="+(pageNo-1);
					}
				}else{
					window.location.href="<?php echo ($BASEPATH); ?>index.php/Home/Finance/rechargeList?pageNo="+pageNo;
				}
			}
		</script>
	</head>
	<body>
		<div style="margin:1%;">
			<div >
				<form action = "<?php echo ($BASEPATH); ?>index.php/Home/Finance/rechargeList" method="post">
					<span>快速检索：</span>
					<span>
						<label>用户账号:</label>
	            		<input type="text" style="width:7%" id="uAccount" name = "uAccount"/>
					</span>
					&nbsp;&nbsp;
					<span>
						<label>充值金额:</label>
	            		<input type="text" style="width:7%" id="rmoney" name = "rmoney"/>
					</span>
					&nbsp;&nbsp;
					<span>
						<label>充值时间:</label>
	            		<input type="text" style="width:10%" id="rTime" name = "rTime"/>
					</span>
					<input type="submit" value="搜索"/>
					<input type="reset" value="重置"/>
				</form>
			</div>
			<button type="button" onclick="" class="btn btn-sm-info"><span class="glyphicon glyphicon-floppy-save"></span>导出Excel</button>
			<br/>
			<label>当前已充值总金额：<span style="color:Red;"><?php echo ($sum); ?></span></label>
		</div>
		<table id="mytable" class ="table table-hover table-bordered table-striped" style = "width: 98%;margin:1%">
			<tr>
				<th><input type="checkbox"/>多选框</th>
				<th>用户账号</th>
				<th>充值金额</th>
				<th>本次充值时间</th>
			</tr>
			<?php if(is_array($page["rows"])): $i = 0; $__LIST__ = $page["rows"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m1): $mod = ($i % 2 );++$i;?><tr>
					<td><input type="checkbox" value="<?php echo ($m1["rid"]); ?>"/></td>
					<td><?php echo ($m1["uaccount"]); ?></td>
					<td><?php echo ($m1["rmoney"]); ?></td>
					<td><?php echo ($m1["rtime"]); ?></td>
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