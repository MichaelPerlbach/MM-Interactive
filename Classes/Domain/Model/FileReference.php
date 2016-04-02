<?php
/**
 * Created by PhpStorm.
 * User: Kozo
 * Date: 20.03.2016
 * Time: 00:18
 */

namespace MikelMade\Mminteractive\Domain\Model;


/**
 * Class FileReference
 * @package MikelMade\Mminteractive\Domain\Model
 */
class FileReference extends \TYPO3\CMS\Extbase\Domain\Model\FileReference
{
    /**
     * @var \MikelMade\Mminteractive\Domain\Model\Map $mminteractive
     */
    protected $mminteractive;

    /**
     * @return \MikelMade\Mminteractive\Domain\Model\Map $mminteractive
     */
    public function getMminteractive()
    {
        return $this->mminteractive;
    }

    /**
     * @param \MikelMade\Mminteractive\Domain\Model\Map $mminteractive
     */
    public function setMminteractive($mminteractive)
    {
        $this->mminteractive = $mminteractive;
    }

}