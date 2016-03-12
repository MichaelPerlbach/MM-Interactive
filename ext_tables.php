<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

// TCA
$TCA['tx_mminteractive_domain_model_produkte'] = array(
  'ctrl' => array(
    'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/tca.php'
  )
);

include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Utility/FlexFormHelper.php');

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature,
  'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/setup.xml');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin($_EXTKEY, 'Pi1', 'Frontendausgabe MM Interactive');

if (TYPO3_MODE === 'BE') {
    $TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_mminteractive_wizicon"] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Private/Php/class.mminteractive_wizicon.php';

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Setup');

    $moduleName = 'mminteractive';
    if (!isset($TBE_MODULES[$moduleName])) {
        $temp_TBE_MODULES = array();
        foreach ($TBE_MODULES as $key => $val) {
            if ($key == 'web') {
                $temp_TBE_MODULES[$key] = $val;
                $temp_TBE_MODULES[$moduleName] = '';
            } else {
                $temp_TBE_MODULES[$key] = $val;
            }
        }
        $TBE_MODULES = $temp_TBE_MODULES;
    }
    // \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule($moduleName, '', '', \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/BackendModule/');

    // Hauptmodul erstellen
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule('MikelMade.' . $_EXTKEY,            # Extension-Key
      $moduleName,           # Kategorie
      '',                   # Modulname
      '',                                # Position
      Array(),     # Controller
      Array(
        'access' => 'user,group',  # Konfiguration
        'icon' => 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/modicon.png',
        'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod_main.xlf',
      ));

    /**
     * Registers a Backend Module
     */
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule('MikelMade.' . $_EXTKEY, 'mminteractive',
      // Make module a submodule of 'mminteractive'
      'mod1',  // Submodule key
      '1',            // Position
      array(
        'Map' => 'list',
      ), array(
        'access' => 'user,group',
        'icon' => 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/map.png',
        'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_map.xlf',
      ));

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript',
  'mminteractive');


?>
