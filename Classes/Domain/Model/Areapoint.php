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
class Areapoint extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
		* uid
		*
		* @lazy
		* @var \integer
		*/
	protected $uid;
	
	/**
		* x
		*
		* @lazy
		* @var \integer
		*/
	protected $x;
	
	/**
		* @lazy
		* @var string $y
		*/
	protected $y;

	/**
		* @lazy
		* @var integer $sorting
		*/
	protected $sorting;
	
	/**
		* Returns the uid
		*
		* @return \integer uid
		*/
	public function getUid() {
		return $this->uid;
	}
	
	/**
		* Returns x
		*
		* @return \integer $x
		*/
	public function getX() {
		return $this->x;
	}

	/**
		* Sets the x
		*
		* @param \integer $x
		* @return void
		*/
	public function setX($x) {
		$this->x = $x;
	}
	
	/**
		* Returns the y
		*
		* @return string y
		*/
	public function getY() {
		return $this->y;
	}
	
	/**
		* Sets the y
		*
		*	@param string $y
		* @return void
		*/
	public function setY($y) {
		$this->y = $y;
	}

	/**
		* Returns the sorting
		*
		* @return integer $sorting
		*/
	public function getSorting() {
		return $this->sorting;
	}
	
	/**
		* Sets the sorting
		*
		*	@param string $sorting
		* @return void
		*/
	public function setSorting($sorting) {
		$this->sorting = $sorting;
	}
}
?>