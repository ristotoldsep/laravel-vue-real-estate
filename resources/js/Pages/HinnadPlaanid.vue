<script setup>
  import { Head, router } from '@inertiajs/vue3'
  import GuestLayout from '@/Layouts/GuestLayout.vue'
  import LocalCheckbox from '@/Components/Checkbox.vue'
  import { ref, onMounted, computed, nextTick, onUnmounted, watch } from 'vue'
  import { debounce, throttle } from 'lodash-es'
  import { useRoute } from '@/Plugins/useRoute'

  const props = defineProps({
    apartments: {
      type: Array,
      required: true,
    },
    images: {
      type: Object,
      required: true,
    },
  })

  const route = useRoute()

  onMounted(() => {
    nextTick(() => {
      tableRef.value = document.querySelector('[data-pc-section="table"]')
      const tbody = document.querySelector('[data-pc-section="tbody"]')
      if (tbody) {
        tbody.addEventListener('mousemove', debouncedHandleRowHover)
        tbody.addEventListener('mouseleave', handleRowUnhover)
        tbody.addEventListener('mouseenter', () => handleTableHover(true))
        tbody.addEventListener('mouseleave', () => handleTableHover(false))
      }
      window.addEventListener('scroll', handleScroll, { passive: true })
      window.addEventListener('resize', debouncedUpdateImagePosition)
      updateImagePosition() // Initial position
    })
  })

  onUnmounted(() => {
    const tbody = document.querySelector('[data-pc-section="tbody"]')
    if (tbody) {
      tbody.removeEventListener('mousemove', debouncedHandleRowHover)
      tbody.removeEventListener('mouseleave', handleRowUnhover)
      tbody.removeEventListener('mouseenter', () => handleTableHover(true))
      tbody.removeEventListener('mouseleave', () => handleTableHover(false))
    }
    window.removeEventListener('scroll', handleScroll)
    window.removeEventListener('resize', debouncedUpdateImagePosition)
  })

  const handleRowHover = (event) => {
    const row = event.target.closest('[data-pc-section="bodyrow"]')

    if (row && row !== lastHoveredRow.value) {
      lastHoveredRow.value = row
      const index = parseInt(row.dataset.pIndex, 10)
      const apartmentId = apartmentTable.value.processedData[index].id
      hoveredApartment.value = apartmentId
      updateImagePosition()
    }
  }

  const handleRowUnhover = () => {
    hoveredApartment.value = null
    lastHoveredRow.value = null
  }

  const formatCurrency = (value) => {
    if (value == null) return '-'
    return value.toLocaleString('et-EE', {
      style: 'currency',
      currency: 'EUR',
      minimumFractionDigits: 0,
      maximumFractionDigits: 0,
    })
  }

  const apartmentTable = ref(null)
  const hoveredApartment = ref(null)
  const loadedImages = ref({})
  const imageContainerRef = ref(null)
  const lastHoveredRow = ref(null)
  const isHoveringTable = ref(false)
  const tableRef = ref(null)
  const isTableInView = ref(false)
  const tableWidth = ref(0)
  const imageLeft = ref(0)
  const tableTop = ref(0)
  const tableBottom = ref(0)
  const imageHeight = 600 // Fixed image height

  // Lazy loading function
  const lazyLoadImage = (apartmentId) => {
    if (!loadedImages.value[apartmentId] && props.images[apartmentId]) {
      const img = new Image()
      img.src = props.images[apartmentId]
      img.onload = () => {
        loadedImages.value[apartmentId] = props.images[apartmentId]
      }
    }
  }

  watch(hoveredApartment, (newValue) => {
    if (newValue !== null) {
      lazyLoadImage(newValue)
    }
  })

  const onRowSelect = (event) => {
    if (event.data.status === 'Müüdud') return
    router.get(route('korteri-detail', { number: event.data.number }))
  }

  const checked = ref(true)

  const roomType = ref([])

  const filteredApartments = computed(() => {
    return props.apartments.filter((apartment) => {
      // Never show hidden apartments
      if (apartment.hidden) return false

      if (!checked.value) {
        // Filter apartments with status === null
        if (apartment.status !== null) {
          return false
        }
      }

      if (roomType.value.length) {
        // If roomType contains "2", include apartments with 2 or fewer rooms or the exact roomType
        if (roomType.value.includes('2')) {
          return apartment.rooms <= 2 || roomType.value.includes(String(apartment.rooms))
        }
        // Otherwise, filter based on exact roomType match
        return roomType.value.includes(String(apartment.rooms))
      }

      // If no specific filtering is applied, include all apartments
      return true
    })
  })

  const updateImagePosition = () => {
    if (!imageContainerRef.value || !tableRef.value) return
    const tableRect = tableRef.value.getBoundingClientRect()
    const windowHeight = window.innerHeight
    const windowWidth = window.innerWidth

    isTableInView.value = tableRect.top < windowHeight && tableRect.bottom > 0

    // Update table dimensions
    tableWidth.value = tableRect.width
    tableTop.value = tableRect.top
    tableBottom.value = tableRect.bottom
    imageLeft.value = tableRect.left + tableRect.width + 10 // 10px gap

    let topPosition = 0 // Start at the top of the viewport

    // Ensure image doesn't go above table top
    if (tableRect.top > 0) {
      topPosition = tableRect.top - 30
    }

    // Ensure image doesn't go below table bottom
    if (tableRect.bottom < topPosition + imageHeight) {
      topPosition = Math.max(tableRect.top - 30, tableRect.bottom - imageHeight)
    }

    imageContainerRef.value.style.top = `${topPosition}px`
    imageContainerRef.value.style.left = `${imageLeft.value}px`
  }

  const handleScroll = () => {
    requestAnimationFrame(updateImagePosition)
  }
  const handleTableHover = (isHovering) => {
    isHoveringTable.value = isHovering
    updateImagePosition()
  }

  const debouncedHandleRowHover = debounce(handleRowHover, 50)
  const debouncedUpdateImagePosition = debounce(updateImagePosition, 50)

  const hasOffers = computed(() => filteredApartments.value.some((apartment) => apartment.offer))
