<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('google_settings', function (Blueprint $table) {
            $table->id();

            // GTM
            $table->boolean('gtm_enabled')->default(false);
            $table->string('gtm_container_id')->nullable();
            $table->string('gtm_inject_position')->default('head');
            $table->string('gtm_auth')->nullable();
            $table->boolean('gtm_all_pages')->default(true);
            $table->boolean('gtm_datalayer_events')->default(true);

            // GA4
            $table->boolean('ga4_enabled')->default(false);
            $table->string('ga4_measurement_id')->nullable();
            $table->string('ga4_property_id')->nullable();
            $table->text('ga4_api_secret')->nullable();
            $table->string('ga4_client_id_cookie')->default('_ga');

            $table->boolean('ga4_ev_view_item')->default(true);          // destination / package detail view
            $table->boolean('ga4_ev_view_search_results')->default(true);
            $table->boolean('ga4_ev_begin_enquiry')->default(true);      // enquiry form opened
            $table->boolean('ga4_ev_generate_lead')->default(true);      // package/callback/general/popup enquiry submitted
            $table->boolean('ga4_ev_search')->default(true);
            $table->boolean('ga4_ev_login')->default(true);
            $table->boolean('ga4_ev_sign_up')->default(true);

            // Google Ads
            $table->boolean('gads_enabled')->default(false);
            $table->string('gads_conversion_id')->nullable();
            $table->string('gads_enquiry_label')->nullable();
            $table->string('gads_signup_label')->nullable();
            $table->string('gads_callback_request_label')->nullable();
            $table->string('gads_remarketing_id')->nullable();
            $table->string('gads_currency')->default('INR');
            $table->boolean('gads_enhanced_conversions')->default(false);

            // Search Console
            $table->string('gsc_verify_method')->nullable();
            $table->string('gsc_meta_content')->nullable();
            $table->boolean('gsc_auto_sitemap')->default(false);
            $table->string('gsc_sitemap_path')->default('sitemap.xml');

            // Meta / Facebook
            $table->boolean('meta_enabled')->default(false);
            $table->string('meta_pixel_id')->nullable();
            $table->text('meta_capi_token')->nullable();
            $table->string('meta_test_event_code')->nullable();
            $table->string('meta_domain_verify')->nullable();

            $table->boolean('meta_ev_page_view')->default(true);
            $table->boolean('meta_ev_view_content')->default(true);      // destination/package viewed
            $table->boolean('meta_ev_lead')->default(true);              // package/general/popup enquiry submitted
            $table->boolean('meta_ev_contact')->default(true);           // callback request / contact us
            $table->boolean('meta_ev_complete_reg')->default(true);
            $table->boolean('meta_ev_search')->default(true);
            $table->boolean('meta_advanced_matching')->default(false);

            // Custom scripts
            $table->longText('custom_head_scripts')->nullable();
            $table->longText('custom_body_top_scripts')->nullable();
            $table->longText('custom_body_bottom_scripts')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('google_settings');
    }
};