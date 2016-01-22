<?php
/**
 * Fontis Magento 2 Customer Group Access
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Fontis
 * @package    Fontis_CustomerGroupAccess
 * @copyright  Copyright (c) 2016 Fontis Pty. Ltd. (https://www.fontis.com.au)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Fontis\CustomerGroupAccess;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface as StoreScopeInterface;

class AccessCheck
{
    /**
     * @var int
     */
    protected $customerGroupAccess;

    /**
     * @var int
     */
    protected $configuredCustomerGroup;

    /**
     * @param ScopeConfigInterface $scopeConfig
     * @param string $configPathPrefix
     * @param int|string|null $storeId
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        $configPathPrefix,
        $storeId = null
    ) {
        $this->customerGroupAccess = (int) $scopeConfig->getValue("$configPathPrefix/customer_group_access", StoreScopeInterface::SCOPE_STORE, $storeId);
        $this->configuredCustomerGroup = (int) $scopeConfig->getValue("$configPathPrefix/customer_group", StoreScopeInterface::SCOPE_STORE, $storeId);
    }

    /**
     * @param int $customerGroupId
     * @return bool
     */
    public function check($customerGroupId)
    {
        $pass = false;

        if ($this->customerGroupAccess === Source\CustomerGroupAccess::ACCESS_NO_RESTRICTIONS) {
            $pass = true;
        } elseif ($this->customerGroupAccess === Source\CustomerGroupAccess::ACCESS_ONLY_ALLOW) {
            if ($customerGroupId === $this->configuredCustomerGroup) {
                $pass = true;
            }
        } elseif ($this->customerGroupAccess === Source\CustomerGroupAccess::ACCESS_ALL_EXCEPT) {
            if ($customerGroupId !== $this->configuredCustomerGroup) {
                $pass = true;
            }
        }

        return $pass;
    }
}
