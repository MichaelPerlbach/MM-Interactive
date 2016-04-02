<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 12.03.2016
 * Time: 13:49
 */

$mminteractive = array(
    'mminteractive' => array(
        'exclude' => 1,
        'l10n_mode' => 'mergeIfNotBlank',
        'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang.xlf:tx_mminteractive_sys_file_reference.mminteractive',
        'config' => array(
            'type' => 'mminteractive',
        )
    )
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference', $mminteractive);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'sys_file_reference',
    'imageoverlayPalette',
    'mminteractive',
    'after:crop'
);