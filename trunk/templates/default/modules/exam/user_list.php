<html>
<head>
	<!-- use dbex object -->
	<title>user register page</title>
	<meta http-equiv="content-type" content="text/html; charset=utf8" />
	<link rel="stylesheet" type="text/css" href="skin/default/dafen/exam.css" />
</head>

<body >
<div id="registered">
	<h1>registered users</h1>
	<table border="1">
		<tr>
			<td>用户id</td>
			<td>用户名</td>
			<td>院校</td>
			<td>注册邮箱</td>
		</tr>
		<?php
		foreach($res as $row) {
			echo "	\n<tr>\n\t<td>{$row['user_id']}</td>\n\t<td>{$row['user_name']}</td>
				\n\t<td>{$row['school']}</td>\n\t<td>{$row['user_email']}</td>\n</tr>";
		}
		?>
	</table>
</div><!-- end of DIV registered -->

<?php
// show pagebar
if($set_pages) {
	echo '<div id="pagebar">';
	echo "\n<p>以上是第$start_item 到$end_item 条记录。当前是第$cur_page 页。</p>";
	echo "<p>";
	if($cur_page > 1) {
		echo "<a href=\"modules.php?app=$appId&cur_page=$prev_page&page_items=$page_items\">previous page</a>";
	}
	echo "&nbsp;</p>"; // space can hold a blank paragraph
	for($i = 1; $i <= $dbo->total_page(); $i ++) {
		echo "\n\t<a ";
		if($i == $cur_page) {
			echo 'class="current" ';
		} 
			echo " href=\"modules.php?app=$appId&cur_page=$i&page_items=$page_items\" >pg $i</a>";
	}
	echo "<p>";
	if($cur_page < $dbo->total_page()) {
		echo "<a href=\"modules.php?app=$appId&cur_page=$next_page&page_items=$page_items\">next page</a>";
	}
	echo "</p>";
	echo '</div>';
}
?>

<hr id="clear" />
<p><a href="modules.php?app=user_reg">注册新用户</a></p>
<p><a href="modules.php?app=user_log">用户登录</a></p>

</body>
</html>
