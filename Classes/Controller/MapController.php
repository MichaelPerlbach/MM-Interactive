<?php
namespace MikelMade\Mminteractive\Controller;

/***************************************************************
 *    Copyright notice
 *
 *    (c) 2016 MikelMade (www.mikelmade.de)
 *    All rights reserved
 *
 *    This script is part of the TYPO3 project. The TYPO3 project is
 *    free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The GNU General Public License can be found at
 *    http://www.gnu.org/copyleft/gpl.html.
 *
 *    This script is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.    See the
 *    GNU General Public License for more details.
 *
 *    This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use MikelMade\Mminteractive\Domain\Model\Map;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 *
 *
 * @package    mminteractive
 * @license    http://www.gnu.org/licenses/gpl.html	GNU	General	Public	License,	version	3	or	later
 *
 */
class MapController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @var    \MikelMade\Mminteractive\Domain\Repository\MapRepository
     * @inject
     */
    protected $mapRepository;


    public function initializeSettings()
    {

    }

    /**
     *    action    list
     *
     * @return     void
     */
    public function listAction()
    {
        
    }

    /**
     * action edit
     *
     * @param \MikelMade\Mminteractive\Domain\Model\Map $map
     * @param int $sysfilereference
     */
    public function editAction(
        \MikelMade\Mminteractive\Domain\Model\Map $map = null,
        $sysfilereference = null
    ) {
        if(empty($map) && empty($sysfilereference)){
            $this->view->assign('status','nothing to do');
        }
        if (empty($map) && $sysfilereference > 0) {
            $mminteractiveId = $this->checkForReference($sysfilereference);
            if($mminteractiveId > 0){
                $map = $this->mapRepository->findByUid($mminteractiveId);
            }else{
                /** @var Map $map */
                $map = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('MikelMade\\Mminteractive\\Domain\\Model\\Map');
                $map->setImage($sysfilereference);
                $this->mapRepository->add($map);

                /** @var PersistenceManager $persistenceManager */
                $persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
                $persistenceManager->persistAll();

                $this->getDatabase()->exec_UPDATEquery('sys_file_reference', 'uid=' . $sysfilereference,
                    array('mminteractive' => $map->getUid()));
            }
        }
        $this->view->assign('map', $map);
    }

    /**
     * @param \MikelMade\Mminteractive\Domain\Model\Map $map
     * @param array $data
     */
    public function addAreaAction(\MikelMade\Mminteractive\Domain\Model\Map $map = null, array $data = null){
        $this->addFlashMessage(__FUNCTION__, __CLASS__);
        $this->redirect('edit');
    }

    /**
     * action addEvent
     *
     * @param \MikelMade\Mminteractive\Domain\Model\Map $map
     * @param array $data
     */
    public function addEventAction(\MikelMade\Mminteractive\Domain\Model\Map $map = null, array $data = null)
    {
        $this->addFlashMessage(__FUNCTION__, __CLASS__);
        $this->redirect('edit');
    }

    /**
     * action addAreaPoint
     *
     * @param \MikelMade\Mminteractive\Domain\Model\Area $area
     * @param array $data
     */
    public function addAreaPointAction(\MikelMade\Mminteractive\Domain\Model\Area $area = null, array $data = null)
    {
        $this->addFlashMessage(__FUNCTION__, __CLASS__);
        $this->redirect('edit');
    }

    /**
     * @return DatabaseConnection
     */
    protected function getDatabase()
    {
        return $GLOBALS['TYPO3_DB'];
    }

    /**
     * @param int $id
     * @return int
     */
    private function checkForReference($id)
    {
        /** @var FileRepository $fileRepository */
        $fileRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
        $sysfilereference = $fileRepository->findFileReferenceByUid($id);
        if($sysfilereference->hasProperty('mminteractive')){
            if($sysfilereference->getProperty('mminteractive') > 0){
                return $sysfilereference->getProperty('mminteractive');
            }
        }
        return 0;
    }
}

?>