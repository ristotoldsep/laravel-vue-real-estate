<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    apartments: {
        type: Array,
        required: true,
    },
});

const visibleApartments = computed(() => props.apartments);

const formatCurrency = (value) => {
    if (value === null || value === undefined) return '-';
    return value.toLocaleString('et-EE', { style: 'currency', currency: 'EUR', minimumFractionDigits: 0, maximumFractionDigits: 0 });
};

const editApartment = (slotProps) => {
    router.get(route('edit.apartment', { apartment: slotProps.data.id }));
};

const onRowSelect = (event) => {
    router.get(route("edit.apartment", { apartment: event.data.id }));
};
</script>

<template>
    <Head title="Korterid" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Korterid</h2>
                <PrimaryButton :href="route('create.apartment')">Lisa uus</PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <DataTable selectionMode="single" class="" :value="visibleApartments" @rowSelect="onRowSelect">
                        <Column
                            field="number"
                            header="Korter"
                            sortable
                        ><template #body="slotProps">{{ slotProps.data.number }}{{ slotProps.data.kulaliskorter ? '*' : '' }}</template></Column>
                        <Column
                            field="floor"
                            header="Korrus"
                            sortable

                        ></Column>
                        <Column
                            field="rooms"
                            header="Tube"
                            sortable
                        ></Column>
                        <Column
                            field="area"
                            header="Üldpind"
                            sortable
                        ></Column>
                        <Column
                            field="balcony"
                            header="Rõdu"
                            sortable
                        ><template #body="slotProps">{{ slotProps.data.balcony != '' ? slotProps.data.balcony : '-' }}</template></Column>
                        <Column

                            field="price"
                            header="Hind"
                            sortable
                        ><template #body="slotProps">
                            {{ formatCurrency(slotProps.data.price) }}
                        </template></Column>
                        <Column
                            field="status"
                            header="Seis"
                            sortable
                        ><template #body="slotProps">
                            <Tag v-if="slotProps.data.status">{{ slotProps.data.status }}</Tag>
                        </template></Column>
                        <Column header="Tegevused" style="width: 10%; min-width: 8rem" bodyStyle="text-align:center">
                            <template #body="slotProps">
                                <PrimaryButton type="div" @click="editApartment(slotProps)">Muuda</PrimaryButton>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
