<?php
namespace MikelMade\Mminteractive\Utility;

/**
 * Class Tx_Mminteractive_Utility_Div
 * @package mminteractive
 */
class Tx_Mminteractive_Utility_Div {
	
	/**
		*	sorts nested arrays
		*	@param array
		*	@return array
	*/
	public static function array_orderby(){
		$args = func_get_args();
		$data = array_shift($args);
		foreach ($args as $n => $field) {
			if (is_string($field)) {
				$tmp = array();
				foreach ($data as $key => $row){
					$tmp[$key] = $row[$field];
				}
				$args[$n] = $tmp;
			}
		}
		$args[] = &$data;
		call_user_func_array('array_multisort', $args);
		return array_pop($args);
	}
	
	/**
		*	finds an entry in a multidimensional array
		*	@param string
		*	@param string (or integer)
		*	@param array
		*	@return integer
	*/
	public static function searchForItem($column, $item, $array) {
		foreach ($array as $key => $val) {
    if ($val[$column] === $item) { return $key; }
		}
		return null;
	}
	
	/**
		*	saves debug information in the extension's base directory
		* @param string
		* @param string
		* @param boolean (false: debug information is added, true: the debug file will be overwritten)
		*	return string
	*/
	public static function debug($header='',$info='',$new=false){
		$divider = "\n---------------------------------------\n";
		$debuginfo = '';
		if($new == false){
			$debuginfo = file_get_contents(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('typo3conf/ext/mminteractive/debug.txt'));
		}
		$debug = fopen(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('typo3conf/ext/mminteractive/debug.txt'),'w+');
		$fdist = (strlen($debuginfo) == 0) ? '' : "\n";
		$debuginfo .= $fdist.'#######################################'."\n".$header.' ';
		$debuginfo .= date('Y-m-d H:i:s').$divider;
		$debuginfo .= $info;
		$debuginfo .= "\n#######################################\n";
		fputs($debug,$debuginfo);
		fclose($debug);
	}
	// How to call:
	//\MikelMade\Mminteractive\Utility\Tx_Mminteractive_Utility_Div::debug('type-of-info',info,false);
	
	/**
		*	removes lots of special characters from a given string
		*	@param string
		*	return string
	*/
	public static function szreplace($string){
		$t = str_replace("  ", " ", $string);
		$t = str_replace("  ", " ", $t);
		$t = str_replace(" ", "-", $t);
		$t = str_replace("À", "A", $t);
		$t = str_replace("à", "a", $t);
		$t = str_replace("Á", "A", $t);
		$t = str_replace("á", "a", $t);
		$t = str_replace("Â", "A", $t);
		$t = str_replace("â", "a", $t);
		$t = str_replace("Ã", "A", $t);
		$t = str_replace("ã", "a", $t);
		$t = str_replace("Ä", "AE", $t);
		$t = str_replace("ä", "ae", $t);
		$t = str_replace("Å", "A", $t);
		$t = str_replace("å", "a", $t);
		$t = str_replace("Æ", "Ae", $t);
		$t = str_replace("æ", "ae", $t);
		$t = str_replace("Ç", "C", $t);
		$t = str_replace("ç", "c", $t);
		$t = str_replace("È", "E", $t);
		$t = str_replace("è", "e", $t);
		$t = str_replace("É", "E", $t);
		$t = str_replace("é", "e", $t);
		$t = str_replace("Ê", "E", $t);
		$t = str_replace("ê", "e", $t);
		$t = str_replace("Ë", "E", $t);
		$t = str_replace("ë", "e", $t);
		$t = str_replace("Ì", "I", $t);
		$t = str_replace("ì", "i", $t);
		$t = str_replace("Í", "I", $t);
		$t = str_replace("í", "i", $t);
		$t = str_replace("Î", "I", $t);
		$t = str_replace("î", "i", $t);
		$t = str_replace("Ï", "I", $t);
		$t = str_replace("ï", "i", $t);
		$t = str_replace("Ñ", "N", $t);
		$t = str_replace("ñ", "n", $t);
		$t = str_replace("Ò", "O", $t);
		$t = str_replace("ò", "o", $t);
		$t = str_replace("Ó", "O", $t);
		$t = str_replace("ó", "o", $t);
		$t = str_replace("Ô", "O", $t);
		$t = str_replace("ô", "o", $t);
		$t = str_replace("Õ", "O", $t);
		$t = str_replace("õ", "o", $t);
		$t = str_replace("Ö", "Oe", $t);
		$t = str_replace("ö", "oe", $t);
		$t = str_replace("Ø", "Oe", $t);
		$t = str_replace("ø", "oe", $t);
		$t = str_replace("Ù", "U", $t);
		$t = str_replace("ù", "u", $t);
		$t = str_replace("Ú", "U", $t);
		$t = str_replace("ú", "u", $t);
		$t = str_replace("Û", "U", $t);
		$t = str_replace("û", "u", $t);
		$t = str_replace("Ü", "Ue", $t);
		$t = str_replace("ü", "ue", $t);
		$t = str_replace("Y´", "Y", $t);
		$t = str_replace("y´", "y", $t);
		$t = str_replace("ß", "ss", $t);
       
		for ($i = 0; $i < 48; $i++){ $t = str_replace(chr ($i), "", $t); }
		for ($i = 58; $i < 65; $i++){ $t = str_replace(chr ($i), "", $t); }
		for ($i = 91; $i < 97; $i++) { $t = str_replace(chr ($i), "", $t); }
		for ($i = 123; $i < 256; $i++){ $t = str_replace(chr ($i), "", $t); }
		return $t;
	}
}