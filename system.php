<?php

// +---------------------------------------------------------------------------------------------------
// | Before finding the right people, the only need to do is to make yourself good enough.
// +---------------------------------------------------------------------------------------------------
// | Author: LongDD <741886920@qq.com> 2013.6.5
// +---------------------------------------------------------------------------------------------------
// | Description: LongCms后台管理入口文件
// +---------------------------------------------------------------------------------------------------
//初始化session key 防止同tp冲突
ini_set('session.save_path', './Data/session/');

define('APP_NAME', 'system');
define('APP_PATH', './App/system/');
//开启调试
define('APP_DEBUG', TRUE);
require('./core/ThinkPHP.php');
// +---------------------------------------------------------------------------------------------------
// | End of file system.php
// | Location: /system.php
// +---------------------------------------------------------------------------------------------------