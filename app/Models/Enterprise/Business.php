<?php

namespace App\Models\Enterprise;

use App\Models\Social\Country;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Business extends Authenticatable
{
    const STATUS_DEACTIVATED = 0;
    const STATUS_ACTIVATED = 1;
    const STATUS_PENDING_ACTIVATION = 2;

    public static $statusTexts = [
        self::STATUS_ACTIVATED => 'activated',
        self::STATUS_DEACTIVATED => 'deactivated',
        self::STATUS_PENDING_ACTIVATION => 'pending activation',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['activated_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'password_change_required' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'logo', 'address',
        'email', 'phone_number', 'fax',
        'website', 'contact_info', 'login_email',
        'password', 'password_change_required',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function activatedBy()
    {
        return $this->belongsTo(User::class, 'activated_by');
    }

    public function gln()
    {
        return $this->hasMany(GLN::class);
    }

    public function getStatusTextAttribute($value)
    {
        return static::$statusTexts[$this->attributes['status']];
    }

    public function getIsActivatedAttribute($value)
    {
        return $this->attributes['status'] === static::STATUS_ACTIVATED;
    }

    public function getIsDeactivatedAttribute($value)
    {
        return $this->attributes['status'] === static::STATUS_DEACTIVATED;
    }

    public function getIsPendingActivationAttribute($value)
    {
        return $this->attributes['status'] === static::STATUS_PENDING_ACTIVATION;
    }

    public function logo($size = 'original')
    {
        $sizes = ["original", "thumb_small", "thumb_medium", "thumb_large", "small", "medium", "large"];

        if (!in_array($size, $sizes)) {
            $size = 'original';
        }

        return 'http://ucontent.icheck.vn/' . $this->getAttribute('logo') . '_' . $size . '.jpg';
    }
}
