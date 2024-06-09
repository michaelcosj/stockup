<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <main class="min-h-screen flex flex-col">
        <header class="flex items-center justify-between py-3 px-5 shadow-sm border-b">
            <Link href="/" class="text-xl font-bold text-primary">StockUp!</Link>
            <div class="flex gap-3 items-center">
                <Link href="/logout" class="hover:text-emerald-500">Logout</Link>
            </div>
        </header>
        <section class="min-h-full flex-grow flex justify-center items-center">
            <slot />
        </section>
    </main>
</template>
