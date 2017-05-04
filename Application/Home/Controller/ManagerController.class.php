<?php
namespace Home\Controller;

use Think\Controller;
class ManagerController extends Controller{
    private $userModel;
    public function __construct(){
        parent::__construct();
        $this->userModel= D("tb_manager");//new TbEmployeeModel();
        //M("tb_employee"); //new Model("tb_employee");
    }
    
    
    
    /**
     * 登录
     * @param unknown $userName
     * @param unknown $userPass
     */
    public function login($userName,$userPass){
        //查询数据
        $users = $this->userModel->where("mAccount = '$userName'")->select();
        $host = $_SERVER["HTTP_HOST"];
        if (count($users)>0){
            $u=$users[0];
            if ($userPass == $u["mPassword"]){
                $_SESSION["loginUser"] = $u;
                $menus = $this->userModel->table("tb_managermenu mm,tb_menu me")->field("m.*")
                ->where("mm.menuid=me.mid and mm.managerid=".$u["mid"])->select();
                $this->assign("BASEPATH",BASEPATH);
                $this->assign("menus",$menus);
                $this->display('Manager/welcome');
            }else{
                //密码错误
                $_SESSION["loginError"]="密码错误";
                redirect("location:http://".$host."/ibike/login.php");
                //                 header("location:http://".$host."/tp/login.php");
            }
        }else{
            //用户名不存在
            
        }
    }
    
}

?>