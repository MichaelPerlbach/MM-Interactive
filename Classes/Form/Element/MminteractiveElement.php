<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 12.03.2016
 * Time: 14:53
 */

namespace MikelMade\Mminteractive\Form\Element;


use TYPO3\CMS\Backend\Form\Element\AbstractFormElement;
use TYPO3\CMS\Backend\Routing\UriBuilder;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Utility\ArrayUtility;

/**
 * Class MminteractiveElement
 * @package MikelMade\Mminteractive\Form\Element
 */
class MminteractiveElement extends AbstractFormElement
{

    /**
     * Default element configuration
     *
     * @var array
     */
    protected $defaultConfig = array(
        'file_field' => 'uid_local'
    );

    /**
     * This will render an imageManipulation field
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render()
    {
        $resultArray = $this->initializeResultArray();
        $languageService = $this->getLanguageService();

        $row = $this->data['databaseRow'];
        $parameterArray = $this->data['parameterArray'];
        $config = ArrayUtility::arrayMergeRecursiveOverrule($this->defaultConfig,
            $parameterArray['fieldConf']['config']);

        $content = '';
        $content .= '<div class="media">';
        $inputField = '<input type="hidden" '
            . 'name="' . $parameterArray['itemFormElName'] . '" '
            . 'value="' . htmlspecialchars($parameterArray['itemFormElValue']) . '" />';

        $content .= $inputField;
        if ($this->data['command'] == "new") {
            $content .= "<p>Please save before editing!</p>";
        } else {
            $file = $this->getFile($row, $config['file_field']);
            if (!$file) {
                return $resultArray;
            }
            $content .= $this->getButton(htmlspecialchars($parameterArray['itemFormElValue']));
        }
        $content .= $this->getInfoTable();

        $content .= '</div>';
        $resultArray['html'] = $content;
        return $resultArray;
    }

    /**
     * Get file object
     *
     * @param array $row
     * @param string $fieldName
     * @return NULL|\TYPO3\CMS\Core\Resource\File
     */
    protected function getFile(array $row, $fieldName)
    {
        $file = null;
        $fileUid = !empty($row[$fieldName]) ? $row[$fieldName] : null;
        if (strpos($fileUid, 'sys_file_') === 0) {
            if (strpos($fileUid, '|')) {
                // @todo: uid_local is a group field that was resolved to table_uid|target - split here again
                // @todo: this will vanish if group fields are moved to array
                $fileUid = explode('|', $fileUid);
                $fileUid = $fileUid[0];
            }
            $fileUid = substr($fileUid, 9);
        }
        if (MathUtility::canBeInterpretedAsInteger($fileUid)) {
            try {
                $file = ResourceFactory::getInstance()->getFileObject($fileUid);
            } catch (FileDoesNotExistException $e) {
            } catch (\InvalidArgumentException $e) {
            }
        }
        return $file;
    }

    /**
     * @return string
     */
    private function getButton($mapUid)
    {
        $languageService = $this->getLanguageService();

        /** @var UriBuilder $routingUriBuilder */
        $routingUriBuilder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Backend\Routing\UriBuilder');
        $prefix = "tx_mminteractive_mminteractive_mminteractiveedit";
        $params = array(
            $prefix . '[sysfilereference]' => $this->data['vanillaUid'],
            $prefix . '[action]' => 'edit',
            $prefix . '[controller]' => 'Map'
        );
        if ($mapUid) {
            $map = [$prefix . '[map]' => $mapUid];
            array_push($params, $map);
        }
        $backendLink = $routingUriBuilder->buildUriFromModule('mminteractive_MminteractiveEdit', $params);

        $button = '<button class="btn btn-default">';

        $button .= /** @lang HTML */
            '<a href="' . $backendLink . '" >';
        $button .= '<span class="t3-icon fa fa-picture-o"></span>';
        $button .= $languageService->sL('LLL:EXT:mminteractive/Resources/Private/Language/locallang.xlf:tx_mminteractive_mminteractive_element.buttontext',
            true);
        $button .= '</a>';
        $button .= '</button>';

        return $button;
    }

    /**
     * @return string
     */
    private function getInfoTable()
    {
        $content = '<div class="table-fit-block table-spacer-wrap"></div>';
        $content .= "<p>TODO</p>";
        return $content;
    }
}