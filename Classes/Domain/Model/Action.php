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
class Action extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * uid
     *
     * @lazy
     * @var \integer
     */
    protected $uid;

    /**
     * title
     *
     * @lazy
     * @var \string
     */
    protected $title;

    /**
     * eventid
     *
     * @lazy
     * @var \integer
     */
    protected $eventid;

    /**
     * areaid
     *
     * @lazy
     * @var \integer
     */
    protected $areaid;

    /**
     * bgcolor
     *
     * @lazy
     * @var \string
     */
    protected $bgcolor;

    /**
     * bgimage
     *
     * @lazy
     * @var \string
     */
    protected $bgimage;

    /**
     * bgimagex
     *
     * @lazy
     * @var \integer
     */
    protected $bgimagex;

    /**
     * bgimagey
     *
     * @lazy
     * @var \integer
     */
    protected $bgimagey;

    /**
     * bgcoloropacity
     *
     * @lazy
     * @var \string
     */
    protected $bgcoloropacity;

    /**
     * bgimageopacity
     *
     * @lazy
     * @var \string
     */
    protected $bgimageopacity;

    /**
     * bgimageoverbgcolor
     *
     * @lazy
     * @var \integer
     */
    protected $bgimageoverbgcolor;

    /**
     * popuptype
     *
     * @lazy
     * @var \integer
     */
    protected $popuptype;

    /**
     * popuptitle
     *
     * @lazy
     * @var \string
     */
    protected $popuptitle;

    /**
     * popupwidth
     *
     * @lazy
     * @var \integer
     */
    protected $popupwidth;

    /**
     * popupheight
     *
     * @lazy
     * @var \integer
     */
    protected $popupheight;

    /**
     * popupx
     *
     * @lazy
     * @var \integer
     */
    protected $popupx;

    /**
     * popupy
     *
     * @lazy
     * @var \integer
     */
    protected $popupy;

    /**
     * popupborderstyle
     *
     * @lazy
     * @var \integer
     */
    protected $popupborderstyle;

    /**
     * popupborderwidth
     *
     * @lazy
     * @var \integer
     */
    protected $popupborderwidth;

    /**
     * popupbordercolor
     *
     * @lazy
     * @var \string
     */
    protected $popupbordercolor;

    /**
     * popupcontentid
     *
     * @lazy
     * @var \integer
     */
    protected $popupcontentid;

    /**
     * popuphtml
     *
     * @lazy
     * @var \integer
     */
    protected $popuphtml;

    /**
     * bordercolor
     *
     * @lazy
     * @var \string
     */
    protected $bordercolor;

    /**
     * borderstyle
     *
     * @lazy
     * @var \string
     */
    protected $borderstyle;

    /**
     * borderwidth
     *
     * @lazy
     * @var \string
     */
    protected $borderwidth;


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
     * Returns the eventid
     *
     * @return \integer $eventid
     */
    public function getEventid()
    {
        return $this->eventid;
    }

    /**
     * Sets the eventid
     *
     * @param \integer $eventid
     * @return void
     */
    public function setEventid($eventid)
    {
        $this->eventid = $eventid;
    }

    /**
     * Returns the areaid
     *
     * @return \integer $areaid
     */
    public function getAreaid()
    {
        return $this->areaid;
    }

    /**
     * Sets the areaid
     *
     * @param \integer $areaid
     * @return void
     */
    public function setAreaid($areaid)
    {
        $this->areaid = $areaid;
    }

    /**
     * Returns the bgcolor
     *
     * @return \integer $bgcolor
     */
    public function getBgcolor()
    {
        return $this->bgcolor;
    }

    /**
     * Sets the bgcolor
     *
     * @param \integer $bgcolor
     * @return void
     */
    public function setBgcolor($bgcolor)
    {
        $this->bgcolor = $bgcolor;
    }

    /**
     * Returns the bgimage
     *
     * @return \integer $bgimage
     */
    public function getBgimage()
    {
        return $this->bgimage;
    }

    /**
     * Sets the bgimage
     *
     * @param \integer $bgimage
     * @return void
     */
    public function setBgimage($bgimage)
    {
        $this->bgimage = $bgimage;
    }

    /**
     * Returns the bgimagex
     *
     * @return \integer $bgimagex
     */
    public function getBgimagex()
    {
        return $this->bgimagex;
    }

    /**
     * Sets the bgimagex
     *
     * @param \integer $bgimagex
     * @return void
     */
    public function setBgimagex($bgimagex)
    {
        $this->bgimagex = $bgimagex;
    }

    /**
     * Returns the bgimagey
     *
     * @return \integer $bgimagey
     */
    public function getBgimagey()
    {
        return $this->bgimagey;
    }

    /**
     * Sets the bgimagey
     *
     * @param \integer $bgimagey
     * @return void
     */
    public function setBgimagey($bgimagey)
    {
        $this->bgimagey = $bgimagey;
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

    /**
     * Returns the bgimageoverbgcolor
     *
     * @return \integer $bgimageoverbgcolor
     */
    public function getBgimageoverbgcolor()
    {
        return $this->bgimageoverbgcolor;
    }

    /**
     * Sets the bgimageoverbgcolor
     *
     * @param \integer $bgimageoverbgcolor
     * @return void
     */
    public function setBgimageoverbgcolor($bgimageoverbgcolor)
    {
        $this->bgimageoverbgcolor = $bgimageoverbgcolor;
    }

    /**
     * Returns the popuptype
     *
     * @return \integer $popuptype
     */
    public function getPopuptype()
    {
        return $this->popuptype;
    }

    /**
     * Sets the popuptype
     *
     * @param \integer $popuptype
     * @return void
     */
    public function setPopuptype($popuptype)
    {
        $this->popuptype = $popuptype;
    }

    /**
     * Returns the popuptitle
     *
     * @return \integer $popuptitle
     */
    public function getPopuptitle()
    {
        return $this->popuptitle;
    }

    /**
     * Sets the popuptitle
     *
     * @param \integer $popuptitle
     * @return void
     */
    public function setPopuptitle($popuptitle)
    {
        $this->popuptitle = $popuptitle;
    }

    /**
     * Returns the popupwidth
     *
     * @return \integer $popupwidth
     */
    public function getPopupwidth()
    {
        return $this->popupwidth;
    }

    /**
     * Sets the popupwidth
     *
     * @param \integer $popupwidth
     * @return void
     */
    public function setPopupwidth($popupwidth)
    {
        $this->popupwidth = $popupwidth;
    }

    /**
     * Returns the popupheight
     *
     * @return \integer $popupheight
     */
    public function getPopupheight()
    {
        return $this->popupheight;
    }

    /**
     * Sets the popupheight
     *
     * @param \integer $popupheight
     * @return void
     */
    public function setPopupheight($popupheight)
    {
        $this->popupheight = $popupheight;
    }

    /**
     * Returns the popupx
     *
     * @return \integer $popupx
     */
    public function getPopupx()
    {
        return $this->popupx;
    }

    /**
     * Sets the popupx
     *
     * @param \integer $popupx
     * @return void
     */
    public function setPopupx($popupx)
    {
        $this->popupx = $popupx;
    }

    /**
     * Returns the popupy
     *
     * @return \integer $ppopupy
     */
    public function getPopupy()
    {
        return $this->popupy;
    }

    /**
     * Sets the popupy
     *
     * @param \integer $popupy
     * @return void
     */
    public function setPopupy($popupy)
    {
        $this->popupy = $popupy;
    }

    /**
     * Returns the popupborderstyle
     *
     * @return \integer $popupborderstyle
     */
    public function getPopupborderstyle()
    {
        return $this->popupborderstyle;
    }

    /**
     * Sets the popupborderstyle
     *
     * @param \integer $popupborderstyle
     * @return void
     */
    public function setPopupborderstyle($popupborderstyle)
    {
        $this->popupborderstyle = $popupborderstyle;
    }

    /**
     * Returns the popupborderwidth
     *
     * @return \integer $popupborderwidth
     */
    public function getPopupborderwidth()
    {
        return $this->popupborderwidth;
    }

    /**
     * Sets the popupborderwidth
     *
     * @param \integer $popupborderwidth
     * @return void
     */
    public function setPopupborderwidth($popupborderwidth)
    {
        $this->popupborderwidth = $popupborderwidth;
    }

    /**
     * Returns the popupbordercolor
     *
     * @return \integer $popupbordercolor
     */
    public function getPopupbordercolor()
    {
        return $this->popupbordercolor;
    }

    /**
     * Sets the popupbordercolor
     *
     * @param \integer $popupbordercolor
     * @return void
     */
    public function setPopupbordercolor($popupbordercolor)
    {
        $this->popupbordercolor = $popupbordercolor;
    }

    /**
     * Returns the popupcontentid
     *
     * @return \integer $popupcontentid
     */
    public function getPopupcontentid()
    {
        return $this->popupcontentid;
    }

    /**
     * Sets the popupcontentid
     *
     * @param \integer $popupcontentid
     * @return void
     */
    public function setPopupcontentid($popupcontentid)
    {
        $this->popupcontentid = $popupcontentid;
    }

    /**
     * Returns the popuphtml
     *
     * @return \integer $popuphtml
     */
    public function getPopuphtml()
    {
        return $this->popuphtml;
    }

    /**
     * Sets the popuphtml
     *
     * @param \integer $popuphtml
     * @return void
     */
    public function setPopuphtml($popuphtml)
    {
        $this->popuphtml = $popuphtml;
    }

    /**
     * Returns the bordercolor
     *
     * @return \integer $bordercolor
     */
    public function getBordercolor()
    {
        return $this->bordercolor;
    }

    /**
     * Sets the bordercolor
     *
     * @param \integer $bordercolor
     * @return void
     */
    public function setBordercolor($bordercolor)
    {
        $this->bordercolor = $bordercolor;
    }

    /**
     * Returns the borderstyle
     *
     * @return \integer $borderstyle
     */
    public function getBorderstyle()
    {
        return $this->borderstyle;
    }

    /**
     * Sets the borderstyle
     *
     * @param \integer $borderstyle
     * @return void
     */
    public function setBorderstyle($borderstyle)
    {
        $this->borderstyle = $borderstyle;
    }

    /**
     * Returns the borderwidth
     *
     * @return \integer $borderwidth
     */
    public function getBorderwidth()
    {
        return $this->borderwidth;
    }

    /**
     * Sets the borderwidth
     *
     * @param \integer $borderwidth
     * @return void
     */
    public function setBorderwidth($borderwidth)
    {
        $this->borderwidth = $borderwidth;
    }
}