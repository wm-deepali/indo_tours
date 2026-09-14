<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\SmtpSetting;
use App\Models\Setting;
use App\Models\GoogleSetting;
use App\Models\SmsSetting;
use App\Services\SmsService;
use Illuminate\Http\RedirectResponse;

class AdminSettingController extends Controller
{
    // ðŸ”¹ Show form

    public function index(Request $request)
    {
        $general = Setting::first();
        $smtp = SmtpSetting::first();
        $google_setting = GoogleSetting::current();
        $sms_settings = SmsSetting::first();
        $states = State::all();

        $activeTab = $request->tab ?? 'general';


        return view(
            'admin.admin-settings.index',
            compact(
                'general',
                'smtp',
                'states',
                'google_setting',
                'sms_settings',
                'activeTab'
            )
        );
    }

    public function generalSettingStore(Request $request)
    {
        $validated = $request->validate([

            'site_name' => 'nullable|string|max:255',
            'tagline' => 'nullable|string|max:255',

            'admin_email' => 'nullable|email|max:255',
            'support_email' => 'nullable|email|max:255',

            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',

            'business_address' => 'nullable|string',

            'footer_description' => 'nullable|string',

            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'pinterest' => 'nullable|url|max:255',

            'currency' => 'nullable|string|max:10',
            'currency_symbol' => 'nullable|string|max:10',
            'timezone' => 'nullable|string|max:100',

        ]);

        $validated['maintenance_mode']
            = $request->has('maintenance_mode');

        $existing = Setting::first();

        if ($request->hasFile('logo')) {
            if ($existing && $existing->logo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($existing->logo);
            }
            $validated['logo'] = $request
                ->file('logo')
                ->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($existing && $existing->favicon) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($existing->favicon);
            }
            $validated['favicon'] = $request
                ->file('favicon')
                ->store('settings', 'public');
        }

        Setting::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return back()->with(
            'success',
            'General settings updated successfully.'
        );
    }

    public function smtpSettingStore(Request $request)
    {
        $validated = $request->validate([

            'smtp_host' => 'required|string|max:255',
            'smtp_port' => 'required|integer',

            'smtp_username' => 'required|string|max:255',
            'smtp_password' => 'required|string',

            'smtp_encryption' => 'required|in:tls,ssl,none',

            'from_name' => 'nullable|string|max:255',
            'from_email' => 'nullable|email|max:255',

            'reply_to_name' => 'nullable|string|max:255',
            'reply_to_email' => 'nullable|email|max:255',
        ]);

        $validated['package_enquiry_alert']
            = $request->has('package_enquiry_alert');

        $validated['callback_request_alert']
            = $request->has('callback_request_alert');

        $validated['general_inquiry_alert']
            = $request->has('general_inquiry_alert');

        $validated['popup_inquiry_alert']
            = $request->has('popup_inquiry_alert');

        $validated['contact_us_alert']
            = $request->has('contact_us_alert');

        $validated['password_reset']
            = $request->has('password_reset');

        SmtpSetting::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return back()->with(
            'success',
            'SMTP settings saved successfully.'
        );
    }

    public function googleSettingStore(Request $request)
    {
        $request->validate([
            'gtm_container_id' => 'nullable|string|max:50',
            'ga4_measurement_id' => 'nullable|string|max:50',
            'gads_conversion_id' => 'nullable|string|max:50',
            'meta_pixel_id' => 'nullable|string|max:50',
            'gsc_verify_method' => 'nullable|in:meta,file,dns',
            'gads_currency' => 'nullable|string|max:5',
        ]);

        $checkboxFields = [
            'gtm_enabled',
            'gtm_all_pages',
            'gtm_datalayer_events',
            'ga4_enabled',
            'ga4_ev_view_item',
            'ga4_ev_view_search_results',
            'ga4_ev_begin_enquiry',
            'ga4_ev_generate_lead',
            'ga4_ev_search',
            'ga4_ev_login',
            'ga4_ev_sign_up',
            'gads_enabled',
            'gads_enhanced_conversions',
            'gsc_auto_sitemap',
            'meta_enabled',
            'meta_ev_page_view',
            'meta_ev_view_content',
            'meta_ev_lead',
            'meta_ev_contact',
            'meta_ev_complete_reg',
            'meta_ev_search',
            'meta_advanced_matching',
        ];

        $data = $request->except(['_token']);

        foreach ($checkboxFields as $field) {
            $data[$field] = $request->boolean($field);
        }

        GoogleSetting::updateOrCreate(['id' => 1], $data);

        return redirect()
            ->route('admin.admin-setting.index', ['tab' => 'tracking'])
            ->with('success', 'Tracking settings saved successfully.');
    }

    public function smsSettingStore(Request $request): RedirectResponse
    {
        $request->merge([
            'enabled' => $request->has('enabled'),
            'notify_otp' => $request->has('notify_otp'),
            'notify_package_enquiry' => $request->has('notify_package_enquiry'),
            'notify_callback_request' => $request->has('notify_callback_request'),
            'notify_general_inquiry' => $request->has('notify_general_inquiry'),
            'notify_popup_inquiry' => $request->has('notify_popup_inquiry'),
        ]);

        $data = $request->validate([
            // MSG91
            'msg91_auth_key' => ['nullable', 'string'],
            'msg91_route' => ['nullable', 'integer', 'in:1,4'],
            'msg91_dlt_entity_id' => ['nullable', 'string', 'max:50'],

            // Global
            'sender_id' => ['nullable', 'string', 'max:11'],
            'default_country_code' => ['nullable', 'digits_between:1,4'],

            // Booleans — checkboxes are absent when unchecked, so we don't require them
            'enabled' => ['nullable', 'boolean'],
            'notify_otp' => ['nullable', 'boolean'],
            'notify_package_enquiry' => ['nullable', 'boolean'],
            'notify_callback_request' => ['nullable', 'boolean'],
            'notify_general_inquiry' => ['nullable', 'boolean'],
            'notify_popup_inquiry' => ['nullable', 'boolean'],
        ]);

        // Normalise boolean fields (checkboxes send "on" or are absent)
        $booleans = [
            'enabled',
            'notify_otp',
            'notify_package_enquiry',
            'notify_callback_request',
            'notify_general_inquiry',
            'notify_popup_inquiry',
        ];

        foreach ($booleans as $key) {
            $data[$key] = $request->boolean($key);
        }

        // Skip saving the auth key if it was left blank (preserve existing value)
        if (empty($data['msg91_auth_key'])) {
            unset($data['msg91_auth_key']);
        }

        $settings = SmsSetting::getInstance();
        $settings->update($data);

        return redirect()
            ->route(
                'admin.admin-setting.index',
                ['tab' => 'sms']
            )
            ->with('success', 'SMS settings saved successfully.');
    }

    // ── Test SMS ─────────────────────────────────────────────────────────────

    public function smsSettingTest(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'string', 'max:20'],
        ]);

        try {
            $sms = SmsService::make();
            $mobile = $sms->normalise($request->mobile);
            $result = $sms->send($mobile, 'This is a test SMS from Indo Tours & Adventures. If you received this, your SMS settings are working correctly.');

            if ($result['success']) {
                return response()->json(['success' => true, 'message' => 'Test SMS sent to ' . $mobile]);
            }

            return response()->json(['success' => false, 'message' => 'Failed to send SMS. Check your credentials and try again.'], 422);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getCities(Request $request)
    {
        return City::where('state_id', $request->state_id)
            ->orderBy('name')
            ->get(['id', 'name']);
    }


}