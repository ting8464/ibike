<?php
namespace Home\Controller;

use Think\Controller;
use Think\Model;
class LoginController extends Controller{
    private $userMode;
    
    public function __construct(){
        parent::__construct();
        $this->userMode=new Model("tb_manager");
    }
    
    /**
     * 用户登录
     */
    public function login($user,$pass){
         $users = $this->userMode->where("mAccount='$user'")->select();
        if(count($users)> 0){
            //用户存在
            $u = $users[0];
            if($pass == $u[mpassword]){
                //密码正确
                $_SESSION["loginUser"]=$u;
                //查询用户拥有的菜单
                $menus=$this->userMode->table("tb_manager u,tb_managermenu um,tb_menu m")
                ->field("m.*")->where("u.mid=um.managerId and um.menuId=m.mid and u.mid=".$u[mid])->select();
                $_SESSION["menus"]=$menus;
    
                $this->assign("url",BASEPATH);//保存绝对路径方便页面使用
                $this->display("ezuiWelcome");
             }else {
                //密码错误
                $_SESSION["loginErro"]="对不起，您输入密码错误";
                $url=BASEPATH."/login.php";
                header("location:$url");
            }
    
        }else {
            //用户不存在
            $_SESSION["loginErro"]="对不起，您输入帐号不存在";
            $url=BASEPATH."/login.php";
            header("location:$url");
        }
    }
    
    
}

?>