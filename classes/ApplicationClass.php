<?php
	/*Creating a Basic Class for your application which consists some usefull and reusable functions*/
	session_start();
	class ApplicationClass{
		
		/*Data Members*/
		public $host = 'localhost'; 		// Your database host
		public $user = 'root';				// Database user which has all the priviledges
		public $password = 'root';			// Database password
		public $db = 'test';				// Database name
		
		/*Here Constructor is use to establish the database connection, when Object of the class will create it will call automatically*/
		function __construct(){	
			$con = mysql_connect($this->host, $this->user, $this->password);
			mysql_select_db($this->db, $con);
		}
		
		/*Member Functions*/
		
		/*This function will replace the original mysql_query() function only for inside the class because its declared as Private*/
		private function query($sql){
			$result = mysql_query($sql);
			if(!$result) echo(mysql_error());
			else return $result;
		}
		
		/*Reusabele function for inserting data into tables*/
		public function  insert($columns,$values,$table){
			//generate query for insertion
			$val_part="";
			$sql = "INSERT INTO `$table` ("; 
			$i = 0; 
			while ( $i < count($columns) ) { 
				//prepare field to be insert
				$sql .= "`" . $columns[$i] . "`"; 
				$val_part .= "'" . $values[$i] . "'"; 
				if ( ($i + 1) != count($columns) ) 
				{ 
					$val_part = $val_part . ", "; 
					$sql .= ", "; 
				} 
				$i++; 
			} 
			$sql .= ") VALUES (" . $val_part . ")";  
			return $this->query($sql) == 1 ? true : false;
		}
		
		/*Reusabele function for update data into tables*/
		public function update($columns,$values,$table, $condition){ 
			//generate query for insertion
			$sql = "UPDATE `$table` SET "; 
			$i = 0; 
			while ( $i < count($columns) ) { 
				//prepare field to be insert
				$sql .= "`" . $columns[$i] . "`= '" . $values[$i] . "'"; 		
				if ( ($i + 1) != count($columns) ) 
				$sql .= ", "; 
				  
				$i++; 
			} 
			//here condition clause will add into sql query 
			$sql .= " WHERE " . $condition . ""; 
			return $this->query($sql);
		}
		
		/*Reusabele function for delete data into tables*/
		public function delete($table,$condition){
		 return $this->query("delete from $table where $condition ");
		  
		}

		/*Reusabele function for fetch all data into tables*/
		public function fetchAll($table,$condition=NULL){	
			$obj = array();
			$result = $this->query("select * from $table $condition");
			//count number of records 
			while($row=mysql_fetch_assoc($result)){
				array_push($obj, $row);
			}
			return $obj;
		}
		
		/*Use to fill data(integer) in dropdown between given range*/
		public function fillDropDownValue($min, $max){
			$data = "";
			for($i=$min;$i<=$max;$i++) {
				$data .= '<option value="'.$i.'">'.$i.'</option>';
			}
			return $data;
		}
		/*Use to fill data(integer) in dropdown between given range*/
		public function fillSelectedDropDownValue($min, $max, $value){
			$data = ""; $selected = "";
			for($i=$min;$i<=$max;$i++) {
				if($value==$i) $selected = "selected='selected'";
				else $selected = "";
				$data .= '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
			}
			return $data;
		}
	}
?>