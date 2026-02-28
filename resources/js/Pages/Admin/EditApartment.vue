<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import LocalCheckbox from '@/Components/Checkbox.vue';
import { usePrimeVue } from 'primevue/config';
import { useToast } from "primevue/usetoast";


import ConfirmDialog from 'primevue/confirmdialog';

import { useConfirm } from "primevue/useconfirm";

const confirm = useConfirm();

const props = defineProps({
    apartment: {
        type: Object,
        default: () => false,
    },
    images: {
        type: Object,
        default: () => false,
    }
});

const toFloat = (val) => (val !== null && val !== undefined && val !== '') ? parseFloat(val) : null
const toInt = (val) => (val !== null && val !== undefined && val !== '') ? parseInt(val) : null

const form = useForm({
  id: props.apartment ? toInt(props.apartment.id) : null,
  number: props.apartment ? toInt(props.apartment.number) : null,
  floor: props.apartment ? toInt(props.apartment.floor) : null,
  rooms: props.apartment ? toInt(props.apartment.rooms) : null,
  area: props.apartment ? toFloat(props.apartment.area) : null,
  balcony: props.apartment ? toFloat(props.apartment.balcony) : null,
  price: props.apartment ? toInt(props.apartment.price) : null,
  salePrice: props.apartment ? toInt(props.apartment.salePrice) : null,
  offer: props.apartment ? props.apartment.offer : null,
  status: props.apartment ? props.apartment.status : null,
  kulaliskorter: props.apartment ? props.apartment.kulaliskorter : false,
  hidden: props.apartment ? props.apartment.hidden : false,
});

const $primevue = usePrimeVue();
const toast = useToast();

const totalSize = ref(0);
const totalSizePercent = ref({
  '1': 0,
  '2': 0,
  '3': 0,
});
const files = ref([]);

const onSelectedFiles = (event) => {
    files.value = event.files;
    files.value.forEach((file) => {
        totalSize.value += parseInt(formatSize(file.size));
    });
};

const onProgress = (event, id) => {
    totalSizePercent.value = {
        ...totalSizePercent.value,
        [id]: parseInt((event.originalEvent.loaded / event.originalEvent.total) * 100)
    };
};

const onUpload = (event, id) => {
    toast.add({ severity: 'success', summary: 'Õnnestus!', detail: 'Faili üleslaaditud ja töödeldud!', life: 6000 });
    totalSizePercent.value = {
      '1': 0,
      '2': 0,
      '3': 0,
    };
    router.reload({ only: ['images'] })
};

const formatSize = (bytes) => {
    const k = 1024;
    const dm = 3;
    const sizes = $primevue.config.locale.fileSizeTypes;

    if (bytes === 0) {
        return `0 ${sizes[0]}`;
    }

    const i = Math.floor(Math.log(bytes) / Math.log(k));
    const formattedSize = parseFloat((bytes / Math.pow(k, i)).toFixed(dm));

    return `${formattedSize} ${sizes[i]}`;
};

const save = () => {
  console.log(form.id)
    if (form.id === null) {
      form.post(route('apartment.create'), {
          preserveState: false,
          onSuccess: () => {
              toast.add({ severity: 'success', summary: 'Success', detail: 'Korter edukalt lisatud', life: 3000 });
          },
      });
    } else {
      form.post(route('apartment.update', { apartment: props.apartment.id }), {
          onSuccess: () => {
              toast.add({ severity: 'success', summary: 'Success', detail: 'Korter edukalt muudetud', life: 3000 });
          },
      });
    }
};

const confirm1 = () => {
  confirm.require({
        message: 'Kas sa tahad korteri '+ props.apartment.id +' kustutada?',
        header: 'Hoiatus',
        icon: 'pi pi-info-circle',
        rejectLabel: 'Katkesta',
        acceptLabel: 'Kustuta',
        rejectClass: '!text-gray-200',
        acceptClass: '!text-red-500',
        accept: () => {
          form.delete(route('apartment.delete', { apartment: props.apartment.id }), {
              onFinish: () => {
                  toast.add({ severity: 'success', summary: 'Success', detail: 'Korter edukalt kustutatud', life: 3000 });
              },
          });
        },
        reject: () => {

        }
    });
}
</script>

