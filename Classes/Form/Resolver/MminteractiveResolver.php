<?php
/**
 * Created by PhpStorm.
 * User: Lukas
 * Date: 12.03.2016
 * Time: 14:38
 */

namespace MikelMade\Mminteractive\Form\Resolver;


use TYPO3\CMS\Backend\Form\NodeFactory;
use TYPO3\CMS\Backend\Form\NodeResolverInterface;

class MminteractiveResolver implements NodeResolverInterface
{
    public function __construct(\TYPO3\CMS\Backend\Form\NodeFactory $nodeFactory, array $data)
    {

    }


    public function resolve()
    {
        // TODO: Implement resolve() method.
        return \MikelMade\Mminteractive\Form\Element\MminteractiveElement::class;
    }

}