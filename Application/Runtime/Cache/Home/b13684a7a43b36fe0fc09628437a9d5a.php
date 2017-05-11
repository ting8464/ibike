<?php if (!defined('THINK_PATH')) exit();?>
<!-- 用户登录或注册成功后来到的欢迎界面 -->
<html>
	<head>
		<title>欢迎您</title>
		<style type="text/css">
			.left-right{float: left;}
		</style>
		<link rel="stylesheet" href="<?php echo ($url); ?>Public/easyui/themes/default/easyui.css"/>
		<link rel="stylesheet" href="<?php echo ($url); ?>Public/easyui/themes/icon.css"/>
		<script type="text/javascript" src="<?php echo ($url); ?>Public/bootstrap/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="<?php echo ($url); ?>Public/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="<?php echo ($url); ?>Public/easyui/locale/easyui-lang-zh_CN.js"></script>
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
        	欢迎您，<?php echo ($_SESSION['loginUser']['turename']); ?>
        	
        	<b><a href="login.php">退出</a></b>
        	
        </div> 
        
        <div data-options="region:'west',title:'系统菜单',split:true" style="width:180px;">
        	<ul id="tt" class="easyui-tree">   
        		<?php if(is_array($_SESSION['menus'])): $i = 0; $__LIST__ = $_SESSION['menus'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m1): $mod = ($i % 2 );++$i; if($m1["mlevel"] == 1): ?><!--如果是二级菜单-->
        				<li>
        					<span><?php echo ($m1["mname"]); ?></span>
        					<ul>
        						<?php $mid = $m1["mid"]; ?>
	        					<?php if(is_array($_SESSION['menus'])): $i = 0; $__LIST__ = $_SESSION['menus'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m2): $mod = ($i % 2 );++$i; if($m2["mlevel"] == 2 AND $m2["mparentid"] == $mid): ?><!--如果是三级菜单-->
	        							<li>
	        								<a href="javascript:addTabs('<?php echo ($m2["mname"]); ?>','<?php echo ($url); echo ($m2["murl"]); ?>')"><?php echo ($m2["mname"]); ?></a>
	        							</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        					</ul>
        				</li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			
<!--             	foreach ($_SESSION["menus"] as $m1){ -->
<!--             	    if($m1["level"]==2)</div>"; -->
<!--                 	     "<ul style='display:none;'>"; -->
<!--             	        foreach ($_SESSION["menus"] as $m2){ -->
<!--                     	    if($m2["level"]==3 && $m2["parentlevel"]==$m1["mid"])\",\"<?php echo ($m2["url"]); ?>\")'><?php echo ($m2["name"]); ?></a></li>";                            	 -->
<!--                     	    } -->
<!--                     	}  -->
<!--                     	 "</ul></li>"; -->
<!--             	    } -->
<!--             	} -->
        
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