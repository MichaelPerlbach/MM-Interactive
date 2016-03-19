<?php
namespace MikelMade\Mminteractive\Controller;

    /***************************************************************
     *    Copyright notice
     *
     *    (c) 2016 MikelMade (www.mikelmade.de)
     *    All rights reserved
     *
     *    This script is part of the TYPO3 project. The TYPO3 project is
     *    free software; you can redistribute it and/or modify
     *    it under the terms of the GNU General Public License as published by
     *    the Free Software Foundation; either version 3 of the License, or
     *    (at your option) any later version.
     *
     *    The GNU General Public License can be found at
     *    http://www.gnu.org/copyleft/gpl.html.
     *
     *    This script is distributed in the hope that it will be useful,
     *    but WITHOUT ANY WARRANTY; without even the implied warranty of
     *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.    See the
     *    GNU General Public License for more details.
     *
     *    This copyright notice MUST APPEAR in all copies of the script!
     ***************************************************************/


/**
 *
 *
 * @package    mminteractive
 * @license    http://www.gnu.org/licenses/gpl.html	GNU	General	Public	License,	version	3	or	later
 *
 */
class    FrontendDisplayController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     *    mapRepository
     *
     * @var    \MikelMade\Mminteractive\Domain\Repository\MapRepository
     * @inject
     */
    protected $mapRepository;


    public function initializeSettings()
    {
        if (isset($this->settings['flexform']) && is_array($this->settings['flexform'])) {
            foreach ($this->settings['flexform'] as $key => $value) {
                if (isset($this->settings[$key]) && $value != '') {
                    $this->settings[$key] = $value;
                }
            }
        }
    }

    public function initializeAction()
    {
        $this->initializeSettings();
    }

    /**
     *    action    showajaxreturn
     *
     * @return     void
     */
    public function showajaxreturnAction()
    {
        $args = $_POST['arguments'];
        $customer = $GLOBALS['TSFE']->fe_user->user['uid'];
        $abspath = '/usr/home/argenv/';
        $persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
        $return = array();

        if ($args['do'] == 'changeaddress') {
            $address = new \MikelMade\Mminteractive\Domain\Model\Useraddress();
            $address->setUserid($customer);
            $address->setName1($args['name1']);
            $address->setName2($args['name2']);
            $address->setName3($args['name3']);
            $address->setStreet($args['street']);
            $address->setHousenumber($args['housenumber']);
            $address->setStreetsuffix($args['streetsuffix']);
            $address->setZip($args['zip']);
            $address->setCity($args['city']);
            $address->setCountry($args['country']);
            $this->useraddressRepository->add($address);
            $persistenceManager->persistAll();
            $newuid = $address->getUid();

            $order = $this->orderRepository->findByUid((int)$args['orderid']);
            $order->setDeliveryaddress($newuid);
            $this->orderRepository->update($order);
            $persistenceManager->persistAll();
            print 'done';
        }

        if ($args['do'] == 'createorder') {
            $thisorder = array();
            $thisorder['orderparts'] = array();
            $temppath = $abspath . 'public_html/orderdata/temp/new_' . $args['kennung'] . '/';
            $xtemppath = $abspath . 'public_html/orderdata/temp/new_' . $args['kennung'] . '/';
            $permpath = $abspath . 'public_html/orderdata/perm/';
            $actpath = $temppath . 'new_' . $args['kennung'];

            foreach ($args['files'] as $file) {
                $ext = pathinfo($xtemppath . $file, PATHINFO_EXTENSION);
                if ($ext == 'zip') {
                    copy($xtemppath . $file, $xtemppath . 'uz.zip');
                    mkdir($xtemppath . 'unzipped', 0777);
                    $handle = popen('unzip ' . $xtemppath . 'uz.zip -d ' . $xtemppath . 'unzipped 2>&1', 'r');
                    pclose($handle);
                    unlink($xtemppath . 'uz.zip');
                }
            }
            $shapedata = explode(',', $args['shapedata']);
            $realfiles = $this->getfiles($xtemppath, $shapedata);
            $realfiles = $this->uniqe_array($realfiles);

            if (count($realfiles) == 0) {
                print 'noshapes';
                exit;
            }
            $time = time();
            $date = date('YmdHi');

            $order = new \MikelMade\Mminteractive\Domain\Model\Order();
            $order->setOrdertitle('Bestellung erstellt am ' . date('d.m.Y - H:i:s'));
            $order->setCreated($time);
            $order->setCustomerid($customer);
            $order->setUploadedfiles(implode(',', $args['files']));

            $this->orderRepository->add($order);
            $persistenceManager->persistAll();
            $newuid = $order->getUid();
            $thisorder['uid'] = $newuid;
            $thisorder['ordertitle'] = $order->getOrdertitle();
            $thisorder['prodinit'] = $this->producttypeRepository->getProducttypes();

            $permpathpart = $date . '-' . $customer . '-' . $newuid;
            $permpathnoslash = $permpath . $permpathpart;
            $permpath = $permpath . $permpathpart . '/';
            $order->setUploaddir($permpathpart);
            $this->orderRepository->update($order);
            $persistenceManager->persistAll();

            foreach ($realfiles as $file) {
                $orderpart = new \MikelMade\Mminteractive\Domain\Model\Orderpart();
                $orderpart->setFile($file[0]);
                $orderpart->Setuploadtime($file[1]);
                $orderpart->setOrderid($newuid);
                $this->orderpartRepository->add($orderpart);
                $persistenceManager->persistAll();
                $thisorder['orderparts'][] = array(
                    'uid' => $orderpart->getUid(),
                    'file' => $orderpart->getFile()
                );
            }
            rename($temppath, $permpath);
            mkdir($permpath . 'download');
            if (is_dir($permpath . 'unzipped')) {
                $phandle = popen('rm -rf ' . $permpath . 'unzipped', 'r');
                pclose($phandle);
            }

            // Finally, zip all files for easy download
            $phandle = popen('zip -j ' . $permpath . 'download/' . $permpathpart . '.zip ' . $permpath . '*', 'r');
            pclose($phandle);
            $this->fcopy($permpath, $permpath . 'orig');

            $return = $thisorder;
        }

        if ($args['do'] == 'setorder') {
            $orderid = 0;
            $data = $args['xdata'];
            $orderdata = array();
            $return = array();

            foreach ($data as $item) {
                $thisproduct = 0;
                $thisreturn = array();
                $thisreturn['id'] = (int)$item['id'];

                if ($orderid == 0) {
                    $orderid = $this->orderpartRepository->getOrderid((int)$item['id']);
                }

                //first, remove all previous orderpartdata as we set it completely new.
                $remdata = $this->orderpartdataRepository->findByOrderpartid((int)$item['id']);
                foreach ($remdata as $remove) {
                    $this->orderpartdataRepository->remove($remove);
                }

                $persistenceManager->persistAll();

                // Then, make all orderpart entries
                if (isset($item['producttype'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid((int)$item['producttype']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('producttype');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->producttypelanguageRepository->getName((int)$item['producttype']);
                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.product',
                            'Mminteractive'),
                        'val' => $name
                    );
                }

                if (isset($item['completion'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid((int)$item['completion']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('completion');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->completionlanguageRepository->getName((int)$item['completion']);
                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.completion',
                            'Mminteractive'),
                        'val' => $name
                    );
                }

                if (isset($item['material'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid((int)$item['material']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('material');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->materiallanguageRepository->getName((int)$item['material']);
                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.material',
                            'Mminteractive'),
                        'val' => $name
                    );
                }

                if (isset($item['materialdesc'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid((int)$item['materialdesc']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('materialdesc');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->materialdesclanguageRepository->getName((int)$item['materialdesc']);
                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.materialdesc',
                            'Mminteractive'),
                        'val' => $name
                    );
                }

                if (isset($item['productiondepth'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid((int)$item['productiondepth']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('productiondepth');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->productiondepthlanguageRepository->getName((int)$item['productiondepth']);
                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.productiondepth',
                            'Mminteractive'),
                        'val' => $name
                    );
                }

                if (isset($item['countable1']) && $item['countable1'] != '0') {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid(1);
                    $orderpartdata->setAmount($item['countable1']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('countable');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->countablelanguageRepository->getName(1);
                    $thisreturn['items'][] = array(
                        'item' => $name,
                        'val' => $item['countable1']
                    );
                }

                if (isset($item['countable2']) && $item['countable2'] != '0') {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid(2);
                    $orderpartdata->setAmount($item['countable2']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('countable');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->countablelanguageRepository->getName(2);
                    $thisreturn['items'][] = array(
                        'item' => $name,
                        'val' => $item['countable2']
                    );
                }

                if (isset($item['implantsupplier'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid((int)$item['implantsupplier']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('implantsupplier');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->implantsystemRepository->getItem((int)$item['implantsupplier']);
                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.supplier',
                            'Mminteractive'),
                        'val' => $name
                    );
                }

                if (isset($item['implantsystem'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid((int)$item['implantsystem']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('implantsystem');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->implantsystemRepository->getItem((int)$item['implantsystem']);
                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.system',
                            'Mminteractive'),
                        'val' => $name
                    );
                }

                if (isset($item['implantsize'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid((int)$item['implantsize']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('implantsize');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->implantsizeRepository->getItem((int)$item['implantsize']);
                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.mm',
                            'Mminteractive'),
                        'val' => $name
                    );
                }

                if (isset($item['implantgingiva'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid((int)$item['implantgingiva']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('implantgingiva');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->implantgingivaRepository->getItem((int)$item['implantgingiva']);
                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.gingiva',
                            'Mminteractive'),
                        'val' => $name
                    );
                }

                if (isset($item['teeth']) && $item['teeth'] != '0') {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStortype('teeth');
                    $orderpartdata->setAmount($item['teeth']);

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.teeth',
                            'Mminteractive'),
                        'val' => $item['teeth']
                    );
                }

                if (isset($item['adw1'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid($item['adw1']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('addwork');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->addworklanguageRepository->getName($item['adw1']);
                    $alanr = $this->addworkRepository->getalanr($item['prod'], $item['adw1']);

                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.addwork',
                            'Mminteractive'),
                        'val' => $name . ' | ' . $alanr
                    );
                }

                if (isset($item['adw2'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid($item['adw2']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('addwork');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->addworklanguageRepository->getName($item['adw2']);
                    $alanr = $this->addworkRepository->getalanr($item['prod'], $item['adw2']);

                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.addwork',
                            'Mminteractive'),
                        'val' => $name . ' | ' . $alanr
                    );
                }

                if (isset($item['color'])) {
                    $orderpartdata = new \MikelMade\Mminteractive\Domain\Model\Orderpartdata();
                    $orderpartdata->setOrderpartid((int)$item['id']);
                    $orderpartdata->setForeignid((int)$item['color']);
                    $orderpartdata->setPid(33);
                    $orderpartdata->setStorname('color');

                    $this->orderpartdataRepository->add($orderpartdata);
                    $persistenceManager->persistAll();

                    $name = $this->colorlanguageRepository->getName((int)$item['color']);
                    $thisreturn['items'][] = array(
                        'item' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_Mminteractive.color',
                            'Mminteractive'),
                        'val' => $name
                    );
                }
                $otext = 'Datei: ' . $item['file'] . "\n";
                foreach ($thisreturn['items'] as $o_item) {
                    $otext .= implode(': ', $o_item) . "\n";
                }

                $thisarticlenumber = 0;
                $thisproduct = 0;
                $thisproduct = $this->productRepository->findByUid((int)$item[prod]);
                $thisarticlenumber = $thisproduct->getArticlenumber();

                $thisorderpart = $this->orderpartRepository->findByUid((int)$item['id']);
                $thisorderpart->setOrdertext($otext);
                $thisorderpart->setProductid($thisarticlenumber);
                $this->orderpartRepository->update($thisorderpart);
                $persistenceManager->persistAll();

                $thisreturn['file'] = $item['file'];
                $orderdata['parts'][] = $thisreturn;
            }
            $feuser = $this->useraddressRepository->findFeuser($customer);
            $thisorder = $this->orderRepository->findByUid((int)$orderid);
            $orderdata['orderid'] = $orderid;
            $orderdata['company'] = $feuser['company'];
            $orderdata['orderdate'] = date('d.m.Y - H:i', $thisorder->getCreated());

            $thisdeliveryaddress = $this->useraddressRepository->findDeliveryaddress($customer);
            $orderdata['deliveryaddress'] = $thisdeliveryaddress;
            $return = $orderdata;
        }

        if ($args['do'] == 'sendorder') {
            $orderid = $args['orderid'];
            $order = $this->orderRepository->findOrder($orderid);
            $templatepath = '/usr/home/argenv/public_html/fileadmin/template/mailtemplates';
            $feuser = $this->useraddressRepository->findFeuser($customer);

            $sendtime = time();
            $senddate = date('d.m.Y,H', $sendtime);
            $mainorder = $this->orderRepository->findByUid((int)$orderid);
            $mainorder->setComment($args['comments']);
            $mainorder->setOrdercode($args['ordercode']);
            $mainorder->setSent($sendtime);
            if (!preg_match("/test/i", $feuser['company'])) {
                $mainorder->setStatus(1);
            }
            $this->orderRepository->update($mainorder);
            $persistenceManager->persistAll();
            $uploaddir = $mainorder->getUploaddir();

            $mail_main = file_get_contents($templatepath . '/mail_main.html');
            $mail_orderpart = file_get_contents($templatepath . '/mail_orderpart.html');
            $mail_row = file_get_contents($templatepath . '/mail_orderpartrow.html');

            $orderparts = $this->orderpartRepository->findOrderparts($orderid);
            $daddress = $mainorder->getDeliveryaddress();
            if ($daddress == 0) {
                $thisdeliveryaddress = $this->useraddressRepository->findDeliveryaddress($customer);
            } else {
                $thisdeliveryaddress = $this->useraddressRepository->findDeliveryaddressById($daddress);
            }
            $orderdata['deliveryaddress'] = $thisdeliveryaddress;
            $orderdata['orderparts'] = $orderparts;
            $deliveryaddress = '<br /><strong>' . htmlentities($feuser['company']) . '</strong>';
            $deliveryaddress .= '<br />' . htmlentities($thisdeliveryaddress['name1']) . ' ' . htmlentities($thisdeliveryaddress['name2']) . ' ' . htmlentities($thisdeliveryaddress['name3']);
            $deliveryaddress .= '<br /><br />' . htmlentities($thisdeliveryaddress['street']) . ' ' . htmlentities($thisdeliveryaddress['streetsuffix']) . ' ' . htmlentities($thisdeliveryaddress['housenumber']);
            $deliveryaddress .= '<br />' . $thisdeliveryaddress['zip'] . ' ' . htmlentities($thisdeliveryaddress['city']) . '<br /><br />';

            $rows = '';
            foreach ($orderparts as $part) {
                $thisrow = '<tr>';
                $part['ordertext'] = rtrim($part['ordertext']);
                $partsarray = explode("\n", $part['ordertext']);

                for ($i = 1; $i < count($partsarray); $i++) {
                    $thisitem = explode(': ', $partsarray[$i]);
                    $thisrow .= '<td width="375" valign="top">' . htmlentities($thisitem[0]) . ': <strong>' . htmlentities($thisitem[1]) . '</strong></td>';
                    if ($i % 2 == 0) {
                        $thisrow .= '</tr><tr>';
                    }
                }
                $thisrow .= '</tr>';
                $partrow = str_replace('###FILE###', $part['file'], $mail_orderpart);
                $partrow = str_replace('###ROWS###', $thisrow, $partrow);
                $rows .= $partrow;
            }
            $mail_main = str_replace('###ROWS###', $rows, $mail_main);
            $mail_main = str_replace('###YEAR###', date('Y'), $mail_main);

            $ocode = (strlen($args['ordercode']) > 0) ? '<br />Auftragskennung: ' . $args['ordercode'] : '';
            $gender = ($feuser['title'] == 'Herr') ? 'r' : '';
            $mail_main = str_replace('###TITLE###', $feuser['title'], $mail_main);
            $mail_main = str_replace('###GENDER###', $gender, $mail_main);
            $mail_main = str_replace('###FIRSTNAME###', htmlentities($feuser['first_name']), $mail_main);
            $mail_main = str_replace('###LASTNAME###', htmlentities($feuser['last_name']), $mail_main);
            $mail_main = str_replace('###ORDERDETAILS###', date('d.m.Y - H:i', $mainorder->getSent()), $mail_main);
            $mail_main = str_replace('###DELIVERYADDRESS###', $deliveryaddress, $mail_main);
            $mail_main = str_replace('###ORDERCODE###', $ocode, $mail_main);
            $mail_main = str_replace('###COMMENT###', $args['comments'], $mail_main);
            $mail_main = str_replace('###CUSTNUMBER###', '<br />Kundennummer: ' . $feuser['name'], $mail_main);

            $to = array($feuser['email']);
            $subject = 'Ihre Bestellung bei Argen vom ' . date('d.m.Y - H:i', $mainorder->getSent());
            $headers = "From: info@argen-digital.de\r\n";
            $headers .= "Reply-To: info@argen-digital.de\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            foreach ($to as $mailto) {
                mail($mailto, $subject, $mail_main, $headers);
            }

            // Mails to the Admins
            $admins = explode(',', $this->settings['emails']);
            $adminmail = str_replace('<!-- ###DL### -->',
                '<tr><td>Download der Dateien: <a href="https://argen-digital.de/orderdata/perm/' . $uploaddir . '/download/' . $uploaddir . '.zip">https://argen-digital.de/orderdata/perm/' . $uploaddir . '/download/' . $uploaddir . '.zip</a></td></tr>',
                $mail_main);
            $subject2 = str_replace('Ihre Bestellung', 'Kundenbestellung', $subject);
            foreach ($admins as $admin) {
                mail(trim(rtrim($admin)), $subject2, $adminmail, $headers);
            }

            $output['orderparts'] = $orderparts;
            $output['deliveryaddress'] = $thisdeliveryaddress;
            $output['company'] = $feuser['company'];
            $output['created'] = date('d.m.Y - H:i', $mainorder->getCreated());
            $return = $output;
        }

        if ($args['do'] == 'updateprod') {
            $products = $this->producttypeproductRepository->findProductsfromTypes((int)$args['prod']);
            $prods = array();
            foreach ($products as $product) {
                $prods[] = $product['productid'];
            }
            $return = $this->completionproductRepository->findcompletionfromProducts($prods);
        }

        if ($args['do'] == 'updatedata') {
            $prods = array();
            $implants = array();
            $return = array();
            $prevdata = $args['prevdata'];

            foreach ($prevdata as $pdata) {
                if ($pdata[0] == 'producttype' && strlen($pdata[1]) > 0) {
                    $products = $this->producttypeproductRepository->findProductsfromTypes((int)$pdata[1]);
                    foreach ($products as $product) {
                        $prods[] = $product['productid'];
                    }
                }
                if ($pdata[0] == 'completion' && strlen($pdata[1]) > 0) {
                    $prods = $this->completionproductRepository->findproductfromCompletion((int)$pdata[1], $prods);
                }
                if ($pdata[0] == 'material' && strlen($pdata[1]) > 0) {
                    $prods = $this->materialproductRepository->findproductfromMaterial((int)$pdata[1], $prods);
                }
                if ($pdata[0] == 'materialdesc' && strlen($pdata[1]) > 0) {
                    $prods = $this->materialdescproductRepository->findproductfromMaterialdesc((int)$pdata[1], $prods);
                }
                if ($pdata[0] == 'color' && strlen($pdata[1]) > 0) {
                    $prods = $this->colorproductRepository->findproductfromColor((int)$pdata[1], $prods);
                }

                if ($pdata[0] == 'implantsupplier' && strlen($pdata[1]) > 0) {
                    $implants = $this->implantRepository->findImplantsfromSupplier((int)$pdata[1]);
                }

                if ($pdata[0] == 'implantsystem' && strlen($pdata[1]) > 0) {
                    $implants = $this->implantRepository->findImplantsfromSystem((int)$pdata[1], $implants);
                }

                if ($pdata[0] == 'implantsize' && strlen($pdata[1]) > 0) {
                    $implants = $this->implantRepository->findImplantsfromSize((int)$pdata[1], $implants);
                }

                if ($pdata[0] == 'implantgingiva' && strlen($pdata[1]) > 0) {
                    $implants = $this->implantRepository->findImplantsfromGingiva((int)$pdata[1], $implants);
                }

            }
            $prods = $this->productRepository->checkstatus($prods);

            switch ($args['elm']) {
                case 'producttype':
                    break;
                case 'completion':
                    if (count($prods) > 0) {
                        $return = array('data' => $this->completionproductRepository->findcompletionfromProducts($prods));
                    } else {
                        $return = array('data' => '');
                    }
                    break;

                case 'material':
                    if (count($prods) > 0) {
                        $return = array('data' => $this->materialproductRepository->findmaterialfromProducts($prods));
                    } else {
                        $return = array('data' => '');
                    }
                    break;

                case 'materialdesc':
                    if (count($prods) > 0) {
                        $return = array('data' => $this->materialdescproductRepository->findmaterialdescfromProducts($prods));
                    } else {
                        $return = array('data' => '');
                    }
                    break;

                case 'color':
                    if (count($prods) > 0) {
                        $return = array('data' => $this->colorproductRepository->findcolorfromProducts($prods));
                    } else {
                        $return = array('data' => '');
                    }
                    break;

                case 'productiondepth':
                    if (count($prods) > 0) {
                        $return = array('data' => $this->productiondepthproductRepository->findproductiondepthfromProducts($prods));
                        $return['addwork'] = $this->addworkproductRepository->findaddworkfromProducts($prods);
                    } else {
                        $return = array('data' => '');
                    }
                    break;

                case 'implantsupplier':
                    if (count($implants) > 0) {
                        $return = array('data' => $this->implantsupplierRepository->findimplantsupplierfromImplants($implants));
                    }
                    break;

                case 'implantsystem':
                    if (count($implants) > 0) {
                        $return = array('data' => $this->implantsystemRepository->findimplantsystemfromImplants($implants));
                    }
                    break;

                case 'implantsize':
                    if (count($implants) > 0) {
                        $return = array('data' => $this->implantsizeRepository->findimplantsizefromImplants($implants));
                    }
                    break;

                case 'implantgingiva':
                    if (count($implants) > 0) {
                        $return = array('data' => $this->implantgingivaRepository->findimplantgingivafromImplants($implants));
                    }
                    break;

            }
            if (count($prods) > 0) {
                $return['prods'] = implode(',', $prods);
            }
        }
        if (count($prods) > 0) {
            $return['countable'] = $this->countableproductRepository->findcountablefromProducts($prods);
        }

        if (isset($return) && count($return) > 0) {
            $xret = json_encode($return);
            $xlength = strlen($xret);
            for ($i = 0; $i < ($xlength + 10); $i++) {
                $xret .= "\n";
            }
            $this->view->assign('xajaxdata', $xret);
        }
    }

    public function getfiles($dir, $shapes)
    {
        $files = array();
        $shapefiles = array();
        $shape = '';
        $realshapes = array();
        mkdir($dir . 'shapes');

        $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
        foreach ($objects as $name => $object) {
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if (in_array(strtolower($ext), $shapes)) {
                if (!in_array(strtolower($ext), $realshapes)) {
                    $realshapes[] = strtolower($ext);
                }
            }
        }
        foreach ($shapes as $xshape) {
            if (in_array($xshape, $realshapes)) {
                $shape = $xshape;
                break;
            }
        }

        foreach ($objects as $name => $object) {
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if (strlen($shape) > 0) {
                if (strtolower($ext) == $shape) {
                    $filearr = explode('/', $name);
                    $thisfile = $filearr[(count($filearr) - 1)];
                    copy($name, $dir . 'shapes/' . $thisfile);
                    $files[] = array($thisfile, filemtime($name));
                }
            }
        }
        return $files;
    }

    function uniqe_array($arr)
    {
        $test = array();
        $ret = array();
        foreach ($arr as $item) {
            if (!in_array($item[0], $test)) {
                $test[] = $item[0];
                $ret[] = $item;
            }
        }
        return $ret;
    }

    function fcopy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (!is_dir($src . '/' . $file)) {
                    rename($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     *    action    list
     *
     * @return     void
     */
    public function listAction()
    {
        //$produkt = $this->request->getArgument('produkt');
        //$produktdata = $this->produkteRepository->frontendsingleprodukt($this->languageRepository,$this->languagenamesRepository,$this->produktenamesRepository,$produkt);
        $this->view->assign('produktdata', $produktdata);
        $implantsystem = $this->implantsystemRepository->findAll();
        $this->view->assign('implantsystem', $implantsystem);

        $implantsupplier = $this->implantsupplierRepository->findAll();
        $this->view->assign('implantsupplier', $implantsupplier);
    }
}