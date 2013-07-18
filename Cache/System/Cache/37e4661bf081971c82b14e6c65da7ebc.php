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

<div class="Item hr">
    <div class="current">权限管理</div>
</div>
<p> 
    你正在为用户组： <b><?php echo ($info["name"]); ?></b>
    分配权限 。项目和版块有全选和取消全选功能
</p>
<form method="post" action="<?php echo U('Access/role_access');?>">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level1): $mod = ($i % 2 );++$i;?><tr>
                <td style="font-size: 14px;">
                    <label>
                        <input name="data[]" level="1" type="checkbox" obj="node_<?php echo ($level1["id"]); ?>" value="<?php echo ($level1["id"]); ?>"/> <b>[项目]</b>
                        <?php echo ($level1["title"]); ?>
                    </label>
                </td>
            </tr>
            <?php if(is_array($level1['child'])): $i = 0; $__LIST__ = $level1['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level2): $mod = ($i % 2 );++$i;?><tr>
                    <td style="padding-left: 30px; font-size: 14px;">
                        <label>
                            <input name="data[]" level="2" type="checkbox" obj="node_<?php echo ($level1["id"]); ?>_<?php echo ($level2["id"]); ?>" value="<?php echo ($level2["id"]); ?>"/>
                            <b>[模块]</b>
                            <?php echo ($level2["title"]); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 50px;">
                        <?php if(is_array($level2['child'])): $i = 0; $__LIST__ = $level2['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$level3): $mod = ($i % 2 );++$i;?><label>
                                <input name="data[]" level="3" type="checkbox" obj="node_<?php echo ($level1["id"]); ?>_<?php echo ($level2["id"]); ?>_<?php echo ($level3["id"]); ?>" value="<?php echo ($level3["id"]); ?>"/>
                                <?php echo ($level3["title"]); ?>
                            </label>
                            &nbsp;&nbsp;&nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
    <div class="commonBtnArea" >
        <button class="btn submit" type="submit">提交</button>
        <button class="btn reset">重置</button>
        <button class="btn empty">清空</button>
    </div>
</form>
<script type="text/javascript">
            //初始化数据
            function setAccess(){
                //清空所有已选中的
                $("input[type='checkbox']").prop("checked",false);
                //数据格式：
                //节点ID：node_id；1，项目；2，模块；3，操作
                //节点级别：level；
                //父级节点ID：pid
                var access=$.parseJSON('<?php echo ($access_list); ?>');
                var access_length=access.length;
                if(access_length>0){
                    for(var i=0;i<access_length;i++){
                        $("input[type='checkbox'][value='"+access[i]['val']+"']").prop("checked","checked");
                    }
                }
            }
            $(function(){
                //执行初始化数据操作
                setAccess();
                //为项目时候全选本项目所有操作
                $("input[level='1']").click(function(){
                    var obj=$(this).attr("obj")+"_";
                    $("input[obj^='"+obj+"']").prop("checked",$(this).prop("checked"));
                });
                //为模块时候全选本模块所有操作
                $("input[level='2']").click(function(){
                    var obj=$(this).attr("obj")+"_";
                    $("input[obj^='"+obj+"']").prop("checked",$(this).prop("checked"));
                    //分隔obj为数组
                    var tem=obj.split("_");
                    //将当前模块父级选中
                    if($(this).prop('checked')){
                        $("input[obj='node_"+tem[1]+"']").prop("checked","checked");
                    }
                });
                //为操作时只要有勾选就选中所属模块和所属项目
                $("input[level='3']").click(function(){
                    var tem=$(this).attr("obj").split("_");
                    if($(this).prop('checked')){
                        //所属项目
                        $("input[obj='node_"+tem[1]+"']").prop("checked","checked");
                        //所属模块
                        $("input[obj='node_"+tem[1]+"_"+tem[2]+"']").prop("checked","checked");
                    }
                });
                //重置初始状态，勾选错误时恢复
                $(".reset").click(function(){
                    setAccess();
                });
                //清空当前已经选中的
                $(".empty").click(function(){
                    $("input[type='checkbox']").prop("checked",false);
                });
            });
</script>
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