
<!-- {{ $heading }} CATEGORIES -->
<section class="activities-categories">
  <div class="container">
    <ul class="tab-nav" data-tab-group="{{ $tabPrefix }}">
      <li class="active" data-tab="{{ $tabPrefix }}-all">All Activities</li>
      @foreach($categories as $category)
        <li data-tab="{{ $tabPrefix }}-{{ $category->slug }}">{{ $category->name }}</li>
      @endforeach
    </ul>
  </div>
</section>

<!-- {{ $heading }} LISTING -->
<section class="activities-listing" id="{{ $sectionId }}">
  <div class="container">
    <div class="activities-listing-head">
      <div class="head-left">
        <span class="eyebrow">{{ $eyebrow }}</span>
        <h2>{{ $heading }}</h2>
        <p>
          Explore handpicked experiences and exciting things to do during
          your trip.
        </p>
      </div>

      <div class="head-right">
        <span class="results-count">{{ $activities->count() }} Activities</span>
      </div>
    </div>

    <div class="tab-nav-content" data-tab-group="{{ $tabPrefix }}">

      {{-- ==================== ALL ==================== --}}
      <div class="tabs active" data-tab="{{ $tabPrefix }}-all">
        <div class="activities-grid">
          @forelse($activities as $activity)
            @include('front-pages.partials.activity-card', ['activity' => $activity])
          @empty
            <p>No activities available right now.</p>
          @endforelse
        </div>
      </div>

      {{-- ==================== ONE PER CATEGORY ==================== --}}
      @foreach($categories as $category)
        <div class="tabs" data-tab="{{ $tabPrefix }}-{{ $category->slug }}">
          <div class="activities-grid">
            @php
                $categoryActivities = $activities->where('activity_category_id', $category->id);
            @endphp

            @forelse($categoryActivities as $activity)
              @include('front-pages.partials.activity-card', ['activity' => $activity])
            @empty
              <p>No activities available in this category yet.</p>
            @endforelse
          </div>
        </div>
      @endforeach

    </div>
  </div>
</section>