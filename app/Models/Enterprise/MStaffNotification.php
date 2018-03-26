<?php

namespace App\Models\Enterprise;

use Jenssegers\Mongodb\Eloquent\Model as Model;

class MStaffNotification extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'staff_notifications';

    /**
     * {@inheritdoc}
     */
    protected $dateFormat = DATE_ISO8601;

    /**
     * {@inheritdoc}
     */
    const CREATED_AT = 'createdAt';

    /**
     * {@inheritdoc}
     */
    const UPDATED_AT = 'updatedAt';

    const TYPE_BUSINESS_REGISTERED = 1;
    const TYPE_BUSINESS_ADD_GLN = 2;
    const TYPE_BUSINESS_UPDATE_GLN = 3;
    const TYPE_BUSINESS_DELETE_GLN = 4;
    const TYPE_BUSINESS_ADD_PRODUCT = 5;
    const TYPE_BUSINESS_UPDATE_PRODUCT = 6;
    const TYPE_BUSINESS_DELETE_PRODUCT = 7;
    const TYPE_IMPORT_PRODUCT_FAILED = 51;
}
