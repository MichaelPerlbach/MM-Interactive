<?php
/**
 * TCA for the database fields.
 *
 * @author Michael Perlbach <info@mikelmade.de>
 */

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$TCA['tx_mminteractive_domain_model_map'] = array(
    'columns' => array(
        'uid' => array(),
        'pid' => array(),
        'title' => array(),
        'image' => array()
    )
);

$TCA['tx_mminteractive_domain_model_area'] = array(
    'columns' => array(
        'uid' => array(),
        'pid' => array(),
        'mapid' => array(),
        'title' => array(),
        'url' => array(),
        'params' => array(),
        'alt' => array(),
        'shape' => array()
    )
);

$TCA['tx_mminteractive_domain_model_areapoint'] = array(
    'columns' => array(
        'uid' => array(),
        'pid' => array(),
        'areaid' => array(),
        'x' => array(),
        'y' => array(),
        'sorting' => array()
    )
);

$TCA['tx_mminteractive_domain_model_event'] = array(
    'columns' => array(
        'uid' => array(),
        'pid' => array(),
        'title' => array()
    )
);

$TCA['tx_mminteractive_domain_model_action'] = array(
    'columns' => array(
        'uid' => array(),
        'pid' => array(),
        'eventid' => array(),
        'areaid' => array(),
        'bgcolor' => array(),
        'bgimage' => array(),
        'bgimageix' => array(),
        'bgimageiy' => array(),
        'bgcoloropacity' => array(),
        'bgimageopacity' => array(),
        'bgimageoverbgcolor' => array(),
        'popuptype' => array(),
        'popuptitle' => array(),
        'popupwidth' => array(),
        'popupheight' => array(),
        'popupx' => array(),
        'popupy' => array(),
        'popupborderstyle' => array(),
        'popupborderwidth' => array(),
        'popupbordercolor' => array(),
        'popupcontentid' => array(),
        'popuphtml' => array(),
        'bordercolor' => array(),
        'borderstyle' => array(),
        'borderwidth' => array()
    )
);

$TCA['tx_mminteractive_domain_model_mapcache'] = array(
    'columns' => array(
        'uid' => array(),
        'pid' => array(),
        'mapid' => array(),
        'cache' => array(),
        'lastchanged' => array()
    )
);
