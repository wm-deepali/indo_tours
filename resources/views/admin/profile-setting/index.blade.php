@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <style>
        :root {
            --bg: #f1f2f4;
            --surface: #ffffff;
            --border: #e3e5e8;
            --text-primary: #202223;
            --text-secondary: #6d7175;
            --text-hint: #8c9196;
            --accent: #303d89;
            --accent-light: #f0f1fc;
            --radius-sm: 8px;
            --radius-md: 12px;
            --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
            --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        .cat-page {
            background: var(--bg);
            padding: 24px 28px;
            min-height: 100vh;
            font-family: var(--font);
            color: var(--text-primary);
            box-sizing: border-box;
        }

        .cat-page * {
            box-sizing: border-box;
        }

        .cat-page-header {
            margin-bottom: 20px;
        }

        .cat-page-header h1 {
            font-size: 20px;
            font-weight: 650;
            margin: 0;
        }

        .cat-page-header p {
            font-size: 13px;
            color: var(--text-secondary);
            margin: 4px 0 0;
        }

        .cat-breadcrumb {
            font-size: 12.5px;
            color: var(--text-hint);
            margin-bottom: 6px;
        }

        .cat-breadcrumb a {
            color: var(--accent);
            text-decoration: none;
        }

        .cat-breadcrumb a:hover {
            text-decoration: underline;
        }

        .cat-breadcrumb span {
            margin: 0 5px;
        }

        .cat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-card);
            max-width: 640px;
            overflow: hidden;
        }

        .cat-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cat-card-header .icon-badge {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--accent-light);
            color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cat-card-header strong {
            font-size: 14px;
            display: block;
        }

        .cat-card-header span {
            font-size: 12px;
            color: var(--text-hint);
        }

        .cat-card-body {
            padding: 24px;
        }

        .form-field {
            margin-bottom: 18px;
        }

        .form-field label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
            letter-spacing: .02em;
        }

        .form-field .hint {
            font-size: 11.5px;
            color: var(--text-hint);
            margin-top: 4px;
        }

        .form-control-styled {
            width: 100%;
            height: 40px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 0 12px;
            font-size: 13.5px;
            font-family: var(--font);
            color: var(--text-primary);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            background: var(--surface);
        }

        .form-control-styled:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(48, 61, 137, .12);
        }

        .form-error {
            color: #b22222;
            font-size: 12px;
            margin-top: 5px;
        }

        .alert-styled {
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .alert-styled.success {
            background: #e7f6ec;
            color: #1a7d3a;
            border: 1px solid #b7e3c4;
        }

        .alert-styled.error {
            background: #fdecec;
            color: #b22222;
            border: 1px solid #f3c2c2;
        }

        .alert-styled button {
            border: none;
            background: none;
            font-size: 16px;
            line-height: 1;
            cursor: pointer;
            color: inherit;
            opacity: .6;
        }

        .alert-styled button:hover {
            opacity: 1;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            padding: 18px 24px;
            border-top: 1px solid var(--border);
            background: var(--surface);
        }

        .btn-primary-dash {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent);
            color: #fff !important;
            border: none;
            border-radius: var(--radius-sm);
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none !important;
            box-shadow: 0 1px 3px rgba(48, 61, 137, .25);
        }

        .btn-primary-dash:hover {
            background: #252f70;
        }
    </style>

    <div class="app-content content container-fluid">
        <div class="cat-page">

            <div class="cat-page-header">
                <div class="cat-breadcrumb">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <span>›</span>
                    Profile Setting
                </div>
                <h1>Profile Setting</h1>
                <p>Update the password used to sign in to the admin panel.</p>
            </div>

            <div class="cat-card">
                <div class="cat-card-header">
                    <div class="icon-badge">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div>
                        <strong>Account Password</strong>
                        <span>Choose a strong password you don't use elsewhere</span>
                    </div>
                </div>

                <form action="{{ route('admin.reset.password') }}" method="POST">
                    @csrf

                    <div class="cat-card-body">

                        @if(Session::has('success'))
                            <div class="alert-styled success">
                                {{ session('success') }}
                                <button type="button" onclick="this.parentElement.remove()">&times;</button>
                            </div>
                        @endif

                        @if(Session::has('error'))
                            <div class="alert-styled error">
                                {{ session('error') }}
                                <button type="button" onclick="this.parentElement.remove()">&times;</button>
                            </div>
                        @endif

                        <div class="form-field">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control-styled @error('password') is-invalid @enderror"
                                placeholder="Enter new password">
                            @error('password')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-field" style="margin-bottom:0;">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control-styled @error('password_confirmation') is-invalid @enderror"
                                placeholder="Confirm new password">
                            @error('password_confirmation')
                            <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary-dash">
                            <i class="fa fa-check"></i> Update Password
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@include('admin.footer')