<?php 
include"connClass.php";
class DALQueryResult {
	private $_results = array();
	public function __construct()
	{
	}
	public function __set($var,$val)
	{
		$this->_results[$var] = $val;
	}
	public function __get($var)
	{
		if (isset($this->_results[$var]))
		{
			return $this->_results[$var];
		}
		else{
			return null;
		}
	}
}


class DAL {
	public function __construct(){		
		$this->dbconnect();				
	}
	
	public function get_models($getsearchword,$sort)
	{
		if($sort==TRUE)
		{
			$sql ="SELECT * FROM temprate WHERE destinations LIKE '".$getsearchword."%' AND (rate IS NOT NULL OR rate != '')ORDER BY destinations ASC";
		}
		else
		{
			if(is_numeric($getsearchword))
			{
				$sql ="SELECT * FROM temprate WHERE areaCodes LIKE '".$getsearchword."%' AND (rate IS NOT NULL OR rate != '')ORDER BY destinations ASC";
			}
			else{
				$sql ="SELECT * FROM temprate WHERE destinations LIKE '%".$getsearchword."%' AND (rate IS NOT NULL OR rate != '')ORDER BY destinations ASC";
			}
		}
		return $this->query($sql);
	}
	
	private function dbconnect()
	{
	$conn= new mysqlconnect();
	$conn->connect();
	}
	
	private function query($sql)
	{
		//	$this->dbconnect();
		$res = mysql_query($sql);
		
		if ($res)
		{
			if (strpos($sql,'SELECT') === false)
			{
				return true;
			}
		}
		else{
			if (strpos($sql,'SELECT') === false)
			{
				return false;
			}
			else{
				return null;
			}
		}
		$results = array();
		while ($row = mysql_fetch_array($res))
		{
			$DALObject = new DALQueryResult();
			foreach ($row as $k=>$v)
			{
				$DALObject->$k = $v; // assign value;
			}
			$results[] = $DALObject;
		}
		return $results;
	}
}

?>