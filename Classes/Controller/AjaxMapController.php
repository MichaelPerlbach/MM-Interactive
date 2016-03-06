<?php

/***************************************************************
 *	Copyright notice
 *
 *	(c) 2016 MikelMade (www.mikelmade.de)
 *	All rights reserved
 *
 *	This script is part of the TYPO3 project. The TYPO3 project is
 *	free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation; either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	The GNU General Public License can be found at
 *	http://www.gnu.org/copyleft/gpl.html.
 *
 *	This script is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
 *	GNU General Public License for more details.
 *
 *	This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
	*
	*	@package	mminteractive
	*	@license	http://www.gnu.org/licenses/gpl.html	GNU	General	Public	License,	version	3	or	later
	*
	*/
class	Tx_mminteractive_Controller_AjaxMapController	extends	\TYPO3\CMS\Extbase\Mvc\Controller\ActionController	{
	
	/**
		*	mapRepository
		*
		*	@var	\MikelMade\Mminteractive\Domain\Repository\MapRepository
		*	@inject
		*/
	protected	$mapRepository;
	
	

	public function initializeSettings() {
		/*
		if(!empty($this->settings['flexform'])) {
			foreach ($this->settings['flexform'] as $key => $value) {
				if (isset($this->settings[$key]) && $value != '') {
					$this->settings[$key] = $value;
				}
 			}
 		}
		*/
	}
		
	//public function initializeAction() { $this->initializeSettings(); }
	
	
	/**
		*	action	addcustomer
		*
		*	@return	 void
	*/
	public	function	addcustomerAction()	{
		$args = $this->request->getArguments();
		$name = $args['name'];
		$dir = $args['dir'];
		$logo = $args['logo'];
		
		$customer = new MikelMade\Mminteractive\Domain\Model\Customer();
		$customer->setDeleted(0);
		$customer->setTitle($name);
		$customer->setStartdir($dir);
		$customer->setLogo($logo);
		$this->customerRepository->add($customer);
		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		$persistenceManager->persistAll();
		$newcustomer = $customer->getUid();
		
		// Standard-Layoutvorlage anlegen
		$layout = new MikelMade\Mminteractive\Domain\Model\Customerlayout();
		$layout->setCustomerid($newcustomer);
		$layout->setTitle('Basislayout');
		$layout->setFont('arial');
		$layout->setFontsize(12);
		$layout->setFontcolor('#000000');
		$layout->setBackgroundcolor('#FFFFFF');
		$layout->setHeadlinecolor('#000000');
		$layout->setLinkColorActive('#FF0000');
		$layout->setLinkColorInactive('#000000');
		$layout->setLinkColorrollover('#FF0000');
		$layout->setPicframe(0);
		$layout->setPicframecolor('#000000');
		$layout->setArrowcolor('#FF0000');
		$layout->setHeadersize(20);
		$layout->setLinecolor('#000000');
		$layout->setUpperedgecolor('#CCCCCC');
		$layout->setIconsColorActive('#FF0000');
		$layout->setIconsColorInactive('#000000');
		$layout->setIconsColorRollover('#FF0000');
		$this->customerlayoutRepository->add($layout);
		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		$persistenceManager->persistAll();
		
		// Alle Verzeichnisse und die DB anlegen.
		$abspath = \MikelMade\Mminteractive\Utility\Tx_Mminteractive_Utility_Div::absPath();
		$logopath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('uploads/tx_mminteractive/');

		mkdir ( $abspath.'webseiten/'.$dir );
		mkdir ( $abspath.'webseiten/'.$dir.'/fileadmin' );
		mkdir ( $abspath.'webseiten/'.$dir.'/fileadmin/layout' );
		mkdir ( $abspath.'webseiten/'.$dir.'/fileadmin/layout/images' );
		copy($logopath.$logo,$abspath.'webseiten/'.$dir.'/fileadmin/layout/images/'.$logo);
		unlink($logopath.$logo);
		print $newcustomer;
	}
	
	/**
		*	action	loadcustomer
		*
		*	@return	 void
	*/
	public	function	loadcustomerAction()	{
		$args = $this->request->getArguments();
		$id = $args['id'];
		print json_encode($this->customerRepository->findCustomer($id));
	}
	
	/**
		*	action	savecustomername
		*
		*	@return	 void
	*/
	public function savecustomernameAction(){
		$args = $this->request->getArguments();
		$id = $args['id'];
		$title = $args['name'];
		$thiscustomer = $this->customerRepository->findByUid((int)$id);
		$thiscustomer->setTitle($title);
		$this->customerRepository->update($thiscustomer);
		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		$persistenceManager->persistAll();
		print $title;
	}
	
	/**
		*	action	savelogonarrow
		*
		*	@return	 void
	*/
	public function savelogonarrowAction(){
		$args = $this->request->getArguments();
		$id = $args['id'];
		$logonarrow = $args['logonarrow'];
		$thiscustomer = $this->customerRepository->findByUid((int)$id);
		$thiscustomer->setLogonarrow((int)$logonarrow);
		
		$this->customerRepository->update($thiscustomer);
		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		$persistenceManager->persistAll();
	}
	
