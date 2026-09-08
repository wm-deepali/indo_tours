<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleSetting extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        // GTM
        'gtm_enabled'            => 'boolean',
        'gtm_all_pages'          => 'boolean',
        'gtm_datalayer_events'   => 'boolean',

        // GA4
        'ga4_enabled'                 => 'boolean',
        'ga4_api_secret'              => 'encrypted',
        'ga4_ev_view_item'            => 'boolean',
        'ga4_ev_view_search_results'  => 'boolean',
        'ga4_ev_begin_enquiry'        => 'boolean',
        'ga4_ev_generate_lead'        => 'boolean',
        'ga4_ev_search'               => 'boolean',
        'ga4_ev_login'                => 'boolean',
        'ga4_ev_sign_up'              => 'boolean',

        // Google Ads
        'gads_enabled'                => 'boolean',
        'gads_enhanced_conversions'   => 'boolean',

        // Search Console
        'gsc_auto_sitemap'       => 'boolean',

        // Meta
        'meta_enabled'              => 'boolean',
        'meta_capi_token'           => 'encrypted',
        'meta_ev_page_view'         => 'boolean',
        'meta_ev_view_content'      => 'boolean',
        'meta_ev_lead'              => 'boolean',
        'meta_ev_contact'           => 'boolean',
        'meta_ev_complete_reg'      => 'boolean',
        'meta_ev_search'            => 'boolean',
        'meta_advanced_matching'    => 'boolean',
    ];

    /**
     * Settings table is a single row — always fetch/create id=1.
     */
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}