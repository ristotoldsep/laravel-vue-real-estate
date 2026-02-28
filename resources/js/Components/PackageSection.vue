<script setup>
const props = defineProps({
  reverseLayout: {
    type: Boolean,
    default: false,
  },
  packageImage: {
    type: String,
    required: true,
  },
  subtitle: {
    type: String,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
  description: {
    type: String,
    required: true,
  },
  colors: {
    type: Array,
    required: true,
  },
  tiles: {
    type: Array,
    required: true,
  },
  pdfFile: {
    type: String,
    required: true,
  },
});
</script>

<template>
    <section class="border-b border-primary-100">
      <div
        :class="[
          'py-10 sm:py-20 px-3 xl:px-0 mx-auto max-w-screen-xl items-center gap-8 flex flex-col',
          reverseLayout ? 'md:flex-row-reverse' : 'md:flex-row'
        ]"
      >
        <div class="md:w-[45%] w-full">
          <img :src="`/images/paketid/${packageImage}`" alt="" />
        </div>
        <div class="w-full md:w-[55%] space-y-10">
          <div class="space-y-3">
            <p class="uppercase">{{ subtitle }}</p>
            <h2>{{ title }}</h2>
            <p>{{ description }}</p>
          </div>
          <PrimaryButton
          class="w-full text-center justify-center md:w-fit"
            type="a"
            :href="`/images/paketid/${pdfFile}`"
            download="UusLoo Pakett.pdf"
          >
            {{ $t('Laadi alla PDF') }}
          </PrimaryButton>
        </div>
      </div>
    </section>
  </template>



