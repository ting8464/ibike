<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>平台展示页面</title>
		<link rel="stylesheet" href="<?php echo ($BASEPATH); ?>Public/bootstrap/css/bootstrap.min.css" />
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/bootstrap.min.js"></script>
	</head>
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
				var a=parseInt(<?php echo ($Platforms["total"]); ?> / pageSize);
				var b=parseInt(<?php echo ($Platforms["total"]); ?> % pageSize);
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
			location.href="<?php echo ($BASEPATH); ?>index.php/Home/Platform/loadPlatform?pageNo="+pageNo+"&pageSize="+pageSize;
		}
		
		/*
		*以下是新增或者修改函数
		*/
		function addOrUpdate(type){
			if(type == 1){
				//传来的是1就是新增
				$("#myModal").modal('toggle');//打开模态窗
				$("#pId").val("-1");
			}else{
				//修改
				var pIds=$("input[name=pId]:checked");
				if(pIds.length !=1 ){
					alert("请选择一行数据进行操作");
					return;
				}
				$("#myModal").modal('toggle');//打开模态窗
				$.post("<?php echo ($BASEPATH); ?>index.php/Home/Platform/loadPlatform",{"pId":pIds.val()},function(data){
					$("#pId").val(data.pid);
					$("#Position").val(data.pposition);
				},"json");
			}
		}
		
	</script>
	</head>
	<body>
		<div>
			<form action="<?php echo ($BASEPATH); ?>index.php/Home/Platform/searchPlatform" method="post">
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="addOrUpdate(1)"><span class="glyphicon glyphicon-plus"></span>新增</button>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="addOrUpdate(2)"><span class="glyphicon glyphicon-pencil"></span>修改</button>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick=""><span class="glyphicon glyphicon-share-alt"></span>导出Excel</button>
			
				<input type="text" id="search" name="pPosition" class="boder" placeholder="按平台位置收索">
				<button type="submit"><span class="glyphicon glyphicon-search"></span>收索</button>
			</form>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">新增/修改</h4>
		      </div>
		       <form action="http://localhost:8080/ibike/index.php/Home/Platform/addOrUpdate" method="post">
		      		<div class="modal-body">
		      			<input type="hidden" value="" name="pId" id="pId">
						<div class="form-group form-inline has-feedback">
							<label style="width: 20%;">平台位置：</label>
							<input type="text" class="form-control has-error nam" name="pPosition" id="Position" style="width: 90%;" placeholder="请输入" /> 
						</div>
					
						<div class="form-group form-inline">
						    <label for="pIsUsed">是否使用</label>
						   	<select id="usertype" name="pIsUsed" class="selectpicker show-tick" style="width: 30%">
                                  <option value="-1">请选择</option>
                                  <option value="0">还没使用</option>
                                  <option value="1">启用</option>
                             </select>
					  	</div>
						
						<div class="form-group form-inline has-feedback">
							<div class="modal-footer">
						        <button type="reset" class="btn btn-default">取消</button>
						        <button type="submit" class="btn btn-primary">确认</button>
						    </div>
					    </div>
			      </div>
		      </form>
		    </div>
		  </div>
		</div>
		<table class="table table-striped table-bordered table-condensed">
			<tr>
				<th><input type="checkbox" name=""/></th>
				<th>编号</th>
				<th>平台位置</th>
				<th>是否启用</th>
				
			</tr>
			<?php if(is_array($Platforms["rows"])): foreach($Platforms["rows"] as $key=>$p): ?><tr>
					<td><input type="checkbox" name="pId" value="<?php echo ($p["pid"]); ?>"/></td>
					<td><?php echo ($p["pid"]); ?></td>
					<td><?php echo ($p["pposition"]); ?></td>
					<td>
						<?php if(($p["pisused"] == 0)): ?>否
						<?php else: ?>是<?php endif; ?>
					</td>
				</tr><?php endforeach; endif; ?>
		</table>
		<nav aria-label="Page navigation" class="text-center">
			<ul class="pagination">
				<li><a href="javascript:return false;">当前显示第<span style="color:red;"><?php echo ($Platforms["pageNo"]); ?></span>页</a></li>
			    <li>
			      	<a href="javascript:turnpage(<?php echo ($Platforms["pageNo"]); ?>,<?php echo ($Platforms["pageSize"]); ?>,-1);" aria-label="Previous">
			        	<span aria-hidden="true">&laquo;</span>
			      	</a>
			    </li>
			    <li><a href="javascript:turnpage(<?php echo ($Platforms["pageNo"]); ?>,<?php echo ($Platforms["pageSize"]); ?>,1);">1</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($Platforms["pageNo"]); ?>,<?php echo ($Platforms["pageSize"]); ?>,2);">2</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($Platforms["pageNo"]); ?>,<?php echo ($Platforms["pageSize"]); ?>,3);">3</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($Platforms["pageNo"]); ?>,<?php echo ($Platforms["pageSize"]); ?>,4);">4</a></li>
			    <li><a href="javascript:turnpage(<?php echo ($Platforms["pageNo"]); ?>,<?php echo ($Platforms["pageSize"]); ?>,5);">5</a></li>
			    <li>
			      	<a href="javascript:turnpage(<?php echo ($Platforms["pageNo"]); ?>,<?php echo ($Platforms["pageSize"]); ?>,0);" aria-label="Next">
			        	<span aria-hidden="true">&raquo;</span>
			      	</a>
			    </li>
			    <li><a href="javascript:return false;">共<span style="color:red;"><?php echo ($Platforms["total"]); ?></span>条数据</a></li>
			</ul>
		</nav>
	</body>
</html>