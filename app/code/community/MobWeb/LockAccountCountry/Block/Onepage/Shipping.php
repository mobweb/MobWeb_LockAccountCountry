<?php

class MobWeb_LockAccountCountry_Block_Onepage_Shipping extends Mage_Checkout_Block_Onepage_Shipping
{
    public function getCountryHtmlSelect($type)
    {
        $countryId = $this->getAddress()->getCountryId();
        if (is_null($countryId)) {
            $countryId = Mage::helper('core')->getDefaultCountry();
        }
        
        $valueAndOptions = Mage::helper('MobWeb_LockAccountCountry')->getValueAndOptions($countryId, $this->getCountryOptions());

        $select = $this->getLayout()->createBlock('core/html_select')
            ->setName($type.'[country_id]')
            ->setId($type.':country_id')
            ->setTitle(Mage::helper('checkout')->__('Country'))
            ->setClass('validate-select')
            ->setValue($valueAndOptions[0])
            ->setOptions($valueAndOptions[1]);

        if ($type === 'shipping') {
            $select->setExtraParams('onchange="if(window.shipping)shipping.setSameAsBilling(false);"');
        }

        return $select->getHtml();
    }
}