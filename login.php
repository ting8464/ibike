<?php
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" /> 
		<title>登录页面</title>    
		<link rel="stylesheet" href="Public/bootstrap/css/bootstrap.css" />
		<script type="text/javascript" src="Public/bootstrap/js/jquery-1.9.1.min.js" ></script>
		<script type="text/javascript" src="Public/bootstrap/js/bootstrap.min.js" ></script>
		<style type="text/css">  
			body{background-image: url(Public/img/55640ad10e47e.jpg);background-size:100%;}
			#login{box-shadow:2px 2px 1px 1px gray;border-radius: 5px;background-color: rgba(0,0,0,0.6)!important;background-color: #000;filter:Alpha(opacity=50);width: 30%;height:20%;margin: auto;background-color: white;margin-top: 7%;padding-top: 20px;}
			#portrait{width: 100px;height: 100px;background-color:whitesmoke;margin: auto;border-radius:50px;position:absolute/relative}
			#form{margin-top: 30px;position:absolute/relative}
		    #submit{margin-bottom: 5px;}
        </style>
		<script type="text/javascript">
			function aaa(obj,reg){//单个验证,失去焦点
				$(obj).parent().removeClass("has-success has-error");//清除边框颜色
				$(obj).parent().find(".glyphicon").removeClass("glyphicon-ok glyphicon-remove");//清除边框图标
				$(obj).parent().find(".tishi").hide();//把提示隐藏
					
				if (reg.test(obj.value)) {//判断输入内容是否符合正则表达式条件
					$(obj).parent().addClass("has-success");//符合把边框颜色改为绿色
					$(obj).parent().find(".glyphicon").addClass("glyphicon-ok").css("color","green").show();//符合把正确图标显示出来；
					$(obj).parent().parent().find(".tishi").hide();//把提示隐藏
				} else{
					$(obj).parent().addClass("has-error");//符合把边框颜色改为错误色
					$(obj).parent().find(".glyphicon").addClass("glyphicon-remove").css("color","red").show();//符合把正确图标显示出来；
					$(obj).parent().parent().find(".tishi").show();//把提示显示出来
				};
			};
			function a1(obj){//获取焦点   
				$(obj).parent().find(".glyphicon").removeClass("glyphicon-ok glyphicon-remove").css("color","");//清除边框图标
				$(obj).parent().removeClass("has-success has-error");//清除边框颜色
				$(obj).parent().parent().find(".tishi").hide();//把提示隐藏
			}
			function checkForm(f){//提交时判断是否阅读协议
				var s = f.ch.checked;
				if(s==false){
				alert("请选择同意协议");
				f.ch.focus();
				return false;
				}
				return true;
			}
			
		</script>
	</head>
	<body>
		<div id="login">
			<div id="portrait">
				<img src="Public/img/tou.jpg" style="border-radius:100px;width: 100%;height: 100%;"/>
			</div>
			<div id="form">
				<form action="#" method="post" class="form-horizontal" onsubmit="return checkForm(this)">
					<div class="form-group form-inline has-feedback">
						<label style="text-align: right;width: 20%;color: white;">帐号：</label>
						<div class="input-group " style="width: 70%;"><!--//按钮加图标-->
					  		<span class="input-group-addon">
					  			<span class="glyphicon glyphicon-user"></span><!--//这就是图标-->
					  		</span>
							<input type="text" class="form-control has-error nam" name="" id="" style="width: 90%;" placeholder="请输入6-12位数字的帐号" onfocus="a1(this)" onblur="aaa(this,/^[0-9]{6,12}$/)"/>    <!--用户名只能是数字-->
						</div>
						<span class="glyphicon glyphicon-remove" style="display: none;"></span>
						<label style="width: 20%;"></label>
						<label class="control-label  tishi" style="color: red;display: none;position:absolute;left: 20%;top:60%;">请输入6到12位数字组成的用户名</label>
					</div>
					  <div class="form-group form-inline has-feedback" style="margin-top:10px;">
							<label style="text-align: right;width: 20%;color: white;">密码：</label>
							<div class="input-group " style="width: 70%;"><!--//按钮加图标-->
						  		<span class="input-group-addon">
						  			<span class="glyphicon glyphicon-lock"></span><!--//这就是图标-->
						  		</span>
								<input type="password" class="form-control has-error  mi" name="pass" id="pass" style="width: 90%;" placeholder="请输入密码" onfocus="a1(this)" onblur="aaa(this,/^[a-zA-Z0-9_]{6,12}$/)"/>
							</div>
							
							<span class="glyphicon glyphicon-remove" style="margin-left: -30px;display: none;"></span>
							<label style="width: 20%;"></label>
							<label class="control-label  tishi" style="color: red;display: none;position:absolute;left: 20%;top:55%;">请输入6-12由数字和字母组成的密码</label>
						</div>
					  <div class="form-group" style="margin-top: -20px;color: yellow;">
					    <div class="col-sm-offset-2 col-sm-10">
					      <div class="checkbox">
					        <label><input type="checkbox" name="ch"> 请阅读相关协议</label>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" id="submit" class="btn btn-info" style="width: 80%;">登录</button>
					    </div>
					  </div>
				</form>
			</div>
		</div>
	</body>
</html>