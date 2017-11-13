<?php

namespace MediaLounge\DisabledProductsRedirect\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_AUTOREDIRECT_ENABLE = 'redirect/general/enable';

    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_AUTOREDIRECT_ENABLE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
