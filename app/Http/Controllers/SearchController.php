<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Category;
use App\Models\Destination;
use App\Models\SubCategory;
use App\Models\TourPackage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private const PER_PAGE = 6;

    // hotels table column that holds the star rating (3/4/5)
    private const HOTEL_STAR_COLUMN = 'star_rating';

    private const MEALS = [
        'breakfast' => ['label' => 'Breakfast', 'flags' => ['breakfast_included']],
        'lunch' => ['label' => 'Lunch', 'flags' => ['lunch_included']],
        'breakfast-dinner' => ['label' => 'Breakfast + Dinner', 'flags' => ['breakfast_included', 'dinner_included']],
        'all-meals' => ['label' => 'All Meals', 'flags' => ['breakfast_included', 'lunch_included', 'dinner_included']],
    ];

    /**
     * GET /search
     * ?q=&type=tour|activity&duration=2-3,4-5&destination=1,2&stars=4,5&meals=&rating=
     *  &category=1,2&sub_category=3,4&activity_category=5,6&min_price=&max_price=&sort=&page=
     * Multi-value params accept both CSV (header panel) and arrays (sidebar form).
     */
    public function index(Request $request)
    {
        $type = $this->resolveType($request);

        $query = $this->buildQuery($type, $request);
        $this->applySort($query, $type, (string) $request->input('sort', 'recommended'));

        $results = $query->paginate(self::PER_PAGE)->withQueryString();

        $counts = [
            'tour' => $this->buildQuery('tour', $request)->count(),
            'activity' => $this->buildQuery('activity', $request)->count(),
        ];

        $selected = [
            'duration' => $this->csv($request, 'duration'),
            'destination' => $this->csv($request, 'destination'),
            'stars' => array_values(array_intersect($this->csv($request, 'stars'), ['3', '4', '5'])),
            'meals' => array_key_exists((string) $request->input('meals'), self::MEALS) ? (string) $request->input('meals') : '',
            'rating' => in_array($request->input('rating'), ['4plus', '3plus'], true) ? $request->input('rating') : '',
            'category' => $this->csv($request, 'category'),
            'subCategory' => $this->csv($request, 'sub_category'),
            'activityCategory' => $this->csv($request, 'activity_category'),
        ];

        $destinations = $type === 'tour'
            ? Destination::whereHas('tourPackages', fn($q) => $q->where('status', 'published'))
                ->orderBy('name')->get(['id', 'name'])
            : collect();

        $categories = $type === 'tour'
            ? Category::with(['subCategories' => function ($q) {
                    $q->whereHas('tourPackages', fn($t) => $t->where('status', 'published'))->orderBy('name');
                }])
                ->whereHas('subCategories.tourPackages', fn($t) => $t->where('status', 'published'))
                ->orderBy('name')->get(['id', 'name'])
            : collect();

        $activityCategories = $type === 'activity'
            ? ActivityCategory::whereHas('activities', fn($a) => $a->where('status', 'published'))
                ->orderBy('name')->get(['id', 'name'])
            : collect();

        $priceMin = (int) config('search.price.min');
        $priceMax = (int) config('search.price.max');

        return view('front-pages.search-result', [
            'type' => $type,
            'results' => $results,
            'counts' => $counts,
            'selected' => $selected,
            'destinations' => $destinations,
            'categories' => $categories,
            'activityCategories' => $activityCategories,
            'durations' => collect(config('search.durations'))->filter(fn($d) => in_array($type, $d['types'], true)),
            'meals' => self::MEALS,
            'priceMin' => $priceMin,
            'priceMax' => $priceMax,
            'currentMin' => max($priceMin, (int) $request->input('min_price', $priceMin)),
            'currentMax' => min($priceMax, (int) $request->input('max_price', $priceMax)) ?: $priceMax,
            'sort' => (string) $request->input('sort', 'recommended'),
            'q' => trim((string) $request->input('q')),
            'chips' => $this->chips($request, $type, $selected, $priceMin, $priceMax),
            'resetUrl' => $request->url() . '?' . http_build_query(array_filter([
                'type' => $type,
                'q' => $request->input('q'),
            ])),
        ]);
    }

    // ---------------------------------------------------------------------

    /** Accepts "a,b,c" or ['a','b','c'] and returns a clean array of strings. */
    private function csv(Request $request, string $key): array
    {
        $value = $request->input($key);
        $list = is_array($value) ? $value : explode(',', (string) $value);

        return array_values(array_filter(array_map('trim', $list), fn($v) => $v !== ''));
    }

    private function resolveType(Request $request): string
    {
        $type = strtolower($this->csv($request, 'type')[0] ?? 'tour');

        return array_key_exists($type, config('search.product_types')) ? $type : 'tour';
    }

    private function buildQuery(string $type, Request $request): Builder
    {
        return $type === 'activity'
            ? $this->activityQuery($request)
            : $this->tourQuery($request);
    }

    private function tourQuery(Request $request): Builder
    {
        $query = TourPackage::query()
            ->with(['country', 'state', 'city', 'highlights', 'hotelStays.hotel', 'subCategory.category'])
            ->where('status', 'published');

        if ($q = trim((string) $request->input('q'))) {
            $like = '%' . $q . '%';

            $query->where(function (Builder $w) use ($like) {
                $w->where('name', 'like', $like)
                    ->orWhereHas('city', fn($c) => $c->where('name', 'like', $like))
                    ->orWhereHas('state', fn($s) => $s->where('name', 'like', $like))
                    ->orWhereHas('country', fn($c) => $c->where('name', 'like', $like))
                    ->orWhereHas('destinations', fn($d) => $d->where('name', 'like', $like));
            });
        }

        if ($ids = array_filter($this->csv($request, 'destination'), 'ctype_digit')) {
            $query->whereHas('destinations', fn($d) => $d->whereIn('destinations.id', $ids));
        }

        // Top-level category filter cascades down to every sub-category under it.
        if ($categoryIds = array_filter($this->csv($request, 'category'), 'ctype_digit')) {
            $query->whereHas('subCategory', fn($s) => $s->whereIn('category_id', $categoryIds));
        }

        if ($subCategoryIds = array_filter($this->csv($request, 'sub_category'), 'ctype_digit')) {
            $query->whereIn('sub_category_id', $subCategoryIds);
        }

        if ($stars = array_intersect($this->csv($request, 'stars'), ['3', '4', '5'])) {
            $query->whereHas('hotelStays.hotel', fn($h) => $h->whereIn(self::HOTEL_STAR_COLUMN, $stars));
        }

        if ($flags = self::MEALS[$request->input('meals')]['flags'] ?? null) {
            $query->whereHas('hotelStays', function (Builder $s) use ($flags) {
                foreach ($flags as $column) {
                    $s->where($column, true);
                }
            });
        }

        if ($request->input('rating') === '4plus') {
            $query->where('rating', '>=', 4);
        } elseif ($request->input('rating') === '3plus') {
            $query->where('rating', '>=', 3);
        }

        $this->applyDuration($query, 'tour', 'duration_days', 1, $request);
        $this->applyPrice($query, 'price', $request);

        return $query;
    }

    private function activityQuery(Request $request): Builder
    {
        $query = Activity::query()
            ->with(['country', 'state', 'city', 'category'])
            ->where('status', 'published');

        if ($q = trim((string) $request->input('q'))) {
            $like = '%' . $q . '%';

            $query->where(function (Builder $w) use ($like) {
                $w->where('name', 'like', $like)
                    ->orWhere('location_label', 'like', $like)
                    ->orWhereHas('city', fn($c) => $c->where('name', 'like', $like))
                    ->orWhereHas('state', fn($s) => $s->where('name', 'like', $like))
                    ->orWhereHas('country', fn($c) => $c->where('name', 'like', $like));
            });
        }

        if ($categoryIds = array_filter($this->csv($request, 'activity_category'), 'ctype_digit')) {
            $query->whereIn('activity_category_id', $categoryIds);
        }

        if ($request->input('rating') === '4plus') {
            $query->where('rating', '>=', 4);
        } elseif ($request->input('rating') === '3plus') {
            $query->where('rating', '>=', 3);
        }

        $this->applyDuration($query, 'activity', 'duration_hours', 24, $request);
        $this->applyPrice($query, 'starting_price', $request);

        return $query;
    }

    /**
     * Only buckets that apply to the current product type are used, so a
     * tour-only bucket (e.g. 4-5 days) never leaks into the activity results/count.
     */
    private function applyDuration(Builder $query, string $type, string $column, int $factor, Request $request): void
    {
        $buckets = collect($this->csv($request, 'duration'))
            ->map(fn($key) => config('search.durations.' . $key))
            ->filter(fn($b) => $b && in_array($type, $b['types'], true));

        if ($buckets->isEmpty()) {
            return;
        }

        $query->where(function (Builder $w) use ($buckets, $column, $factor) {
            foreach ($buckets as $bucket) {
                $w->orWhere(function (Builder $range) use ($bucket, $column, $factor) {
                    $range->where($column, '>=', $bucket['min'] * $factor);

                    if ($bucket['max'] !== null) {
                        $range->where($column, '<=', $bucket['max'] * $factor);
                    }
                });
            }
        });
    }

    private function applyPrice(Builder $query, string $column, Request $request): void
    {
        $min = (int) $request->input('min_price', 0);
        $max = (int) $request->input('max_price', 0);
        $ceiling = (int) config('search.price.max');

        if ($min > 0) {
            $query->where($column, '>=', $min);
        }

        if ($max > 0 && $max < $ceiling) {
            $query->where($column, '<=', $max);
        }
    }

    private function applySort(Builder $query, string $type, string $sort): void
    {
        $price = $type === 'activity' ? 'starting_price' : 'price';
        $duration = $type === 'activity' ? 'duration_hours' : 'duration_days';

        switch ($sort) {
            case 'price-low':
                $query->orderByRaw("{$price} IS NULL")->orderBy($price);
                break;

            case 'price-high':
                $query->orderByDesc($price);
                break;

            case 'duration':
                $query->orderByRaw("{$duration} IS NULL")->orderBy($duration);
                break;

            case 'rating':
                $query->orderByRaw('rating IS NULL')->orderByDesc('rating')->orderByDesc('review_count');
                break;

            default: // recommended
                $query->orderByDesc('featured')->latest('id');
        }
    }

    /**
     * Active filter chips. Each chip carries the URL that removes only that filter.
     */
    private function chips(Request $request, string $type, array $selected, int $priceMin, int $priceMax): array
    {
        $base = $request->except('page');

        $url = function (array $params) use ($request) {
            return $request->url() . ($params ? '?' . http_build_query($params) : '');
        };

        $withoutValue = function (string $key, string $value) use ($base, $url, $request) {
            $params = $base;
            $left = array_values(array_diff($this->csv($request, $key), [$value]));
            $left ? $params[$key] = $left : $params = array_diff_key($params, [$key => 1]);

            return $url($params);
        };

        $without = fn(array $keys) => $url(array_diff_key($base, array_flip($keys)));

        $chips = [];

        if ($q = trim((string) $request->input('q'))) {
            $chips[] = ['label' => '"' . $q . '"', 'url' => $without(['q'])];
        }

        foreach ($selected['duration'] as $key) {
            $bucket = config('search.durations.' . $key);
            if ($bucket && in_array($type, $bucket['types'], true)) {
                $chips[] = ['label' => $bucket['label'], 'url' => $withoutValue('duration', $key)];
            }
        }

        if ($type === 'tour') {
            $names = Destination::whereIn('id', array_filter($selected['destination'], 'ctype_digit'))->pluck('name', 'id');
            foreach ($names as $id => $name) {
                $chips[] = ['label' => $name, 'url' => $withoutValue('destination', (string) $id)];
            }

            $categoryNames = Category::whereIn('id', array_filter($selected['category'], 'ctype_digit'))->pluck('name', 'id');
            foreach ($categoryNames as $id => $name) {
                $chips[] = ['label' => $name, 'url' => $withoutValue('category', (string) $id)];
            }

            $subCategoryNames = SubCategory::whereIn('id', array_filter($selected['subCategory'], 'ctype_digit'))->pluck('name', 'id');
            foreach ($subCategoryNames as $id => $name) {
                $chips[] = ['label' => $name, 'url' => $withoutValue('sub_category', (string) $id)];
            }

            foreach ($selected['stars'] as $star) {
                $chips[] = ['label' => $star . ' Star', 'url' => $withoutValue('stars', $star)];
            }

            if ($selected['meals']) {
                $chips[] = ['label' => self::MEALS[$selected['meals']]['label'], 'url' => $without(['meals'])];
            }
        }

        if ($type === 'activity') {
            $activityCategoryNames = ActivityCategory::whereIn('id', array_filter($selected['activityCategory'], 'ctype_digit'))->pluck('name', 'id');
            foreach ($activityCategoryNames as $id => $name) {
                $chips[] = ['label' => $name, 'url' => $withoutValue('activity_category', (string) $id)];
            }
        }

        if ($selected['rating']) {
            $chips[] = [
                'label' => $selected['rating'] === '4plus' ? '4★ & above' : '3★ & above',
                'url' => $without(['rating']),
            ];
        }

        $min = (int) $request->input('min_price', $priceMin);
        $max = (int) $request->input('max_price', $priceMax);
        if ($min > $priceMin || ($max > 0 && $max < $priceMax)) {
            $chips[] = [
                'label' => '₹' . number_format($min) . ' – ' . ($max < $priceMax ? '₹' . number_format($max) : '₹' . number_format($priceMax) . '+'),
                'url' => $without(['min_price', 'max_price']),
            ];
        }

        return $chips;
    }
}