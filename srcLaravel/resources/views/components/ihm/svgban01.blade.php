            <svg width="960" height="75" viewBox="0 0 1920 150" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <!-- Dégradé pour l'éclair -->
                    <linearGradient id="electricGradient" x1="0" y1="0" x2="1" y2="0">
                    <stop offset="0%" stop-color="#00f" />
                    <stop offset="50%" stop-color="#0ff">
                        <animate attributeName="stop-color" values="#0ff;#fff;#0ff" dur="0.6s" repeatCount="indefinite" />
                    </stop>
                    <stop offset="100%" stop-color="#00f" />
                    </linearGradient>
                    <!-- Dégradé de fond -->
                    <linearGradient id="backgroundGradient" x1="0" y1="0" x2="1" y2="0">
                        <stop offset="0%" stop-color="#0a0f25" />
                        <stop offset="100%" stop-color="#0b1a40" />
                    </linearGradient>
                    <!-- Dégradé pour les éclairs -->
                    <linearGradient id="lightningGradient" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#ffd700" />
                        <stop offset="100%" stop-color="#ff8c00" />
                    </linearGradient>
                    <!-- Filtre pour l'effet de lueur -->
                    <filter id="glow" x="-50%" y="-50%" width="200%" height="200%">
                        <feGaussianBlur stdDeviation="4" result="coloredBlur"/>
                        <feMerge>
                        <feMergeNode in="coloredBlur"/>
                        <feMergeNode in="SourceGraphic"/>
                        </feMerge>
                    </filter>
                </defs>
                <!-- Fond -->
                <rect width="1920" height="150" fill="url(#backgroundGradient)" />
                <!-- Cercle central représentant le plasma -->
                <circle cx="960" cy="75" r="50" fill="#1e3a5f" filter="url(#glow)">
                    <animate attributeName="r" from="45" to="55" dur="1.5s" repeatCount="indefinite" />
                    <animate attributeName="fill" values="#1e3a5f;#224670;#1e3a5f" dur="2s" repeatCount="indefinite" />
                </circle>
                <!-- Éclairs stylisés -->
                <path d="M960,25 Q970,50 960,75 Q950,100 960,125" stroke="url(#lightningGradient)" stroke-width="2" fill="none" filter="url(#glow)">
                    <animate attributeName="stroke-width" from="1" to="3" dur="0.5s" repeatCount="indefinite" />
                    <animate attributeName="opacity" from="0.5" to="1" dur="0.5s" repeatCount="indefinite" />
                </path>
                <path d="M920,50 Q930,75 920,100" stroke="url(#lightningGradient)" stroke-width="2" fill="none" filter="url(#glow)">
                    <animate attributeName="stroke-width" from="1" to="3" dur="0.7s" repeatCount="indefinite" />
                    <animate attributeName="opacity" from="0.5" to="1" dur="0.7s" repeatCount="indefinite" />
                </path>
                <path d="M1000,50 Q1010,75 1000,100" stroke="url(#lightningGradient)" stroke-width="2" fill="none" filter="url(#glow)">
                    <animate attributeName="stroke-width" from="1" to="3" dur="0.6s" repeatCount="indefinite" />
                    <animate attributeName="opacity" from="0.5" to="1" dur="0.6s" repeatCount="indefinite" />
                </path>
                <!-- Arcs concentriques pour simuler le confinement magnétique -->
                <circle cx="960" cy="75" r="70" stroke="#ffd700" stroke-width="1" fill="none" opacity="0.5">
                    <animate attributeName="r" from="70" to="75" dur="1.5s" repeatCount="indefinite" />
                </circle>
                <circle cx="960" cy="75" r="90" stroke="#ffd700" stroke-width="1" fill="none" opacity="0.3">
                    <animate attributeName="r" from="90" to="95" dur="1.5s" repeatCount="indefinite" />
                </circle>
                <circle cx="960" cy="75" r="110" stroke="#ffd700" stroke-width="1" fill="none" opacity="0.1">
                    <animate attributeName="r" from="110" to="115" dur="1.5s" repeatCount="indefinite" />
                </circle>
                <!-- Arc électrique sur toute la largeur -->
                <path d="M0,150 Q300,100 400,120 T800,80 Q1000,50 1200,70"
                        stroke="url(#electricGradient)" 
                        stroke-width="4"
                        fill="none"
                        filter="url(#glow)">
                    <animate attributeName="d"
                            dur="0.25s"
                            repeatCount="indefinite"
                            values="
                            M200,150 Q300,100 400,120 T800,80 Q1000,50 1200,70;
                            M0,150 Q310,90 390,130 T790,100 Q1010,60 1200,70;
                            M800,150 Q290,110 410,115 T805,70 Q995,55 1200,70;
                            M0,150 Q300,100 400,120 T800,80 Q1000,50 1200,70" />
                    <animate attributeName="filter"
                            values="url(#glow);none;url(#glow)"
                            dur="0.4s"
                            repeatCount="indefinite" />               
                </path>
                <!-- Citations animées -->
                <!-- Groupe pour les citations -->
                <g id="citations">
                    <g>
                    <text id="citation1" x="1920" y="40" text-anchor="end" font-size="20" fill="#ffd700" opacity="0">
                        <tspan>"La technologie est une extension de l'homme." - Marshall McLuhan</tspan>
                    </text>
                    </g>

                    <g>
                    <text id="citation2" x="0" y="70" text-anchor="start" font-size="20" fill="#ffd700" opacity="0">
                        <tspan>"L'avenir appartient à ceux qui croient en la beauté de leurs rêves." - Eleanor Roosevelt</tspan>
                    </text>

                    </g>
                    
                    <g>
                    <text id="citation3" x="1920" y="100" text-anchor="end" font-size="20" fill="#ffd700" opacity="0">
                        <tspan>"L'innovation distingue un leader d'un suiveur." - Steve Jobs</tspan>
                    </text>
                    </g>
                    
                    <g>
                    <text id="citation4" x="0" y="130" text-anchor="start" font-size="20" fill="#ffd700" opacity="0">
                        <tspan>"La créativité, c'est l'intelligence qui s'amuse." - Albert Einstein</tspan>
                    </text>
            
                    </g>

                    <animate xlink:href="#citation1" attributeName="x" from="1920" to="0" dur="10s" begin="0s;40s" />
                    <animate xlink:href="#citation1" attributeName="opacity" values="0;1;1;0" dur="10s" begin="0s;40s" />

                    <animate xlink:href="#citation2" attributeName="x" from="0" to="1920" dur="10s" begin="10s;50s" />
                    <animate xlink:href="#citation2" attributeName="opacity" values="0;1;1;0" dur="10s" begin="10s;50s" />

                    <animate xlink:href="#citation3" attributeName="x" from="1920" to="0" dur="10s" begin="20s;60s" />
                    <animate xlink:href="#citation3" attributeName="opacity" values="0;1;1;0" dur="10s" begin="20s;60s" />

                    <animate xlink:href="#citation4" attributeName="x" from="0" to="1920" dur="10s" begin="30s;70s" />
                    <animate xlink:href="#citation4" attributeName="opacity" values="0;1;1;0" dur="10s" begin="30s;70s" />

                    



                </g>
                <!-- Path pour la courbe de Lissajous -->
                <path id="lissajous-path" fill="none" stroke="#ffd700" stroke-width="2" z-index="2"/>
            </svg>