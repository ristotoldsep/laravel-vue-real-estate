<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { useI18n } from 'vue-i18n'
const { t } = useI18n()

const form = useForm({
    selectedOption: "korterid",
    email: "",
});
</script>

<template>
    <Head title="Äripinnad | Uus Loo | Saha tee 8 | Korterid ja äripinnad Loo alevikus" />

    <GuestLayout>

        <section
            class="max-w-screen-xl mx-auto px-3 xl:px-0 space-y-5 md:space-y-10 mt-5 pb-10"
        >
            <img
                class="w-full h-[200px] sm:h-auto object-cover"
                src="@images/uusloo-aripinnad.webp"
                alt=""
            />
            <div class="md:flex space-y-5 items-center gap-20 px-4">
                <h1 class="text-2xl max-w-[610px] md:text-3xl font-bold">
                    {{ $t('UusLoo hoonest saab Loo aleviku uus maamärk – silmapaistev ja esinduslik.') }}
                </h1>
                <p>
                    {{ $t('Asukohalt aleviku täielikus tsentris ja südames koondab see inimesi ja elu oma mõõdukalt rahulikus tuiksoones.') }}
                </p>
            </div>
        </section>
        <section class="border-y border-primary-100 py-20 w-full">
            <div
                class="max-w-screen-xl px-3 xl:px-0 mx-auto gap-8 items-center flex flex-col md:flex-row"
            >
                <div class="md:w-1/2">
                    <img
                        src="@images/uusloo-aripinnad-loo-alevik.webp"
                        alt=""
                    />
                </div>
                <div class="md:w-1/2">
                    <h2>{{ $t('UusLoo Äripinnad') }}</h2>
                    <div class="mt-5 space-y-3 leading-relaxed">
                        <p>
                            {{ $t('Esimesel ja teisel korrusel leiavad koha valitud ärid ja teenused, mis rikastavad positiivselt elukeskkonda ja kogukonna elu, sealjuures segamata elukeskkonda majas. Kõik 1.korruse äripinnad on eraldiseisvate sissepääsudega otse tänavalt. Kohaliku omavalitsuse poolt on majja tulemas perearsti- ja tervisekeskus, mis asub privaatse ja eraldatud trepikojaga hoone küljel ning lastehoid, mis asub eraldi sektsioonis eenduvas hoovipoolses osas.') }}
                        </p>
                        <p class="">
                            {{ $t('Saha tee 8 ühendab endas meeldiva elukeskkonna ja väikekoha ärikeskkonna. Hoone pakub võimalusi kontoripindadele, väikepoodidele, kohvikutele, restoranidele ja muudele lisandväärtust loovatele teenustele. Äripinnad on saadaval suuruses 48 m²-140 m².') }}
                        </p>
                        <p>{{ $t('Võta ühendust ja uuri saadavust lähemalt!') }}</p>
                    </div>
                </div>
            </div>
        </section>

        <Kontaktivorm />
    </GuestLayout>
</template>
