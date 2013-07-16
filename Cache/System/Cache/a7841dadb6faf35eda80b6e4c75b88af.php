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
                    <!-- longdd 2013.7.16 后台节点添加编辑-->

<div>
    <div class="Item hr">
        <div class="current">
            <?php if(ACTION_NAME == 'node_edit'): ?>编辑节点
                <?php else: ?>
                添加节点<?php endif; ?>
        </div>
    </div>
    <!-- Add -->
    <div id='Add_user'>
        <form action="<?php if(ACTION_NAME == 'node_edit'): echo U('Access/node_edit'); else: echo U('Access/node_add'); endif; ?>" method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                <tr>
                    <th width="120">名称(Example:Add)：</th>
                    <td>
                        <input type="text" name="name" class="input" value="<?php echo ($info["name"]); ?>"/>
                        <?php if(ACTION_NAME == 'node_edit'): ?><input type="hidden" name="id" class="input" value="<?php echo ($info["id"]); ?>"/><?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th width="120">标题(Example:添加)：</th>
                    <td>
                        <input type="text" name="title" class="input" value="<?php echo ($info["title"]); ?>"/>
                    </td>
                </tr>
                <tr>
                    <th>状态：</th>
                    <td>
                        <select name="status" style="width: 80px;">
                            <option value="1">启用</option>
                            <option value="0">禁用</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>类型:</th>
                    <td>
                        <select name="level" style="width: 80px;">
                            <option value="3">操作</option>
                            <option value="2">模块</option>
                            <option value="1">应用</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>父节点:</th>
                    <td>
                        <select name="pid" style="min-width: 80px;">
                            <option value='0'>根目录</option>
                            <?php if(is_array($trees)): foreach($trees as $key=>$vo): ?><option value='<?php echo ($vo["id"]); ?>'><?php echo ($vo["prefix"]); echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>备注：</th>
                    <td>
                        <textarea name="remark" rows="5" cols="57"><?php echo ($info["remark"]); ?></textarea>
                    </td>
                </tr>
            </table>
            <button class="btn submit" type='submit'>提交</button>
            <button class="btn submit xubox_close" type='reset'>取消</button>
        </form>
    </div>
</div>
<?php if(ACTION_NAME == 'node_edit'): ?><script>
        $(function(){
            $("select[name='pid']").val('<?php echo ($info["pid"]); ?>');
            $("select[name='status']").val('<?php echo ($info["status"]); ?>');
        })
    </script><?php endif; ?>
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