<?php 
// this file is compiled by compile.sh 
// if you want to change this page 
// modify the corresponding model file and template file 
// gipsa 2012
?><?php
global $dbServs; // initial in $dbConfFile
$dbo = new dbex($dbServs);
$sql = "select d.res_id as id, r.res_name as name from resource_basic as r JOIN download as d using(res_id) group by d.res_id order by count(d.user_id) desc limit 5";
$hot_reses = $dbo->getAll($sql);
?>
<?php
/* data instructions:
 * 
 * $hot_reses[n][]		(n <= 5 && n >= 0)
 *		id	--> 资源id
 *		name	--> 资源名称
 *	
 */
?>
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
