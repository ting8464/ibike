<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>统计管理</title>
	<link rel="stylesheet" href="<?php echo ($BASEPATH); ?>Public/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/bootstrap.min.js"></script>
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
				var a=parseInt(<?php echo ($data["total"]); ?> / pageSize);
				var b=parseInt(<?php echo ($data["total"]); ?> % pageSize);
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
			location.href="<?php echo ($BASEPATH); ?>index.php/Home/Statistics/loadStatisticalData?pageNo="+pageNo+"&pageSize="+pageSize;
		}
	</script>
</head>
<body>
	<form action="<?php echo ($BASEPATH); ?>index.php/Home/Statistics/searchPlatform" method="post">
		<input type="text" id="search" name="pPosition" class="boder" placeholder="按平台收索">
		<button type="submit"><span class="glyphicon glyphicon-search"></span>收索</button>
	</form>
	<table class="table table-striped table-bordered table-condensed" style="margin: 5px">
			<tr>
				<th>平台</th>
				<th>该平台拥有车辆数</th>
				<th>该平台正在使用车辆数</th>
				<th>该平台暂时没有使用车辆数</th>
				<th>该平台完好无损车辆数</th>
				<th>该平台已损坏的车辆数</th>
				<th>该平台完全报废的车辆数</th>
			</tr>
			<?php if(is_array($data["rows"])): $i = 0; $__LIST__ = $data["rows"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><tr>
					<td><?php echo ($p["pposition"]); ?></td>
					<td><?php echo ($p["allbike"]); ?></td>
					<td><?php echo ($p["isuse"]); ?></td>
					<td><?php echo ($p["nouse"]); ?></td>
					<td><?php echo ($p["goodbike"]); ?></td>
					<td><?php echo ($p["badbike"]); ?></td>
					<td><?php echo ($p["scrapbike"]); ?></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</table>
		<nav aria-label="Page navigation" class="text-center">
			<ul class="pagination">
				<li><a href="javascript:return false;">当前显示第<span style="color:red;"><?php echo ($data["pageNo"]); ?></span>页</a></li>
			    <li>
			      	<a href="javascript:turnpage(<?php echo ($data["pageNo"]); ?>,<?php echo ($data["pageSize"]); ?>,-1);" aria-label="Previous">
			        	<span aria-hidden="true">&laquo;</span>
			      	</a>
			    </li>
			    <li><a href="javascript:turnpage(<?php echo ($data["pageNo"]); ?>,<?php echo ($data["pageSize"]); ?>,1)">1</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($data["pageNo"]); ?>,<?php echo ($data["pageSize"]); ?>,2);">2</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($data["pageNo"]); ?>,<?php echo ($data["pageSize"]); ?>,3);">3</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($data["pageNo"]); ?>,<?php echo ($data["pageSize"]); ?>,4);">4</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($data["pageNo"]); ?>,<?php echo ($data["pageSize"]); ?>,5);">5</a></li>
			    <li>
			      	<a href="javascript:turnpage(<?php echo ($data["pageNo"]); ?>,<?php echo ($data["pageSize"]); ?>,0);" aria-label="Next">
			        	<span aria-hidden="true">&raquo;</span>
			      	</a>
			    </li>
			    <li><a href="javascript:return false;">共<span style="color:red;"><?php echo ($data["total"]); ?></span>条数据</a></li>
			</ul>
		</nav>
</body>
</html>