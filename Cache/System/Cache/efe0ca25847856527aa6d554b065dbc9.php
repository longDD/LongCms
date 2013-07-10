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
                    <!-- longdd 2013.6.18 后台用户管理-->

<div>
    <div class="Item hr">
        <div class="current">管理员列表</div>
        <div id='inside_menu'>
            <ul>
                <li>
                    <a id='add_user_btn' href='javascript:;'>添加管理员</a>
                </li>
            </ul>
        </div>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab" id="user_table">
        <thead>
            <tr>
                <td>AID</td>
                <td>账号</td>
                <td>状态</td>
                <td>备注</td>
                <td>创建时间</td>
                <td width="150">操作</td>
            </tr>
        </thead>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center">
                <td><?php echo ($vo["id"]); ?></td>
                <td><?php echo ($vo["account"]); ?></td>
                <td>
                    <?php if($vo['status']): ?><font style='color:green;'>可用</font>
                        <?php else: ?> <font style='color:red;'>禁用</font><?php endif; ?>
                </td>
                <td><?php echo ($vo["remark"]); ?></td>
                <td><?php echo (date('Y-m-d H:i:s',$vo["create_time"])); ?></td>
                <td>
                    <?php if($vo["email"] == C('ADMIN_AUTH_KEY')): ?>--
                        <?php else: ?>
                        [
                        <a class='user_edit' href="<?php echo U('Access/userEdit?id='.$vo['id']);?>">编辑</a>
                        ]
                [
                        <a class='user_del' href="<?php echo U('Access/userDel?id='.$vo['id']);?>">删除</a>
                        ]<?php endif; ?>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <div id="page"><?php echo ($page); ?></div>
    <!-- Add -->
    <div id='Add_user' style='display: none;'>
        <form id='Add_user_form' action="" method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                <tr>
                    <th width="120">用户名：</th>
                    <td>
                        <input type="text" name="username" class="input"/>
                    </td>
                </tr>
                <tr>
                    <th>密码：</th>
                    <td>
                        <input class="input" name="pwd" type="password" size="40" value="" />
                    </td>
                </tr>
                <tr>
                    <th>重复密码：</th>
                    <td>
                        <input class="input" name="pwd_r" type="password" size="40" value="" />
                    </td>
                </tr>
                <tr>
                    <th>邮箱：</th>
                    <td>
                        <input class="input" name="email" type="text" size="40" value="" />
                    </td>
                </tr>
                <tr>
                    <th>状态：</th>
                    <td>
                        <select name="status" style="width: 80px;">
                            <option value="1">启用</option>
                            <option value="0">禁用</option>
                        </select>
                        如果禁用了将无法登陆本系统
                    </td>
                </tr>
                <tr>
                    <th>所属用户组</th>
                    <td>
                        <select name="role_id" style="min-width: 80px;">
                            <?php if(is_array($trees)): foreach($trees as $key=>$vo): ?><option value='<?php echo ($vo["id"]); ?>'><?php echo ($vo["prefix"]); echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>备注：</th>
                    <td>
                        <textarea name="remark" rows="5" cols="57"></textarea>
                    </td>
                </tr>
            </table>
            <button class="btn submit" type='submit'>提交</button>
            <button class="btn submit xubox_close" type='button'>取消</button>
        </form>
    </div>
    <script>
        $(function() {
            //增加用户弹出窗
            $('#add_user_btn').on('click', function() {
                var i = $.layer({
                    type: 1,
                    title: '添加用户',
                    closeBtn: [0, true],
                    border: [5, 0.5, '#666', true],
                    shade: [0.8, '#000', true],
                    offset: ['150px', '50%'],
                    move: ['.xubox_title', true],
                    area: ['620px', 'auto'],
                    page: {
                        html: $('#Add_user').html()
                    },
                    success: function() {
                        $('form').on('submit', function() {
                            if ($("input[name='username']").val() == '') {
                                layer.alert('账号不能为空！', 0);
                            } else if ($("input[name='pwd']").val() == '') {
                                layer.alert('密码不能为空！', 0);
                            } else if ($("input[name='pwd']").val() != $("input[name='pwd_r']").val()) {
                                layer.alert('两次密码输入不一致！', 0);
                            } else if ($("input[name='email']").val() == '') {
                                layer.alert('邮箱不能为空！', 0);
                            } else {
                                $.ajax({
                                    type: "post",
                                    url: "__URL__/userAdd",
                                    data: 'username=' + $("input[name='username']").val() + '&password=' + $("input[name='pwd']").val() + '&email=' + $("input[name='email']").val() + '&status=' + $("select[name='status']").val() + '&remark=' + $("textarea[name='remark']").val() + '&role_id=' + $("select[name='role_id']").val(),
                                    success: function(msg) {
                                        // $('#Add_user').html($('#xuboxPageHtml').html());
                                        // layer.alert(msg, 0);
                                        // layer.close(i);
                                        window.location.reload();
                                    }
                                });
                            }
                            return false;
                        });
                    },
                    close: function(i) {
                        $('#Add_user').html($('#xuboxPageHtml').html());
                        layer.close(i);
                    }
                });
                $('#Add_user').html(' ');
            });
            //编辑用户弹窗
            $('.user_edit').each(function() {
                $(this).on('click', function() {
                    //iframe
                    $.layer({
                        type : 2,
                        closeBtn : [0,true],
                        shadeClose: false,
                        shade : [0.8 , '#000' , true],
                        iframe : {
                            src : $(this).attr('href')
                        },
                        title : '编辑',
                        area: ['620px', '450px'],
                        //层加载成功后进行的回调
                        success : function(){ 

                        },
                        end : function(){

                        }
                    });
                    return false;
                });
            });
            //删除用户弹窗
            $('.user_del').each(function() {
                $(this).on('click', function() {
                    var url = $(this).attr("href");
                    $.layer({
                        shade: [0.8, '#000', true],
                        area: ['300px', '200px'],
                        dialog: {
                            msg: '确认删除？',
                            btns: 2,
                            type: 4,
                            btn: ['删除', '取消'],
                            yes: function() {
                                window.location = url;
                            }
                        }
                    });
                    return false;
                });
            });
        });
    </script>
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