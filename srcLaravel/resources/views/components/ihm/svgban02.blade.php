<svg width="720" height="160" viewBox="0 0 360 80" xmlns="http://www.w3.org/2000/svg">
    <defs>
            <!-- Filtre pour l'effet de lueur -->
        <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
            <feGaussianBlur stdDeviation="4" result="coloredBlur"/>
            <feMerge>
            <feMergeNode in="coloredBlur"/>
            <feMergeNode in="SourceGraphic"/>
            </feMerge>
        </filter>
        <linearGradient id="backgroundGradient" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%" stop-color="#0a0f25" />
            <stop offset="50%" stop-color="#c0d8fb" />
            <stop offset="100%" stop-color="#0a0f25" />
        </linearGradient>

    </defs>
    <!-- Fond 
        <rect width="1920" height="150" fill="url(#backgroundGradient)" />
        -->
    <rect width="360" height="80" fill="#2f2fd0" />
    <!-- Cercle central représentant le plasma -->

    <circle cx="180" cy="80" r="20" fill="#ffd700" filter="url(#glow)">
        <animate attributeName="r" from="20" to="35" dur="8s" repeatCount="indefinite" />
        <animate attributeName="fill" values="#ffd700;#ffffff" dur="4s" begin="0s" repeatCount="indefinite" />
    </circle>

    
    <!-- Arcs concentriques pour simuler le confinement magnétique -->
    <circle cx="180" cy="80" r="20" stroke="#ffd700" stroke-width="8" fill="none" opacity="0.5">
        <animate attributeName="r" from="20" to="75" dur="2s" repeatCount="indefinite" />
    </circle>
    <circle cx="180" cy="80" r="20" stroke="#ffd700" stroke-width="12" fill="none" opacity="0.3">
        <animate attributeName="r" from="20" to="75" dur="4s" repeatCount="indefinite" />
    </circle>
    <circle cx="180" cy="80" r="20" stroke="#ffd700" stroke-width="16" fill="none" opacity="0.1">
        <animate attributeName="r" from="20" to="75" dur="8s" repeatCount="indefinite" />
    </circle>
    <!-- Path pour la courbe de Lissajous -->
    <path id="lissajous-path" fill="none" stroke="#ffd700" stroke-width="2" z-index="2"/>
</svg>