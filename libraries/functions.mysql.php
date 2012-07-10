<?php

function sql_query($q) {
	$gQ = mysql_query($q) or die('ERROR: '.mysql_error().' QUERY: '.$q);
	while($r = @mysql_fetch_assoc($gQ)) {
		$rtn[] = $r;
	}
	
	return $rtn;
}

function sql_insert($table, $data) {
	if(is_array($data) && count($data) > 0) {
		foreach($data as $f => $v) {
			$fields[] = $f;
			$values[] = mysql_real_escape_string($v);
		}
		
		sql_query("INSERT INTO `".ir_pre.$table."` (`".implode("`, `", $fields)."`) VALUES('".implode("', '", $values)."')");
		
		return true;
	} else {
		return false;	
	}
}

function sql_update($table, $data, $sel, $where = 'id') {
	if(is_array($data) && count($data) > 0) {
		foreach($data as $f => $v) {
			$fields[] = "`".$f."` = '".mysql_real_escape_string($v)."'";
		}
		
		sql_query("UPDATE `".ir_pre.$table."` SET ".implode(", ", $fields)." WHERE `".$where."` = '".$sel."'");
		
		return true;
	} else {
		return false;	
	}
}

function sql_selectBy($table, $id, $where = 'id') {
	return sql_query("SELECT * FROM `".ir_pre.$table."` WHERE `$where` = '$id'");
}

function sql_selectByIndex($table, $id, $where = 'id', $level = true) {
	$d = sql_query("SELECT * FROM `".ir_pre.$table."` WHERE `$where` = '$id'");
	return ($level === true) ? $d[0] : $d;
}

function sql_deleteByIndex($table, $id, $where = 'id') {
	sql_query("DELETE FROM `".ir_pre.$table."` WHERE `".$where."` = '".$id."'");
	return mysql_affected_rows();
}

function sql_stdSelect($tables, $o = '') {
	if(is_array($o['whereAnd'])) {
		$where.= join(" AND ", $o['whereAnd']);	
	}
	
	if(is_array($o['whereOr'])) {
		$where.= join(" OR ", $o['whereOr']);		
	}
	
	if(!empty($where)) {
		$where = " WHERE ".$where;		
	}
	
	if(is_array($o['records'])) {
		$records = join(", ", $o['records']);	
	} else {
		$records = '*';	
	}
	
	if(!empty($o['order'])) {
		$order = " ORDER BY ".$o['order'];	
	}
	
	if(!empty($o['limit'])) {
		$order = " LIMIT ".$o['limit'];	
	}
	
	return sql_query("SELECT ".$records." FROM  ".join(", ", $tables).$where.$order.$limit);
}
?>
