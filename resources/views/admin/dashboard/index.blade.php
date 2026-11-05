@include('admin.top-header')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  /* ── Design Tokens ──────────────────────────────────────────── */
  :root {
    --bg: #f1f2f4;
    --surface: #ffffff;
    --border: #e3e5e8;
    --text-primary: #202223;
    --text-secondary: #6d7175;
    --text-hint: #8c9196;
    --accent: #303d89;
    /* Shopify indigo-navy */
    --accent-light: #f0f1fc;
    --green: #007a5e;
    --green-bg: #e3f1ec;
    --amber: #916a00;
    --amber-bg: #fff5cc;
    --blue: #0069d9;
    --blue-bg: #e8f2ff;
    --red: #b22222;
    --red-bg: #fce8e8;
    --teal: #0a7a72;
    --teal-bg: #e1f3f1;
    --purple: #6d28d9;
    --purple-bg: #ede9fe;
    --radius-sm: 8px;
    --radius-md: 12px;
    --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
    --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  }

  /* ── Reset for content area ─────────────────────────────────── */
  .content-area * {
    box-sizing: border-box;
  }

  .content-area {
    background: var(--bg);
    padding: 24px 28px;
    min-height: 100vh;
    font-family: var(--font);
    color: var(--text-primary);
  }

  /* ── Page header ────────────────────────────────────────────── */
  .dash-page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px;
  }

  .dash-page-header h1 {
    font-size: 20px;
    font-weight: 650;
    color: var(--text-primary) !important;
    margin: 0;
  }

  .dash-page-header .dash-meta {
    font-size: 13px;
    color: var(--text-secondary);
    margin-top: 2px;
  }

  .dash-date-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 7px 13px;
    font-size: 13px;
    font-weight: 500;
    color: var(--text-primary);
    cursor: pointer;
    box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
  }

  /* ── Surface card ───────────────────────────────────────────── */
  .cardx {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 20px;
    box-shadow: var(--shadow-card);
    height: 100%;
    transition: box-shadow .18s;
  }

  .cardx:hover {
    box-shadow: 0 3px 10px rgba(0, 0, 0, .1), 0 0 0 1px var(--border);
  }

  .cardx h1, .cardx h2, .cardx h3, .cardx h4, .cardx h5, .cardx h6,
  .cardx p, .cardx td, .cardx th, .cardx li {
    color: var(--text-primary) !important;
  }

  .cardx h5 {
    font-size: 13px;
    font-weight: 600;
    letter-spacing: .02em;
    text-transform: uppercase;
    color: var(--text-secondary) !important;
    margin-bottom: 16px;
  }

  .cardx .cardx-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
  }

  .cardx .cardx-head h5 { margin-bottom: 0; }

  .cardx-link {
    font-size: 12.5px;
    font-weight: 600;
    color: var(--accent);
    text-decoration: none;
  }

  .cardx-link:hover { text-decoration: underline; color: var(--accent); }

  /* ── KPI cards ──────────────────────────────────────────────── */
  .kpi-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 20px 20px 18px;
    box-shadow: var(--shadow-card);
    position: relative;
    height: 100%;
    transition: box-shadow .18s;
  }

  .kpi-card:hover {
    box-shadow: 0 3px 10px rgba(0, 0, 0, .1), 0 0 0 1px var(--border);
  }

  .kpi-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--text-secondary);
    margin-bottom: 6px;
    padding-right: 40px;
  }

  .kpi-value {
    font-size: 28px;
    font-weight: 700;
    color: var(--text-primary) !important;
    line-height: 1.1;
    margin-bottom: 10px;
  }

  .kpi-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 20px;
  }

  .kpi-badge.up { background: var(--green-bg); color: var(--green); }
  .kpi-badge.warn { background: var(--amber-bg); color: var(--amber); }
  .kpi-badge.info { background: var(--blue-bg); color: var(--blue); }
  .kpi-badge.flat { background: var(--bg); color: var(--text-secondary); }

  .kpi-icon {
    position: absolute;
    top: 18px;
    right: 18px;
    width: 36px;
    height: 36px;
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    opacity: .85;
  }

  .kpi-icon.purple { background: var(--purple-bg); color: var(--purple); }
  .kpi-icon.green { background: var(--green-bg); color: var(--green); }
  .kpi-icon.blue { background: var(--blue-bg); color: var(--blue); }
  .kpi-icon.amber { background: var(--amber-bg); color: var(--amber); }
  .kpi-icon.teal { background: var(--teal-bg); color: var(--teal); }
  .kpi-icon.red { background: var(--red-bg); color: var(--red); }

  .kpi-divider {
    height: 1px;
    background: var(--border);
    margin: 14px -20px;
  }

  .kpi-sub { font-size: 12px; color: var(--text-hint); }

  /* ── Revenue / greeting banner ──────────────────────────────── */
  .revenue-banner {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    padding: 22px 24px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    box-shadow: var(--shadow-card);
  }

  .revenue-banner .greet {
    font-size: 15px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 2px;
  }

  .revenue-banner .sub { font-size: 13px; color: var(--text-secondary); }

  .revenue-banner .rev-num { text-align: right; }

  .revenue-banner .rev-num span {
    font-size: 26px;
    font-weight: 700;
    color: var(--text-primary);
    display: block;
    line-height: 1.1;
  }

  .revenue-banner .rev-num small { font-size: 12px; color: var(--text-hint); }

  /* ── Progress bars ──────────────────────────────────────────── */
  .progress { height: 6px; border-radius: 10px; background: var(--bg); overflow: hidden; }
  .progress-bar { border-radius: 10px; }
  .progress-row { margin-bottom: 14px; }
  .progress-row:last-child { margin-bottom: 0; }
  .progress-label { display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 5px; }
  .progress-label span:first-child { color: var(--text-secondary); font-weight: 500; }
  .progress-label span:last-child { color: var(--text-primary); font-weight: 600; }

  /* ── Table ──────────────────────────────────────────────────── */
  .dash-table { width: 100%; border-collapse: collapse; font-size: 13px; }

  .dash-table thead th {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: var(--text-hint) !important;
    padding: 0 12px 10px;
    border-bottom: 1px solid var(--border);
    text-align: left;
    white-space: nowrap;
  }

  .dash-table tbody tr { border-bottom: 1px solid var(--bg); transition: background .12s; }
  .dash-table tbody tr:hover { background: var(--bg); }
  .dash-table tbody tr:last-child { border-bottom: none; }

  .dash-table tbody td {
    padding: 11px 12px;
    color: var(--text-primary) !important;
    vertical-align: middle;
  }

  .dash-table .cust-name { font-weight: 600; }
  .dash-table .cust-sub { font-size: 12px; color: var(--text-hint); }

  .table-scroll { overflow-x: auto; }

  .empty-row td {
    text-align: center;
    padding: 28px 12px !important;
    color: var(--text-hint) !important;
    font-size: 13px;
  }

  /* ── Status / source badges ────────────────────────────────── */
  .status-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11.5px;
    font-weight: 600;
    padding: 3px 9px;
    border-radius: 20px;
    white-space: nowrap;
  }

  .status-pill::before { content: ''; width: 5px; height: 5px; border-radius: 50%; display: inline-block; }

  .status-pill.new { background: var(--blue-bg); color: var(--blue); }
  .status-pill.new::before { background: var(--blue); }
  .status-pill.contacted { background: var(--amber-bg); color: var(--amber); }
  .status-pill.contacted::before { background: var(--amber); }
  .status-pill.converted { background: var(--green-bg); color: var(--green); }
  .status-pill.converted::before { background: var(--green); }
  .status-pill.lost { background: var(--red-bg); color: var(--red); }
  .status-pill.lost::before { background: var(--red); }

  .src-tag {
    font-size: 11.5px;
    font-weight: 600;
    padding: 3px 9px;
    border-radius: 6px;
    background: var(--bg);
    color: var(--text-secondary);
  }

  /* ── Range tabs (Today | 7D | 15D | 30D) ─────────────────────── */
  .range-tabs {
    display: inline-flex;
    background: var(--bg);
    border-radius: var(--radius-sm);
    padding: 3px;
    gap: 2px;
  }

  .range-tabs button {
    border: none;
    background: transparent;
    font-size: 12.5px;
    font-weight: 600;
    color: var(--text-secondary);
    padding: 6px 13px;
    border-radius: 7px;
    cursor: pointer;
    transition: all .15s;
  }

  .range-tabs button.active {
    background: var(--surface);
    color: var(--accent);
    box-shadow: 0 1px 2px rgba(0, 0, 0, .08);
  }

  .range-tab-pane { display: none; }
  .range-tab-pane.active { display: block; }

  /* ── Ranked list (top packages / destinations) ────────────────── */
  .rank-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid var(--bg);
    font-size: 13px;
  }

  .rank-item:last-child { border-bottom: none; }

  .rank-item .rank {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background: var(--bg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    color: var(--text-secondary);
    flex-shrink: 0;
    margin-right: 10px;
  }

  .rank-item .rname { flex: 1; font-weight: 500; color: var(--text-primary); }
  .rank-item .rname small { display: block; font-weight: 400; font-size: 11.5px; color: var(--text-hint); }

  .rank-item .rqty {
    font-size: 13px;
    font-weight: 700;
    color: var(--text-primary);
    background: var(--bg);
    padding: 2px 8px;
    border-radius: 6px;
  }

  /* ── Section label ──────────────────────────────────────────── */
  .section-label { font-size: 16px; font-weight: 650; color: var(--text-primary); margin-bottom: 14px; }

  /* ── Chart wrapper ──────────────────────────────────────────── */
  .chart-wrap { position: relative; height: 220px; }
  .chart-wrap.sm { height: 190px; }

  @media (max-width: 768px) {
    .content-area { padding: 16px; }
    .revenue-banner { padding: 16px; }
    .kpi-value { font-size: 24px; }
  }
</style>

<div class="main-section">
  @include('admin.header')

  <div class="container-fluid">
    <div class="content-area">

      <!-- Page header -->
      <div class="dash-page-header">
        <div>
          <h1>Overview</h1>
          <div class="dash-meta">Welcome back, {{ auth()->user()->name }}</div>
        </div>
        <div class="dash-date-badge">
          <i class="fa fa-calendar-alt" style="color:var(--text-hint)"></i>
          {{ now()->format('jS M, Y') }}
          <i class="fa fa-chevron-down" style="font-size:10px;color:var(--text-hint)"></i>
        </div>
      </div>

      <!-- Greeting / this month enquiries banner -->
      <div class="revenue-banner">
        <div>
          <div class="greet">Enquiries this month</div>
          <div class="sub">{{ $enquiriesThisMonth ?? 0 }} new leads across {{ $activePackagesCount ?? 0 }} active packages</div>
        </div>
        <div class="rev-num">
          <span>{{ $enquiriesThisMonth ?? 0 }}</span>
          <small>
            @if(($enquiryGrowthPercent ?? 0) >= 0)
              <span style="color:var(--green)">▲ {{ $enquiryGrowthPercent ?? 0 }}%</span>
            @else
              <span style="color:var(--red)">▼ {{ abs($enquiryGrowthPercent ?? 0) }}%</span>
            @endif
            vs last month
          </small>
        </div>
      </div>

      <!-- KPI Summary Cards -->
      <div class="row g-3 mb-3">
        <div class="col-6 col-md-4 col-xl-2-4" style="flex:0 0 20%; max-width:20%;">
          <div class="kpi-card">
            <div class="kpi-icon purple"><i class="fa fa-map-marker-alt"></i></div>
            <div class="kpi-label">Destinations</div>
            <div class="kpi-value">{{ $destinationsCount ?? 0 }}</div>
            <span class="kpi-badge flat">{{ $activeDestinationsCount ?? 0 }} active</span>
          </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2-4" style="flex:0 0 20%; max-width:20%;">
          <div class="kpi-card">
            <div class="kpi-icon teal"><i class="fa fa-mountain"></i></div>
            <div class="kpi-label">Attractions</div>
            <div class="kpi-value">{{ $attractionsCount ?? 0 }}</div>
            <span class="kpi-badge flat">across all destinations</span>
          </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2-4" style="flex:0 0 20%; max-width:20%;">
          <div class="kpi-card">
            <div class="kpi-icon amber"><i class="fa fa-person-hiking"></i></div>
            <div class="kpi-label">Activities</div>
            <div class="kpi-value">{{ $activitiesCount ?? 0 }}</div>
            <span class="kpi-badge flat">{{ $activeActivitiesCount ?? 0 }} active</span>
          </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2-4" style="flex:0 0 20%; max-width:20%;">
          <div class="kpi-card">
            <div class="kpi-icon blue"><i class="fa fa-suitcase-rolling"></i></div>
            <div class="kpi-label">Tour Packages</div>
            <div class="kpi-value">{{ $packagesCount ?? 0 }}</div>
            <span class="kpi-badge up"><i class="fa fa-arrow-up"></i> {{ $newPackagesThisMonth ?? 0 }} new</span>
          </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2-4" style="flex:0 0 20%; max-width:20%;">
          <div class="kpi-card">
            <div class="kpi-icon green"><i class="fa fa-envelope-open-text"></i></div>
            <div class="kpi-label">Enquiries</div>
            <div class="kpi-value">{{ $enquiriesCount ?? 0 }}</div>
            <span class="kpi-badge warn">{{ $pendingEnquiriesCount ?? 0 }} pending reply</span>
          </div>
        </div>
      </div>
       <!-- Recent Enquiries with range tabs -->
      <div class="cardx mb-3">
        <div class="cardx-head" style="flex-wrap:wrap;gap:10px;">
          <h5 style="margin-bottom:0;">Recent Enquiries</h5>
          <div class="range-tabs" id="enquiryRangeTabs">
            <button type="button" class="active" data-range="today">Today</button>
            <button type="button" data-range="7d">7 Days</button>
            <button type="button" data-range="15d">15 Days</button>
            <button type="button" data-range="30d">30 Days</button>
          </div>
        </div>

        @foreach(['today','7d','15d','30d'] as $range)
        <div class="range-tab-pane {{ $loop->first ? 'active' : '' }}" data-range-pane="{{ $range }}">
          <div class="table-scroll">
            <table class="dash-table">
              <thead>
                <tr>
                  <th>Customer</th>
                  <th>Package</th>
                  <th>Destination</th>
                  <th>Travel Date</th>
                  <th>Pax</th>
                  <th>Source</th>
                  <th>Status</th>
                  <th>Received</th>
                </tr>
              </thead>
              <tbody>
                @forelse(($enquiriesByRange[$range] ?? []) as $enq)
                <tr>
                  <td>
                    <div class="cust-name">{{ $enq->name }}</div>
                    <div class="cust-sub">{{ $enq->phone }}</div>
                  </td>
                  <td>{{ $enq->package_title }}</td>
                  <td>{{ $enq->destination_name }}</td>
                  <td>{{ $enq->travel_date ? \Carbon\Carbon::parse($enq->travel_date)->format('d M, Y') : '—' }}</td>
                  <td>{{ $enq->pax ?? '—' }}</td>
                  <td><span class="src-tag">{{ $enq->source ?? 'Website' }}</span></td>
                  <td><span class="status-pill {{ strtolower($enq->status ?? 'new') }}">{{ ucfirst($enq->status ?? 'New') }}</span></td>
                  <td style="color:var(--text-hint)">{{ $enq->created_at ? $enq->created_at->diffForHumans() : '—' }}</td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="8">No enquiries in this range</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Analytics row: trend + response status -->
      <div class="row g-3 mb-3">
        <div class="col-lg-8">
          <div class="cardx">
            <div class="cardx-head">
              <h5>Enquiries Trend</h5>
              <a href="#" class="cardx-link">View report</a>
            </div>
            <div class="chart-wrap">
              <canvas id="enquiryTrendChart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="cardx">
            <h5>Response Status</h5>
            <div class="chart-wrap sm">
              <canvas id="responseStatusChart"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Top packages + top destinations -->
      <div class="row g-3 mb-3">
        <div class="col-lg-6">
          <div class="cardx">
            <div class="cardx-head">
              <h5>Most Enquired Packages</h5>
              <a href="{{ url('admin/packages') }}" class="cardx-link">View all</a>
            </div>
            @forelse($topPackages ?? [] as $i => $pkg)
              <div class="rank-item">
                <div style="display:flex;align-items:center;flex:1;">
                  <div class="rank">{{ $i + 1 }}</div>
                  <div class="rname">
                    {{ $pkg->title }}
                    <small>{{ $pkg->destination_name ?? '' }}</small>
                  </div>
                </div>
                <div class="rqty">{{ $pkg->enquiries_count }} enq</div>
              </div>
            @empty
              <div class="rank-item"><div class="rname" style="color:var(--text-hint)">No enquiry data yet</div></div>
            @endforelse
          </div>
        </div>
        <div class="col-lg-6">
          <div class="cardx">
            <h5>Enquiries by Destination</h5>
            @forelse($topDestinations ?? [] as $dest)
              <div class="progress-row">
                <div class="progress-label">
                  <span>{{ $dest->name }}</span>
                  <span>{{ $dest->enquiries_count }}</span>
                </div>
                <div class="progress">
                  <div class="progress-bar" style="width: {{ $dest->percent ?? 0 }}%; background: var(--accent);"></div>
                </div>
              </div>
            @empty
              <div style="color:var(--text-hint);font-size:13px;">No destination data yet</div>
            @endforelse
          </div>
        </div>
      </div>

     

    </div><!-- /content-area -->
  </div><!-- /container-fluid -->
</div><!-- /main-section -->

<script>
  // ── Range tabs: show/hide table panes ──────────────────────────
  document.addEventListener('DOMContentLoaded', function () {
    var tabWrap = document.getElementById('enquiryRangeTabs');
    if (tabWrap) {
      tabWrap.addEventListener('click', function (e) {
        var btn = e.target.closest('button[data-range]');
        if (!btn) return;
        tabWrap.querySelectorAll('button').forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        var range = btn.getAttribute('data-range');
        document.querySelectorAll('[data-range-pane]').forEach(function (pane) {
          pane.classList.toggle('active', pane.getAttribute('data-range-pane') === range);
        });
      });
    }

    // ── Enquiries Trend chart ─────────────────────────────────────
    var trendCtx = document.getElementById('enquiryTrendChart');
    if (trendCtx) {
      new Chart(trendCtx, {
        type: 'line',
        data: {
          labels: {!! json_encode($enquiryTrendLabels ?? []) !!},
          datasets: [{
            label: 'Enquiries',
            data: {!! json_encode($enquiryTrendData ?? []) !!},
            borderColor: '#303d89',
            backgroundColor: 'rgba(48,61,137,0.08)',
            borderWidth: 2,
            tension: 0.35,
            fill: true,
            pointRadius: 0,
            pointHoverRadius: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { display: false } },
          scales: {
            x: { grid: { display: false } },
            y: { beginAtZero: true, grid: { color: '#f1f2f4' } }
          }
        }
      });
    }

    // ── Response Status doughnut ────────────────────────────────
    var statusCtx = document.getElementById('responseStatusChart');
    if (statusCtx) {
      new Chart(statusCtx, {
        type: 'doughnut',
        data: {
          labels: {!! json_encode($responseStatusLabels ?? ['New', 'Contacted', 'Converted', 'Lost']) !!},
          datasets: [{
            data: {!! json_encode($responseStatusData ?? [0, 0, 0, 0]) !!},
            backgroundColor: ['#0069d9', '#916a00', '#007a5e', '#b22222'],
            borderWidth: 0
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '68%',
          plugins: { legend: { position: 'bottom', labels: { boxWidth: 8, font: { size: 11 } } } }
        }
      });
    }
  });
</script>

@include('admin.footer')