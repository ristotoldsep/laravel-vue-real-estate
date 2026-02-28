<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const currentImageIndex = ref(0);
const images = ref([
    "/images/renderid/saha-8_c1.webp",
    "/images/renderid/saha-8_c2.webp",
    "/images/renderid/saha-8_c3.webp",
    "/images/renderid/saha-8_c4.webp",
    "/images/renderid/saha-8_c7.webp",
    "/images/renderid/saha-8_c8.webp",
    "/images/renderid/saha-8_c9.webp",
    "/images/renderid/saha-8_c10.webp",
]);

const currentImage = computed(() => images.value[currentImageIndex.value]);

function nextImage() {
    if (currentImageIndex.value < images.value.length - 1) {
        currentImageIndex.value++;
    } else {
        currentImageIndex.value = 0;
    }
}

function previousImage() {
    if (currentImageIndex.value > 0) {
        currentImageIndex.value--;
    } else {
        currentImageIndex.value = images.value.length - 1;
    }
}
</script>

<template>
    <div class="w-full relative">
        <div class="relative z-10">
            <!-- Slideshow images -->
            <transition-group
                name="heroSlideshow"
                mode="out-in"
                tag="div"
                class="aspect-ratio-box overflow-hidden"
            >
                <img
                    class="aspect-ratio-box-inside"
                    :src="currentImage"
                    alt="Uus Loo Hausers uusarendus"
                    :key="currentImage"
                />
            </transition-group>

            <!-- Slideshow controls -->
            <div
                class="flex items-center justify-between absolute w-full bg-primary-100 uppercase p-3 sm:p-6 bottom-0"
            >
                <div class="">
                    <h6 class="font-piazolla sm:text-lg font-normal">
                        Uus Loo
                    </h6>
                    <h6 class="font-bold text-xl sm:text-2xl leading-none">
                        {{$t('Valmib 2026')}}
                    </h6>
                </div>
                <div class="flex items-center justify-between w-[40%]">
                    <!-- Previous arrow -->
                    <svg
                        @click="previousImage"
                        class="w-8 h-8 hover:text-primary-400 cursor-pointer"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M7.41254 17.5L25.9985 17.5C26.2638 17.5 26.5181 17.3946 26.7056 17.2071C26.8932 17.0195 26.9985 16.7652 26.9985 16.5C26.9985 16.2347 26.8932 15.9804 26.7056 15.7929C26.5181 15.6053 26.2638 15.5 25.9985 15.5L7.41254 15.5L14.7065 8.20796C14.8943 8.02018 14.9998 7.76551 14.9998 7.49996C14.9998 7.23441 14.8943 6.97973 14.7065 6.79196C14.5188 6.60418 14.2641 6.49869 13.9985 6.49869C13.733 6.49869 13.4783 6.60418 13.2905 6.79196L4.29054 15.792C4.19741 15.8848 4.12352 15.9952 4.07311 16.1167C4.0227 16.2382 3.99675 16.3684 3.99675 16.5C3.99675 16.6315 4.0227 16.7617 4.07311 16.8832C4.12352 17.0047 4.19741 17.1151 4.29054 17.208L13.2905 26.208C13.4783 26.3957 13.733 26.5012 13.9985 26.5012C14.2641 26.5012 14.5188 26.3957 14.7065 26.208C14.8943 26.0202 14.9998 25.7655 14.9998 25.5C14.9998 25.2344 14.8943 24.9797 14.7065 24.792L7.41254 17.5Z"
                            fill="currentColor"
                        />
                    </svg>
                    <h4 class="slide-counter">
                        {{ currentImageIndex + 1 }}/{{ images?.length }}
                    </h4>

                    <!-- Next Arrow -->
                    <svg
                        @click="nextImage"
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

            <div
                class="hidden h-full w-full ml-5 -z-10 -bottom-5 lg:block absolute bg-primary-200"
            ></div>
        </div>
    </div>
</template>