</script>

<template>
  <Head title="Hinnad ja plaanid | Uus Loo | Saha tee 8 | Korterid ja äripinnad Loo alevikus" />

  <GuestLayout>
    <section
      class="max-w-screen-xl mx-auto px-3 xl:px-0 flex flex-col md:flex-row items-top gap-10 py-20"
    >
      <div class="w-full md:w-[65%]" ref="tableRef">
        <h1 class="leading-none text-4xl">{{ $t('Hinnad & plaanid') }}</h1>
        <div
          class="py-4 px-3 mt-5 font-piazolla flex flex-col md:flex-row md:items-center md:justify-between gap-4 md:gap-10 text-nowrap overflow-x-auto"
        >
          <div class="flex items-center gap-5">
            <span>{{ $t('Näita:') }}</span>
            <div class="flex items-center gap-2 text-sm">
              <span>{{ $t('Saadaval') }}</span>
              <InputSwitch v-model="checked" />
              <span>{{ $t('Kõik') }}</span>
            </div>
          </div>
          <div class="flex items-center gap-5">
            <p>{{ $t('Tubade arv:') }}</p>
            <div class="flex items-center gap-2">
              <div class="flex items-center">
                <LocalCheckbox
                  v-model:checked="roomType"
                  inputId="roomType1"
                  name="roomType"
                  value="2"
                />
                <label for="roomType1" class="ml-2">{{ $t('1-2 tuba') }}</label>
              </div>
              <div class="flex items-center">
                <LocalCheckbox
                  v-model:checked="roomType"
                  inputId="roomType2"
                  name="roomType"
                  value="3"
                />
                <label for="roomType2" class="ml-2">{{ $t('3 tuba') }}</label>
              </div>
              <div class="flex items-center">
                <LocalCheckbox
                  v-model:checked="roomType"
                  inputId="roomType3"
                  name="roomType"
                  value="4"
                />
                <label for="roomType3" class="ml-2">{{ $t('4 tuba') }}</label>
              </div>
            </div>
          </div>
        </div>
        <div>
          <DataTable
            ref="apartmentTable"
            selectionMode="single"
            class=""
            :value="filteredApartments"
            @rowSelect="onRowSelect"
            size="small"
          >
            <Column field="number" :header="$t('Korter')" sortable>
              <template #body="slotProps">
                {{ slotProps.data.number }}{{ slotProps.data.kulaliskorter ? '*' : '' }}
              </template>
            </Column>
            <Column field="floor" :header="$t('Korrus')" sortable></Column>
            <Column field="rooms" :header="$t('Tube')" sortable></Column>
            <Column field="area" :header="$t('Üldpind')" sortable></Column>
            <Column field="balcony" :header="$t('Rõdu')" sortable>
              <template #body="slotProps">
                {{ slotProps.data.balcony != '' ? slotProps.data.balcony : '-' }}
              </template>
            </Column>
            <Column field="price" :header="$t('Hind')" sortable>
              <template #body="slotProps">
                <template v-if="slotProps.data.status === 'Müüdud'">-</template>
                <template v-else-if="slotProps.data.salePrice">
                  <div class="flex flex-col">
                    <span class="text-red-600 ms-2">
                      {{ formatCurrency(slotProps.data.salePrice) }}
                    </span>
                    <span class="line-through">{{ formatCurrency(slotProps.data.price) }}</span>
                  </div>
                </template>
                <template v-else>
                  {{ formatCurrency(slotProps.data.price) }}
                </template>
              </template>
            </Column>
            <Column
              class="text-nowrap"
              v-if="hasOffers"
              field="offer"
              :header="$t('Eripakkumine')"
            ></Column>
            <Column field="status" :header="$t('Seis')" sortable>
              <template #body="slotProps">
                <Tag v-if="slotProps.data.status" :value="$t(slotProps.data.status)"></Tag>
              </template>
            </Column>
          </DataTable>
        </div>
        <p class="mt-5 text-sm">
          {{ $t('Hinnad sisaldavad käibemaksu.') }}
          <br />
          {{ $t('Müüjal on õigus müümata korterite hindasid muuta.') }}
        </p>
        <p class="mt-5 text-md"> 
          {{ $t('* Korteriomandid 1-10 on külaliskorterid') }}
        </p>
      </div>
      <div
        ref="imageContainerRef"
        class="hidden lg:block fixed transition-all duration-300"
        :style="{
          width: `calc(35% - 10px)`,
          maxWidth: `calc(100% - ${tableWidth}px - 20px)`,
          height: `${imageHeight}px`,
          opacity: isHoveringTable && isTableInView ? 1 : 0,
          pointerEvents: isHoveringTable && isTableInView ? 'auto' : 'none',
        }"
      >
        <img
          v-for="apartment in filteredApartments"
          :key="apartment.id"
          v-show="loadedImages[apartment.id] && hoveredApartment === apartment.id"
          :src="loadedImages[apartment.id]"
          :alt="`Apartment ${apartment.number}`"
          class="absolute top-0 left-0 w-full h-full object-contain transition-opacity duration-300"
          loading="lazy"
        />
      </div>
    </section>
    <Kontaktivorm />
  </GuestLayout>
</template>

<style scoped>
  .md\:fixed {
    position: fixed;
  }
</style>