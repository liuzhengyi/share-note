<?php 
// this file is compiled by compile.sh 
// if you want to change this page 
// modify the corresponding model file and template file 
// gipsa 2012
?><?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8" xml:lang="utf-8">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>新用户注册</title>
		<base href=<?php echo $siteDomain; ?> />
		<link rel="stylesheet" type="text/css" href="./skin/default/dafen/main.css" />
	</head>
	<script type='text/javascript'>
		function getVerCode() {
			var rand_value = Math.random();
			document.getElementById("verCodePic").src="foundation/veriCodes.php?vc="+rand_value ;
		}
		function check_form() {
			var vericode = document.getElementById('veriCode').value;
			var email = document.getElementById('email').value;
			if (email = '') {
				alert(<?php echo "邮箱不能为空";?>);
				return false;
			}
			if (vericode = '') {
				alert('<?php echo "请输入正确的验证码" ?>');
				return false;
			}
			return true;
		}
	</script>
	<body>
		<?php require_once("uiparts/header.php");?>
		<div id="MainContainer">
			<div id="MainLeft">
				&nbsp;
			</div>
			<div id="MainMiddle">
				<div id="user_forget">
				<form action="do.php?act=forget" onsubmit='return check_form()' method="post">
					<h2> 如果你忘记了密码？</h2>
					<table>
					<tr>
						&nbsp;
					</tr>
					<tr>
						<td width="224" height="40" align="right">请输入你注册使用的eMail： </td>
	        			    	<td height="40" colspan="2" align="left"><input type="text" name="email" id="email" /></td>
					</tr>
				        <tr>
        					<td height="40" align="right">请输入验证码: </td>
				            	<td width="116" height="40" align="left"><input type="text" style="width:110px;" name="veriCode" id="veriCode" maxlength="5"/> </td>
			           		<td width="332" height="40"> <img border="0" src="foundation/veriCodes.php" id="verCodePic" /><a href="javascript:;" onclick="getVerCode(); return false;">看不清楚？</a></td>
				     	</tr>
				        <tr>
					        <td></td>
	   			            	<td height="50" colspan="2"><input type="submit" value="取回密码" /></td>
				        </tr>
		          </table>
		      </form>
			  </div>
			</div>
			<div id="Mainright">
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

