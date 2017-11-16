<?php

namespace MediaLounge\DisabledProductsRedirect\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_AUTOREDIRECT_ENABLE = 'redirect/general/enable';
    const XML_PATH_AUTOREDIRECT_NOTICE = 'redirect/general/notice';

    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_AUTOREDIRECT_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getNoticeMessage()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_AUTOREDIRECT_NOTICE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
