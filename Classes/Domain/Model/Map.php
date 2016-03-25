<?php
namespace MikelMade\Mminteractive\Domain\Model;

    /***************************************************************
     *
     *  Copyright notice
     *
     *  (c) 2016
     *
     *  All rights reserved
     *
     *  This script is part of the TYPO3 project. The TYPO3 project is
     *  free software; you can redistribute it and/or modify
     *  it under the terms of the GNU General Public License as published by
     *  the Free Software Foundation; either version 3 of the License, or
     *  (at your option) any later version.
     *
     *  The GNU General Public License can be found at
     *  http://www.gnu.org/copyleft/gpl.html.
     *
     *  This script is distributed in the hope that it will be useful,
     *  but WITHOUT ANY WARRANTY; without even the implied warranty of
     *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *  GNU General Public License for more details.
     *
     *  This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/

/**
 * Class Map
 * @package MikelMade\Mminteractive\Domain\Model
 */
class Map extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * areas
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MikelMade\Mminteractive\Domain\Model\Area>
     * @cascade remove
     */
    protected $areas = null;

    /**
     * @var int
     */
    protected $image = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->areas = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return int
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param int $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Adds a Area
     *
     * @param \MikelMade\Mminteractive\Domain\Model\Area $area
     * @return void
     */
    public function addArea(\MikelMade\Mminteractive\Domain\Model\Area $area)
    {
        $this->areas->attach($area);
    }

    /**
     * Removes a Area
     *
     * @param \MikelMade\Mminteractive\Domain\Model\Area $areaToRemove The Area to be removed
     * @return void
     */
    public function removeArea(\MikelMade\Mminteractive\Domain\Model\Area $areaToRemove)
    {
        $this->areas->detach($areaToRemove);
    }

    /**
     * Returns the areas
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MikelMade\Mminteractive\Domain\Model\Area> $areas
     */
    public function getAreas()
    {
        return $this->areas;
    }

    /**
     * Sets the areas
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MikelMade\Mminteractive\Domain\Model\Area> $areas
     * @return void
     */
    public function setAreas(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $areas)
    {
        $this->areas = $areas;
    }

}