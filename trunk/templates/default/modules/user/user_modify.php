<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8" xml:lang="utf-8">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>修改用户信息</title>
		<link rel="stylesheet" type="text/css" href="./skin/default/dafen/main.css" />
	</head>
	<body onload="reg_init();">
		<?php require_once("uiparts/header.php");?>

		<div id="MainContainer">
			<div id="MainLeft">
				&nbsp;
			</div>
			<div id="MainMiddle">
				<script type="text/javascript">
					var input_email;
					var input_password;

					function reg_init()
					{
						input_email = document.getElementById("input_email");
						input_password = document.getElementById("input_password");
					}

					function check_input()
					{
						var text_email = input_email.value;
						var text_password = input_password.value;

						//Check email
						if (text_email.length <= 4 || text_email.indexOf("@") < 0
							|| text_email.indexOf("@") >= (text_email.length - 1)
							|| -1 != text_email.search("/[^a-zA-Z0-9_@.-]/g"))
						{
							document.getElementById("hint_input_email").style.visibility = "visible";
							document.getElementById("btn_submit").disabled = true;
							return;
						}
						else
						{
							document.getElementById("hint_input_email").style.visibility = "hidden";
						}

						//Check password
						if (text_password.length < 6 || text_password.length > 30)
						{
							document.getElementById("hint_input_password").style.visibility = "visible";
							document.getElementById("btn_submit").disabled = true;
							return;
						}
						else
						{
							document.getElementById("hint_input_password").style.visibility = "hidden";
						}

						document.getElementById("btn_submit").disabled = false;
					}
				</script>
				<div id="Register">
					<h2>修改用户信息</h2>
					<form action="do.php?act=reg" method="post">
						<table border='0'>
							<tr>
								<td>e-mail：</td>
								<td>
									<input type='text' id='input_email' name='email' maxlength='50' onchange="check_input();"/>
									<span class='hint_result' id="hint_input_email">&nbsp;*</span><br/>
									<span class="hint">请输入您常用的邮箱地址，作为登录名</span>
								</td>
							</tr>
							<tr>
								<td>密码：</td>
								<td>
									<input type='password' id='input_password' name='password' maxlength='30' onkeyup="check_input();"/>
									<span class='hint_result' id="hint_input_password">&nbsp;*</span><br/>
									<span class="hint">6个字符以上，30个字符以内，区分大小写</span>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<input type='submit' id='btn_submit' name='submit' disabled='disabled' value='修改'/></td>
								</td>
							</tr>
						</table>
						<input type='hidden' name='submitted' value='TRUE'/></td>
					</form>
				</div>
			</div>
			<div id="MainRight">
				&nbsp;
			</div>

			<div class="clearfix">
			</div>
		</div>

		<div id="Copyright">
			<p>Copyright 2012 NJAU CS</p>
		</div>
	</body>
</html>
