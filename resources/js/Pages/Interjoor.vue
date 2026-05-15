<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PackageSection from "@/Components/PackageSection.vue";
import { useI18n } from 'vue-i18n';

const { t } = useI18n();
const colorsI = ref([
    { name: t('Põhitoon Tikkurila F497'), image: "pakett-1/f497.png" },
    { name: t('Aktsenttoon Tikkurila H497'), image: "pakett-1/h497.png" },
    { name: t('Aktsenttoon Tikkurila J447'), image: "pakett-1/j447.png" },
]);

const colorsII = ref([
    { name: t('Põhitoon Tikkurila G497'), image: "pakett-2/g497.png" },
    { name: t('Aktsenttoon Tikkurila K497'), image: "pakett-2/k497.png" },
    { name: t('Aktsenttoon Tikkurila J487'), image: "pakett-2/j487.png" },
]);

const colorsIII = ref([
    { name: t('Põhitoon Tikkurila F497'), image: "pakett-3/f497.png" },
    { name: t('Põhitoon Tikkurila G499'), image: "pakett-3/g499.png" },
    { name: t('Põhitoon Tikkurila K499'), image: "pakett-3/k499.png" },
]);

const tilesI = ref([
    {
        name: t('Spoonparkett 1-lipiline hele tamm'),
        image: "pakett-1/spoonparkett-1.jpg",
    },
    {
        name: t('Naturaalparkett 3-lipiline hele tamm'),
        image: "pakett-1/3-lipiline-parkett.png",
    },
    {
        name: t('Keraamilineplaat hele 60x60cm'),
        image: "pakett-1/keraamilineplaat.jpg",
    },
    {
        name: t('Aktsentplaat terrazzo hele 60x60cm'),
        image: "pakett-1/aktsentplaat.jpg",
    },
]);

const tilesII = ref([
    {
        name: t('Spoonparkett 1-lipiline naturaalne tamm'),
        image: "pakett-2/spoonparkett-1-lipiline.png",
    },
    {
        name: t('Naturaalparkett 3-lipiline naturaalne tamm'),
        image: "pakett-2/naturaalparkett-3-lipiline.png",
    },
    {
        name: t('Keraamilineplaat liivakivi 60x60cm'),
        image: "pakett-2/keraamilineplaat.jpg",
    },
]);

const tilesIII = ref([
    {
        name: t('Spoonparkett 1-lipiline hele tamm'),
        image: "pakett-1/spoonparkett-1.jpg",
    },
    {
        name: t('Naturaalparkett 3-lipiline hele tamm'),
        image: "pakett-1/3-lipiline-parkett.png",
    },
    { name: t('Keraamilineplaat marmor 60x60cm'), image: "pakett-3/marmor.png" },
    {
        name: t('Aktsentplaat tume kivi 60x60cm'),
        image: "pakett-3/keraamilineplaat.jpg",
    },
]);
</script>

<template>
    <Head title="Interjöör | Uus Loo | Saha tee 8 | Korterid ja äripinnad Loo alevikus" />

    <GuestLayout>
        <PackageSection
            :packageImage="'pakett-1/pakett-1-meeleolu.webp'"
            :subtitle="$t('Helge, naturaalne ja pehme')"
            :title="$t('Modernne boho')"
            :description="$t('Minimalistlik modernne boho pakett toob teie koju valgusküllase ja avara atmosfääri, kus valitsevad helged toonid ja naturaalsed materjalid. Kombineerides kaasaegset minimalismi ja boheemlaslikku hubasust, on tulemuseks rahulik ja harmooniline elukeskkond. Suurepärane tasakaal lihtsuse ja isikupära vahel loob unikaalse ja stiilse ruumi. Sobib ideaalselt neile, kes hindavad looduslähedust ja mugavust.')"
            :colors="colorsI"
            :tiles="tilesI"
            pdfFile="pakett-1/pakett-1.pdf"
        />
        <PackageSection
            reverseLayout
            :packageImage="'pakett-2/pakett-2-meeleolu.webp'"
            :subtitle="t('Hubane, soe ja looduslik')"
            :title="t('Skandinaavialik japandi')"
            :description="t('Skandinaavialik japandi pakett ühendab endas põhjamaise hubasuse ja jaapani stiili lihtsuse. See pakett pakub sooja ja kutsuvat interjööri, kus looduslikud materjalid ja pehmed tekstuurid loovad rahuliku õhkkonna. Puidust põrandad, neutraalsed värvipaletid ja minimalistlik mööbel annavad ruumile avaruse ja selguse. Ideaalne valik neile, kes otsivad rahulikkust ja tasakaalu oma kodus.')"
            :colors="colorsII"
            :tiles="tilesII"
            pdfFile="pakett-2/pakett-2.pdf"
        />
        <PackageSection
            :packageImage="'pakett-3/pakett-3-meeleolu.webp'"
            :subtitle="t('Karge, luksuslik ja elegantne')"
            :title="t('Kaasaegne minimalism')"
            :description="t('Kaasaegne modernne minimalism pakett pakub stiilset ja luksuslikku elukeskkonda, kus valitsevad puhtad jooned ja karged toonid. Monokroomsed värvipaletid ja minimalistlikud mööbliesemed loovad avara ja õhulise ruumi. Disaini keskmes on funktsionaalsus ja esteetika, pakkudes mugavat ja kaasaegset elukeskkonda. Täiuslik valik neile, kes hindavad luksust ja elegantsi igapäevaelus.')"
            :colors="colorsIII"
            :tiles="tilesIII"
            pdfFile="pakett-3/pakett-3.pdf"
        />

        <!-- Koostööpartnerid -->
        <section class="border-b border-primary-100 py-10 sm:py-20 px-3 xl:px-0">
            <div class="mx-auto max-w-screen-xl">
                <div class="mb-10 sm:mb-14">
                    <p class="uppercase text-xs tracking-widest text-primary-300 mb-3">{{ $t('Koostöö') }}</p>
                    <h2>{{ $t('Meie partnerid') }}</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <!-- Aunman -->
                    <div class="border border-primary-100 p-10 sm:p-14 flex flex-col gap-8 transition-colors duration-300 hover:border-primary-200">
                        <img
                            src="/images/partnerid/aunman-logo.webp"
                            alt="Aunman"
                            class="h-14 w-auto object-contain object-left"
                        />
                        <p class="text-primary-500 leading-relaxed">
                            {{ $t('Aunman on Eesti pereettevõte, mis loob eksklusiivset eritellimusmööblit juba 20 aastat. Pakume personaalset teenindust, disaineri abil reaalajas jälgitavat tootmist ja 5-aastast garantiid. Meie Viljandis asuv tehas tagab kvaliteedi ja täpsuse igas detailis. Loome koos Sinuga unistuste kodu.') }}
                        </p>
                    </div>
                    <!-- Architype Estonia + Hansakivi -->
                    <div class="border border-primary-100 p-10 sm:p-14 flex flex-col gap-8 transition-colors duration-300 hover:border-primary-200">
                        <div class="flex flex-col gap-6">
                            <img
                                src="/images/partnerid/architype-logo.svg"
                                alt="Architype Estonia"
                                class="h-9 w-auto object-contain object-left"
                            />
                            <img
                                src="/images/partnerid/hansakivi-logo.webp"
                                alt="Hansakivi"
                                class="h-10 w-auto object-contain object-left"
                            />
                        </div>
                        <p class="text-primary-500 leading-relaxed">
                            {{ $t('Kvaliteetsed pinnamaterjalid tänapäevasesse interjööri.') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <Kontaktivorm />
    </GuestLayout>
</template>
