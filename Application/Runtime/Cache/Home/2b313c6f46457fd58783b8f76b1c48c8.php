<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>添加单车平台</title>
		<link rel="stylesheet" href="../../../../Public/bootstrap/css/bootstrap.css" />
		<script type="text/javascript" src="../../../../Public/bootstrap/js/jquery-1.9.1.min.js" ></script>
		<script type="text/javascript" src="../../../../Public/bootstrap/js/bootstrap.min.js" ></script>
		<style type="text/css"></style>
		<script type="text/javascript">
		$(function(){
			$("#dialog").modal("show");
		});
		</script>
	</head>
	<body>
	    <div class="container">
			<div class="row">
				<img style="width: 100%;height: 100%" src="../../../../Public/img/U11696P6T1024D13766F30636DT20140923165921.jpg">
								
				<div class="col-md-offset-6 col-md-2">
					<div class="modal fade" tabindex="-1" role="dialog" id="dialog">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header alert-success">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">添加平台</h4>
							    </div>
							    <div class="modal-body" style="text-align: center;">
								    <form action="http://localhost:8080/ibike/index.php/Home/Platform/addPlatform" method="post" class="form-horizontal">
									    <div class="form-group form-inline">
										    <label for="Position">平台位置</label>
										    <input type="text" class="form-control" name="pPosition" id="Position" placeholder="添加平台位置">
									    </div>
									    <div class="form-group form-inline">
										    <label for="pIsUsed">是否使用</label>
										   <select id="usertype" name="pIsUsed" class="selectpicker show-tick" style="width: 30%">
		                                        <option value="0">还没使用</option>
		                                        <option value="1">启用</option>
                                        	</select>
									  	</div>
								      	<div class="modal-footer">
								      		<button type="reset" class="btn btn-info">取消</button>
									        <button type="submit" class="btn btn-info">确定</button>
								      	</div>
									</form>
								</div>
						    </div><!-- /.modal-content的结束 -->    
						</div><!-- /.modal-dialog 的结束-->
					</div>  	
			  	</div>
			</div>
		</div>
	</body>
</html>