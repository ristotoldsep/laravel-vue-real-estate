<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InteriorGallery from "../Components/InteriorGallery.vue";
</script>

<template>
    <Head title="Galerii | Uus Loo | Saha tee 8 | Korterid ja äripinnad Loo alevikus" />

    <GuestLayout>
        <ImageCarousel />
        <InteriorGallery  />
        <Kontaktivorm />
    </GuestLayout>
</template>
