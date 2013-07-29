<?php

// +---------------------------------------------------------------------------------------------------
// | Before finding the right people, the only need to do is to make yourself good enough.
// +---------------------------------------------------------------------------------------------------
// | Author: LongDD <741886920@qq.com> 2013.6.5
// +---------------------------------------------------------------------------------------------------
// | Description: LongCms后台会员管理
// +---------------------------------------------------------------------------------------------------

class AccessAction extends BaseAction {

    //用户管理
    public function index() {
        $this->baseList('user', $fields = 'id,account,email,status,remark,create_time');
        $this->baseTree('role', 'id,pid,name');
        $this->display();
    }

    //添加用户
    public function userAdd() {
        //添加用户
        $data['account'] = $_POST['username'];
        $data['password'] = myMd5($_POST['password']);
        $data['email'] = $_POST['email'];
        $data['status'] = $_POST['status'];
        $data['remark'] = $_POST['remark'];
        $data['verify'] = 0;
        $data['create_time'] = time();
        //添加用户，角色关联
        $id = $this->baseAdd('user', $data);
        $data2['role_id'] = $_POST['role_id'];
        $data2['user_id'] = $id;
        if ($id && $this->baseAdd('role_user', $data2)) {
            $rst = '添加成功';
        } else {
            $rst = 0;
        }
        //id,account,email,status,remark,create_time
        $this->ajaxReturn($rst, 'JSON');
    }

