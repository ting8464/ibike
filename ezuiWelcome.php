<?php
session_start();
?>
<!-- 用户登录或注册成功后来到的欢迎界面 -->
<html>
	<head>
		<title>欢迎您</title>
		<style type="text/css">
			.left-right{float: left;}
		</style>
		<link rel="stylesheet" href="Public/easyui/themes/default/easyui.css"/>
		<link rel="stylesheet" href="Public/easyui/themes/icon.css"/>
		<script type="text/javascript" src="Public/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="Public/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="Public/easyui/locale/easyui-lang-zh_CN.js"></script>
		<script type="text/javascript">
		 
		function addTabs($title,$url){
			$('#Tab1').tabs('add',{    
			    title:$title,
			    selected:true,
			    closable:true,
			    content:'<iframe src="'+$url+'" width="100%" height="100%" frameborder="0"></iframe>'  
			}); 
			
		}
		</script>
	</head>
	<body class="easyui-layout"> 
        <div data-options="region:'north',split:true" style="height:30px;">
        	
        	<?php
			if (isset($_SESSION["loginUser"])){
			    echo $_SESSION["loginUser"]["turename"]."欢迎您使用本公司客户管理系统，祝您使用愉快";
			}
			?>
        	<b><a href="login.php">退出</a></b>
        	
        </div> 
        
        <div data-options="region:'west',title:'系统菜单',split:true" style="width:180px;">
        	<ul id="tt" class="easyui-tree">   
			<?php 
            	foreach ($_SESSION["menus"] as $m1){
            	    if($m1["level"]==2){//如果是二级菜单
                	    echo "<li>";
                	    echo "<div class='mm' aa='0' style='cursor: pointer'>{$m1["name"]}</div>";
                	    echo "<ul style='display:none;'>";
            	        foreach ($_SESSION["menus"] as $m2){
                    	    if($m2["level"]==3 && $m2["parentlevel"]==$m1["mid"]){//如果是三级菜单，那么当前它父级菜单要与父级菜单级别相等
                    	        echo "<li><a href='javascript:addTabs(\"{$m2["name"]}\",\"{$m2["url"]}\")'>{$m2["name"]}</a></li>";                            	
                    	    }
                    	} 
                    	echo "</ul></li>";
            	    }
            	}
            ?>
            </ul>
        </div>   
        <div data-options="region:'center'" style="background:#eee;" class="easyui-layout">
        	<div data-options="region:'center'" style="background:#eee;">
            	<div id="Tab1" class="easyui-tabs" data-options="fit:true"> 
                    <div title="welcome" >   
                        <div id="cc" class="easyui-calendar"  data-options="fit:true"></div>   
                    </div>  
                </div>
           </div>  
        </div>   
    </body>  
</html>