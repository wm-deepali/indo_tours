<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsSetting extends Model
{
    protected $table = 'sms_settings';

    protected $fillable = [
        // MSG91
        'msg91_auth_key',
        'msg91_route',
        'msg91_dlt_entity_id',

        // Global
        'sender_id',
        'default_country_code',
        'enabled',

        // Notification toggles
        'notify_otp',
        'notify_package_enquiry',
        'notify_callback_request',
        'notify_general_inquiry',
        'notify_popup_inquiry',
    ];

    /**
     * Encrypt sensitive credential fields at rest.
     * Requires APP_KEY to be set (uses Laravel's built-in AES-256 encryption).
     */
    protected $casts = [
        'msg91_auth_key' => 'encrypted',

        'enabled' => 'boolean',
        'notify_otp' => 'boolean',
        'notify_package_enquiry' => 'boolean',
        'notify_callback_request' => 'boolean',
        'notify_general_inquiry' => 'boolean',
        'notify_popup_inquiry' => 'boolean',
    ];

    /**
     * Always return a singleton row (id = 1).
     */
    public static function getInstance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    /**
     * Convenience: is a given notification event enabled?
     */
    public function shouldNotify(string $event): bool
    {
        return $this->enabled && (bool) ($this->{"notify_{$event}"} ?? false);
    }
}