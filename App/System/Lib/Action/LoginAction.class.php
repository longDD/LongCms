<?php

// +---------------------------------------------------------------------------------------------------
// | Before finding the right people, the only need to do is to make yourself good enough.
// +---------------------------------------------------------------------------------------------------
// | Author: LongDD <741886920@qq.com> 2013.6.5
// +---------------------------------------------------------------------------------------------------
// | Description: LongCms后台登陆控制
// +---------------------------------------------------------------------------------------------------

class LoginAction extends Action {

    //登陆界面
    public function index() {
        if (IS_POST) {
            $this->checkVerification();
            $this->checkLogin();
        } else {
            $this->display();
        }
    }

    //登陆认证
    private function checkLogin() {
        if (empty($_POST['account'])) {
            $this->error('账号不能为空!');
        } elseif (empty($_POST['password'])) {
            $this->error('密码不能为空!');
        }
        //认证条件
        import('ORG.Util.RBAC');
        $map = array();
        $map['account'] = $_POST['account'];
        $map['status'] = array('gt', 0);
        $authInfo = RBAC::authenticate($map);
        //认证
        if ($authInfo === FALSE) {
            $this->error('账号不存在或已禁用！');
        } else {
            if ($authInfo['password'] != myMd5($_POST['password'])) {
                $this->error('密码错误！');
            }
            $_SESSION[C('USER_AUTH_KEY')] = $authInfo['id'];
            $_SESSION['email'] = $authInfo['email'];
            $_SESSION['loginUserName'] = $authInfo['nickname'];
            $_SESSION['lastLoginTime'] = $authInfo['last_login_time'];
            $_SESSION['login_count'] = $authInfo['login_count'];
            if ($authInfo['account'] == C('SUPER_ADMIN')) {
                $_SESSION[C('ADMIN_AUTH_KEY')] = true;
            }
            //保存登陆信息
            $user = M('user');
            $ip = get_client_ip();
            $time = time();
            $data = array();
            $data['id'] = $authInfo['id'];
            $data['last_login_time'] = $time;
            $data['login_count'] = array('exp', 'login_count+1');
            $data['last_login_ip'] = $ip;
            $user->save($data);
        }
        //缓存访问权限
        RBAC::saveAccessList();
        $this->success('登陆成功', __APP__ . '/Index/index');
    }

    //认证验证码
    public function checkVerification() {
        if (md5($_POST['verify']) !== $_SESSION['verify']) {
            $this->error('验证码错误!');
            exit;
        }
    }

    //生成验证码
    public function createVerification() {
        import('ORG.Util.Image');
        Image::buildImageVerify(4, 1, 'png', 60, 30);
    }

    //退出登陆
    public function logOut() {
        if (isset($_SESSION[C('USER_AUTH_KEY')])) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
            $this->success('登出成功！', __APP__ . '/Login/index');
        } else {
            $this->error('已经登出！');
        }
    }

}

// +---------------------------------------------------------------------------------------------------
// | End of file LoginAction.class.php
// | Location: /App/system/Lib/Action/LoginAction.class.php
// +---------------------------------------------------------------------------------------------------