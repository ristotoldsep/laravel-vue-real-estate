<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="bg-primary-50 mx-auto overflow-hidden">
        <div class="fixed right-0 top-44 z-[999]">
            <a href="https://hausers.ee/" target="_blank">
                <svg width="45" height="152" viewBox="0 0 45 152" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="45" height="152" fill="#FFF"></rect><image href="/images/hausers-logo-dark.png" width="152" height="45" transform="translate(45) rotate(90)"></image></svg>
            </a>
        </div>
        <Navbar />
        <div
            class="min-h-screen"
        >
            <slot />
        </div>
    </div>
</template>
