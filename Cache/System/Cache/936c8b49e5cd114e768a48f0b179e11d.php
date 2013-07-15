<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>后台管理</title>
        <!-- longdd 2013.6.18 header内容(js,css)-->
<link rel="stylesheet" type="text/css" href="__CSS__base.css" />
<link rel="stylesheet" type="text/css" href="__CSS__layout.css" />
<script src="__JS__jquery.min.js"></script>
<script src="__JS__functions.js"></script>
<script src="__JS__base.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script>

    </head>
    <body>
        <div class="wrap">
            <!-- longdd 2013.6.18 头部-->
<div id="Top">
    <div class="logo">
        <a href="<?php echo U('Index/index');?>">
            <img style="margin-top: 10px;" src="__IMG__logo.png"/>
        </a>
    </div>
    <div class="help">
        <a href="#">使用帮助</a>
        <span>
            <a href="#">关于</a>
        </span>
    </div>
    <div class="menu">
        <ul>
            <?php echo ($menus); ?>
        </ul>
    </div>
</div>
<div id="Tags">
    <div class="userPhoto"></div>
    <div class="navArea">
        <div class="userInfo">
            <div>
                <a href="#" class="sysSet"><span>&nbsp;</span>系统设置</a> 
                <a href="<?php echo U('Login/logout');?>" class="loginOut"><span>&nbsp;</span>退出系统</a>
            </div>
            欢迎您,<font color='red'><?php echo (session('loginUserName')); ?></font>
        </div>
        <div class="nav">
            <font id="today">
            <?php echo date("Y-m-d H:i:s"); ?>
            </font>
            您的位置：<?php echo ($nav); ?>
        </div>
    </div>
</div>
<div class="clear"></div>


            <div class="mainBody">
                <!-- longdd 2013.6.18 后台左侧-->
<div id="Left">
    <div id="control" class=""></div>
    <div class="subMenuList">
        <div class="itemTitle">菜单</div>
        <ul>
            <?php if(is_array($Smenu)): foreach($Smenu as $key=>$v): ?><li><a href="<?php echo U($v['model'].'/'.$v['action']);?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
        </ul>
    </div>
</div>


                <div id="Right">
                    <!-- longdd 2013.6.18 后台首页-->

<div class="Item hr">
    <div class="current">系统信息</div>
</div>
<div>
    <ul>
        <li><span>后台目录管理</span></li>
    </ul>
</div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <!-- longdd 2013.6.18 后台底部-->
<script type="text/javascript">
    $(window).resize(autoSize);
    $(function() {
        //自动适应尺寸
        autoSize();
        //时间
        var time = self.setInterval(function() {
            $("#today").html(date("Y-m-d H:i:s"));
        }, 1000);
        //退出确认
        $(".loginOut").click(function() {
            var url = $(this).attr("href");
            $.layer({
                shade: [0.8, '#000', true],
                area: ['300px', '200px'],
                dialog: {
                    msg: '退出系统？',
                    btns: 2,
                    type: 4,
                    btn: ['退出', '取消'],
                    yes: function() {
                        window.location = url;
                    }
                }
            });
            return false;
        });

    });

</script>



    </body>
</html>