<?php
/**
 * Technooze_Treview extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Technooze
 * @package    Technooze_Treview
 * @copyright  Copyright (c) 2008 Technooze LLC
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 *
 * @category Technooze
 * @package  Technooze_Treview
 * @module   Treview
 * @author   Damodar Bashyal (enjoygame @ hotmail.com)
 */
 ?>
 <?php
class Technooze_Treview_Block_Reviews extends Mage_Core_Block_Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getRatingSummary()
    {
        $storeId = Mage::app()->getStore()->getStoreId();
        $summaryData = Mage::getModel('review/review_summary')
            ->setStoreId($storeId)
            ->load(Mage::registry('product')->getId());

        return $summaryData->getData('rating_summary');
    }

    public function getReviewsCount()
    {
        $storeId = Mage::app()->getStore()->getStoreId();
        $summaryData = Mage::getModel('review/review_summary')
            ->setStoreId($storeId)
            ->load(Mage::registry('product')->getId());

        return $summaryData->getData('reviews_count');
    }

    public function getReviewsUrl()
    {
        return Mage::getUrl('review/product/list', array(
                'id'        => Mage::registry('product')->getId(),
                'category'  => Mage::registry('product')->getCategoryId()
            ));
    }

    public function getFirstReview()
    {
        $data = array();
        $sum = Mage::getModel('review/review')->getCollection()
            ->addStoreFilter(Mage::app()->getStore()->getId())
            ->addStatusFilter('approved')
            ->addEntityFilter('product', Mage::registry('product')->getId())
            ->getFirstItem()
            ->setDateOrder();

        if($reviewer = $sum->getNickname())
        {
            $data['review'] = Mage::helper('ag')->character_limiter($sum->getDetail(), 250);
            $data['reviewer'] = $reviewer;
        } else {
            $data = false;
        }

        return $data;
    }
}
