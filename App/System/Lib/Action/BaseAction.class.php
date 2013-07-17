<?php

// +---------------------------------------------------------------------------------------------------
// | Before finding the right people, the only need to do is to make yourself good enough.
// +---------------------------------------------------------------------------------------------------
// | Author: LongDD <741886920@qq.com> 2013.6.5
// +---------------------------------------------------------------------------------------------------
// | Description: LongCms后台基类
// +---------------------------------------------------------------------------------------------------

class BaseAction extends Action {

    public function __construct() {
        parent::__construct();
//权限认证 ->登陆
        $this->CheckLogin();
//生成一级，二级菜单
        $this->CreateMenu();
    }

    private function CheckLogin() {
// 用户权限检查
        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
            import('ORG.Util.RBAC');
            if (!RBAC::AccessDecision()) {
//检查认证识别号
                if (!$_SESSION [C('USER_AUTH_KEY')]) {
//跳转到认证网关
                    redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                }
// 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
// 定义权限错误页面
                    redirect(C('RBAC_ERROR_PAGE'));
                } else {
                    if (C('GUEST_AUTH_ON')) {
                        $this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
                    }
// 提示错误信息
//                     echo L('_VALID_ACCESS_');
                    $this->error(L('_VALID_ACCESS_'));
                }
            }
        }
    }

//生成一级菜单
    private function CreateMenu() {
//获取目录
        $menu = D('Access')->getMenu();
//超级管理员判断
        if (empty($_SESSION[C('ADMIN_AUTH_KEY')])) {
//$id = $_SESSION[C('USER_AUTH_KEY')];
//获取节点
//$nodes = D('Access')->getNode($id);
//根据节点生成目录
        }
        $count = count($menu);
        $menus = "";
        foreach ($menu as $key => $val) {
            if ($key + 1 == 1) {
                $css = $val['model'] == MODULE_NAME ? "fisrt_current" : "fisrt";
                $menus.='<li class="' . $css . '"><span><a href="' . U($val['model'] . '/index') . '">' . $val['name'] . '</a></span></li>';
            } else if ($key + 1 == $count) {
                $css = $val['model'] == MODULE_NAME ? "end_current" : "end";
                $menus.='<li class="' . $css . '"><span><a href="' . U($val['model'] . '/index') . '">' . $val['name'] . '</a></span></li>';
            } else {
                $css = $val['model'] == MODULE_NAME ? "current" : "";
                $menus.='<li class="' . $css . '"><span><a href="' . U($val['model'] . '/index') . '">' . $val['name'] . '</a></span></li>';
            }
        }
        $this->assign('menus', $menus);
//根据当前一级菜单生成二级菜单
        $this->CreateSecondaryMenu();
//面包屑
        $this->createNav();
    }

//生成二级菜单
    private function CreateSecondaryMenu() {
        $SecondaryMenu = D('Access')->getSecondaryMenu();
        $this->assign('Smenu', $SecondaryMenu);
    }

//生成面包屑导航
    private function createNav() {
        $menus = D('Access')->getNav();
        $str = '网站首页 > ';
        for ($i = count($menus); $i > 0; $i--) {
            if ($i == 1) {
                $str.=$menus[$i - 1]['name'];
            } else {
                $str.=$menus[$i - 1]['name'] . ' > ';
            }
        }
        $this->assign('nav', $str);
    }

//通用树
    public function baseTree($model, $fields = '*') {
        $model = M($model);
        $list = $model->field($fields)->select();
        import('ORG.Util.Tree');
        $Tree = new Tree($list);
        $trees = $Tree->get_tree();
        $this->assign('trees', $trees);
    }

//通用列表
    public function baseList($model, $fields = '*', $rows = 15) {
        $model = M($model); // 实例化model对象
        import('ORG.Util.Page'); // 导入分页类
        $count = $model->count(); // 查询满足要求的总记录数
        $Page = new Page($count, $rows); // 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show(); // 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $model->field($fields)->order('create_time')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('list', $list); // 赋值数据集
        $this->assign('page', $show); // 赋值分页输出
    }

//通用添加
    public function baseAdd($model, $data) {
        $model = M($model);
        return $model->add($data);
    }

//通用删除
    public function baseDel($model,$map,$isAlert = 1){
        $model = M($model);
        $rst = $model->where($map)->limit(1)->delete();
        if($isAlert == 1){
            if($rst){
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }
        }
    }
//通用修改
//获取一条
    public function get_one($model,$id = null,$index = 'id'){
        $model = M($model);
        if(!empty($id)){
            $map[$index] = $id;
        }
        $info = $model->where($map)->find();
        $this->assign('info',$info);
    }
}

// +---------------------------------------------------------------------------------------------------
// | End of file BaseAction.class.php
// | Location: /App/system/Lib/Action/BaseAction.class.php
// +---------------------------------------------------------------------------------------------------