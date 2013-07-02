<?php

// +---------------------------------------------------------------------------------------------------
// | Before finding the right people, the only need to do is to make yourself good enough.
// +---------------------------------------------------------------------------------------------------
// | Author: LongDD <741886920@qq.com> 2013.6.10
// +---------------------------------------------------------------------------------------------------
// | Description: 系统管理登陆
// +---------------------------------------------------------------------------------------------------

class LoginAction extends Action {

    public function index() {
//        if (IS_POST) {
//            //登陆请求
//            $this->checkUser();
//        } else {
//            //显示登陆界面
//            $this->display();
//        }
        $this->checkUser();
    }

    private function checkUser() {
        import('ORG.Util.RBAC');
        $method = get_class_methods('RBAC');
        print_r($method);
    }

}

/*End of file LoginAction.class.php */
/* Location: ./App/Lib/Action/LoginAction.class.php */