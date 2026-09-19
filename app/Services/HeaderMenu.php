<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\Category;
use App\Models\Country;
use App\Models\Destination;
use App\Models\SubCategory;
use App\Models\TourPackage;
use Illuminate\Support\Collection;

class HeaderMenu
{
    private const ITEM_LIMIT = 12;

    private ?int $indiaId = null;

    /**
     * India / International panels.
     * $scope = 'india'          -> only Indian destinations & packages
     * $scope = 'international'  -> only non-India destinations & packages
     *
     * Returns a list of ['title' => string, 'items' => Collection<{label, url}>]
     */
    public function forScope(string $scope): Collection
    {
        $flagged = $this->categoryGroups($scope)
            ->concat($this->subCategoryGroups($scope))
            ->sortBy('sort');

        return collect([
            [
                'title' => 'Popular Destinations',
                'items' => $this->destinations($scope),
            ],
        ])
            ->concat($flagged)
            ->filter(fn($g) => $g['items']->isNotEmpty())   // hide empty accordions
            ->values();
    }

    /**
     * Activities panel: flagged Activity Categories, each with its activities.
     */
    public function activities(): Collection
    {
        return ActivityCategory::inHeader()
            ->get(['id', 'name', 'header_sort_order'])
            ->map(fn($c) => [
                'title' => $c->name,
                'items' => Activity::where('status', 'published')
                    ->where('activity_category_id', $c->id)
                    ->orderByDesc('featured')
                    ->orderBy('sort_order')
                    ->orderBy('name')
                    ->limit(self::ITEM_LIMIT)
                    ->get(['id', 'name', 'slug'])
                    ->map(fn($a) => (object) [
                        'label' => $a->name,
                        'url'   => url('/activities/' . $a->slug),   // <-- change to your activity page URL/route
                    ]),
            ])
            ->filter(fn($g) => $g['items']->isNotEmpty())
            ->values();
    }

    // ---------------------------------------------------------------------

    private function destinations(string $scope): Collection
    {
        $query = Destination::published()->where('is_featured', true);

        return $this->applyCountryScope($query, $scope)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->limit(self::ITEM_LIMIT)
            ->get(['id', 'name', 'slug'])
            ->map(fn($d) => (object) [
                'label' => $d->name,
                'url'   => url('/destination/' . $d->slug),   // <-- change to your destination page URL/route
            ]);
    }

    private function categoryGroups(string $scope): Collection
    {
        return Category::inHeader()
            ->get(['id', 'name', 'menu_name', 'header_sort_order'])
            ->map(fn($c) => [
                'sort'  => $c->header_sort_order,
                'title' => $c->menu_name ?: $c->name,
                'items' => $this->packages(
                    $scope,
                    fn($q) => $q->whereHas('subCategory', fn($s) => $s->where('category_id', $c->id))
                ),
            ]);
    }

    private function subCategoryGroups(string $scope): Collection
    {
        return SubCategory::inHeader()
            ->get(['id', 'name', 'header_sort_order'])
            ->map(fn($s) => [
                'sort'  => $s->header_sort_order,
                'title' => $s->name,
                'items' => $this->packages($scope, fn($q) => $q->where('sub_category_id', $s->id)),
            ]);
    }

    private function packages(string $scope, \Closure $constraint): Collection
    {
        $query = TourPackage::where('status', 'published');
        $constraint($query);
        return $this->applyCountryScope($query, $scope)
            ->orderByDesc('featured')
            ->latest()
            ->limit(self::ITEM_LIMIT)
            ->get(['id', 'name', 'slug'])
            ->map(fn($p) => (object) [
                'label' => $p->name,
                'url'   => url('/tour-package/' . $p->slug),
            ]);
    }

    // India vs International, decided by the record's country
    private function applyCountryScope($query, string $scope)
    {
        $indiaId = $this->indiaId();
        if ($scope === 'india') {
            return $indiaId ? $query->where('country_id', $indiaId) : $query->whereRaw('1 = 0');
        }

        // international: has a country, and it isn't India
        $query->whereNotNull('country_id');

           
        return $indiaId ? $query->where('country_id', '!=', $indiaId) : $query;
    }

    private function indiaId(): ?int
    {
        return $this->indiaId ??= Country::where('name', 'India')->value('id');
    }
}