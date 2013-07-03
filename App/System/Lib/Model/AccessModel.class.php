<?php

// +---------------------------------------------------------------------------------------------------
// | Before finding the right people, the only need to do is to make yourself good enough.
// +---------------------------------------------------------------------------------------------------
// | Author: LongDD <741886920@qq.com> 2013.6.5
// +---------------------------------------------------------------------------------------------------
// | Description: LongCms 权限模型
// +---------------------------------------------------------------------------------------------------
class AccessModel extends Model {

    //获取节点
    public function getNode($authId = null) {
        if (empty($authId)) {
            $node = M('node');
            return $node->select();
        } else {
            //根据authId获取节点
        }
    }

    //获取目录
    public function getMenu() {
        //缓存目录 pass
        $menu = M('menu');
        $map['status'] = 1;
        $map['pid'] = 0;
        return $menu->where($map)->select();
    }

    //获取二级目录
    public function getSecondaryMenu() {
        $menu = M('menu');
        $map['model'] = MODULE_NAME;
        $map['action'] = 'index';
        $map['pid'] = 0;
        $map['staus'] = 1;
        $current = $menu->where($map)->field('id')->find();

        $mapTwo['pid'] = $current['id'];
        $mapTwo['status'] = 1;
        return $menu->where($mapTwo)->select();
    }

    //面包屑
    public function getNav() {
        $menu = M('menu');
        $map['model'] = MODULE_NAME;
        $map['action'] = ACTION_NAME;
        $map['staus'] = 1;
        $current = $menu->where($map)->field('id,pid,name')->find();
        return $this->getParent($current, 'menu');
    }

    //获取父目录
    public function getParent($current, $model) {
        static $rst = array();
        $rst[] = $current;
        $model = M($model);
        if ($current['pid'] != 0) {
            $map['id'] = $current['pid'];
            $current_r = $model->where($map)->field('id,pid,name')->find();
            $this->getParent($current_r, $model);
        }

        return $rst;
    }

}

// +---------------------------------------------------------------------------------------------------
// | End of file AccessModel.class.php
// | Location: /App/system/Lib/Model/AccessModel.class.php
// +---------------------------------------------------------------------------------------------------