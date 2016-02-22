<?php

class MobWeb_LockAccountCountry_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getAccountCountry()
	{
		if($customer = Mage::getSingleton('customer/session')->getCustomer()) {
			if($customerBillingAddressId = $customer->getDefaultBilling()) {
				if($customerBillingAddress = Mage::getModel('customer/address')->load($customerBillingAddressId)) {
					return $customerBillingAddress->getCountry();
				}
			}
		}

		return false;
	}

	public function getValueAndOptions($defaultValue, $defaultOptions)
	{
		// If the customer is logged in and has selected a country, use this country as the
		// only option for the dropdown
		if($accountCountry = Mage::helper('MobWeb_LockAccountCountry')->getAccountCountry()) {

		    // Loop through the options and retrieve the option for the account country
		    foreach($defaultOptions AS $i => $option) {
		        if($option['value'] === $accountCountry) {

		            // Return the account country and the option array with only the account country
		            return array($accountCountry, array($option));
		        }
		    }
		}

		// If no account country is available, return the default value and options
		return array($defaultValue, $defaultOptions);
	}
}