	/**
		*	action save logo
		*
		*	@return	 void
	*/
	public	function	savelogoAction()	{
		$args = $this->request->getArguments();
		$id = $args['id'];
		$logo = $args['logo'];
		$thiscustomer = $this->customerRepository->findByUid((int)$id);
		$startdir = $thiscustomer->getStartdir();
		$prevlogo = $thiscustomer->getLogo($logo);
		$thiscustomer->setLogo($logo);
		$this->customerRepository->update($thiscustomer);
		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		$persistenceManager->persistAll();
		
		$abspath = \MikelMade\Mminteractive\Utility\Tx_Mminteractive_Utility_Div::absPath();
		$logopath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('uploads/tx_mminteractive/');
		unlink($abspath.'webseiten/'.$startdir.'/fileadmin/layout/images/'.$prevlogo);
		copy($logopath.$logo,$abspath.'webseiten/'.$startdir.'/fileadmin/layout/images/'.$logo);
		unlink($logopath.$logo);
	}
	
	/**
		*	action	savecustomer
		*
		*	@return	 void
	*/
	public function savecustomerAction(){
		$args = $this->request->getArguments();
		$langversions = json_decode($args['languageversions']);
		
		foreach($langversions as $langversion){
			$thisversion = $this->gruppennamesRepository->findByUid((int)$langversion[0]);
			$thisversion->setTitle($langversion[1]);
			$thisversion->setDescription($langversion[2]);
			$this->gruppennamesRepository->update($thisversion);
		}
		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		$persistenceManager->persistAll();
		$this->gruppennamesRepository->setDisplay($langversions,$this->produktenamesRepository);
	}
	
	/**
		*	action	loadlayout
		*
		*	@return	 void
	*/
	public function loadlayoutAction(){
		$args = $this->request->getArguments();		$id = $args['id'];		$thislayout = $this->customerlayoutRepository->findLayout((int)$id);				/*		$abspath = \MikelMade\Mminteractive\Utility\Tx_Mminteractive_Utility_Div::absPath();		$fp = fopen($abspath.'webseiten/debug.txt','w+');		fputs($fp,json_encode($thislayout));		fclose($fp);		*/				print json_encode($thislayout);
	}
	
	/**
		*	action	savelayout
		*
		*	@return	 void
	*/
	public function savelayoutAction(){
		$args = $this->request->getArguments();		$id = $args['id'];		$thislayout = $this->customerlayoutRepository->findByUid((int)$id);		$thislayout->setTitle($args['title']);		$thislayout->setFont($args['font']);		$thislayout->setFontsize($args['fontsize']);		$thislayout->setFontcolor($args['fontcolor']);		$thislayout->setHeadlinecolor($args['headlinecolor']);		$thislayout->setBackgroundcolor($args['backgroundcolor']);		$thislayout->setLinkColorActive($args['linkcoloractive']);		$thislayout->setLinkColorInactive($args['linkcolorinactive']);		$thislayout->setLinkColorrollover($args['linkcolorrollover']);		$thislayout->setPicframe($args['picframe']);		$thislayout->setPicframecolor($args['picframecolor']);		$thislayout->setArrowcolor($args['arrowcolor']);		$thislayout->setHeadersize($args['headersize']);		$thislayout->setLinecolor($args['linecolor']);		$thislayout->setUpperedgeColor($args['upperedgecolor']);		$thislayout->setIconsColorActive($args['iconscoloractive']);		$thislayout->setIconsColorInactive($args['iconscolorinactive']);		$thislayout->setIconsColorRollover($args['iconscolorrollover']);		$this->customerlayoutRepository->update($thislayout);		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');		$persistenceManager->persistAll();
	}
	
	/**
		*	action	deletelayout
		*
		*	@return	 void
	*/
	public function deletelayoutAction(){
		$args = $this->request->getArguments();		$id = $args['id'];		$custid = $args['custid'];		$thislayout = $this->customerlayoutRepository->findByUid((int)$id);		$thislayout->setDeleted(1);		$this->customerlayoutRepository->update($thislayout);		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');		$persistenceManager->persistAll();		$data = $this->customerlayoutRepository->findLayouts((int)$custid);		print json_encode($data);
	}
	
	/**
		*	action	addlayout
		*
		*	@return	 integer
	*/
	public function addvorlageAction(){
		$args = $this->request->getArguments();		$custid = $args['custid'];		$thislayout = new MikelMade\Mminteractive\Domain\Model\Customerlayout();		$thislayout->setCustomerid($custid);		$thislayout->setTitle($args['title']);		$thislayout->setFont($args['font']);		$thislayout->setFontsize($args['fontsize']);		$thislayout->setFontcolor($args['fontcolor']);		$thislayout->setHeadlinecolor($args['headlinecolor']);		$thislayout->setBackgroundcolor($args['backgroundcolor']);		$thislayout->setLinkColorActive($args['linkcoloractive']);		$thislayout->setLinkColorInactive($args['linkcolorinactive']);		$thislayout->setLinkColorrollover($args['linkcolorrollover']);		$thislayout->setPicframe($args['picframe']);		$thislayout->setPicframecolor($args['picframecolor']);		$thislayout->setArrowcolor($args['arrowcolor']);		$thislayout->setHeadersize($args['headersize']);		$thislayout->setLinecolor($args['linecolor']);		$thislayout->setUpperedgeColor($args['upperedgecolor']);		$thislayout->setIconsColorActive($args['iconscoloractive']);		$thislayout->setIconsColorInactive($args['iconscolorinactive']);		$thislayout->setIconsColorRollover($args['iconscolorrollover']);		$this->customerlayoutRepository->add($thislayout);		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');		$persistenceManager->persistAll();		$data = array('layoutid'=>$thislayout->getUid(),'layouts'=>$this->customerlayoutRepository->findLayouts((int)$custid));		print json_encode($data);
	}
}
?>