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
 * Area
 */
class Area extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    protected $title = '';
    
    /**
     * url
     *
     * @var string
     */
    protected $url = '';
    
    /**
     * params
     *
     * @var string
     */
    protected $params = '';
    
    /**
     * alt
     *
     * @var string
     */
    protected $alt = '';

    /**
     * bgcolor
     *
     * @var string
     */
    protected $bgcolor;
    /**
     * bgimage
     *
     * @var string
     */
    protected $bgimage;
    /**
     * bgimageix
     *
     * @var string
     */
    protected $bgimageix;
    /**
     * bgimageiy
     *
     * @var string
     */
    protected $bgimageiy;
    /**
     * bgcoloropacity
     *
     * @var string
     */
    protected $bgcoloropacity;
    /**
     * bgimageopacity
     *
     * @var string
     */
    protected $bgimageopacity;
    /**
     * bgimageoverbgcolor
     *
     * @var string
     */
    protected $bgimageoverbgcolor;
    /**
     * popuptype
     *
     * @var string
     */
    protected $popuptype;
    /**
     * popuptitle
     *
     * @var string
     */
    protected $popuptitle;
    /**
     * popupwidth
     *
     * @var string
     */
    protected $popupwidth;
    /**
     * popupheight
     *
     * @var string
     */
    protected $popupheight;
    /**
     * popupx
     *
     * @var string
     */
    protected $popupx;
    /**
     * popupy
     *
     * @var string
     */
    protected $popupy;
    /**
     * popupborderstyle
     *
     * @var string
     */
    protected $popupborderstyle;
    /**
     * popupborderwidth
     *
     * @var string
     */
    protected $popupborderwidth;
    /**
     * popupbordercolor
     *
     * @var string
     */
    protected $popupbordercolor;
    /**
     * popupcontentid
     *
     * @var string
     */
    protected $popupcontentid;
    /**
     * popuphtml
     *
     * @var string
     */
    protected $popuphtml;
    /**
     * bordercolor
     *
     * @var string
     */
    protected $bordercolor;
    /**
     * borderstyle
     *
     * @var string
     */
    protected $borderstyle;
    /**
     * borderwidth
     *
     * @var string
     */
    protected $borderwidth;
    
    /**
     * areapoints
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MikelMade\Mminteractive\Domain\Model\Areapoint>
     * @cascade remove
     */
    protected $areapoints = null;
    
    /**
     * event
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MikelMade\Mminteractive\Domain\Model\Event>
     * @cascade remove
     */
    protected $event = null;
    
    /**
     * method
     *
     * @var \MikelMade\Mminteractive\Domain\Model\Method
     */
    protected $method = null;
    
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
        $this->areapoints = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->event = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns the url
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    /**
     * Sets the url
     *
     * @param string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    /**
     * Returns the params
     *
     * @return string $params
     */
    public function getParams()
    {
        return $this->params;
    }
    
    /**
     * Sets the params
     *
     * @param string $params
     * @return void
     */
    public function setParams($params)
    {
        $this->params = $params;
    }
    
    /**
     * Returns the alt
     *
     * @return string $alt
     */
    public function getAlt()
    {
        return $this->alt;
    }
    
    /**
     * Sets the alt
     *
     * @param string $alt
     * @return void
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    /**
     * @return string
     */
    public function getBgcolor()
    {
        return $this->bgcolor;
    }

    /**
     * @param string $bgcolor
     */
    public function setBgcolor($bgcolor)
    {
        $this->bgcolor = $bgcolor;
    }

    /**
     * @return string
     */
    public function getBgimage()
    {
        return $this->bgimage;
    }

    /**
     * @param string $bgimage
     */
    public function setBgimage($bgimage)
    {
        $this->bgimage = $bgimage;
    }

    /**
     * @return string
     */
    public function getBgimageix()
    {
        return $this->bgimageix;
    }

    /**
     * @param string $bgimageix
     */
    public function setBgimageix($bgimageix)
    {
        $this->bgimageix = $bgimageix;
    }

    /**
     * @return string
     */
    public function getBgimageiy()
    {
        return $this->bgimageiy;
    }

    /**
     * @param string $bgimageiy
     */
    public function setBgimageiy($bgimageiy)
    {
        $this->bgimageiy = $bgimageiy;
    }

    /**
     * @return string
     */
    public function getBgcoloropacity()
    {
        return $this->bgcoloropacity;
    }

    /**
     * @param string $bgcoloropacity
     */
    public function setBgcoloropacity($bgcoloropacity)
    {
        $this->bgcoloropacity = $bgcoloropacity;
    }

    /**
     * @return string
     */
    public function getBgimageopacity()
    {
        return $this->bgimageopacity;
    }

    /**
     * @param string $bgimageopacity
     */
    public function setBgimageopacity($bgimageopacity)
    {
        $this->bgimageopacity = $bgimageopacity;
    }

    /**
     * @return string
     */
    public function getBgimageoverbgcolor()
    {
        return $this->bgimageoverbgcolor;
    }

    /**
     * @param string $bgimageoverbgcolor
     */
    public function setBgimageoverbgcolor($bgimageoverbgcolor)
    {
        $this->bgimageoverbgcolor = $bgimageoverbgcolor;
    }

    /**
     * @return string
     */
    public function getPopuptype()
    {
        return $this->popuptype;
    }

    /**
     * @param string $popuptype
     */
    public function setPopuptype($popuptype)
    {
        $this->popuptype = $popuptype;
    }

    /**
     * @return string
     */
    public function getPopuptitle()
    {
        return $this->popuptitle;
    }

    /**
     * @param string $popuptitle
     */
    public function setPopuptitle($popuptitle)
    {
        $this->popuptitle = $popuptitle;
    }

    /**
     * @return string
     */
    public function getPopupwidth()
    {
        return $this->popupwidth;
    }

    /**
     * @param string $popupwidth
     */
    public function setPopupwidth($popupwidth)
    {
        $this->popupwidth = $popupwidth;
    }

    /**
     * @return string
     */
    public function getPopupheight()
    {
        return $this->popupheight;
    }

    /**
     * @param string $popupheight
     */
    public function setPopupheight($popupheight)
    {
        $this->popupheight = $popupheight;
    }

    /**
     * @return string
     */
    public function getPopupx()
    {
        return $this->popupx;
    }

    /**
     * @param string $popupx
     */
    public function setPopupx($popupx)
    {
        $this->popupx = $popupx;
    }

    /**
     * @return string
     */
    public function getPopupy()
    {
        return $this->popupy;
    }

    /**
     * @param string $popupy
     */
    public function setPopupy($popupy)
    {
        $this->popupy = $popupy;
    }

    /**
     * @return string
     */
    public function getPopupborderstyle()
    {
        return $this->popupborderstyle;
    }

    /**
     * @param string $popupborderstyle
     */
    public function setPopupborderstyle($popupborderstyle)
    {
        $this->popupborderstyle = $popupborderstyle;
    }

    /**
     * @return string
     */
    public function getPopupborderwidth()
    {
        return $this->popupborderwidth;
    }

    /**
     * @param string $popupborderwidth
     */
    public function setPopupborderwidth($popupborderwidth)
    {
        $this->popupborderwidth = $popupborderwidth;
    }

    /**
     * @return string
     */
    public function getPopupbordercolor()
    {
        return $this->popupbordercolor;
    }

    /**
     * @param string $popupbordercolor
     */
    public function setPopupbordercolor($popupbordercolor)
    {
        $this->popupbordercolor = $popupbordercolor;
    }

    /**
     * @return string
     */
    public function getPopupcontentid()
    {
        return $this->popupcontentid;
    }

    /**
     * @param string $popupcontentid
     */
    public function setPopupcontentid($popupcontentid)
    {
        $this->popupcontentid = $popupcontentid;
    }

    /**
     * @return string
     */
    public function getPopuphtml()
    {
        return $this->popuphtml;
    }

    /**
     * @param string $popuphtml
     */
    public function setPopuphtml($popuphtml)
    {
        $this->popuphtml = $popuphtml;
    }

    /**
     * @return string
     */
    public function getBordercolor()
    {
        return $this->bordercolor;
    }

    /**
     * @param string $bordercolor
     */
    public function setBordercolor($bordercolor)
    {
        $this->bordercolor = $bordercolor;
    }

    /**
     * @return string
     */
    public function getBorderstyle()
    {
        return $this->borderstyle;
    }

    /**
     * @param string $borderstyle
     */
    public function setBorderstyle($borderstyle)
    {
        $this->borderstyle = $borderstyle;
    }

    /**
     * @return string
     */
    public function getBorderwidth()
    {
        return $this->borderwidth;
    }

    /**
     * @param string $borderwidth
     */
    public function setBorderwidth($borderwidth)
    {
        $this->borderwidth = $borderwidth;
    }
    
    /**
     * Adds a Areapoint
     *
     * @param \MikelMade\Mminteractive\Domain\Model\Areapoint $areapoint
     * @return void
     */
    public function addAreapoint(\MikelMade\Mminteractive\Domain\Model\Areapoint $areapoint)
    {
        $this->areapoints->attach($areapoint);
    }
    
    /**
     * Removes a Areapoint
     *
     * @param \MikelMade\Mminteractive\Domain\Model\Areapoint $areapointToRemove The Areapoint to be removed
     * @return void
     */
    public function removeAreapoint(\MikelMade\Mminteractive\Domain\Model\Areapoint $areapointToRemove)
    {
        $this->areapoints->detach($areapointToRemove);
    }
    
    /**
     * Returns the areapoints
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MikelMade\Mminteractive\Domain\Model\Areapoint> $areapoints
     */
    public function getAreapoints()
    {
        return $this->areapoints;
    }
    
    /**
     * Sets the areapoints
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MikelMade\Mminteractive\Domain\Model\Areapoint> $areapoints
     * @return void
     */
    public function setAreapoints(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $areapoints)
    {
        $this->areapoints = $areapoints;
    }
    
    /**
     * Adds a Event
     *
     * @param \MikelMade\Mminteractive\Domain\Model\Event $event
     * @return void
     */
    public function addEvent(\MikelMade\Mminteractive\Domain\Model\Event $event)
    {
        $this->event->attach($event);
    }
    
    /**
     * Removes a Event
     *
     * @param \MikelMade\Mminteractive\Domain\Model\Event $eventToRemove The Event to be removed
     * @return void
     */
    public function removeEvent(\MikelMade\Mminteractive\Domain\Model\Event $eventToRemove)
    {
        $this->event->detach($eventToRemove);
    }
    
    /**
     * Returns the event
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MikelMade\Mminteractive\Domain\Model\Event> $event
     */
    public function getEvent()
    {
        return $this->event;
    }
    
    /**
     * Sets the event
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MikelMade\Mminteractive\Domain\Model\Event> $event
     * @return void
     */
    public function setEvent(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $event)
    {
        $this->event = $event;
    }
    
    /**
     * Returns the method
     *
     * @return \MikelMade\Mminteractive\Domain\Model\Method $method
     */
    public function getMethod()
    {
        return $this->method;
    }
    
    /**
     * Sets the method
     *
     * @param \MikelMade\Mminteractive\Domain\Model\Method $method
     * @return void
     */
    public function setMethod(\MikelMade\Mminteractive\Domain\Model\Method $method)
    {
        $this->method = $method;
    }

}