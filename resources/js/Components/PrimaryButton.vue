<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        default: "",
    },
    type: {
        type: String,
        default: "inertia",
    },
});

const component = computed(() => {
    switch (props.type) {
        case "inertia":
            return Link;
        case "a":
            return "a";
        case "div":
            return "div";
        case "button":
            return "button";
        default:
            return "div";
    }
});

const emit = defineEmits(["click"]);

const handleClick = () => {
    if (props.disabled) return;

    emit("click");
};
</script>

<template>
    <component
        :is="component"
        :href="href || undefined"
        @click="handleClick"
        class="inline-flex whitespace-nowrap font-normal font-piazolla items-center px-4 py-2 bg-primary-600 border border-transparent text-sm text-white uppercase tracking-widest hover:bg-primary-700 focus:bg-primary-700 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </component>
</template>
