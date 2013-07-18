<?php if (!defined('THINK_PATH')) exit();?><!-- longdd 2013.7.10 后台用户编辑-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title></title>
    <!-- longdd 2013.6.18 header内容(js,css)-->
<link rel="stylesheet" type="text/css" href="__CSS__base.css" />
<link rel="stylesheet" type="text/css" href="__CSS__layout.css" />
<script src="__JS__jquery.min.js"></script>
<script src="__JS__functions.js"></script>
<script src="__JS__base.js"></script>
<script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script>

</head>
<body>
    <div id='Add_user'>
        <form id='Add_user_form' action="" method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table1">
                <tr>
                    <th width="120">用户名：</th>
                    <td>
                        <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>
                        <?php echo ($info["account"]); ?>
                    </td>
                </tr>
                <?php if(!empty($_SESSION[C('ADMIN_AUTH_KEY')])): ?><tr>
                        <th>密码：</th>
                        <td>
                            <input class="input" name="password" type="password" size="40" value="" />
                        </td>
                    </tr><?php endif; ?>
                <tr>
                    <th>邮箱：</th>
                    <td>
                        <input class="input" name="email" type="text" size="40" value="<?php echo ($info["email"]); ?>" />
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
            <button class="btn submit xubox_close" type='button'>取消</button>
        </form>
    </div>
    <script>
        $(function(){
            $("select[name='status']").val('<?php echo ($info["status"]); ?>');
            $("select[name='role_id']").val('<?php echo ($role_user["role_id"]); ?>');
        })
    </script>
</body>
</html>