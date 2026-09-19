<?php

// config/search.php
// Single source of truth for the header search panel now, and for the
// results page filters + query later.

return [

    'product_types' => [
        'tour'     => 'Tour',
        'activity' => 'Activity',
    ],

    // Non-overlapping day buckets. min/max are inclusive, max = null means no upper limit.
    // 'types' = which product types the bucket applies to.
    'durations' => [
        '1'     => ['label' => 'Upto 1 Day',  'min' => 0, 'max' => 1,    'types' => ['tour', 'activity']],
        '2-3'   => ['label' => '2 to 3 Days', 'min' => 2, 'max' => 3,    'types' => ['tour']],
        '4-5'   => ['label' => '4 to 5 Days', 'min' => 4, 'max' => 5,    'types' => ['tour']],
        '6-7'   => ['label' => '6 to 7 Days', 'min' => 6, 'max' => 7,    'types' => ['tour']],
        '8plus' => ['label' => '8+ Days',     'min' => 8, 'max' => null, 'types' => ['tour']],
    ],

    'price' => [
        'min' => 0,
        'max' => 500000,
    ],

    // Activity duration units (admin form)
    'duration_units' => [
        'minutes' => 'Minutes',
        'hours'   => 'Hours',
        'days'    => 'Days',
    ],

    // Free-cancellation windows (hours) for activities
    'cancellation_hours' => [24, 48, 72],

    // Options for the "Price Unit" dropdown on tour packages and activities
    'price_units' => [
        'Per Person',
        'Per Adult',
        'Per Couple',
        'Per Child',
        'Per Group',
    ],

];