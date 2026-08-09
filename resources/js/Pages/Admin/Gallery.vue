<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GalleryImageManager from '@/Components/Admin/GalleryImageManager.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import draggable from 'vuedraggable';
import ConfirmDialog from 'primevue/confirmdialog';
import { useToast } from 'primevue/usetoast';
import { useConfirm } from 'primevue/useconfirm';

const props = defineProps({
    hero: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        default: () => [],
    },
});

const toast = useToast();
const confirm = useConfirm();

// Local copy so vuedraggable can reorder; resynced on every prop reload.
const categoryItems = ref([...props.categories]);

watch(
    () => props.categories,
    (val) => {
        categoryItems.value = [...val];
    }
);

const saveCategoryOrder = () => {
    router.post(
        route('admin.gallery.category.reorder'),
        { ids: categoryItems.value.map((c) => c.id) },
        { preserveScroll: true, preserveState: true }
    );
};

const addCategory = () => {
    router.post(
        route('admin.gallery.category.create'),
        {},
        {
            preserveScroll: true,
            onSuccess: () =>
                toast.add({
                    severity: 'success',
                    summary: 'Lisatud',
                    detail: 'Uus kategooria loodud — anna sellele nimi.',
                    life: 4000,
                }),
        }
    );
};

const saveNames = (category) => {
    router.post(
        route('admin.gallery.category.update', category.id),
        {
            name_et: category.name.et,
            name_en: category.name.en,
            name_ru: category.name.ru,
        },
        {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () =>
                toast.add({
                    severity: 'success',
                    summary: 'Salvestatud',
                    detail: 'Kategooria nimed uuendatud.',
                    life: 3000,
                }),
        }
    );
};

const deleteCategory = (category) => {
    confirm.require({
        message: `Kustutada kategooria "${category.name.et || 'Nimetu'}" koos kõigi piltidega?`,
        header: 'Kinnita kustutamine',
        icon: 'pi pi-exclamation-triangle',
        acceptLabel: 'Kustuta',
        rejectLabel: 'Loobu',
        accept: () => {
            router.delete(route('admin.gallery.category.delete', category.id), {
                preserveScroll: true,
                onSuccess: () =>
                    toast.add({
                        severity: 'success',
                        summary: 'Kustutatud',
                        detail: 'Kategooria eemaldatud.',
                        life: 3000,
                    }),
            });
        },
    });
};
</script>

<template>
    <Head title="Galerii haldus" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Galerii</h2>
        </template>

        <Toast />
        <ConfirmDialog></ConfirmDialog>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Hero slideshow -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                    <h3 class="font-bold text-lg mb-1">Esilehe slaidid</h3>
                    <p class="text-sm text-gray-500 mb-4">
                        Suur pildivahetus esilehe päises. Lohista pilte järjekorra muutmiseks.
                    </p>

                    <GalleryImageManager :category="hero" />
                </div>

                <!-- Carousel categories -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div>
                            <h3 class="font-bold text-lg mb-1">Galerii kategooriad</h3>
                            <p class="text-sm text-gray-500">
                                Galerii karusselli vahelehed esilehel, galerii- ja asukohalehel.
                                Lohista kategooriaid või pilte järjekorra muutmiseks.
                            </p>
                        </div>
                        <PrimaryButton type="button" @click="addCategory">
                            Lisa kategooria
                        </PrimaryButton>
                    </div>

                    <p v-if="!categoryItems.length" class="text-sm text-gray-500 italic">
                        Kategooriaid pole. Ilma kategooriateta galeriid avalikul lehel ei kuvata.
                    </p>

                    <draggable
                        v-model="categoryItems"
                        item-key="id"
                        handle=".category-handle"
                        @end="saveCategoryOrder"
                        class="space-y-4"
                    >
                        <template #item="{ element }">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start gap-3 mb-4">
                                    <span
                                        class="category-handle cursor-move select-none text-gray-400 text-xl leading-none pt-6"
                                        title="Lohista järjekorra muutmiseks"
                                        >⠿</span
                                    >

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 flex-1">
                                        <div>
                                            <label class="font-bold block mb-1 text-sm">Nimi (EE)</label>
                                            <InputText
                                                v-model="element.name.et"
                                                class="w-full !border rounded-md !border-surface-300"
                                            />
                                        </div>
                                        <div>
                                            <label class="font-bold block mb-1 text-sm">Nimi (EN)</label>
                                            <InputText
                                                v-model="element.name.en"
                                                class="w-full !border rounded-md !border-surface-300"
                                            />
                                        </div>
                                        <div>
                                            <label class="font-bold block mb-1 text-sm">Nimi (RU)</label>
                                            <InputText
                                                v-model="element.name.ru"
                                                class="w-full !border rounded-md !border-surface-300"
                                            />
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-2 pt-6">
                                        <PrimaryButton type="button" @click="saveNames(element)">
                                            Salvesta
                                        </PrimaryButton>
                                        <button
                                            type="button"
                                            @click="deleteCategory(element)"
                                            class="text-sm text-red-600 hover:text-red-800 underline"
                                        >
                                            Kustuta
                                        </button>
                                    </div>
                                </div>

                                <GalleryImageManager :category="element" />
                            </div>
                        </template>
                    </draggable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
