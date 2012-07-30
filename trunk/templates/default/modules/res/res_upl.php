<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="utf-8" xml:lang="utf-8">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>大学生学习资料分享中心</title>
		<link rel="stylesheet" type="text/css" href="./skin/default/dafen/main.css" />
		<script type="text/javascript">
			function check_input_upload()
			{
				var input_name = document.getElementById("input_name");
				var value_name = input_name.value;
				var input_file = document.getElementById("input_file");
				var value_file = input_file.value;
				var input_subject = document.getElementById("input_subject");
				var value_subject = input_subject.value;
				var input_comment = document.getElementById("input_comment");
				var value_comment = input_comment.value;

				//Check name
				if (value_name.length <= 0 || value_name.length > 30)
				{
					document.getElementById("hint_input_name").style.visibility = "visible";
					document.getElementById("btn_submit").disabled = true;
					return;
				}
				else
				{
					document.getElementById("hint_input_name").style.visibility = "hidden";
				}

				//Check file
				if (value_file.length <= 0)
				{
					document.getElementById("hint_input_file").style.visibility = "visible";
					document.getElementById("btn_submit").disabled = true;
					return;
				}
				else
				{
					document.getElementById("hint_input_file").style.visibility = "hidden";
				}

				//Check subject
				if (value_subject.length <= 0 || value_subject.length > 10)
				{
					document.getElementById("hint_input_subject").style.visibility = "visible";
					document.getElementById("btn_submit").disabled = true;
					return;
				}
				else
				{
					document.getElementById("hint_input_subject").style.visibility = "hidden";
				}

				//Check comment
				if (value_comment.length <= 0 || value_comment.length > 100)
				{
					document.getElementById("hint_input_comment").style.visibility = "visible";
					document.getElementById("btn_submit").disabled = true;
					return;
				}
				else
				{
					document.getElementById("hint_input_comment").style.visibility = "hidden";
				}

				document.getElementById("btn_submit").disabled = false;
			}
		</script>
	</head>
	<body>
		<?php require_once("uiparts/header.php");?>

		<div id="MainContainer">
			<div id="MainLeft">
				<?php require_once("uiparts/links.php");?>
			</div>
			<div id="MainMiddle">
				<div id="ResourceShow">
					<h2>资源上传</h2>
					<form enctype="multipart/form-data" action="do.php?act=res_upl" method="post">
						<input type="hidden" name="MAX_FILE_SIZE" value="2097152" /><!-- 2kByte -->
						<table border='0'>
							<tr>
								<td>资源名称：</td>
								<td>
									<input type="text" name="name" id="input_name" maxlength="50" onchange='check_input_upload();' value=""/>
									<span class="hint" id="hint_input_name">*</span>
								</td>
							</tr>
							<tr>
								<td>文件：</td>
								<td>
									<input type="file" name="upfile" onchange="check_input_upload();" id="input_file"/>
									<span class="hint" id="hint_input_file">*</span>
								</td>
							</tr>
							<tr>
								<td>所属科目：</td>
								<td>
									<input type="text" name="subject" id="input_subject" onchange="check_input_upload();" maxlength="30" value=""/>
									<span class="hint" id="hint_input_subject">*</span>
								</td>
								</tr>
							<tr>
								<td>类型：</td>
								<td>
									<select onchange="check_input_upload();" name="type">
										<option value="xxbj" selected="selected">学习笔记</option>
										<option value="jskj">教师课件</option>
										<option value="fxtg">复习提纲</option>
										<option value="mnsj">模拟试卷</option>
										<option value="wnzt">往年真题</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>来源：</td>
								<td>
									<select onchange="check_input_upload();" name="source">
										<option value="self" selected="selected">原创</option>
										<option value="nett">网络</option>
										<option value="othe">其他</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>简介：<span class="hint" id="hint_input_comment">*</span></td>
								<td>
									<textarea id="input_comment" name="intro" cols="30" rows="7" onkeyup="check_input_upload();" value=""></textarea>
								</td>
							</tr>
						</table>

						<input type='submit' name="submit" id="btn_submit" disabled="disabled" value="上传"/>

						<input type='hidden' name='submitted' value='TRUE'/></td>
					</form>
				</div>
			</div>
			<div id="MainRight">
				<?php require_once("uiparts/login.php");?>
				<?php require_once("uiparts/hot_res.php");?>
			</div>

			<div class="clearfix">
			</div>
		</div>

		<?php require_once("uiparts/footer.php");?>
	</body>
</html>