    //删除用户
    public function userDel() {
        $id = (int)$_GET['id'];
        //删除用户
        $map['id'] = $id;
        $this->baseDel('user',$map,0);
        //删除用户关联
        $map2['user_id'] = $id;
        $this->baseDel('role_user',$map2);
    }
    //编辑用户
    public function userEdit(){
        if(IS_POST){
            if(!empty($_POST['password'])){
                $data['password'] = myMd5($_POST['password']);
            }
            $data['email'] = $_POST['email'];
            $data['status'] = $_POST['status'];
            $data['remark'] = $_POST['remark'];
            $data['verify'] = 0;
            $data['update_time'] = time();
            //修改用户
            $model = M('user');
            $rst = $model->where('id='.$_POST['id'])->save($data);
            //角色关联
            $dataT['role_id'] = $_POST['role_id'];
            $modelT = M('role_user');
            $rstT = $modelT->where('user_id='.$_POST['id'])->save($dataT);

            if ($rst || $rstT) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }

        }else{
        //调取用户数据
        $this->get_one('user',(int)$_GET['id']);
        //用户对于角色
        $model = M('role_user');
        $role_user = $model->where('user_id='.(int)$_GET['id'])->find();
        //调取角色
        $this->baseTree('role', 'id,pid,name');

        $this->assign('role_user',$role_user);
        $this->display();
        }
    }

    //后台目录管理
    public function menu() {
        $this->baseTree('menu');
        $this->display();
    }
    public function menu_add(){
        if(IS_POST){
            if(!$this->baseAdd('menu',$_POST)){
                $this->error('添加失败');
            }else{
                $this->success('添加成功',U('Access/menu'));
            }
        }else{
            //目录树
            $this->baseTree('menu', 'id,pid,name');
            $this->display('menuEdit');
        }
    }

    public function menu_edit(){
        if(IS_POST){
            $map['id'] = $_POST['id'];
            unset($_POST['id']);
            $model = M('menu');
            $rst = $model->where($map)->save($_POST);

            if ($rst) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        }else{
            $this->baseTree('menu', 'id,pid,name');
            $this->get_one('menu',(int)$_GET['id']);
            $this->display('menuEdit');
        }
    }

    public function menu_del(){
        $map['id']  = (int)$_GET['id'];
        $this->baseDel('menu',$map);
    }

    //角色管理
    public function role() {
        $this->baseList('role');
        $this->display();
    }

    public function role_add(){
        if(IS_POST){
            $_POST['create_time'] = time();
            if(!$this->baseAdd('role',$_POST)){
                $this->error('添加失败');
            }else{
                $this->success('添加成功',U('Access/role'));
            }
        }else{
            //调取角色
            $this->baseTree('role', 'id,pid,name');
            $this->display('roleEdit');
        }
    }

    public function role_edit(){
        if(IS_POST){
            $_POST['update_time'] = time();
            $map['id'] = $_POST['id'];
            unset($_POST['id']);
            $model = M('role');
            $rst = $model->where($map)->save($_POST);

            if ($rst) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        }else{
            $this->get_one('role',(int)$_GET['id']);
            $this->baseTree('role', 'id,pid,name');
            $this->display('roleEdit');
        }
    }

    public function role_del(){
        $map['id']  = (int)$_GET['id'];
        $this->baseDel('role',$map);
    }

    public function role_access(){
        if(IS_POST){
            $access = M('access');
            if(count($_POST['data']>0)){
                //获取角色节点
                $map['role_id'] = $_POST['id'];
                $access_list = $access->where($map)->field('node_id')->select();
                if(is_null($access_list)){
                    $list  = array();
                }else{
                    $list = array();
                    foreach ($access_list as $v) {
                        $list[] = $v['node_id'];
                    }
                }
                $rst = true;
                //判断需要删除的节点
                $node_del = array_diff($list,$_POST['data']);
                foreach ($node_del as $v) {
                    $map['node_id'] = $v;
                    if(!$access->where($map)->delete()){
                        $rst = fasle;
                    }
                }
                //判断需要添加的节点
                $node_add = array_diff($_POST['data'],$list);
                $data['role_id'] = $_POST['id'];
                foreach ($node_add as $v) {
                    $data['node_id'] = $v;
                    if(!$access->add($data)){
                        $rst = fasle;
                    }
                }
            }else{
                $map['role_id'] = $_POST['id'];
                $rst = $access->where($map)->delete();
            }
            //提示
            if($rst){
                    $this->success('授权成功');
                }else{
                    $this->error('授权失败');
                }
        }else{
            //获取节点列表
            $model = M('node');
            import('ORG.Util.Tree');
            $list = $model->select();
            $tree = new Tree($list);
            $rst = $tree->get_list();

            //获取当前用户组权限 
            $access = M('access');
            $map['role_id'] = $_GET['id'];
            $access_list = $access->where($map)->select();
            if(is_null($access_list)){
                $access_list = array();
            }

            $this->assign('id',$_GET['id']);
            $this->assign('access_list',json_encode($access_list));
            $this->assign('list',$rst);
            $this->display('roleAccess');
        }
    }

    //节点管理
    public function node() {
        $this->baseTree('node');
        $this->display();
    }

    public function node_add(){
        if(IS_POST){
            if(!$this->baseAdd('node',$_POST)){
                $this->error('添加失败');
            }else{
                $this->success('添加成功',U('Access/node'));
            }
        }else{
            //调取节点
            $this->baseTree('node', 'id,pid,name');
            $this->display('nodeEdit');
        }
    }

    public function node_edit(){
        if(IS_POST){
            $map['id'] = $_POST['id'];
            unset($_POST['id']);
            $model = M('node');
            $rst = $model->where($map)->save($_POST);

            if ($rst) {
                $this->success('修改成功');
            } else {
                $this->error('修改失败');
            }
        }else{
            //删除自身 ###
            $this->get_one('node',(int)$_GET['id']);
            $this->baseTree('node', 'id,pid,name');
            $this->display('nodeEdit');
        }
    }

    public function node_del(){
        $map['id']  = (int)$_GET['id'];
        $this->baseDel('node',$map);
    }

}

// +---------------------------------------------------------------------------------------------------
// | End of file AccessAction.class.php
// | Location: /App/system/Lib/Action/AccessAction.class.php
// +---------------------------------------------------------------------------------------------------