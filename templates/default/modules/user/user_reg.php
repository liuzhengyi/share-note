<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8" xml:lang="utf-8">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>新用户注册</title>
		<link rel="stylesheet" type="text/css" href="./skin/default/dafen/main.css" />
	</head>
	<body onload="reg_init();">
		<?php require_once("uiparts/header.php");?>

		<div id="MainContainer">
			<div id="MainLeft">
				&nbsp;
			</div>
			<div id="MainMiddle">
				<div id="Register">
					<script type="text/javascript">
						var input_email;
						var input_username;
						var input_password;
						var input_school;
						var input_major;
						var input_year;
						var input_vericode;
						
						function getVerCode() {
							var rand_value = Math.random();
							document.getElementById("verCodePic").src="foundation/veriCodes.php?vc="+rand_value ;
						}
						function reg_init()
						{
							input_email = document.getElementById("input_email");
							input_username = document.getElementById("input_username");
							input_password = document.getElementById("input_password");
							input_school = document.getElementById("input_school");
							input_major = document.getElementById("input_major");
							input_year = document.getElementById("input_year");
							input_vericode = document.getElementById("input_veriCode");
						}

						function check_input()
						{
							var text_email = input_email.value;
							var text_username = input_username.value;
							var text_password = input_password.value;
							var text_school = input_school.value;
							var text_major = input_major.value;
							var text_year = input_year.value;
							var text_vericode = input_vericode.value;

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

							//Check username
							if (text_username.length < 4 || text_username.length > 15
								|| -1 != text_username.search("/[^a-zA-Z0-9]/g"))
							{
								document.getElementById("hint_input_username").style.visibility = "visible";
								document.getElementById("btn_submit").disabled = true;
								return;
							}
							else
							{
								document.getElementById("hint_input_username").style.visibility = "hidden";
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

							//Check school
							if (text_school.length > 30 || text_school.length < 1)
							{
								document.getElementById("hint_input_school").style.visibility = "visible";
								document.getElementById("btn_submit").disabled = true;
								return;
							}
							else
							{
								document.getElementById("hint_input_school").style.visibility = "hidden";
							}

							//Check major
							if (text_major.length > 30 || text_major.length < 1)
							{
								document.getElementById("hint_input_major").style.visibility = "visible";
								document.getElementById("btn_submit").disabled = true;
								return;
							}
							else
							{
								document.getElementById("hint_input_major").style.visibility = "hidden";
							}

							//Check year
							if (4 != text_year.length || !(1999 <= parseInt(text_year) && parseInt(text_year) <= 2019))
							{
								document.getElementById("hint_input_year").style.visibility = "visible";
								document.getElementById("btn_submit").disabled = true;
								return;
							}
							else
							{
								document.getElementById("hint_input_year").style.visibility = "hidden";
							}

							//Check veriCode
							if (5 != text_vericode.length )
							{
								document.getElementById("hint_input_vericode").style.visibility = "visible";
								document.getElementById("btn_submit").disabled = true;
								return;
							}
							else
							{
								document.getElementById("hint_input_vericode").style.visibility = "hidden";
							}
							document.getElementById("btn_submit").disabled = false;
						}
					</script>
					<h2>新用户注册</h2>
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
								<td>用户名：</td>
								<td>
									<input type='text' id='input_username' name='username' maxlength='15' onchange="check_input();"/>
									<span class='hint_result' id="hint_input_username">&nbsp;*</span><br/>
									<span class="hint">4到15个字符，只可使用英文字母或数字，<b>注册之后将不可修改</b></span>
								</td>
							</tr>
							<tr>
								<td>密码：</td>
								<td>
									<input type='password' id='input_password' name='password' maxlength='30' onchange="check_input();"/>
									<span class='hint_result' id="hint_input_password">&nbsp;*</span><br/>
									<span class="hint">6个字符以上，30个字符以内，区分大小写</span>
								</td>
							</tr>
							<tr>
								<td>学校：</td>
								<td>
									<input type='text' id='input_school' name='school' maxlength='30' onchange="check_input();"/>
									<span class='hint_result' id="hint_input_school">&nbsp;*</span><br/>
									<span class="hint">10个汉字以内，<b>注册之后将不可修改</b></span>
								</td>
							</tr>
							<tr>
								<td>专业：</td>
								<td>
									<input type='text' id='input_major' name='major' maxlength='30' onchange="check_input();"/>
									<span class='hint_result' id="hint_input_major">&nbsp;*</span><br/>
									<span class="hint">10个汉字以内，<b>注册之后将不可修改</b></span>
								</td>
							</tr>
							<tr>
								<td>入学年份：</td>
								<td>
									<input type='text' id='input_year' name='entrance_year' maxlength='4' size='4' onchang="check_input();"/>
									<span class='hint_result' id="hint_input_year">&nbsp;*</span><br/>
									<span class="hint">1999-2019之间，<b>注册之后将不可修改</b></span>
								</td>
							</tr>
						        <tr>
        							<td>验证码: </td>
				        		    	<td>
									<input type="text" name="veriCode" id="input_veriCode" maxlength="5" size="5" onkeyup="check_input();"/>
									<span class='hint_result' id="hint_input_vericode">&nbsp;*</span>
					           	 		<img border="0" src="foundation/veriCodes.php" id="verCodePic" /><a href="javascript:;" onclick="getVerCode(); return false;">看不清楚？</a>
								</td>
						     	</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<input type='submit' id='btn_submit' name='submit' disabled='disabled' value='注册'/></td>
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
