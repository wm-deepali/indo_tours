<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmtpSetting extends Model
{
    protected $fillable = [
        'smtp_host',
        'smtp_port',
        'smtp_username',
        'smtp_password',
        'smtp_encryption',
        'from_name',
        'from_email',
        'reply_to_name',
        'reply_to_email',
        'package_enquiry_alert',
        'callback_request_alert',
        'general_inquiry_alert',
        'popup_inquiry_alert',
        'contact_us_alert',
        'password_reset',
    ];

    protected $casts = [
        'package_enquiry_alert' => 'boolean',
        'callback_request_alert' => 'boolean',
        'general_inquiry_alert' => 'boolean',
        'popup_inquiry_alert' => 'boolean',
        'contact_us_alert' => 'boolean',
        'password_reset' => 'boolean',
    ];

    /**
     * Always return a singleton row (id = 1).
     */
    public static function getInstance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}