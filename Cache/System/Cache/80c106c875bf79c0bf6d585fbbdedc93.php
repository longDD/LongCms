<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>LongCms</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            html, body, div, h1, h2, h3, h4, h5, h6, p, img, dl,
            dt, dd, ol, ul, li, table, tr, td, form{
                margin: 0;
                padding: 0;
                border: 0;
            }
            body{
                background-color: #fff;
                text-align: center;
                font-family: '宋体';
                font-size: 14px;
                color: #000;
            }
            #container{
                width: 300px;
                height: 280px;
                border: solid 1px #E5E5E5;
                margin:10% auto 0;
                background-color: #F1F1F1;
                padding: 25px;
            }
            #login_box{
                text-align: left;
            }
            #login_header{
                width: 100%;
                height: 20px;
                font-size: 20px;
                line-height: 20px;
            }
            .login_line{
                width: 100%;
                height: 60px;
                margin-top: 10px;
            }
            .login_line span{
                display: block;
                width: 100%;
                height: 20px;
                font-weight: bold;
            }
            .login_line input{
                display: block;
                margin: 0;
                border: 0;
                padding: 0;
                width: 100%;
                border: solid 1px #B9B9B9;
                height: 30px;
                text-indent: 10px;
            }
            #verify input{
                width: 50%;
                float: left;
            }
            #verify img{
                border: none;
                float: left;
                margin-left: 15px;
            }
            #login_btn{
                width: 100%;
                height: 30px;
                margin: 5px;
            }
            #login_btn input{
                display: block;
                margin: 0;
                border: 0;
                padding: 0;
                width: 50px;
                border: solid 1px #2F5BB7;
                height: 30px;
                color:#fff;
                background-color: #4B8DF9;
                border-radius: 5px;
                font-weight: bold;
            }
            #find_pw{
                width: 100%;
                height: 30px;
                line-height: 30px;
                margin-top:10px;
            }
            #find_pw a{
                color:#1155CC;
                text-decoration: none;
            }
            #find_pw a:hover{
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <div id="login_box">
                <div id="login_header"><span>登陆</span></div>
                <form method="post" action="__SELF__">
                    <div class="login_line">
                        <span>账号</span>
                        <input name="account" type="text"/>
                    </div>
                    <div class="login_line">
                        <span>密码</span>
                        <input name="password" type="password"/>
                    </div>
                    <div class="login_line" id="verify">
                        <span>验证码</span>
                        <input name="verify" type="password"/>
                        <img id="verify_img" src="__APP__/Login/createVerification" onclick="fleshVerify();" title="点击刷新验证码" style="cursor:pointer" align="absmiddle" />
                    </div>
                    <div id="login_btn">
                        <input name="submit" type="submit" value="登陆"/>
                    </div>
                </form>
                <div id="find_pw">
                    <a href="#">找回密码</a>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="__JS__jquery.js"></script>
        <script type="text/javascript" src="__PUBLIC__/layer/layer.min.js"></script>
        <script>
                            $(function() {
                                $('form').submit(function() {
                                    if ($("input[name='account']").val() == '') {
                                        layer.alert('账号不能为空！', 0);
                                        return false;
                                    }
                                    if ($("input[name='password']").val() == '') {
                                        layer.alert('密码不能为空！', 0);
                                        return false;
                                    }
                                    if ($("input[name='verify']").val() == '') {
                                        layer.alert('验证码不能为空！', 0);
                                        return false;
                                    }
                                });
                            });
                            function fleshVerify() {                         //重载验证码
                                var timenow = new Date().getTime();
                                $('#verify_img').attr('src', '__APP__/Login/createVerification/' + timenow);
                            }
        </script>
    </body>
</html>