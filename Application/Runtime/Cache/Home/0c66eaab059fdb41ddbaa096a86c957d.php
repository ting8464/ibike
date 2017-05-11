<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>展示平台加盟活动页面</title>
		<link rel="stylesheet" href="<?php echo ($BASEPATH); ?>Public/bootstrap/css/bootstrap.css" />
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/jquery-1.9.1.min.js" ></script>
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/bootstrap.min.js" ></script>
		<style type="text/css"></style>
		<script type="text/javascript">
		/*
		 *点击分页处理函数
		 */
		function turnpage(pageNo,pageSize,type){
			if(type == -1){
				pageNo = pageNo-1;
				if(pageNo == 0){
					alert("已经是第一页了");
					return;
				}
			}else if(type == 0){
				pageNo = pageNo+1;
				var a=parseInt(<?php echo ($platformActivity["total"]); ?> / pageSize);
				var b=parseInt(<?php echo ($platformActivity["total"]); ?> % pageSize);
				if(b > 0){
					a +=1;
				}
				if(pageNo > a){
					alert("已经是最后一页了");
					return;
				}
				
			}else{
				pageNo = type;
				
			}
			location.href="<?php echo ($BASEPATH); ?>index.php/Home/Activity/showAddPlatformActicity?pageNo="+pageNo+"&pageSize="+pageSize;
		}
		</script>
	</head>
	<body>
		<form action="<?php echo ($BASEPATH); ?>index.php/Home/Activity/searchPlatformActivity" method="post">
			<div class="form-group form-inline">
				<input type="text" id="searchJoinway" name="searchJoinway" class="form-control" style="width: 20%;border-color:" placeholder="按加盟方式收索">
				<input type="text" id="searchBenefit" name="searchBenefit" class="form-control" style="width: 20%" placeholder="按优惠收索">
				<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search" ></span>收索</button>
			</div>
		</form>
		<table class="table table-striped table-bordered table-condensed">
			<tr>
				<th><input type="checkbox" name=""/></th>
				<th>加盟方式</th>
				<th>加盟优惠</th>
				<th>活动开始时间</th>
				<th>活动结束时间</th>
			</tr>
			<?php if(is_array($platformActivity["rows"])): foreach($platformActivity["rows"] as $key=>$p): ?><tr>
					<td><input type="checkbox" name="tid" value="<?php echo ($p["tid"]); ?>"/></td>
					<td><?php echo ($p["tname"]); ?></td>
					<td><?php echo ($p["tcontent"]); ?></td>
					<td><?php echo ($p["tstarttime"]); ?></td>
					<td><?php echo ($p["tendtime"]); ?></td>
				</tr><?php endforeach; endif; ?>
		</table>
		<nav aria-label="Page navigation" class="text-center" style="margin-top: -25px">
			<ul class="pagination">
				<li><a href="javascript:return false;">当前显示第<span style="color:red;"><?php echo ($platformActivity["pageNo"]); ?></span>页</a></li>
			    <li>
			      	<a href="javascript:turnpage(<?php echo ($platformActivity["pageNo"]); ?>,<?php echo ($platformActivity["pageSize"]); ?>,-1);" aria-label="Previous">
			        	<span aria-hidden="true">&laquo;</span>
			      	</a>
			    </li>
			    <li><a href="javascript:turnpage(<?php echo ($platformActivity["pageNo"]); ?>,<?php echo ($platformActivity["pageSize"]); ?>,1);">1</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($platformActivity["pageNo"]); ?>,<?php echo ($platformActivity["pageSize"]); ?>,2);">2</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($platformActivity["pageNo"]); ?>,<?php echo ($platformActivity["pageSize"]); ?>,3);">3</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($platformActivity["pageNo"]); ?>,<?php echo ($platformActivity["pageSize"]); ?>,4);">4</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($platformActivity["pageNo"]); ?>,<?php echo ($platformActivity["pageSize"]); ?>,5);">5</a></li>
			    <li>
			      	<a href="javascript:turnpage(<?php echo ($platformActivity["pageNo"]); ?>,<?php echo ($platformActivity["pageSize"]); ?>,0);" aria-label="Next">
			        	<span aria-hidden="true">&raquo;</span>
			      	</a>
			    </li>
			    <li><a href="javascript:return false;">共<span style="color:red;"><?php echo ($platformActivity["total"]); ?></span>条数据</a></li>
			</ul>
		</nav>
	</body>
</html>