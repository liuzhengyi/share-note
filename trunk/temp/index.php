<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8" xml:lang="utf-8">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>大学生学习资料分享中心</title>
	    <link rel="stylesheet" type="text/css" href="./skin/default/dafen/main.css" />
    </head>
    <body>
        <div id="TitleContainer">
            <div id="MainMenu">
                <ul>
                    <li><a href="<?php echo $webRoot; ?>main.php">主页</a></li>
                    <li><a href="<?php echo $webRoot; ?>main.php?content=category">资源分类</a></li>
                    <li><a href="<?php echo $webRoot; ?>main.php?content=help">使用帮助</a></li>
                    <li><a href="<?php echo $webRoot; ?>main.php?content=about">关于我们</a></li>
                </ul>
            </div>
            <div id="TitleImg">
                <img src="./skin/default/dafen/logo.png" alt="大学生学习资料分享中心"/>
            </div>
        </div>

        <div id="MainContainer">
            <div id="MainLeft">
                <div id="FriendLinks">
                    <h2>友情链接</h2>
                    <!--在PHP中生成内容-->
                </div>
            </div>
            <div id="MainMiddle">
                <div id="Search">
                    <form>
                        <input type="textfield" id="text" maxlength="100" />
                        <input type="button" id="btn" value="搜索" />
                    </form>
                </div>
                <div id="MainShow">
                    <?php
                        switch ($_GET['content'])
                        {
                            case 'category':
                                ?>
                                <h2>分类检索</h2>
                                <?php
                            break;
                            case 'help':
                                ?>
                                <h2>帮助</h2>
                                <?php
                            break;
                            case 'about':
                                ?>
                                <h2>关于</h2>
                                <?php
                            break;
                            default:
                                ?>
                                <h2>主页</h2>
                                <?php
                            break;
                        }
                    ?>
                </div>
            </div>
            <div id="MainRight">
                <div id="UserLogin">
                    <!--
                    <table border='0'>
                        <tr>
                            <td>用户名：</td><td>Frank!!!</td>
                        </tr>
                        <tr>
                            <td>权威值：</td><td>2</td>
                        </tr>
                        <tr>
                            <td>贡献值：</td><td>2</td>
                        </tr>
                        <tr>
                            <td><a href="modules.php?app=upload">上传资料</a></td>
                            <td><a href="do.php?act=logout">退出登录</a></td>
                        </tr>
                    </table>
                    -->
                    <form action="<?php echo $webRoot?>do.php?act=login">
                        <label for="UsernameInput">
                            用户名：<br/>
                            <input type="textfield" name="username" id="UsernameInput" maxlength='30' value=""/><br/>
                        </label>
                        <label for="PasswordInput">
                            密码：<br/>
                            <input type="password" name="password" id="PasswordInput" maxlength='30' value=""/><br/>
                        </label>
                        <input type="submit" name="login" value="登录" id="BtnLogin" />
                        <input type="button" name="register" value="注册" id="BtnRegister" />
                    </form>
                </div>
                <div id="GoodResource">
                    <h2>优秀资源</h2>
                    <!--在PHP中生成内容-->
                </div>
            </div>

            <div class="clearfix">
            </div>
        </div>
    </body>
</html>
