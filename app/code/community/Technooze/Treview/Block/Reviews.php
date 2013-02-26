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

class Technooze_Treview_Block_Reviews extends Mage_Core_Block_Template
{
    private $_product = false;
    protected $_reviewsCollection;
    public $_reviewListLimit = 5;

    public function _construct(){
        parent::_construct();

        if(!$this->_product){
            $this->_product = Mage::registry('product');
        }
    }

    public function _toHtml()
    {
        return parent::_toHtml();
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function setProduct(Mage_Catalog_Model_Product $product)
    {
        $this->_product = $product;
    }

    public function getProduct()
    {
        return $this->_product;
    }

    public function getReviewsCollection()
    {
        if (null === $this->_reviewsCollection) {
            $this->_reviewsCollection = Mage::getModel('review/review')->getCollection()
                ->addStoreFilter(Mage::app()->getStore()->getId())
                ->addStatusFilter('approved')
                ->addEntityFilter('product', $this->getProduct()->getId())
                ->setDateOrder()
                ->setPageSize($this->_reviewListLimit)
                ->setCurPage(1)
            ;
        }
        return $this->_reviewsCollection;
    }

    public function getRatingSummary()
    {
        $storeId = Mage::app()->getStore()->getStoreId();
        $summaryData = Mage::getModel('review/review_summary')
                        ->setStoreId($storeId)
                        ->load($this->getProduct()->getId());

        return $summaryData->getData('rating_summary');
    }

    public function getReviewsCount()
    {
        $storeId = Mage::app()->getStore()->getStoreId();
        $summaryData = Mage::getModel('review/review_summary')
                        ->setStoreId($storeId)
                        ->load($this->getProduct()->getId());

        return $summaryData->getData('reviews_count');
    }

    public function getReviewsUrl()
    {
        return Mage::getUrl('review/product/list', array(
                'id'        => $this->getProduct()->getId(),
                'category'  => $this->getProduct()->getCategoryId()
            ));
    }

    public function getFirstReview()
    {
        $data = array();
        $sum = Mage::getModel('review/review')->getCollection()
            ->addStoreFilter(Mage::app()->getStore()->getId())
            ->addStatusFilter('approved')
            ->addEntityFilter('product', $this->getProduct()->getId())
            ->getFirstItem()
            ->setDateOrder();

        if($reviewer = $sum->getNickname())
        {
            $data['review'] = $sum->getDetail();
            $data['reviewer'] = $reviewer;
        } else {
            $data = false;
        }

        return $data;
    }
}
