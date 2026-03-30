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
    
    @yield('content')
    
    <x-footer />
</body>
</html>
