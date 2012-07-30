<?php
/*
	public function __construct($dbServs)
	public function setPages($perPage,$currPage)
	public function setNopages()
	public function getRs($sql)
	public function getAll($sql)
	public function getRow($sql)
	public function exeUpdate($sql)
	public function create($sql)
	public function affected_rows($sql)
	public function insert_id()
	public function delete_row($idname, $idvalue, $tname)
	public function total_page()
	public function total_row()
	public function check_exist($key, $value, $table)
	public function check_pass($e, $p)
	public function close()
*/

class dbex{

	private $dbc;		// initial in __construct($dbServs);
	private $rowCount;	// initial in getRs();
	private $perPage;	// initial in setPages();
	private $currPage;	// initial in setPages();
	private $totalPage;	// initial in getRs();

	public function __construct($dbServs)
	{
		$this->dbc = new mysqli($dbServs[0], $dbServs[2], $dbServs[3], $dbServs[1]);
		if($this->dbc->connect_error) {
			if( DEBUG ) {
				echo "debug: cdb, __construct, $this->dbc->connect_error.";
			}
			else {
				die ("");
			}
		}
	}

	public function setPages($perPage,$currPage=1)
	{
		$this->perPage=$perPage;
		$this->currPage=$currPage;
	}

	public function setNopages()
	{
		$this->perPage='';
	}

	public function getRs($sql)
	{
		$rs=array();
		if($this->perPage){
			$sql_count="select count(1) as total_count ".strstr($sql,"from"); //查询总数
//			$result_count=mysql_query($sql_count);
			$result_count=$this->dbc->query($sql_count);
//			$data_count=mysql_fetch_assoc($result_count);
			$data_count=$result_count->fetch_assoc();
//			echo "debug,cdbex.php: \$data_count = $data_count[total_count]";
			$this->rowCount=$data_count['total_count'];
			$sql.=" limit ".($this->currPage-1)*$this->perPage.",".$this->perPage;
//			echo "debug: <h3>\$this->currPage=$this->currPage, \$this->perPage=$this->perPage.</h3>";
//			echo "debug: <h3>$sql</h3>";
		}
		if( DEBUG ) {
		$result=$this->dbc->query($sql); if(!$result) { echo "debug: cdbex, $sql. any error:". $this->dbc->error. "errorno: ".$this->dbc->errno."\$result = $result."; }
		// i don't understrand that why i get server error when i removed the '!' before '$result' once.
		} else {
			$result=$this->dbc->query($sql) or die('<script type="text/javascript">location.href="servtools/error.php?error_type=dberr";</script>');
		}
	 

		if($this->perPage){
			$total_rs=$this->rowCount;
			$per_page=$this->perPage;
			$curr_page=$this->currPage;
			$total_page=floor(abs($total_rs-1)/$per_page)+1;//总页数
			$this->totalPage=$total_page;

 		//限制超页错误
			if($curr_page > $total_page){
 	   			echo '<script type="text/javascript" >history.go(-1);</script>';
// 	   			echo "<script type=\"text/javascript\" id=\"debug\">alert(\"\$sql_count='$sql_count',\$total_rs=$total_rs,\$per_page=$per_page,\$c_page=$curr_page, \$t_p=$total_page\"); history.go(-1);</script>";
		 		exit;
			}
	 	}
	 	/*
		while($rsRow=mysql_fetch_array($result)){
			$rs[]=$rsRow;
		}
		return $rs;
		*/
		while($rsRow = $result->fetch_array()) {
			$rs[] = $rsRow;
		}
		return $rs;
	}

	public function getAll($sql)
	{
		$this->setNopages();
		return $this->getRs($sql);
	}
	public function getRow($sql)
	{
		if( DEBUG ) {
		$result=$this->dbc->query($sql); if(!$result) { echo "debug: cdbex, $sql. any error:". $this->dbc->error. "errorno: ".$this->dbc->errno."\$result = $result."; }
		} else {
		$result=$this->dbc->query($sql) or die('<script type="text/javascript">location.href="servtools/error.php?error_type=dberr";</script>');
		}
		return $result->fetch_array();
	}

	public function exeUpdate($sql)
	{
   	/*
	if(mysql_query($sql)){
	return mysql_affected_rows();
	*/
		if($this->dbc->query($sql)) {
			return $this->dbc->affected_rows;
		}else{
			return false;
   		}
	}

	public function create($sql)
	{
//   $result=mysql_query($sql);
//   $create=mysql_fetch_array($result);
	$result=$this->dbc->query($sql);
	$create=$result->fetch_array($result);
	return $create;
	}

	public function affected_rows($sql)
	{
//   	return mysql_affected_rows();
		$this->dbc->query($sql);
		return $this->dbc->affected_rows;
	}

	public function insert_id()
	{
  		return $this->dbc->insert_id;
	}

	public function delete_row($idname, $idvalue, $tname)
	{
  		$sql = "delete from $tname where $idname = '$idvalue' limit 1";
  		$this->dbc->query($sql);
		return $this->dbc->affetcted_rows;
	}
	
	public function total_page()
	{
		return $this->totalPage;
	}

	public function total_row()
	{
		return $this->rowCount;
	}

	public function check_exist($key, $value, $table="user_basic")
	{
		if(empty($key) || empty($value) || empty($table)) {
			return 0;
		} else {
			$sql = "select 1 from $table where $key = '$value' limit 1";
			$res = $this->dbc->query($sql);
			return $res->num_rows;
		}
	}

	public function check_pass($e, $p)
	{
		if(empty($e) || empty($p)) {
			return 0;
		} else {
			$sql = "select 1 from user_basic where user_email = '$e' and user_pass = sha1('$p')";
			$res = $this->dbc->query($sql);
			return $res->num_rows;
		}
	}
  
	public function close()
	{
  		$this->dbc->close();
	}
}
?>
