<?php

 /**
		* Loads css and javascript files in the backend.
		*
		* @author Michael Perlbach <info@mikelmade.de>
	*/
class Tx_Mminteractive_ViewHelpers_Be_Map_ResourceViewHelper extends	\TYPO3\CMS\Fluid\ViewHelpers\Be\AbstractBackendViewHelper {
		public function render() {
				$doc = $this->getDocInstance();
				$pageRenderer = $doc->getPageRenderer();
				$extRelPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath("mminteractive");
						
				$pageRenderer->addCssFile($extRelPath . "Resources/Public/Css/mm_icons.css");
				$pageRenderer->addCssFile($extRelPath . "Resources/Public/Css/styles.css");
				$pageRenderer->addCssFile($extRelPath . "Resources/Public/Css/customer.css");
				$pageRenderer->addCssFile($extRelPath . "Resources/Public/Js/pikaday/css/pikaday.css");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/jquery.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/common.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/jquery.caret.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/farbtastic.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/customer.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/jquery.nicescroll.min.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/SimpleAjaxUploader.min.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/jquery.cookie.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/jquery.json.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/moment.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/pikaday/pikaday.js");
				$pageRenderer->addJsFile($extRelPath . "Resources/Public/Js/pikaday/plugins/pikaday.jquery.js");

				$output = $this->renderChildren();
				$output = $doc->startPage("title") . $output;
				$output .= $doc->endPage();

				return $output;
		}
}



?>