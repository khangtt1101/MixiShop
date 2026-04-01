<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Streetwear E-Commerce')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 200, 'GRAD' 0, 'opsz' 24;
            font-size: 20px;
        }
        body {
            background-color: #131313;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
        }
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              colors: {
                "surface-tint": "#c6c6c7",
                "inverse-primary": "#5d5f5f",
                "surface-dim": "#131313",
                "surface-variant": "#353535",
                "surface-container-highest": "#353535",
                "on-primary-fixed-variant": "#e2e2e2",
                "on-primary-fixed": "#ffffff",
                "surface-container-lowest": "#0e0e0e",
                "primary-fixed-dim": "#454747",
                "on-tertiary-fixed-variant": "#e3e2e2",
                "inverse-on-surface": "#303030",
                "background": "#131313",
                "secondary": "#c6c6c6",
                "primary": "#ffffff",
                "inverse-surface": "#e2e2e2",
                "on-secondary-container": "#e2e2e2",
                "surface-container": "#1f1f1f",
                "surface": "#131313",
                "on-secondary-fixed": "#1a1c1c",
                "outline-variant": "#474747",
                "on-tertiary-container": "#000000",
                "on-background": "#e2e2e2",
                "primary-container": "#d4d4d4",
                "on-primary-container": "#000000",
                "primary-fixed": "#5d5f5f",
                "outline": "#919191",
                "on-error-container": "#ffdad6",
                "surface-bright": "#393939",
                "error": "#ffb4ab",
                "on-tertiary-fixed": "#ffffff",
                "surface-container-low": "#1b1b1b",
                "tertiary-container": "#919090",
                "on-primary": "#1a1c1c",
                "tertiary": "#e3e2e2",
                "secondary-fixed-dim": "#ababab",
                "on-error": "#690005",
                "tertiary-fixed-dim": "#464747",
                "secondary-container": "#454747",
                "surface-container-high": "#2a2a2a",
                "on-surface": "#e2e2e2",
                "on-secondary-fixed-variant": "#3a3c3c",
                "error-container": "#93000a",
                "on-tertiary": "#1b1c1c",
                "tertiary-fixed": "#5e5e5e",
                "on-secondary": "#1a1c1c",
                "secondary-fixed": "#c6c6c6",
                "on-surface-variant": "#c6c6c6"
              },
              fontFamily: {
                "headline": ["Space Grotesk"],
                "body": ["Inter"],
                "label": ["Inter"]
              },
              borderRadius: {"DEFAULT": "0px", "lg": "0px", "xl": "0px", "full": "9999px"},
            },
          },
        }
    </script>
</head>
<body class="bg-background text-on-background selection:bg-primary selection:text-on-primary min-h-screen flex flex-col pt-20">
    <x-navbar />
    
    @if(session('success'))
        <div id="flash-message-success" class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50 flex items-center gap-3 bg-surface-container-high text-on-surface px-6 py-4 border border-outline-variant shadow-xl" style="transition: opacity 0.5s ease-in-out;">
            <span class="material-symbols-outlined text-green-400">check_circle</span>
            <p class="font-medium font-body text-sm whitespace-nowrap">{{ session('success') }}</p>
            <button onclick="document.getElementById('flash-message-success').style.opacity='0'; setTimeout(()=>document.getElementById('flash-message-success').remove(), 500)" class="ml-4 text-on-surface hover:text-white transition-colors flex items-center">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('flash-message-success');
                if(el) { el.style.opacity = '0'; setTimeout(()=>el.remove(), 500); }
            }, 6000);
        </script>
    @endif

    @if(session('error'))
        <div id="flash-message-error" class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50 flex items-center gap-3 bg-error-container text-on-error-container px-6 py-4 border border-error shadow-xl" style="transition: opacity 0.5s ease-in-out;">
            <span class="material-symbols-outlined">error</span>
            <p class="font-medium font-body text-sm">{{ session('error') }}</p>
            <button onclick="document.getElementById('flash-message-error').style.opacity='0'; setTimeout(()=>document.getElementById('flash-message-error').remove(), 500)" class="ml-4 hover:opacity-75 transition-opacity flex items-center">
                <span class="material-symbols-outlined text-[18px]">close</span>
            </button>
        </div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('flash-message-error');
                if(el) { el.style.opacity = '0'; setTimeout(()=>el.remove(), 500); }
            }, 7000);
        </script>
    @endif
    
    @yield('content')
    
    <x-footer />
</body>
</html>
