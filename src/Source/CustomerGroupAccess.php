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

namespace Fontis\CustomerGroupAccess\Source;

use Magento\Framework\Data\OptionSourceInterface;

class CustomerGroupAccess implements OptionSourceInterface
{
    const ACCESS_NO_RESTRICTIONS = 0;
    const ACCESS_ONLY_ALLOW = 1;
    const ACCESS_ALL_EXCEPT = 2;

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ["value" => self::ACCESS_NO_RESTRICTIONS, "label" => __("No restrictions")],
            ["value" => self::ACCESS_ONLY_ALLOW, "label" => __("Only allow group ...")],
            ["value" => self::ACCESS_ALL_EXCEPT, "label" => __("Allow all groups except ...")],
        ];
    }
}
