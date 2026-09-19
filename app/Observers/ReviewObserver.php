<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Review;
use App\Models\TourPackage;

// Keeps rating / review_count in sync with published reviews,
// for any reviewable model that knows how to refresh itself.
class ReviewObserver
{
    public function saved(Review $review): void
    {
        $this->refresh($review);
    }

    public function deleted(Review $review): void
    {
        $this->refresh($review);
    }

    private function refresh(Review $review): void
    {
        $reviewable = $review->reviewable;

        if ($reviewable instanceof Activity || $reviewable instanceof TourPackage) {
            $reviewable->refreshRating();
        }
    }
}