<template>
    <Head :title="form.id ? `Korter nr ${apartment.number} muutmine` : 'Uus korter'" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Korter {{ apartment.number }}</h2>
        </template>

        <Toast />
        <ConfirmDialog></ConfirmDialog>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 w-1/2 mb-1">
                  <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2 mb-2">
                      <LocalCheckbox v-model:checked="form.hidden" inputId="hidden" />
                      <label for="hidden" class="font-bold">Peida korter tabelist</label>
                    </div>
                    <div>
                      <label for="number" class="font-bold block mb-2"> Korteri number</label>
                      <InputNumber v-model="form.number" inputId="number" :useGrouping="false" class="w-full md:w-14rem" />
                    </div>
                    <div>
                      <label for="floor" class="font-bold block mb-2"> Korrus</label>
                      <InputNumber v-model="form.floor" inputId="floor" :useGrouping="false" class="w-full md:w-14rem" />
                    </div>
                    <div>
                      <label for="floor" class="font-bold block mb-2"> Tube</label>
                      <InputNumber v-model="form.rooms" inputId="floor" :useGrouping="false" class="w-full md:w-14rem" />
                    </div>
                    <div>
                      <label for="area" class="font-bold block mb-2"> Üldpind</label>
                      <InputNumber v-model="form.area" inputId="area" :useGrouping="false" :minFractionDigits="2" :maxFractionDigits="2" class="w-full md:w-14rem" />
                    </div>
                    <div>
                      <label for="balcony" class="font-bold block mb-2"> Rõdu</label>
                      <InputNumber v-model="form.balcony" inputId="balcony" :useGrouping="false" :minFractionDigits="2" :maxFractionDigits="2" class="w-full md:w-14rem" />
                    </div>
                    <div>
                      <label for="price" class="font-bold block mb-2"> Hind</label>
                      <InputNumber v-model="form.price" inputId="price" :useGrouping="false" class="w-full md:w-14rem" />
                    </div>
                    <div>
                      <label for="salePrice" class="font-bold block mb-2"> Soodushind</label>
                      <InputNumber v-model="form.salePrice" inputId="salePrice" :useGrouping="false" class="w-full md:w-14rem" />
                    </div>
                    <div>
                      <label for="salePrice" class="font-bold block mb-2"> Pakkumine</label>
                      <InputText v-model="form.offer" inputId="salePrice" :useGrouping="false" class="w-full !border rounded-md !border-surface-300 md:w-14rem" />
                    </div>
                    <div>
                      <label for="status" class="font-bold block mb-2"> Staatus</label>
                      <Dropdown v-model="form.status" :options="[
                        'Broneeritud',
                        'Müüdud',
                        'Naabrist Parem'
                      ]" showClear placeholder="Vali staatus" inputId="status" class="!w-full " />
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                      <LocalCheckbox v-model:checked="form.kulaliskorter" inputId="kulaliskorter" />
                      <label for="kulaliskorter" class="font-bold">Külaliskorter</label>
                    </div>
                  </div>
                </div>

                <div v-if="form.id" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 mb-1 rounded-lg w-full">
                  <div class="flex flex-col gap-6">
                    <div>
                      <label for="status" class="font-bold block mb-2">Korteri plaan</label>
                      <FileUpload
                        mode="basic"
                        name="file"
                        :url="'/api/upload/apartment/' + apartment.id"
                        accept="image/*"
                        :maxFileSize="10000000"
                        @upload="onUpload($event, 1)"
                        @select="onSelectedFiles"
                        @progress="onProgress($event, 1)"
                        :auto="true"
                        withCredentials
                        chooseLabel="Sirvi"
                      />
                      <ProgressBar v-if="totalSizePercent['1'] !== 0"
                      :value="totalSizePercent['1']" :class="['md:w-20rem h-1rem w-full md:ml-auto', { 'exceeded-progress-bar': totalSizePercent['1'] > 100 }]"
                          >
                          {{ totalSizePercent['1'] === 100 ? 'Pildi töötlemine ...' : totalSizePercent['1'] + '%' }}
                      </ProgressBar
                      >
                    </div>
                    <Image v-if="images.apartment" alt="Image">
                        <template #image>
                            <img :src="images.apartment" alt="image" />
                        </template>
                    </Image>

                    <Divider />

                    <div>
                      <label for="status" class="font-bold block mb-2">Korruse plaan</label>
                      <FileUpload
                        mode="basic"
                        name="file"
                        :url="'/api/upload/floor/' + apartment.id"
                        accept="image/*"
                        :maxFileSize="10000000"
                        @upload="onUpload($event, 2)"
                        @select="onSelectedFiles"
                        @progress="onProgress($event, 2)"
                        :auto="true"
                        withCredentials
                        chooseLabel="Sirvi"
                      />
                      <ProgressBar v-if="totalSizePercent['2'] !== 0" :value="totalSizePercent['2']" :class="['md:w-20rem h-1rem w-full md:ml-auto', { 'exceeded-progress-bar': totalSizePercent['2'] > 100 }]"
                          >
                          {{ totalSizePercent['2'] === 100 ? 'Pildi töötlemine ...' : totalSizePercent['2'] + '%' }}
                          </ProgressBar
                      >
                    </div>

                    <Image v-if="images.floor" alt="Image">
                        <template #image>
                            <img :src="images.floor" alt="image" />
                        </template>
                    </Image>

                    <Divider />

                    <div>
                      <label for="status" class="font-bold block mb-2">Asendiplaan</label>
                      <FileUpload
                        mode="basic"
                        name="file"
                        :url="'/api/upload/position/' + apartment.id"
                        accept="image/*"
                        :maxFileSize="10000000"
                        @upload="onUpload($event, 3)"
                        @select="onSelectedFiles"
                        @progress="onProgress($event, 3)"
                        :auto="true"
                        withCredentials
                        chooseLabel="Sirvi"
                      />
                      <ProgressBar v-if="totalSizePercent['3'] !== 0" :value="totalSizePercent['3']"  :class="['md:w-20rem h-1rem w-full md:ml-auto', { 'exceeded-progress-bar': totalSizePercent['3'] > 100 }]"
                          >
                          {{ totalSizePercent['3'] === 100 ? 'Pildi töötlemine ...' : totalSizePercent['3'] + '%' }}
                          </ProgressBar
                      >
                    </div>

                    <Image v-if="images.position" alt="Image">
                        <template #image>
                            <img :src="images.position" alt="image" />
                        </template>
                    </Image>
                  </div>
              </div>
            </div>

            <div class="mt-4 max-w-7xl mx-auto w-full flex justify-center">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5 rounded-lg flex gap-4">
                  <PrimaryButton @click="save">{{ form.id ? 'Salvesta' : 'Loo'}}</PrimaryButton>
                  <PrimaryButton v-if="apartment.id" type="div" @click="confirm1">Kustuta</PrimaryButton>
                </div>
            </div>

            </div>
    </AuthenticatedLayout>
</template>
