<template>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 250 150" width="300" height="150">
        <!-- Background -->
        <rect width="250" height="150" fill="#1E293B" rx="20" />

        <!-- EN Symbol -->
        <g transform="translate(50, 30)">
            <!-- E Shape -->
            <rect x="0" y="0" width="60" height="15" fill="#4F46E5" />
            <rect x="0" y="22" width="40" height="15" fill="#4F46E5" />
            <rect x="0" y="44" width="60" height="15" fill="#4F46E5" />

            <!-- N Shape -->
            <path d="M80,60 V0 H100 L140,60 H120 L100,20 V60 Z" fill="#22D3EE" />
        </g>

        <!-- Text -->
        <text x="50%" y="130" fill="url(#textGradient)" font-family="'Poppins', sans-serif" font-size="22" font-weight="600" text-anchor="middle" style="text-transform: uppercase; letter-spacing: 3px;">
            EN Studio
        </text>

        <!-- Gradient Definition -->
        <defs>
            <linearGradient id="textGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#4F46E5;stop-opacity:1" />
                <stop offset="100%" style="stop-color:#22D3EE;stop-opacity:1" />
            </linearGradient>
        </defs>
    </svg>
</template>
