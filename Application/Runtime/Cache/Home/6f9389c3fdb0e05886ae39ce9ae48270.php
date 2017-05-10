<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>添加活动</title>
		<link rel="stylesheet" href="<?php echo ($BASEPATH); ?>Public/bootstrap/css/bootstrap.css" />
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/jquery-1.9.1.min.js" ></script>
		<script type="text/javascript" src="<?php echo ($BASEPATH); ?>Public/bootstrap/js/bootstrap.min.js" ></script>
		<style type="text/css"></style>
		<script type="text/javascript">
		$(function(){
			$("#PlatformActivity").hide();
			$("#addPlatformActivity").click(function(){
				$("#PlatformActivity").show();
				$("#addPlatformActivity").hide();
				$("#addActivity").hide();
			});
			
		});
		</script>
	</head>
	<body >
		<div class="col-md-6 col-md-offset-3" style="text-align: center;margin-top: 10%">
			<h1>
				<button class="btn btn-info btn-lg" id="addPlatformActivity">添加平台加盟活动</button>
			</h1>
			<h1>
				<button class="btn btn-info btn-lg" id="addActivity">添加活动</button>
			</h1>
		</div>
	    <div class="col-md-6 col-md-offset-3" id="PlatformActivity">
    		<div class="panel panel-primary" style="margin-top: -100px">
    			<div class="panel-heading">添加平台加盟活动</div>
				<div class="panel-body" style="margin-top: 20px">
					<form action="http://localhost:8080/ibike/index.php/Home/Activity/addPlatformActivity" method="post">
						<div class="form-group form-inline has-feedback">
							<label style="text-align: right;width: 20%;">活动方式：</label>
							<div class="input-group " style="width: 70%;">
						  		<input type="text" class="form-control has-error" name="tname" id="tname" style="width: 90%;border: 1px solid #265A88;" placeholder="请输入加盟方式" />   
							</div>
						</div>
						<div class="form-group form-inline has-feedback">
							<label style="text-align: right;width: 20%;">开始时间：</label>
							<div class="input-group " style="width: 70%;">
						  		<input type="text" class="form-control has-error" name="tstarttime" id="tstarttime" style="width: 90%;border: 1px solid #265A88;" placeholder="请输入活动开始时间2017-01-01" />   
							</div>
						</div>
						<div class="form-group form-inline has-feedback">
							<label style="text-align: right;width: 20%;">结束时间：</label>
							<div class="input-group " style="width: 70%;">
						  		<input type="text" class="form-control has-error" name="tendtime" id="tendtime" style="width: 90%;border: 1px solid #265A88;" placeholder="请输入活动结束时间2017-01-01" />   
							</div>
						</div>
						<div class="form-group form-inline has-feedback">
							<label style="text-align: right;width: 20%;">活动优惠：</label><br/>
							<div class="input-group " style="width: 70%;margin-left: 20%;">
								<textarea name="tcontent" id="tcontent" style="width: 90%;height:150px;border: 1px solid #265A88;"></textarea>
						  	</div>
						</div>
						<div class="form-group form-inline" style="width: 100%;text-align: center;">
							<input type="reset" value="取消" style="width: 30%;" id="reset" />
							<input type="submit" value="确认" style="width: 30%;" id="submit" />
						</div>
					</form>
				</div>
			</div>
		</div>
		
	</body>
</html>