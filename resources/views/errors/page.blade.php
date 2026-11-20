<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $code }} | Portofolio.app</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            display: grid;
            min-height: 100vh;
            margin: 0;
            padding: 24px;
            place-items: center;
            background-color: #2b2e33;
            background-image:
                repeating-linear-gradient(0deg, rgba(255,255,255,0.03) 0, rgba(255,255,255,0.03) 1px, transparent 1px, transparent 3px),
                repeating-linear-gradient(90deg, rgba(0,0,0,0.18) 0, rgba(0,0,0,0.18) 1px, transparent 1px, transparent 3px),
                radial-gradient(circle at 50% 0%, #3e444d 0%, #1d2024 100%);
            color: #1c1c1e;
            font-family: 'Geist', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .error-window {
            width: min(100%, 520px);
            overflow: hidden;
            border: 1px solid #1a1c20;
            border-radius: 14px;
            background-color: #e4e7ec;
            background-image: repeating-linear-gradient(90deg, #e2e5ea, #e2e5ea 6px, #ebedf1 6px, #ebedf1 12px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.85);
        }

        .navbar {
            display: flex;
            min-height: 54px;
            align-items: center;
            justify-content: center;
            border-top: 1px solid #cdd5df;
            border-bottom: 1px solid #2d3642;
            background: linear-gradient(180deg, #b0bccd 0%, #889bb3 49%, #7a8fa9 50%, #6d84a2 100%);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.45);
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.55);
        }

        .content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 38px 28px 32px;
            text-align: center;
        }

        .error-icon {
            display: grid;
            width: 76px;
            height: 76px;
            place-items: center;
            border: 1px solid #35475e;
            border-radius: 22%;
            background: linear-gradient(180deg, #5ea5f7 0%, #2a7ae2 49%, #1967d2 50%, #2272dc 100%);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.55), 0 6px 12px rgba(0,0,0,0.3);
            color: #fff;
            font-size: 32px;
            text-shadow: 0 -1px 0 rgba(0,0,0,0.45);
        }

        .message-card {
            width: 100%;
            padding: 24px;
            border: 1px solid #abaeb3;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 1px 2px rgba(0,0,0,0.12), inset 0 1px 0 #fff;
        }

        .code {
            margin: 0;
            color: #6b7280;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.16em;
        }

        h1 {
            margin: 8px 0 10px;
            color: #1f2937;
            font-size: clamp(22px, 5vw, 28px);
            line-height: 1.2;
        }

        .description {
            margin: 0;
            color: #4b5563;
            font-size: 15px;
            line-height: 1.6;
        }

        .home-link {
            display: inline-flex;
            min-height: 44px;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 20px;
            border: 1px solid #104591;
            border-radius: 7px;
            background: linear-gradient(180deg, #5ea5f7 0%, #2a7ae2 49%, #1967d2 50%, #2272dc 100%);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.55), 0 2px 4px rgba(0,0,0,0.25);
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            text-shadow: 0 -1px 0 rgba(0,0,0,0.45);
            transition: filter 0.15s ease;
        }

        .home-link:hover {
            filter: brightness(1.08);
        }

        .home-link:focus-visible {
            outline: 3px solid #1d4ed8;
            outline-offset: 3px;
        }

        @media (max-width: 420px) {
            body {
                padding: 16px;
            }

            .content {
                gap: 16px;
                padding: 28px 18px 22px;
            }

            .message-card {
                padding: 20px 16px;
            }
        }
    </style>
</head>
<body>
    <main class="error-window" aria-labelledby="error-title">
        <div class="navbar">Portofolio.app</div>
        <div class="content">
            <div class="error-icon" aria-hidden="true">
                <i class="{{ $icon }}"></i>
            </div>
            <section class="message-card">
                <p class="code">ERROR {{ $code }}</p>
                <h1 id="error-title">{{ $title }}</h1>
                <p class="description">{{ $description }}</p>
            </section>
            <a class="home-link" href="{{ route('public.index') }}">
                <i class="fa-solid fa-house" aria-hidden="true"></i>
                Kembali ke halaman utama
            </a>
        </div>
    </main>
</body>
</html>
