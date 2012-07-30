<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8" xml:lang="utf-8">
<head>
	<link rel="stylesheet" type="text/css" href="skin/default/dafen/main.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改用户信息</title>
<base href="$siteDomain"/>
</head>
<body onload="reg_init();">
	<?php require_once("uiparts/header.php");?>
	<div id="MainContainer">
		<div id="MainLeft">
			&nbsp;
		</div>
		<div id="MainMiddle">
			<div id="Modify">
			<script type="text/javascript">
				var formerly_pw;
				var new_pw;
				var new_pw_repeat;
				
				function reg_init()
				{
					formerly_pw = document.getElementById('formerly_pw');
					new_pw = document.getElementById('new_pw');
					new_pw_repeat = document.getElementById('new_pw_repeat');
				}
				function check_input()
				{
					var text_formerly_pw = formerly_pw.value;
					var text_new_pw = new_pw.value;
					var text_new_pw_repeat = new_pw_repeat.value;
					// check formerly_pw
					if ( text_formerly_pw.length < 6 || text_formerly_pw.length > 30 ) {
						document.getElementById('hint_result_formerly_pw').style.visibility = "visible";
						document.getElementById('btn_submit').disabled = true;
						return;
					} else {
						document.getElementById('hint_result_formerly_pw').style.visibility = "hidden";
					}
					// check new_pw
					if ( text_new_pw.length < 6 || text_new_pw.length > 30 ) {
						document.getElementById('hint_result_new_pw').style.visibility = "visible";
						document.getElementById('btn_submit').disabled = true;
						return;
					} else {
						document.getElementById('hint_result_new_pw').style.visibility = "hidden";
					}
					// check new_pw_repeat
					if ( text_new_pw_repeat.length < 6 || text_new_pw_repeat.length > 30 ) {
						document.getElementById('hint_result_new_pw_repeat').style.visibility = "visible";
						document.getElementById('btn_submit').disabled = true;
						return;
					} else {
						document.getElementById('hint_result_new_pw_repeat').style.visibility = "hidden";
					}
					document.getElementById('btn_submit').disabled = false;
				}
			</script>
				<h2>修改用户信息</h2>
					<form action="do.php?act=user_pw_change" method="post">
						<table border='0'>
							<tr>
								<td>原始密码:</td>
								<td>
									<input type='password' name='formerly_pw' id='formerly_pw' maxlength="15" onchange="check_input();"/>
									<span class='hint_result' id='hint_result_formerly_pw'>&nbsp;*</span><br/>
								</td>
							</tr>
							<tr>
								<td>新密码:</td>
								<td>
									<input type='password' name='new_pw' id='new_pw' onchange="check_input();" />
									<span class='hint_result' id='hint_result_new_pw'>&nbsp;*</span><br/>
							</td>
							</tr>
							<tr>
								<td>重复密码:</td>
								<td>
									<input type='password' name='new_pw_repeat' id='new_pw_repeat' onkeyup="check_input();"/>
									<span class='hint_result' id='hint_result_new_pw_repeat'>&nbsp;*</span><br/>
							</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>
									<input type='submit' id='btn_submit' name='submit'  values='修改'/></td>
								</td>
							</tr>	
						</table>
						<input type='hidden' name='submitted' value='TRUE'/></td>
					</form>
			</div> <!-- end of div Modify -->
		</div><!-- end of div MainMiddle -->
		<div id="MainRight">
			<?php require_once('uiparts/login.php'); ?>
		</div>
	
		<div class="clearfix">
		</div>
		
		<div id="Copyright">
			<p>Copyright 2012 NJAU CS</p>
		</div>
	</div><!-- end of div MainContainer -->
</body>
</html>
