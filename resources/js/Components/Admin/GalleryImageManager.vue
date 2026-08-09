<script setup>
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import draggable from 'vuedraggable';
import { useToast } from 'primevue/usetoast';
import { useConfirm } from 'primevue/useconfirm';

const props = defineProps({
    category: {
        type: Object,
        required: true,
    },
});

const toast = useToast();
const confirm = useConfirm();

// Local copy so vuedraggable can mutate it; resynced whenever props reload.
const items = ref([...props.category.images]);

watch(
    () => props.category.images,
    (val) => {
        items.value = [...val];
    }
);

const uploadPercent = ref(0);
const uploading = ref(false);

// PHP's max_file_uploads caps files *per request* (20 by default) and silently
// drops the overflow. Uploading in batches keeps any selection size working
// without depending on the server's php.ini.
const BATCH_SIZE = 15;

/**
 * PrimeVue's built-in XHR uploader can't send the CSRF token, so we take over
 * with customUpload and post through axios, which attaches X-XSRF-TOKEN itself.
 * Note @progress and @upload never fire under customUpload.
 */
const uploadFiles = async (event) => {
    const files = event.files ?? [];

    if (!files.length) return;

    const batches = [];
    for (let i = 0; i < files.length; i += BATCH_SIZE) {
        batches.push(files.slice(i, i + BATCH_SIZE));
    }

    // Progress is tracked in bytes so the bar stays smooth across batches.
    const totalBytes = files.reduce((sum, file) => sum + file.size, 0) || 1;
    let sentBytes = 0;

    uploading.value = true;
    uploadPercent.value = 0;

    try {
        for (const batch of batches) {
            const data = new FormData();
            batch.forEach((file) => data.append('file[]', file));

            const batchBytes = batch.reduce((sum, file) => sum + file.size, 0);

            await axios.post(route('admin.gallery.images.upload', props.category.id), data, {
                onUploadProgress: (e) => {
                    const loaded = e.total ? (e.loaded / e.total) * batchBytes : 0;
                    uploadPercent.value = Math.min(
                        100,
                        Math.round(((sentBytes + loaded) / totalBytes) * 100)
                    );
                },
            });

            sentBytes += batchBytes;
        }

        toast.add({
            severity: 'success',
            summary: 'Õnnestus!',
            detail: `${files.length} pilti üles laaditud.`,
            life: 5000,
        });

        router.reload({ only: ['hero', 'categories'] });
    } catch (error) {
        toast.add({
            severity: 'error',
            summary: 'Üleslaadimine ebaõnnestus',
            detail: error.response?.data?.message ?? 'Proovi uuesti.',
            life: 8000,
        });
    } finally {
        uploading.value = false;
        uploadPercent.value = 0;
    }
};

const saveOrder = () => {
    router.post(
        route('admin.gallery.images.reorder', props.category.id),
        { ids: items.value.map((i) => i.id) },
        { preserveScroll: true, preserveState: true }
    );
};

const deleteImage = (image) => {
    confirm.require({
        message: 'Kustutada see pilt?',
        header: 'Kinnita kustutamine',
        icon: 'pi pi-exclamation-triangle',
        acceptLabel: 'Kustuta',
        rejectLabel: 'Loobu',
        accept: () => {
            router.delete(
                route('admin.gallery.images.delete', [props.category.id, image.id]),
                {
                    preserveScroll: true,
                    preserveState: true,
                    onSuccess: () =>
                        toast.add({
                            severity: 'success',
                            summary: 'Kustutatud',
                            detail: 'Pilt eemaldatud.',
                            life: 3000,
                        }),
                }
            );
        },
    });
};
</script>

<template>
    <div class="space-y-3">
        <div class="flex items-center gap-3 flex-wrap">
            <FileUpload
                mode="basic"
                name="file"
                accept="image/*"
                :multiple="true"
                :maxFileSize="10000000"
                :auto="true"
                customUpload
                chooseLabel="Lisa pilte"
                @uploader="uploadFiles"
            />
            <span class="text-sm text-gray-500">
                {{ items.length }} pilti
            </span>
        </div>

        <ProgressBar v-if="uploading" :value="uploadPercent" class="h-1rem">
            {{ uploadPercent === 100 ? 'Piltide töötlemine ...' : uploadPercent + '%' }}
        </ProgressBar>

        <p v-if="!items.length" class="text-sm text-gray-500 italic">
            Pilte pole veel lisatud.
        </p>

        <draggable
            v-else
            v-model="items"
            item-key="id"
            @end="saveOrder"
            class="grid grid-cols-3 md:grid-cols-5 gap-3"
        >
            <template #item="{ element }">
                <div class="relative group cursor-move">
                    <img
                        :src="element.url"
                        alt=""
                        class="object-cover aspect-square w-full rounded"
                    />
                    <button
                        type="button"
                        @click="deleteImage(element)"
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center leading-none"
                    >
                        ×
                    </button>
                </div>
            </template>
        </draggable>
    </div>
</template>
