<div id="GoodResource">
	<h2>热门资源</h2>
	<ul>
<?php
foreach($hot_reses as $k) {
	echo "<li><a href=\"modules.php?app=res_show&res_id={$k['id']}\" >{$k['name']}</a></li>";
}
?>
	</ul>
</div>
