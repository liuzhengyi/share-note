<?php
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
