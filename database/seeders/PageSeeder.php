<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Terms & Conditions',
                'slug' => 'term-conditions',
                'h1' => 'Terms & Conditions',
                'is_active' => true,
                'meta_title' => 'Terms & Conditions | Indo Tours & Adventures',
                'meta_description' => 'Read the Terms & Conditions governing your use of IND Tour Adventure\'s website, tour packages, bookings, and travel services.',
                'robots' => 'index, follow',
                'content' => $this->termsContent(),
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'h1' => 'Privacy Policy',
                'is_active' => true,
                'meta_title' => 'Privacy Policy | Indo Tours & Adventures',
                'meta_description' => 'Learn how IND Tour Adventure collects, uses, and protects your personal information.',
                'robots' => 'index, follow',
                'content' => '<p>Add your Privacy Policy content here.</p>',
            ],
            [
                'title' => 'Copyright Policy',
                'slug' => 'copyright-policy',
                'h1' => 'Copyright Policy',
                'is_active' => true,
                'meta_title' => 'Copyright Policy | Indo Tours & Adventures',
                'meta_description' => 'Read about how IND Tour Adventure protects its intellectual property and content rights.',
                'robots' => 'index, follow',
                'content' => '<p>Add your Copyright Policy content here.</p>',
            ],
            [
                'title' => 'Help Center',
                'slug' => 'help-center',
                'h1' => 'Help Center',
                'is_active' => true,
                'meta_title' => 'Help Center | Indo Tours & Adventures',
                'meta_description' => 'Get answers to common questions about bookings, cancellations, and travel with IND Tour Adventure.',
                'robots' => 'index, follow',
                'content' => '<p>Add your Help Center content here.</p>',
            ],
            [
                'title' => 'Cancellation Policy',
                'slug' => 'cancellation-policy',
                'h1' => 'Cancellation Policy',
                'is_active' => true,
                'meta_title' => 'Cancellation Policy | Indo Tours & Adventures',
                'meta_description' => 'Understand the cancellation and refund terms for bookings made with IND Tour Adventure.',
                'robots' => 'index, follow',
                'content' => '<p>Add your Cancellation Policy content here.</p>',
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }
    }

    private function termsContent(): string
    {
        return <<<'HTML'
<p><strong>Last updated:</strong> August 13, 2026</p>

<h4>Acceptance of These Terms</h4>
<p>
    These Terms &amp; Conditions ("Terms") govern your access to and
    use of the IND Tour Adventure website, including its travel
    planning services, tour packages, destination information, travel
    guides, booking services, and related services (collectively, the
    "Services").
</p>
<p>
    By accessing or using our Services, you agree to be bound by these
    Terms. If you do not agree with any part of these Terms, please do
    not use the website or our Services.
</p>

<h4>About IND Tour Adventure</h4>
<p>
    IND Tour Adventure is a travel and tour planning platform that
    helps travellers discover destinations, plan trips, explore tour
    packages, and connect with travel services. We may work with
    hotels, transportation providers, tour operators, activity
    providers, guides, and other third-party travel partners.
</p>

<h4>Eligibility</h4>
<ul>
    <li>You must be at least 18 years of age to make a booking through our Services.</li>
    <li>You must provide accurate and complete information when making an enquiry or booking.</li>
    <li>You are responsible for ensuring that you have the necessary documents, permissions, visas, and approvals required for your journey.</li>
    <li>You agree to use our Services only for lawful purposes.</li>
</ul>

<h4>Travel Enquiries &amp; Bookings</h4>
<p>
    Our website may display destinations, tour packages, itineraries,
    activities, hotels, transportation options, and other
    travel-related information. Availability, pricing, inclusions, and
    schedules may change depending on the service provider and travel
    dates.
</p>
<ul>
    <li>A booking is confirmed only after confirmation from IND Tour Adventure or the relevant travel service provider.</li>
    <li>An enquiry or booking request submitted through the website does not automatically guarantee availability.</li>
    <li>We reserve the right to correct pricing or availability errors before confirming a booking.</li>
    <li>You are responsible for reviewing the itinerary, inclusions, exclusions, dates, and passenger details before confirming your booking.</li>
</ul>

<h4>Tour Packages &amp; Itineraries</h4>
<p>
    Tour itineraries are provided for planning purposes and may be
    subject to changes due to weather conditions, transportation
    schedules, government regulations, local conditions, availability,
    safety requirements, or circumstances beyond our reasonable
    control.
</p>
<p>
    We may make reasonable changes to an itinerary when necessary
    while attempting to maintain the overall nature and value of the
    planned experience.
</p>

<h4>Pricing &amp; Payment</h4>
<ul>
    <li>All prices are displayed in Indian Rupees (INR) unless otherwise specified.</li>
    <li>Prices may vary based on destination, travel dates, hotel availability, transportation, activities, group size, and other factors.</li>
    <li>Any applicable taxes, service charges, or additional fees will be communicated during the booking process where applicable.</li>
    <li>A booking may require full or partial payment depending on the selected package and service provider.</li>
    <li>A booking will be considered confirmed only after the required payment and confirmation have been received.</li>
</ul>

<h4>Cancellation &amp; Refunds</h4>
<p>
    Cancellation and refund terms may vary depending on the selected
    tour, hotel, transportation provider, activity, destination, and
    booking conditions.
</p>
<ul>
    <li>Cancellation requests must be submitted through the contact details provided by IND Tour Adventure.</li>
    <li>Applicable cancellation charges may be deducted from the refundable amount.</li>
    <li>Some bookings may be non-refundable or partially refundable.</li>
    <li>Refund processing time may depend on the payment method and the relevant service provider.</li>
    <li>Any refund will be processed according to the cancellation terms applicable to the specific booking.</li>
</ul>

<h4>Travel Documents &amp; Visa Requirements</h4>
<p>
    Travellers are responsible for obtaining and maintaining valid
    passports, visas, permits, travel insurance, identification
    documents, vaccination certificates, and any other documents
    required for their journey.
</p>
<p>
    IND Tour Adventure may provide general travel information, but we
    do not guarantee the approval of any visa, permit, entry
    authorization, or other travel document. Travellers should verify
    current requirements with the relevant government authorities
    before travelling.
</p>

<h4>Hotels &amp; Accommodation</h4>
<p>
    Hotel and accommodation services may be provided by independent
    third-party properties. Room types, facilities, check-in and
    check-out times, policies, and amenities are subject to the
    individual property's terms and availability.
</p>
<p>
    Hotel photographs and descriptions are provided for general
    informational purposes and may vary from the actual property or
    room allocated at the time of stay.
</p>

<h4>Transportation</h4>
<p>
    Transportation services may be provided by third-party airlines,
    rail operators, car rental companies, bus operators, drivers, or
    other transportation providers.
</p>
<p>
    Delays, cancellations, route changes, traffic conditions, weather,
    strikes, and other transportation-related circumstances may occur.
    Where applicable, the terms and conditions of the relevant
    transportation provider will also apply.
</p>

<h4>Travel Insurance</h4>
<p>
    We strongly recommend that travellers obtain suitable travel
    insurance before starting their journey. Travel insurance may help
    cover certain circumstances such as medical emergencies, trip
    cancellation, baggage loss, or travel delays, depending on the
    selected policy.
</p>
<p>
    IND Tour Adventure does not provide insurance coverage unless
    specifically stated in the booking details.
</p>

<h4>Traveller Responsibilities</h4>
<ul>
    <li>Provide accurate passenger and contact information.</li>
    <li>Follow the instructions and safety guidelines provided by tour operators and service providers.</li>
    <li>Respect local laws, customs, cultures, communities, and the environment.</li>
    <li>Arrive at the specified departure points on time.</li>
    <li>Take responsibility for personal belongings and travel documents.</li>
    <li>Inform us or the relevant service provider of any special requirements before travel.</li>
</ul>

<h4>Third-Party Services</h4>
<p>
    Certain services available through our platform may be provided by
    independent third parties. These may include hotels, airlines,
    transportation companies, restaurants, tour operators, guides,
    activity providers, and other travel partners.
</p>
<p>
    Third-party providers may have their own terms, conditions,
    policies, cancellation rules, and limitations. You agree to comply
    with the applicable terms of such providers when using their
    services.
</p>

<h4>Website Content &amp; Travel Information</h4>
<p>
    We make reasonable efforts to keep the information published on
    our website accurate and useful. However, destination information,
    opening hours, prices, transportation schedules, weather
    conditions, attractions, and other travel information may change
    without notice.
</p>
<p>
    Information provided on the website should be treated as general
    travel information and should be independently verified where
    necessary before making important travel decisions.
</p>

<h4>User Content</h4>
<p>
    If you submit reviews, comments, photographs, testimonials,
    feedback, or other content to IND Tour Adventure, you confirm that
    you have the necessary rights to submit that content.
</p>
<p>
    By submitting content, you grant IND Tour Adventure a
    non-exclusive, royalty-free right to use, reproduce, display, and
    publish the content for operating and promoting our Services,
    subject to applicable law.
</p>

<h4>Intellectual Property</h4>
<p>
    All content available on the website, including the IND Tour
    Adventure name, logo, text, graphics, photographs, videos,
    designs, layouts, icons, and other materials, is owned by or
    licensed to IND Tour Adventure and is protected by applicable
    intellectual property laws.
</p>
<p>
    You may not copy, reproduce, modify, distribute, publish, sell, or
    create derivative works from our website content without prior
    written permission.
</p>

<h4>Prohibited Use</h4>
<ul>
    <li>You may not use the website for any unlawful, fraudulent, or unauthorized purpose.</li>
    <li>You may not attempt to gain unauthorized access to our website, systems, or databases.</li>
    <li>You may not interfere with the security or operation of the website.</li>
    <li>You may not use automated tools, bots, crawlers, or scrapers to access or collect website content without permission.</li>
    <li>You may not impersonate another person or organization.</li>
    <li>You may not upload or transmit malicious code, viruses, or harmful material.</li>
</ul>

<h4>Safety &amp; Activities</h4>
<p>
    Certain tours and activities may involve physical activity,
    adventure, outdoor environments, water activities, trekking,
    wildlife encounters, or other inherent risks.
</p>
<p>
    Travellers should consider their personal health, fitness,
    experience, and ability before participating in any activity. You
    must follow all safety instructions provided by the relevant
    activity operator or guide.
</p>

<h4>Limitation of Liability</h4>
<p>
    To the maximum extent permitted by applicable law, IND Tour
    Adventure shall not be responsible for indirect, incidental,
    special, consequential, or unforeseeable losses arising from the
    use of our website or travel services.
</p>
<p>
    We are not responsible for delays, cancellations, losses,
    injuries, changes, or disruptions caused by circumstances beyond
    our reasonable control or by independent third-party service
    providers, subject to applicable law.
</p>

<h4>Force Majeure</h4>
<p>
    IND Tour Adventure shall not be responsible for delays,
    cancellations, or failures in performance caused by circumstances
    beyond our reasonable control, including natural disasters,
    extreme weather, pandemics, epidemics, government restrictions,
    political unrest, strikes, transportation disruptions, technical
    failures, or other unforeseen events.
</p>

<h4>Privacy</h4>
<p>
    Your use of our Services may involve the collection and processing
    of personal information. Such information will be handled in
    accordance with our Privacy Policy.
</p>

<h4>Changes to These Terms</h4>
<p>
    We may update or modify these Terms from time to time to reflect
    changes to our Services, business practices, or applicable laws.
    Updated Terms will be published on this page with a revised "Last
    updated" date.
</p>
<p>
    Your continued use of the website after changes are published
    constitutes acceptance of the updated Terms.
</p>

<h4>Suspension &amp; Termination</h4>
<p>
    We reserve the right to suspend or terminate access to our
    Services where necessary, including in cases of misuse, fraudulent
    activity, violation of these Terms, or where required by
    applicable law.
</p>

<h4>Governing Law &amp; Dispute Resolution</h4>
<p>
    These Terms shall be governed by and interpreted in accordance
    with the laws of India.
</p>
<p>
    Any dispute arising out of or relating to these Terms or the
    Services should first be resolved amicably between the parties.
    Where an amicable resolution cannot be reached, the dispute shall
    be subject to the jurisdiction of the competent courts in India,
    subject to applicable law.
</p>

<h4>Contact Us</h4>
<p>
    If you have any questions, concerns, or requests regarding these
    Terms &amp; Conditions, please contact IND Tour Adventure through
    the contact details provided on our website.
</p>
<p><strong>Website:</strong> IND Tour Adventure</p>
<p><strong>Email:</strong> info@indtouradventure.com</p>
HTML;
    }
}