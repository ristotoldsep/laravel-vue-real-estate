<script setup>
  import { Head, useForm } from '@inertiajs/vue3'
  import GuestLayout from '@/Layouts/GuestLayout.vue'
  import { useToast } from 'primevue/usetoast'
  import { ref, onMounted, watch, onUnmounted } from 'vue'
  import { useI18n } from 'vue-i18n'
  import '@splidejs/vue-splide/css/core'

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
    gallery: {
      type: Array,
      default: () => [],
    },
  })

  // Gallery lightbox
  const visible = ref(false)
  const main = ref(null)
  const thumbs = ref(null)

  const mainOptions = {
    perPage: 1,
    perMove: 1,
    gap: '1rem',
    pagination: false,
    arrows: true,
  }

  const thumbsOptions = {
    type: 'slide',
    rewind: true,
    gap: '0.75rem',
    pagination: false,
    fixedWidth: 90,
    fixedHeight: 60,
    cover: true,
    focus: 'center',
    isNavigation: true,
    updateOnMove: true,
    arrows: false,
    snap: true,
    drag: true,
  }

  const onThumbsReady = () => {
    const thumbsSplide = thumbs.value?.splide
    if (thumbsSplide) {
      main.value?.sync(thumbsSplide)
    }
  }

  const openLightbox = (index) => {
    visible.value = true
    setTimeout(() => {
      main.value?.go(index)
    }, 300)
  }

  const onKeydown = (e) => {
    if (e.key === 'ArrowLeft') main.value?.go('<')
    else if (e.key === 'ArrowRight') main.value?.go('>')
  }

  watch(visible, (open) => {
    if (open) window.addEventListener('keydown', onKeydown)
    else window.removeEventListener('keydown', onKeydown)
  })

  onUnmounted(() => window.removeEventListener('keydown', onKeydown))

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
            <TabPanel v-if="gallery && gallery.length" :header="$t('Galerii')">
              <div class="grid grid-cols-2 gap-3 p-4">
                <img
                  v-for="(img, index) in gallery"
                  :key="index"
                  :src="img.url"
                  alt=""
                  class="object-cover aspect-[3/2] w-full cursor-pointer rounded transition-opacity hover:opacity-90"
                  @click="openLightbox(index)"
                />
              </div>
            </TabPanel>
          </TabView>
        </div>
      </div>
    </section>
    <Kontaktivorm />

    <Dialog
      v-model:visible="visible"
      modal
      dismissableMask
      :header="$t('Galerii')"
      :style="{ width: '95vw', maxWidth: '1000px' }"
    >
      <Splide :options="mainOptions" ref="main" class="lightbox-main" aria-label="Korteri galerii">
        <SplideSlide v-for="(img, i) in gallery" :key="i">
          <img :src="img.url" alt="" />
        </SplideSlide>
      </Splide>

      <Splide
        :options="thumbsOptions"
        ref="thumbs"
        @splide:mounted="onThumbsReady"
        class="lightbox-thumbs mt-3 flex justify-center"
        aria-label="Galerii pisipildid"
      >
        <SplideSlide v-for="(img, i) in gallery" :key="i">
          <img :src="img.url" alt="" />
        </SplideSlide>
      </Splide>
    </Dialog>
  </GuestLayout>
</template>
