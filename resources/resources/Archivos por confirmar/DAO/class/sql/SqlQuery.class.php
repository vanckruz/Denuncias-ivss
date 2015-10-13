<?php

class SqlQuery{
	var $txt;
	var $params = array();
	var $idx = 0;

	
	function SqlQuery($txt){
		$this->txt = $txt;
	}

	public function setString($value){
		$value = addslashes($value);
		$this->params[$this->idx++] = "'".$value."'";
	}
	
	public function set($value){
		$value = addslashes($value);
		$this->params[$this->idx++] = "'".$value."'";
	}
	
	public function setNumber($value){
		if($value===null){
			$this->params[$this->idx++] = "null";
			return;
		}
		if(!is_numeric($value)){
			throw new Exception($value.' is not a number');
		}
		$this->params[$this->idx++] = "'".$value."'";
	}

	
	public function getQuery()
	{
		if($this->idx==0)
		{
			return $this->txt;
		}
		$p = explode("?", $this->txt);
		$sql = '';
		for($i=0;$i<=$this->idx;$i++)
		{
			if($i>=count($this->params))
			{
				$sql .= $p[$i];
			}
			else{
                 	if("null"===$this->params[$i])
					{
                    	$columnName = $this->getColumnName($p[$i]);
                    	if(isset($columnName))
						{
                        	$sql .= $columnName."is ".$this->params[$i];
                        }
						else{ $sql .= $p[$i].$this->params[$i];}
                    }
					else{$sql .= $p[$i].$this->params[$i];}
				 }
		}
		return $sql;
	}
        
    private function getColumnName($textCopy){
                $trimmedUppercaseSql = trim(strtoupper($this->txt));
                if($this->startsWith($trimmedUppercaseSql, "SELECT ")){
                    $rightTrimmedTextCopy = rtrim($textCopy, " ");
                    $columnName = rtrim($rightTrimmedTextCopy, "=");
                    if(strlen($columnName) !== strlen($rightTrimmedTextCopy)){
                        return $columnName;
                    }
                }
                return null;
        }
	
	private function replaceFirst($str, $old, $new){
		$len = strlen($str);
		for ($i=0;$i<$len;$i++){
			if($str[$i]==$old){
				$str = substr($str,0,$i).$new.substr($str,$i+1);
				return $str;
			}
		}
		return $str;
	}
        
        private function startsWith($haystack, $needle)
        {
            return !strncmp($haystack, $needle, strlen($needle));
        }

        private function endsWith($haystack, $needle)
        {
            $length = strlen($needle);
            if ($length == 0) {
                return true;
            }

            return (substr($haystack, -$length) === $needle);
        }        
}
?>