<script setup>
  import { Link } from '@inertiajs/vue3'
  import { ref, computed, onMounted } from 'vue'
import '@splidejs/vue-splide/css/core'
import { useI18n } from 'vue-i18n'

const { t } = useI18n()
  const activeTab = ref('Hoonest')

  const currentImageIndex = ref(0)
  const imagesHoonest = ref([
    '/images/renderid/saha-8_c1.webp',
    '/images/renderid/saha-8_c2.webp',
    '/images/renderid/saha-8_c7.webp',
    '/images/renderid/saha-8_c3.webp',
    '/images/renderid/saha-8_c7.webp',
    '/images/renderid/saha-8_c8.webp',
    '/images/renderid/saha-8_c9.webp',
    '/images/renderid/saha-8_c10.webp',
  ])

  const imagesUmbruskond = ref([
    '/images/umbruskond/loo-alevik1.webp',
    '/images/umbruskond/loo-alevik2.webp',
    '/images/umbruskond/loo-alevik3.webp',
    '/images/umbruskond/loo-alevik4.webp',
    '/images/umbruskond/loo-alevik5.webp',
    '/images/umbruskond/loo-alevik6.webp',
    '/images/umbruskond/loo-alevik7.webp',
  ])

  const imagesInterior = ref([
    '/images/interjoor/saha-8-elutuba.webp',
    '/images/interjoor/saha-8-elutuba-2.webp',
    '/images/interjoor/saha-8-kook.webp',
      '/images/interjoor/saha-8-vannituba.webp',
    '/images/interjoor/saha-8-elutuba-3.webp',
    '/images/interjoor/saha-8-rodu.webp',
    '/images/interjoor/saha-8-fuajee.webp',
  ])

  const imagesEhitus = ref([
    '/images/renderid/saha_main.webp',
    '/images/ehitus/ehitus-1.webp',
    '/images/ehitus/ehitus-16.webp',
    '/images/ehitus/ehitus-17.webp',
    '/images/ehitus/ehitus-2.webp',
    '/images/ehitus/ehitus-4.webp',
    '/images/ehitus/ehitus-5.webp',
    '/images/ehitus/ehitus-6.webp',
    '/images/ehitus/ehitus-7.webp',
    '/images/ehitus/ehitus-8.webp',
    '/images/ehitus/ehitus-9.webp',
    '/images/ehitus/ehitus-10.webp',
    '/images/ehitus/ehitus-11.webp',
    '/images/ehitus/ehitus-12.webp',
    '/images/ehitus/ehitus-13.webp',
    '/images/ehitus/ehitus-14.webp',
    '/images/ehitus/ehitus-15.webp',
  ])

  const perPage = ref(3)
  const totalImages = ref(1)

  const currentPage = computed(() => {
    return Math.ceil(currentImageIndex.value / perPage.value) + 1
  })

  const pages = computed(() => {
    if (karusell.value === null) return 1

    return Math.ceil(activeImages.value.length / perPage.value)
  })

  const activeImages = computed(() => {
    if (activeTab.value === 'Hoonest') {
      return imagesHoonest.value
    } else if (activeTab.value === 'Interior') {
      return imagesInterior.value
    } else if (activeTab.value === 'Ehitus') {
      return imagesEhitus.value
    } else {
      return imagesUmbruskond.value
    }
  })

  const nextImage = (event) => {
    karusell.value.go('+' + perPage.value)
  }

  const previousImage = (event) => {
    karusell.value.go('-' + perPage.value)
  }

  const karusell = ref(null)

  const onPageChange = (index, o, a) => {
    currentImageIndex.value = o
  }

  const onUpdated = (a) => {
    currentImageIndex.value = 0
    perPage.value = a.options.perPage
    totalImages.value = a.length
  }

  const onRefresh = (a) => {
    totalImages.value = a.length
  }

  const visible = ref(false)
  const main = ref(null)
  const thumbs = ref(null)

  const mainOptions = {
    // type      : 'loop',
    perPage: 1,
    perMove: 1,
    gap: '1rem',
    pagination: false,
    arrows: false,
  }

  const thumbsOptions = {
    type: 'slide',
    rewind: true,
    gap: '10',
    pagination: false,
    fixedWidth: 110,
    fixedHeight: 70,
    cover: true,
    focus: 'center',
    isNavigation: true,
    updateOnMove: true,
    arrows: false,
    snap: true,
  }

  const onThumbsReady = () => {
    const thumbsSplide = thumbs.value?.splide

    if (thumbsSplide) {
      thumbsOptions.start = currentThumbnail.value
      main.value?.sync(thumbsSplide)
    }
  }

  const currentThumbnail = ref(0)

  const clickImage = (image, index) => {
    if (isMobile()) return

    currentThumbnail.value = index
    visible.value = true
    setTimeout(() => {
      main.value?.go(index)
    }, 300)
  }

  const onGalleryMove = (index, prev, dest) => {
    currentThumbnail.value = prev
  }

  const isMobile = () => {
    if (
      /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)
    ) {
      return true
    } else {
      return false
    }
  }

  const switchTab = (tab) => {
    activeTab.value = tab
    currentThumbnail.value = 0
    currentImageIndex.value = 0
    karusell.value.go(0)
  }
