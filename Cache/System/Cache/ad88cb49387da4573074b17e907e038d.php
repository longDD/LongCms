<?php if (!defined('THINK_PATH')) exit();?><!-- longdd 2013.6.10 登陆界面-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            body{
                background: #fff;
                font-family: '宋体';
                font-size: 14px;
                text-align: center;
            }
            .login_box{
                padding: 25px;
                width: 300px;
                height: 230px;
                text-align: left;
                border: solid 1px #E5E5E5;
                background: #F1F1F1;
                margin: 10% auto 0;
            }
            .login_header{
                width: 100%;
                font-size: 16px;
                height: 30px;
            }
            .longin_body{

            }
            .login_line{
                width: 100%;
                height: 60px;
            }
            .login_line label{
                display: block;
                width: 100%;
                height: 30px;
                line-height: 30px;
                font-weight: bold;
            }
            .login_line input{
                margin: 0;
                padding: 0;
                border: solid 1px #C0C0C0;
                height: 30px;
                width: 80%;
                line-height: 25px;
            }
            .login_sub{
                margin-top: 20px;
                width: 100%;
                height: 30px;
                line-height: 30px;
            }
            .login_sub input{
                margin: 0;
                padding: 0;
                border: solid 1px #2F5BB7;
                background: #4A8BF5;
                color: #fff;
                height: 30px;
                width: 50px;
                border-radius: 5px;
                font-weight: bold;
            }
            .login_footer{
                margin-top: 10px;
                width: 100%;
                height: 30px;
                line-height: 30px;
            }
            .login_footer a{
                color: #1155CC;
                text-decoration: none;
            }
            .login_footer a:hover{
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="login_box">
            <div class="login_header">
                <span>登陆</span>
            </div>
            <div class="longin_body">
                <form action="__SELF__" method="post">
                    <div class="login_line">
                        <label for="username">账号：</label>
                        <input type="text" name="username" id="password"/>
                    </div>
                    <div class="login_line">
                        <label for="password">密码：</label>
                        <input type="password" name="password" id="password"/>
                    </div>
                    <div class="login_sub">
                        <input type="submit" id="login_submit" value="登陆"/>
                    </div>
                </form>
            </div>
            <div class="login_footer">
                <a href="#">忘记密码？</a>
            </div>
        </div>
    </body>
</html>