<?php
namespace MikelMade\Mminteractive\Utility;

/**
 * Class Div
 * @package mminteractive
 */
class Div
{

    /**
     *    sorts nested arrays
     * @param array
     * @return array
     */
    public static function array_orderby()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row) {
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
     *    finds an entry in a multidimensional array
     * @param string
     * @param string (or integer)
     * @param array
     * @return integer
     */
    public static function searchForItem($column, $item, $array)
    {
        foreach ($array as $key => $val) {
            if ($val[$column] === $item) {
                return $key;
            }
        }
        return null;
    }

    /**
     *    saves debug information in the extension's base directory
     * @param string
     * @param string
     * @param boolean (false: debug information is added, true: the debug file will be overwritten)
     *    return string
     */
    public static function debug($header = '', $info = '', $new = false)
    {
        $divider = "\n---------------------------------------\n";
        $debuginfo = '';
        if ($new == false) {
            $debuginfo = file_get_contents(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('typo3conf/ext/mminteractive/debug.txt'));
        }
        $debug = fopen(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('typo3conf/ext/mminteractive/debug.txt'),
            'w+');
        $fdist = (strlen($debuginfo) == 0) ? '' : "\n";
        $debuginfo .= $fdist . '#######################################' . "\n" . $header . ' ';
        $debuginfo .= date('Y-m-d H:i:s') . $divider;
        $debuginfo .= $info;
        $debuginfo .= "\n#######################################\n";
        fputs($debug, $debuginfo);
        fclose($debug);
    }
    // How to call:
    //\MikelMade\Mminteractive\Utility\Tx_Mminteractive_Utility_Div::debug('type-of-info',info,false);

    /**
     *    removes lots of special characters from a given string
     * @param string
     *    return string
     */
    public static function szreplace($string)
    {
        $t = str_replace("  ", " ", $string);
        $t = str_replace("  ", " ", $t);
        $t = str_replace(" ", "-", $t);
        $t = str_replace("�", "A", $t);
        $t = str_replace("�", "a", $t);
        $t = str_replace("�", "A", $t);
        $t = str_replace("�", "a", $t);
        $t = str_replace("�", "A", $t);
        $t = str_replace("�", "a", $t);
        $t = str_replace("�", "A", $t);
        $t = str_replace("�", "a", $t);
        $t = str_replace("�", "AE", $t);
        $t = str_replace("�", "ae", $t);
        $t = str_replace("�", "A", $t);
        $t = str_replace("�", "a", $t);
        $t = str_replace("�", "Ae", $t);
        $t = str_replace("�", "ae", $t);
        $t = str_replace("�", "C", $t);
        $t = str_replace("�", "c", $t);
        $t = str_replace("�", "E", $t);
        $t = str_replace("�", "e", $t);
        $t = str_replace("�", "E", $t);
        $t = str_replace("�", "e", $t);
        $t = str_replace("�", "E", $t);
        $t = str_replace("�", "e", $t);
        $t = str_replace("�", "E", $t);
        $t = str_replace("�", "e", $t);
        $t = str_replace("�", "I", $t);
        $t = str_replace("�", "i", $t);
        $t = str_replace("�", "I", $t);
        $t = str_replace("�", "i", $t);
        $t = str_replace("�", "I", $t);
        $t = str_replace("�", "i", $t);
        $t = str_replace("�", "I", $t);
        $t = str_replace("�", "i", $t);
        $t = str_replace("�", "N", $t);
        $t = str_replace("�", "n", $t);
        $t = str_replace("�", "O", $t);
        $t = str_replace("�", "o", $t);
        $t = str_replace("�", "O", $t);
        $t = str_replace("�", "o", $t);
        $t = str_replace("�", "O", $t);
        $t = str_replace("�", "o", $t);
        $t = str_replace("�", "O", $t);
        $t = str_replace("�", "o", $t);
        $t = str_replace("�", "Oe", $t);
        $t = str_replace("�", "oe", $t);
        $t = str_replace("�", "Oe", $t);
        $t = str_replace("�", "oe", $t);
        $t = str_replace("�", "U", $t);
        $t = str_replace("�", "u", $t);
        $t = str_replace("�", "U", $t);
        $t = str_replace("�", "u", $t);
        $t = str_replace("�", "U", $t);
        $t = str_replace("�", "u", $t);
        $t = str_replace("�", "Ue", $t);
        $t = str_replace("�", "ue", $t);
        $t = str_replace("Y�", "Y", $t);
        $t = str_replace("y�", "y", $t);
        $t = str_replace("�", "ss", $t);

        for ($i = 0; $i < 48; $i++) {
            $t = str_replace(chr($i), "", $t);
        }
        for ($i = 58; $i < 65; $i++) {
            $t = str_replace(chr($i), "", $t);
        }
        for ($i = 91; $i < 97; $i++) {
            $t = str_replace(chr($i), "", $t);
        }
        for ($i = 123; $i < 256; $i++) {
            $t = str_replace(chr($i), "", $t);
        }
        return $t;
    }
}