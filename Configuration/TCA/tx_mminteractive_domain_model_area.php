<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,url,params,alt,bgcolor,bgimage,bgimageix,bgimageiy,bgcoloropacity,bgimageopacity,bgimageoverbgcolor,popuptype,popuptitle,popupwidth,popupheight,popupx,popupy,popupborderstyle,popupborderwidth,popupbordercolor,popupcontentid,popuphtml,bordercolor,borderstyle,borderwidth,areapoints,event,method,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('mminteractive') . 'Resources/Public/Icons/tx_mminteractive_domain_model_area.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, url, params, alt, bgcolor, bgimage, bgimageix, bgimageiy, bgcoloropacity, bgimageopacity, bgimageoverbgcolor, popuptype, popuptitle, popupwidth, popupheight, popupx, popupy, popupborderstyle, popupborderwidth, popupbordercolor, popupcontentid, popuphtml, bordercolor, borderstyle, borderwidth, areapoints, event, method',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, url, params, alt, bgcolor, bgimage, bgimageix, bgimageiy, bgcoloropacity, bgimageopacity, bgimageoverbgcolor, popuptype, popuptitle, popupwidth, popupheight, popupx, popupy, popupborderstyle, popupborderwidth, popupbordercolor, popupcontentid, popuphtml, bordercolor, borderstyle, borderwidth, areapoints, event, method, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_mminteractive_domain_model_area',
				'foreign_table_where' => 'AND tx_mminteractive_domain_model_area.pid=###CURRENT_PID### AND tx_mminteractive_domain_model_area.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'url' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.url',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'params' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.params',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'alt' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.alt',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bgcolor' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.bgcolor',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bgimage' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.bgimage',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bgimageix' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.bgimageix',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bgimageiy' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.bgimageiy',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bgcoloropacity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.bgcoloropacity',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bgimageopacity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.bgimageopacity',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bgimageoverbgcolor' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.bgimageoverbgcolor',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popuptype' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popuptype',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popuptitle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popuptitle',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popupwidth' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popupwidth',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popupheight' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popupheight',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popupx' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popupx',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popupy' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popupy',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popupborderstyle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popupborderstyle',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popupborderwidth' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popupborderwidth',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popupbordercolor' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popupbordercolor',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popupcontentid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popupcontentid',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'popuphtml' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.popuphtml',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'bordercolor' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.bordercolor',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'borderstyle' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.borderstyle',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'borderwidth' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.borderwidth',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'areapoints' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.areapoints',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_mminteractive_domain_model_areapoint',
				'foreign_field' => 'area',
				'foreign_sortby' => 'sorting',
				'maxitems' => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'useSortable' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'event' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.event',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_mminteractive_domain_model_event',
				'foreign_field' => 'area',
				'foreign_sortby' => 'sorting',
				'maxitems' => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'useSortable' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'method' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:mminteractive/Resources/Private/Language/locallang_db.xlf:tx_mminteractive_domain_model_area.method',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_mminteractive_domain_model_method',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		
		'map' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);