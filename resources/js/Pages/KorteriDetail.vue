<script setup>
  import { Head, useForm } from '@inertiajs/vue3'
  import GuestLayout from '@/Layouts/GuestLayout.vue'
  import { useToast } from 'primevue/usetoast'
  import { ref, onMounted } from 'vue'
  import { useI18n } from 'vue-i18n'

  const { t } = useI18n()

  defineProps({
    apartment: {
      type: Object,
      required: true,
    },
    images: {
      type: Object,
      required: true,
    },
  })

  const formatCurrency = (value) => {
    if (value === null || value === undefined) return '-'
    return value.toLocaleString('et-EE', {
      style: 'currency',
      currency: 'EUR',
      minimumFractionDigits: 0,
      maximumFractionDigits: 0,
    })
  }

  //Function that adds square meter to the number
  const formatSquareMeters = (value) => {
    return value + ' m²'
  }
</script>

<template>
  <Head :title="`Korter nr ${apartment.number} | Uus Loo | Saha tee 8 | Korterid ja äripinnad Loo alevikus`" />

  <GuestLayout>
    <section
      class="h-[100px] sm:h-[200px] relative overflow-hidden mt-10 bg-primary-700/90 text-center flex items-center justify-center"
    >
      <h1 class="text-primary-50 relative z-10">{{$t('Korter nr')}} {{ apartment.number }}</h1>
      <img class="w-full opacity-10 z-0 absolute" src="@images/saha8.webp" alt="" />
    </section>
    <section>
      <div class="max-w-screen-xl mx-auto px-3 xl:px-0 gap-10 flex flex-col md:flex-row py-20">
        <div class="w-full md:w-[40%]">
          <h2>{{$t('Korter nr')}} {{ apartment.number }}</h2>
          <div class="grid grid-cols-2 *:border-b *:border-primary-100 mt-5 font-piazolla">
            <div class="py-2">{{$t('Korrus')}} :</div>
            <div class="py-2">{{ apartment.floor }}/8</div>
            <div class="py-2">{{$t('Tubade arv')}} :</div>
            <div class="py-2">{{ apartment.rooms }}</div>
            <div class="py-2">{{$t('Üldpind')}} :</div>
            <div class="py-2">
              {{ formatSquareMeters(apartment.area) }}
            </div>
            <div class="py-2">{{$t('Rõdu')}} :</div>
            <div class="py-2">
              {{ formatSquareMeters(apartment.balcony) }}
            </div>
            <div class="py-2">{{$t('Hind')}} :</div>
            <div class="py-2">
              <div v-if="apartment.salePrice">
                <span class="line-through">
                  {{ formatCurrency(apartment.price) }}
                </span>
                <span class="ms-2 text-red-500">
                  {{ formatCurrency(apartment.salePrice) }}
                </span>
              </div>
              <div v-else>
                {{ formatCurrency(apartment.price) }}
              </div>
            </div>
            <div class="py-2">{{$t('Seis')}} :</div>
            <div class="py-2">{{ $t(apartment.status || 'Vaba') }}</div>
          </div>
          <div v-if="apartment.kulaliskorter" class="mt-4 p-4 bg-primary-50 rounded-lg border border-primary-200">
            <p class="text-sm font-piazolla">{{ $t('Tegemist on külaliskorteriga. Küsi lisa!') }}</p>
          </div>
          <PrimaryButton
            v-if="apartment.status !== 'Broneeritud'"
            href="#korteriKontakt"
            class="mt-5 w-full text-center justify-center"
          >
            {{$t('Broneeri')}}
          </PrimaryButton>
        </div>
        <div class="w-full md:w-[60%]">
          <TabView>
            <TabPanel v-if="images['apartment']" :header="$t('Korteri plaan')">
              <div class="flex justify-center w-full p-10">
                <img class="w-full max-w-[500px]" :src="images['apartment']" alt="" />
              </div>
            </TabPanel>
            <TabPanel v-if="images['floor']" :header="$t('Korruse plaan')">
              <div class="flex justify-center w-full p-10">
                <img class="w-full" :src="images['floor']" alt="" />
              </div>
            </TabPanel>
            <TabPanel v-if="images['position']" :header="$t('Asendiplaan')">
              <div class="flex justify-center w-full p-10">
                <img class="w-full max-w-[400px]" :src="images['position']" alt="" />
              </div>
            </TabPanel>
          </TabView>
        </div>
      </div>
    </section>
    <Kontaktivorm />
  </GuestLayout>
</template>