</script>

<template>
  <Dialog v-model:visible="visible" modal dismissableMask :header="$t('Galerii')">
    <Splide
      aria-labelledby="uusloo-gallery"
      :options="mainOptions"
      ref="main"
      @splide:move="onGalleryMove"
    >
      <SplideSlide v-for="slide in activeImages" :key="slide.alt">
        <img :src="slide" :alt="slide.alt" />
      </SplideSlide>
    </Splide>

    <Splide
      aria-label="Väike galerii"
      :options="thumbsOptions"
      ref="thumbs"
      @splide:mounted="onThumbsReady"
      class="mt-2 flex justify-center"
    >
      <SplideSlide
        v-for="(slide, index) in activeImages"
        :key="slide.alt"
        class="cursor-pointer"
        @click="currentThumbnail = index"
      >
        <div class="p-1" :class="{ 'bg-primary-400': index === currentThumbnail }">
          <img :src="slide" :alt="slide.alt" />
        </div>
      </SplideSlide>
    </Splide>
  </Dialog>

  <div class="py-10 md:py-14 max-w-screen-xl mx-auto px-3 md:px-5" id="galerii">
    <!-- Galerii header -->
    <div class="sm:flex-row flex flex-col gap-6">
      <div class="w-full sm:w-[65%] space-y-4">
        <h2>{{$t('Galerii')}}</h2>
      </div>
      <div class="hidden sm:flex sm:w-1/2 flex gap-12 items-center sm:justify-end">
        <!-- Previous arrow -->
        <svg
          @click="previousImage()"
          class="w-8 h-8 hover:text-primary-400 cursor-pointer"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M7.41254 17.5L25.9985 17.5C26.2638 17.5 26.5181 17.3946 26.7056 17.2071C26.8932 17.0195 26.9985 16.7652 26.9985 16.5C26.9985 16.2347 26.8932 15.9804 26.7056 15.7929C26.5181 15.6053 26.2638 15.5 25.9985 15.5L7.41254 15.5L14.7065 8.20796C14.8943 8.02018 14.9998 7.76551 14.9998 7.49996C14.9998 7.23441 14.8943 6.97973 14.7065 6.79196C14.5188 6.60418 14.2641 6.49869 13.9985 6.49869C13.733 6.49869 13.4783 6.60418 13.2905 6.79196L4.29054 15.792C4.19741 15.8848 4.12352 15.9952 4.07311 16.1167C4.0227 16.2382 3.99675 16.3684 3.99675 16.5C3.99675 16.6315 4.0227 16.7617 4.07311 16.8832C4.12352 17.0047 4.19741 17.1151 4.29054 17.208L13.2905 26.208C13.4783 26.3957 13.733 26.5012 13.9985 26.5012C14.2641 26.5012 14.5188 26.3957 14.7065 26.208C14.8943 26.0202 14.9998 25.7655 14.9998 25.5C14.9998 25.2344 14.8943 24.9797 14.7065 24.792L7.41254 17.5Z"
            fill="currentColor"
          />
        </svg>
        <h4 class="slide-counter">{{ currentPage }}/{{ pages }}</h4>

        <!-- Next Arrow -->
        <svg
          @click="nextImage()"
          class="w-8 h-8 hover:text-primary-400 cursor-pointer"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M23.5845 15.5H4.99854C4.73332 15.5 4.47896 15.6053 4.29143 15.7929C4.10389 15.9804 3.99854 16.2348 3.99854 16.5C3.99854 16.7652 4.10389 17.0196 4.29143 17.2071C4.47896 17.3946 4.73332 17.5 4.99854 17.5H23.5845L16.2905 24.792C16.1028 24.9798 15.9973 25.2344 15.9973 25.5C15.9973 25.7655 16.1028 26.0202 16.2905 26.208C16.4783 26.3958 16.733 26.5012 16.9985 26.5012C17.2641 26.5012 17.5188 26.3958 17.7065 26.208L26.7065 17.208C26.7997 17.1151 26.8735 17.0047 26.924 16.8832C26.9744 16.7618 27.0003 16.6315 27.0003 16.5C27.0003 16.3684 26.9744 16.2382 26.924 16.1167C26.8735 15.9952 26.7997 15.8849 26.7065 15.792L17.7065 6.79198C17.5188 6.60421 17.2641 6.49872 16.9985 6.49872C16.733 6.49872 16.4783 6.60421 16.2905 6.79198C16.1028 6.97975 15.9973 7.23443 15.9973 7.49998C15.9973 7.76553 16.1028 8.02021 16.2905 8.20798L23.5845 15.5Z"
            fill="currentColor"
          />
        </svg>
      </div>
    </div>
    <!-- Tabs -->
    <div>
      <ul class="flex gap-6 mt-6">
        <li
          :class="{
            'active text-primary-700': activeTab === 'Hoonest',
          }"
          class="font-bold text-primary-600 cursor-pointer tab"
          @click="switchTab('Hoonest')"
        >
          {{$t('Hoonest')}}
          <span class="indicator"></span>
        </li>
        <li
          :class="{
            'active text-primary-700': activeTab === 'Umbruskond',
          }"
          class="font-bold text-primary-500 cursor-pointer tab"
          @click="switchTab('Umbruskond')"
        >
          {{$t('Ümbruskond')}}
          <span class="indicator"></span>
        </li>
        <li
          :class="{
            'active text-primary-700': activeTab === 'Interior',
          }"
          class="font-bold text-primary-500 cursor-pointer tab"
          @click="switchTab('Interior')"
        >
          {{$t('Interjöör')}}
          <span class="indicator"></span>
        </li>
        <li
          :class="{
            'active text-primary-700': activeTab === 'Ehitus',
          }"
          class="font-bold text-primary-500 cursor-pointer tab"
          @click="switchTab('Ehitus')"
        >
          {{$t('Ehitus')}}
          <span class="indicator"></span>
        </li>
      </ul>
    </div>
    <!-- Images Carousel -->
    <Splide
      ref="karusell"
      class="mt-4"
      :options="{
        arrows: false,
        perPage: 3,
        rewind: true,
        gap: 32,
        breakpoints: {
          640: {
            perPage: 1,
          },
          768: {
            perPage: 2,
          },
        },
      }"
      aria-label="My Favorite Images"
      @splide:move="onPageChange"
      @splide:updated="onUpdated"
      @splide:mounted="onUpdated"
      @splide:refresh="onRefresh"
    >
      <SplideSlide v-for="(image, index) in activeImages">
        <img
          :src="image"
          :alt="image"
          class="object-cover aspect-[3/2] w-full cursor-pointer"
          @click="clickImage(image, index)"
        />
      </SplideSlide>
    </Splide>
    <div class="sm:hidden sm:w-1/2 flex gap-12 items-center justify-center">
      <!-- Previous arrow -->
      <svg
        @click="previousImage()"
        class="w-8 h-8 hover:text-primary-400 cursor-pointer"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M7.41254 17.5L25.9985 17.5C26.2638 17.5 26.5181 17.3946 26.7056 17.2071C26.8932 17.0195 26.9985 16.7652 26.9985 16.5C26.9985 16.2347 26.8932 15.9804 26.7056 15.7929C26.5181 15.6053 26.2638 15.5 25.9985 15.5L7.41254 15.5L14.7065 8.20796C14.8943 8.02018 14.9998 7.76551 14.9998 7.49996C14.9998 7.23441 14.8943 6.97973 14.7065 6.79196C14.5188 6.60418 14.2641 6.49869 13.9985 6.49869C13.733 6.49869 13.4783 6.60418 13.2905 6.79196L4.29054 15.792C4.19741 15.8848 4.12352 15.9952 4.07311 16.1167C4.0227 16.2382 3.99675 16.3684 3.99675 16.5C3.99675 16.6315 4.0227 16.7617 4.07311 16.8832C4.12352 17.0047 4.19741 17.1151 4.29054 17.208L13.2905 26.208C13.4783 26.3957 13.733 26.5012 13.9985 26.5012C14.2641 26.5012 14.5188 26.3957 14.7065 26.208C14.8943 26.0202 14.9998 25.7655 14.9998 25.5C14.9998 25.2344 14.8943 24.9797 14.7065 24.792L7.41254 17.5Z"
          fill="currentColor"
        />
      </svg>
      <h4 class="slide-counter text-3xl">{{ currentPage }}/{{ pages }}</h4>

      <!-- Next Arrow -->
      <svg
        @click="nextImage()"
        class="w-8 h-8 hover:text-primary-400 cursor-pointer"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M23.5845 15.5H4.99854C4.73332 15.5 4.47896 15.6053 4.29143 15.7929C4.10389 15.9804 3.99854 16.2348 3.99854 16.5C3.99854 16.7652 4.10389 17.0196 4.29143 17.2071C4.47896 17.3946 4.73332 17.5 4.99854 17.5H23.5845L16.2905 24.792C16.1028 24.9798 15.9973 25.2344 15.9973 25.5C15.9973 25.7655 16.1028 26.0202 16.2905 26.208C16.4783 26.3958 16.733 26.5012 16.9985 26.5012C17.2641 26.5012 17.5188 26.3958 17.7065 26.208L26.7065 17.208C26.7997 17.1151 26.8735 17.0047 26.924 16.8832C26.9744 16.7618 27.0003 16.6315 27.0003 16.5C27.0003 16.3684 26.9744 16.2382 26.924 16.1167C26.8735 15.9952 26.7997 15.8849 26.7065 15.792L17.7065 6.79198C17.5188 6.60421 17.2641 6.49872 16.9985 6.49872C16.733 6.49872 16.4783 6.60421 16.2905 6.79198C16.1028 6.97975 15.9973 7.23443 15.9973 7.49998C15.9973 7.76553 16.1028 8.02021 16.2905 8.20798L23.5845 15.5Z"
          fill="currentColor"
        />
      </svg>
    </div>
  </div>
</template>
