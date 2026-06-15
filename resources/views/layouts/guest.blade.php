<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Authentification | PolyTech</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; font-family: 'Inter', sans-serif; }
        
        body {
            background: radial-gradient(circle at top left, rgba(74,163,255,.12) 0%, transparent 40%),
                        radial-gradient(circle at bottom right, rgba(6,214,160,.08) 0%, transparent 40%),
                        linear-gradient(160deg, #07101a 0%, #0b1624 45%, #111f33 100%);
            color: #e5eefb;
            display: flex; align-items: center; justify-content: center;
            overflow-y: auto;
            min-height: 100vh;
            position: relative;
            padding: 2rem 1.25rem;
        }

        /* Animated blobs */
        body::before {
            content: ''; position: absolute;
            width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(74,163,255,.1) 0%, transparent 70%);
            top: -150px; left: -100px; animation: pulse 6s ease-in-out infinite alternate; pointer-events: none;
        }
        body::after {
            content: ''; position: absolute;
            width: 400px; height: 400px; border-radius: 50%;
            background: radial-gradient(circle, rgba(6,214,160,.08) 0%, transparent 70%);
            bottom: -150px; right: -100px; animation: pulse 8s ease-in-out infinite alternate-reverse; pointer-events: none;
        }
        @keyframes pulse { 0% { transform: scale(1); } 100% { transform: scale(1.15); } }

        .auth-container {
            width: 100%; max-width: 460px;
            padding: 2.5rem 3rem;
            background: rgba(255,255,255,.03);
            border: 1px solid rgba(148,163,184,.14);
            border-radius: 24px;
            backdrop-filter: blur(20px);
            box-shadow: 0 24px 50px rgba(0,0,0,.25);
            position: relative; z-index: 10;
        }
        
        .auth-brand {
            display: flex; align-items: center; justify-content: center; gap: .7rem;
            text-decoration: none; margin-bottom: 2rem;
        }
        .auth-brand-icon {
            width: 44px; height: 44px; border-radius: 12px;
            background: linear-gradient(135deg, #4aa3ff, #0f4c81);
            display: grid; place-items: center;
            font-weight: 900; font-size: .9rem; color: #fff;
            box-shadow: 0 8px 20px rgba(74,163,255,.3);
        }
        .auth-brand-name { font-size: 1.4rem; font-weight: 800; color: #f8fbff; line-height: 1; }
        .auth-brand-name span { color: #4aa3ff; }

        .auth-form-header { text-align: center; margin-bottom: 2rem; }
        .auth-form-header h2 { font-size: 1.25rem; font-weight: 800; color: #f8fbff; margin-bottom: .4rem; }
        .auth-form-header p { font-size: .88rem; color: rgba(229,238,251,.65); }

        .auth-form-grid { display: grid; gap: 1.2rem; }
        .auth-label { display: block; font-size: .8rem; font-weight: 600; color: rgba(229,238,251,.8); margin-bottom: .4rem; }
        
        .auth-input, input[type="email"], input[type="password"], input[type="text"] {
            width: 100%; padding: .8rem 1rem;
            border-radius: 12px;
            background: rgba(255,255,255,.05) !important;
            border: 1px solid rgba(148,163,184,.18) !important;
            color: #fff !important; font-size: .9rem;
            transition: all .2s; outline: none; box-shadow: none;
        }
        .auth-input:focus, input[type="email"]:focus, input[type="password"]:focus, input[type="text"]:focus {
            background: rgba(255,255,255,.08) !important;
            border-color: #4aa3ff !important;
            box-shadow: 0 0 0 4px rgba(74,163,255,.15) !important;
        }

        .auth-actions { margin-top: 1.5rem; text-align: center; display: flex; flex-direction: column; align-items: center; }
        .auth-submit {
            width: 100%; padding: 1rem; border-radius: 14px;
            background: linear-gradient(135deg, #2176ff, #0056e0); 
            color: #fff !important; font-weight: 800; font-size: 1rem;
            border: none; cursor: pointer; transition: all .3s ease; 
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(33, 118, 255, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .auth-submit:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 12px 28px rgba(33, 118, 255, 0.45); 
            filter: brightness(1.1);
        }
        
        .auth-link {
            font-size: .85rem; color: rgba(229,238,251,.65); font-weight: 600;
            text-decoration: none; transition: color .2s; display: inline-block;
        }
        .auth-link:hover { color: #4aa3ff; }
        
        .auth-error { color: #fca5a5; font-size: .75rem; font-weight: 600; margin-top: .3rem; }
        
        /* Checkbox styling */
        .auth-check-wrap { display: flex; align-items: center; gap: .5rem; }
        .auth-check { width: 16px; height: 16px; accent-color: #4aa3ff; }
    </style>
</head>
<body>
    <div class="auth-container">
        <a href="{{ url('/') }}" class="auth-brand" style="flex-direction: column;">
            <img src="{{ asset('images/logo.png') }}" alt="EPG Logo" style="height: 100px; width: auto; margin-bottom: 0.5rem;">
            <div class="auth-brand-name">Ecole Polytechnique <span>Des Génies</span></div>
        </a>

        {{ $slot }}
    </div>
</body>
</html>
