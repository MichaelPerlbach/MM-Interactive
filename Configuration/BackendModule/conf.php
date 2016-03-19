<?php
/**
 * Dummy Configuration for a Backend Module Group
 *
 * @author Michael Perlbach <info@mikelmade.de>
 */
define('TYPO3_MOD_PATH', '../typo3conf/ext/mminteractive/Configuration/BackendModule/');
$MCONF['name'] = 'MMinteractive';
$MCONF['script'] = '_DISPATCH';
$MCONF['access'] = 'user,group';
$MLANG['default']['tabs_images']['tab'] = 'ext_icon.png';
$MLANG['default']['ll_ref'] = 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_mod_main.xlf';
?>