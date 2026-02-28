<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
</script>

<template>
    <Head title="Asukoht | Uus Loo | Saha tee 8 | Korterid ja äripinnad Loo alevikus" />

    <GuestLayout>
        <section
            class="max-w-screen-xl mx-auto px-3 xl:px-0 space-y-5 md:space-y-10 text-center mt-5"
        >
            <img
                class="w-full h-[200px] sm:h-auto object-cover"
                src="@images/asukoht.webp"
                alt=""
            />
        </section>
        <Vahemaad />
        <ImageCarousel />
        <section class="border-y border-primary-100">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2028.9410752196486!2d24.943737377489462!3d59.4340573026329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4692ec370e8cb367%3A0xb6171443008d5ae3!2sSaha%20tee%208%2C%20Loo%2C%2074201%20Harju%20maakond!5e0!3m2!1sen!2see!4v1721663823158!5m2!1sen!2see"
                width="100%"
                height="400"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
        </section>
        <Kontaktivorm />
    </GuestLayout>
</template>
