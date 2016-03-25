<?php
namespace MikelMade\Mminteractive\ViewHelpers\Be\Map;

/**
 * Loads css and javascript files in the backend.
 *
 * @author Michael Perlbach <info@mikelmade.de>
 */
class ResourceViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Be\AbstractBackendViewHelper
{
    public function render()
    {
        $doc = $this->getDocInstance();
        $pageRenderer = $doc->getPageRenderer();
        $extRelPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath("mminteractive");

        $pageRenderer->addCssFile($extRelPath . "Resources/Public/Css/mm_icons.css");
        $pageRenderer->addCssFile($extRelPath . "Resources/Public/Css/styles.css");
        $pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/jquery.js");
        $pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/common.js");
        
        $output = $this->renderChildren();
        $output = $doc->startPage("title") . $output;
        $output .= $doc->endPage();
        return $output;
    }
}


?>