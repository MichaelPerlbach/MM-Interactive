<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('mminteractive').'Classes/Utility/AjaxDispatcher.php';

$TYPO3_CONF_VARS['BE']['AJAX']['mminteractiveAjaxDispatcher'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('mminteractive').'Classes/Utility/AjaxDispatcher.php:Tx_mminteractive_Utility_AjaxDispatcher->initAndDispatch';

// FE plugin 
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'MikelMade.'.$_EXTKEY,
	'Pi1',
	array(
		'FrontendDisplay' => 'list,showajaxreturn'
	),
	// non-cacheable actions 
	array(
		'FrontendDisplay' => 'showajaxreturn'
	)
);