<?php
namespace MikelMade\Mminteractive\Domain\Model;

    /***************************************************************
     *  Copyright notice
     *
     *  (c) 2016 MikelMade (http://www.mikelmade.de)
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
 *
 *
 * @package mminteractive
 *
 */
class Area extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * uid
     *
     * @lazy
     * @var \integer
     */
    protected $uid;

    /**
     * mapid
     *
     * @lazy
     * @var \integer
     */
protected mapid;

    /**
     * title
     *
     * @lazy
     * @var \string
     */
    protected $title;

    /**
     * url
     *
     * @lazy
     * @var \string
     */
    protected $url;

    /**
     * params
     *
     * @lazy
     * @var \string
     */
    protected $params;

    /**
     * alt
     *
     * @lazy
     * @var \string
     */
    protected $alt;

    /**
     * event
     *
     * @lazy
     * @var \integer
     */
    protected $event;

    /**
     * shape
     *
     * @lazy
     * @var \integer
     */
    protected $shape;

    /**
     * backgroundcolor
     *
     * @lazy
     * @var \string
     */
    protected $backgroundcolor;

    /**
     * backgroundimage
     *
     * @lazy
     * @var \string
     */
    protected $backgroundimage;

    /**
     * bgimageix
     *
     * @lazy
     * @var \integer
     */
    protected $bgimageix;

    /**
     * bgimageiy
     *
     * @lazy
     * @var \integer
     */
    protected $bgimageiy;

    /**
     * bgcoloropacity
     *
     * @lazy
     * @var \integer
     */
    protected $bgcoloropacity;

    /**
     * bgimageopacity
     *
     * @lazy
     * @var \integer
     */
    protected $bgimageopacity;

    /**
     * Returns the uid
     *
     * @return \integer $uid
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Returns the mapid
     *
     * @return \integer $mapid
     */
    public function getMapid()
    {
        return $this->mapid;
    }

    /**
     * Sets the mapid
     *
     * @param \integer $mapid
     * @return void
     */
    public function setMapid($mapid)
    {
        $this->mapid = $mapid;
    }

    /**
     * Returns the title
     *
     * @return \string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param \string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the url
     *
     * @return \string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the url
     *
     * @param \string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Returns the params
     *
     * @return \string $params
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Sets the params
     *
     * @param \string $params
     * @return void
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * Returns the alt
     *
     * @return \string $alt
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Sets the alt
     *
     * @param \string $alt
     * @return void
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    /**
     * Returns the event
     *
     * @return \integer $event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Sets the event
     *
     * @param \integer $event
     * @return void
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * Returns the shape
     *
     * @return \integer $shape
     */
    public function getshape()
    {
        return $this->shape;
    }

    /**
     * Sets the shape
     *
     * @param \integer $shape
     * @return void
     */
    public function setshape($shape)
    {
        $this->shape = $shape;
    }

    /**
     * Returns the backgroundcolor
     *
     * @return \integer $backgroundcolor
     */
    public function getBackgroundcolor()
    {
        return $this->backgroundcolor;
    }

    /**
     * Sets the backgroundcolor
     *
     * @param \integer $backgroundcolor
     * @return void
     */
    public function setBackgroundcolor($backgroundcolor)
    {
        $this->backgroundcolor = $backgroundcolor;
    }

    /**
     * Returns the backgroundimage
     *
     * @return \string $backgroundimage
     */
    public function getBackgroundimage()
    {
        return $this->backgroundimage;
    }

    /**
     * Sets the backgroundimage
     *
     * @param \string $backgroundimage
     * @return void
     */
    public function setBackgroundimage($backgroundimage)
    {
        $this->backgroundimage = $backgroundimage;
    }

    /**
     * Returns the bgimageix
     *
     * @return \integer $bgimageix
     */
    public function getBgimageix()
    {
        return $this->bgimageix;
    }

    /**
     * Sets the bgimageix
     *
     * @param \integer $bgimageix
     * @return void
     */
    public function setBgimageiy($bgimageix)
    {
        $this->bgimageix = $bgimageix;
    }

    /**
     * Returns the bgimageiy
     *
     * @return \string $bgimageiy
     */
    public function getBgimageiy()
    {
        return $this->bgimageiy;
    }

    /**
     * Sets the bgimageiy
     *
     * @param \string $bgimageiy
     * @return void
     */
    public function setBgimageiy($bgimageiy)
    {
        $this->bgimageiy = $bgimageiy;
    }

    /**
     * Returns the bgcoloropacity
     *
     * @return \integer $bgcoloropacity
     */
    public function getBgcoloropacity()
    {
        return $this->bgcoloropacity;
    }

    /**
     * Sets the bgcoloropacity
     *
     * @param \integer $bgcoloropacity
     * @return void
     */
    public function setBgcoloropacity($bgcoloropacity)
    {
        $this->bgcoloropacity = $bgcoloropacity;
    }

    /**
     * Returns the bgimageopacity
     *
     * @return \integer $bgimageopacity
     */
    public function getBgimageopacity()
    {
        return $this->bgimageopacity;
    }

    /**
     * Sets the bgimageopacity
     *
     * @param \integer $bgimageopacity
     * @return void
     */
    public function setBgimageopacity($bgimageopacity)
    {
        $this->bgimageopacity = $bgimageopacity;
    }
}