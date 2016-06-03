<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * Copyright (c) 2011-present Qualiteam software Ltd. All rights reserved.
 * See https://www.x-cart.com/license-agreement.html for license details.
 */

namespace XLite\Module\XC\BulkEditing\Logic\BulkEdit\Field\Product;

class QuantityInStock extends \XLite\Module\XC\BulkEditing\Logic\BulkEdit\Field\AField
{
    public static function getSchema($name, $options)
    {
        return [
            $name => [
                'label'    => static::t('Quantity in stock'),
                'type'     => 'XLite\View\FormModel\Type\PatternType',
                'pattern'  => [
                    'alias'      => 'integer',
                    'rightAlign' => false,
                ],
                'position' => isset($options['position']) ? $options['position'] : 0,
            ],
        ];
    }

    public static function getData($name, $object)
    {
        return [
            $name => 0,
        ];
    }

    public static function populateData($name, $object, $data)
    {
        $object->setAmount($data->{$name});
    }

    /**
     * @param string               $name
     * @param \XLite\Model\Product $object
     * @param array                $options
     *
     * @return array
     */
    public static function getViewData($name, $object, $options)
    {
        $inventorTrackingStatus = $object->getInventoryEnabled();

        return $inventorTrackingStatus
            ? [
                $name => [
                    'label'    => static::t('Quantity in stock'),
                    'value'    => $object->getAmount(),
                    'position' => isset($options['position']) ? $options['position'] : 0,
                ],
            ]
            : [];
    }
}
