<?php

// +---------------------------------------------------------------------------------------------------
// | Before finding the right people, the only need to do is to make yourself good enough.
// +---------------------------------------------------------------------------------------------------
// | Author: LongDD <741886920@qq.com> 2013.6.10
// +---------------------------------------------------------------------------------------------------
// | Description: 系统基类
// +---------------------------------------------------------------------------------------------------

class BaseAction extends Action {

    public function __construct() {
        //继承
        parent::__construct();
        //权限监测
        //生成一级目录
        //生成二级目录
        //redirect(U('Login/index'));
    }

}

/*End of file BaseAction.class.php */
/* Location: ./App/Lib/Action/BaseAction.class.php */