<?php
function reportErrorScript($id, $errors) {
	if(count($errors) > 0) {
		foreach($errors as $field => $msg) {
			$errorsArray[] = array(
				'name' => $field,
				'errorMsg' => $msg
			);	
		}
		return '
			<script type="text/javascript">
				(function($, undefined) {
					$(function() {
						$("#'.$id.'").foxoErrors({
							"errorData" : '.json_encode($errorsArray).'
						});
					});
				})(jQuery);
			</script>
		';	
	}	
}


function objectToArray($object) {
	if(!is_object($object) && !is_array($object)) {
		return $object;
	}
	
	if(is_object($object)) {
		$object = get_object_vars($object);
	}
	
	return array_map('objectToArray', $object );
}

function encrypt($data, $key) {
	return hash('sha256', _com_key.$data.$key);
}

function password($p) {
	return encrypt($p, _pass_key);		
}

function checksum($arr) {
	return encrypt(join(_com_key, $arr), _com_key);	
}

function truncateString($text, $chars=25) {
	if(strlen($text) > $chars) {
		$text = $text." ";
		$text = substr($text,0,$chars);
		$text = substr($text,0,strrpos($text,' '));
		$text = $text."...";
	}
	
	return $text;
}

function buildUrl($url, $parts) {
	return $url.join("/", $parts);
}


function escapeForUrl($d) {
	//TODO: Replace whitespaces with underscores/dash/etc and remove all non-alphanumeric characters. 
	return urlencode($d);	
}

function formatPrice($price) {
	return number_format($price,2);
}

function genSelectHtml($data, $sel = '') {
	if(is_array($data)) {
		foreach($prov as $a => $t) {
			$html[] = '<option id="'.$a.'" value="'.$a.'" '.(($sel == $a) ? 'selected' : '').'>'.$t.' ('.$a.')</option>';
		}
	
		return join(PHP_EOL, $html);
	} else {
			
	}
}

function yearDropDown($num = 40, $sel) {
	$cur = date("Y");
	$min = $cur - $num;
	
	while($cur > $min) {
		$list .= '<option value="'.$cur.'" '.(($cur == $sel) ? 'selected' : '').'>'.$cur.'</option>';		
		$cur--;
	}
	
	return $list;
}


// Function from PHP.net - php at wizap dot com - http://zt.a.atr.im
function removeHtmlTags($s , $keep = '' , $expand = 'script|style|noframes|select|option'){
	  /**///prep the string
	  $s = ' ' . $s;
	 
	  /**///initialize keep tag logic
	  if(strlen($keep) > 0){
			$k = explode('|',$keep);
			for($i=0;$i<count($k);$i++){
				 $s = str_replace('<' . $k[$i],'[{(' . $k[$i],$s);
				 $s = str_replace('</' . $k[$i],'[{(/' . $k[$i],$s);
			}
	  }
	 
	  //begin removal
	  /**///remove comment blocks
	  while(stripos($s,'<!--') > 0){
			$pos[1] = stripos($s,'<!--');
			$pos[2] = stripos($s,'-->', $pos[1]);
			$len[1] = $pos[2] - $pos[1] + 3;
			$x = substr($s,$pos[1],$len[1]);
			$s = str_replace($x,'',$s);
	  }
	 
	  /**///remove tags with content between them
	  if(strlen($expand) > 0){
			$e = explode('|',$expand);
			for($i=0;$i<count($e);$i++){
				 while(stripos($s,'<' . $e[$i]) > 0){
					  $len[1] = strlen('<' . $e[$i]);
					  $pos[1] = stripos($s,'<' . $e[$i]);
					  $pos[2] = stripos($s,$e[$i] . '>', $pos[1] + $len[1]);
					  $len[2] = $pos[2] - $pos[1] + $len[1];
					  $x = substr($s,$pos[1],$len[2]);
					  $s = str_replace($x,'',$s);
				 }
			}
	  }
	 
	  /**///remove remaining tags
	  while(stripos($s,'<') > 0){
			$pos[1] = stripos($s,'<');
			$pos[2] = stripos($s,'>', $pos[1]);
			$len[1] = $pos[2] - $pos[1] + 1;
			$x = substr($s,$pos[1],$len[1]);
			$s = str_replace($x,'',$s);
	  }
	 
	  /**///finalize keep tag
	  for($i=0;$i<count($k);$i++){
			$s = str_replace('[{(' . $k[$i],'<' . $k[$i],$s);
			$s = str_replace('[{(/' . $k[$i],'</' . $k[$i],$s);
	  }
		
	  
	  return trim(nl2br($s));
}
			
?>
