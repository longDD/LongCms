<?php

return array(
//'配置项'=>'配置值'
// USER_AUTH_ON 是否需要认证
// USER_AUTH_TYPE 认证类型
// USER_AUTH_KEY 认证识别号
// REQUIRE_AUTH_MODULE  需要认证模块
// NOT_AUTH_MODULE 无需认证模块
// USER_AUTH_GATEWAY 认证网关
// RBAC_DB_DSN  数据库连接DSN
// RBAC_ROLE_TABLE 角色表名称
// RBAC_USER_TABLE 用户表名称
// RBAC_ACCESS_TABLE 权限表名称
// RBAC_NODE_TABLE 节点表名称
    'USER_AUTH_ON' => true,
    'USER_AUTH_TYPE' => 2, // 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY' => 'long_authId', // 用户认证SESSION标记
    'REQUIRE_AUTH_MODULE' => '', // 默认需要认证模块
    'NOT_AUTH_ACTION' => '', // 默认无需认证操作
    'USER_AUTH_GATEWAY' => '/Login/index', // 默认认证网关
//'RBAC_ERROR_PAGE' => '/Index/index', //无权限跳转页面
    'USER_AUTH_MODEL' => 'user',
    'RBAC_ROLE_TABLE' => 'role',
    'RBAC_USER_TABLE' => 'role_user',
    'RBAC_ACCESS_TABLE' => 'access',
    'RBAC_NODE_TABLE' => 'node',
    //'RBAC_DB_DSN' => '',
//数据库
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'localhost',
    'DB_NAME' => 'long_cms',
    'DB_USER' => 'root',
    'DB_PWD' => 'long01',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 'long_',
    //加密常量
    'ENCRYPT_CONSTANT' => 'longDD',
    //默认超级管理员 无需认证
    'SUPER_ADMIN' => 'admin',
    //路径
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => __ROOT__ . '/App/' . APP_NAME . '/Tpl/Public/',
        '__JS__' => __ROOT__ . '/App/' . APP_NAME . '/Tpl/Public/js/',
        '__CSS__' => __ROOT__ . '/App/' . APP_NAME . '/Tpl/Public/css/',
        '__IMG__' => __ROOT__ . '/App/' . APP_NAME . '/Tpl/Public/img/',
    ),
    //页面追踪
    'SHOW_PAGE_TRACE' => true,
);