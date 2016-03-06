<?php

/**
 * Class FlexFormHelper
 * @package mminteractive
 */
class FlexFormHelper {

	/**
		* @param array $fConfig
		* @param \TYPO3\CMS\backend\form\FormEngine $fObj
		*
		* @return void
		*/
	public function getRegions(&$fConfig, $fObj) {
		// fetch Repository
		$pluginConfiguration = array(
			'extensionName' => 'Mminteractive',
			'pluginName' => 'mminteractive_pi1'
		);
		$bootstrap = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('\\TYPO3\\CMS\\Extbase\\core\\bootstrap');
		$bootstrap->initialize($pluginConfiguration);
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('\\TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		//$repository = $objectManager->get('MikelMade\\Mminteractive\\Domain\\Repository\\RegionRepository');
				
		// conf
		$configurationManager = $objectManager->get('\\TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
		$configuration = $configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS, 'Mminteractive','');
				
		// fetch data
		//$regions = $repository->findAllDefault();

		// change conf
		/*
		foreach ($regions as $region) {
			array_push($fConfig['items'], array(
				$region['regionname'],
				$region['regionid']
			));
		}
		*/
		return $fConfig;
	}
} 