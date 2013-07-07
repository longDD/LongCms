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

    //后台目录管理
    public function menu() {
        $this->baseTree('menu', $fields = 'id,account');
        $this->display();
    }

    //角色管理
    public function role() {
        $this->baseList('role', $fields = 'id,account');
        $this->display();
    }

    //节点管理
    public function node() {
        $this->baseTree('node', $fields = 'id,account');
        $this->display();
    }

}

// +---------------------------------------------------------------------------------------------------
// | End of file AccessAction.class.php
// | Location: /App/system/Lib/Action/AccessAction.class.php
// +---------------------------------------------------------------------------------------------------