<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-pink dark:text-white/50">

        <div
            class="relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white"
        >
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header
                    class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3"
                >
                    <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Log in
                            </Link>

                            <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
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
                </main>

                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                    <p>© <span>{{new Date().getFullYear()}}</span> ENStudio. All Rights Reserved.</p>
                    <p>This software and its content are the property of ENStudio Inc.</p>
                    <p>For inquiries, please contact us at <a href="mailto:sadekinislam6@gmail.com">sadekinislam6@gmail.com</a>.</p>
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </footer>
            </div>
        </div>
    </div>
</template>
