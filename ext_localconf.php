<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

require_once \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('mminteractive') . 'Classes/Utility/AjaxDispatcher.php';

$TYPO3_CONF_VARS['BE']['AJAX']['mminteractiveAjaxDispatcher'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('mminteractive') . 'Classes/Utility/AjaxDispatcher.php:Tx_mminteractive_Utility_AjaxDispatcher->initAndDispatch';

// FE plugin 
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin('MikelMade.' . $_EXTKEY, 'Pi1', array(
    'FrontendDisplay' => 'list,showajaxreturn'
  ), // non-cacheable actions
  array(
    'FrontendDisplay' => 'showajaxreturn'
  ));


$timestamp = time();
// Register FormEngine node type resolver hook to render RTE in FormEngine if enabled
$TYPO3_CONF_VARS['SYS']['formEngine']['nodeResolver'][$timestamp] = array(
  'nodeName' => 'mminteractive',
  'priority' => 50,
  'class' => \MikelMade\Mminteractive\Form\Resolver\MminteractiveResolver::class,
);