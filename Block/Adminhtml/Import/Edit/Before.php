<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_Blog
 * @copyright   Copyright (c) 2018 Mageplaza (http://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\Blog\Block\Adminhtml\Import\Edit;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Mageplaza\Blog\Helper\Data as BlogHelper;
use Mageplaza\Blog\Model\Config\Source\Import\Type;

/**
 * Class Before
 * @package Mageplaza\Blog\Block\Adminhtml\Import\Edit
 */
class Before extends Template
{
    /**
     * @var BlogHelper
     */
    public $blogHelper;

    /**
     * @var Type
     */
    public $importType;

    /**
     * Before constructor.
     * @param Context $context
     * @param BlogHelper $blogHelper
     * @param Type $importType
     * @param array $data
     */
    public function __construct(
        Context $context,
        BlogHelper $blogHelper,
        Type $importType,
        array $data = []
    )
    {
        $this->blogHelper = $blogHelper;
        $this->importType = $importType;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getTypeSelector()
    {
        $types = [];
        foreach ($this->importType->toOptionArray() as $item) {
            $types[] = $item['value'];
        }
        array_shift($types);

        return BlogHelper::jsonEncode($types);

    }

    /**
     * @param $priority
     * @param $message
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getMessagesHtml($priority, $message)
    {
        /** @var $messagesBlock \Magento\Framework\View\Element\Messages */
        $messagesBlock = $this->_layout->createBlock(\Magento\Framework\View\Element\Messages::class);
        $messagesBlock->{$priority}(__($message));

        return $messagesBlock->toHtml();
    }

    public function getImportButtonHtml()
    {
        $importUrl = $this->getUrl('mageplaza_blog/import/import');
        $html = '&nbsp;&nbsp;<button id="word-press-import" href="' . $importUrl . '" class="" type=""><span><span><span>Import</span></span></span></button>';
        return $html;
    }
}