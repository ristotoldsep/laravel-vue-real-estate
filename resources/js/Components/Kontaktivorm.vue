<script setup>
  import { useForm } from '@inertiajs/vue3'
  import Textarea from 'primevue/textarea'
  import { useToast } from 'primevue/usetoast'
  import { ref } from 'vue'
  import { useI18n } from 'vue-i18n'

  defineOptions({ inheritAttrs: false })
  const { t } = useI18n()

  const toast = useToast()

  const form = useForm({
    firstName: '',
    lastName: '',
    phone: '',
    email: '',
    comments: '',
  })

  const isLoading = ref(false)

  const contact = () => {
    isLoading.value = true

    form.post('/contact', {
      preserveScroll: true,
      onSuccess: () => {
        toast.add({
          severity: 'success',
          summary: t('Huvi registreeritud'),
          detail: t('Võtame Sinuga peatselt ühendust!'),
          life: 6000,
        })
        form.reset()
        isLoading.value = false
      },
      onError: () => {
        isLoading.value = false
      }
    })
  }
</script>

<template>
  <Toast position="top-center"><template #icon></template></Toast>
  <section v-bind="$attrs" class="bg-primary-100 py-20" id="korteriKontakt">
    <div class="max-w-screen-xl px-3 xl:px-0 mx-auto md:flex items-center">
      <div class="md:w-[40%] flex flex-col space-y-8 pr-6">
        <div class="flex flex-col lg:flex-row gap-6">
          <div class="text-center flex flex-col items-center flex-1">
            <img
              class="max-w-[120px] lg:max-w-[180px] border border-primary-200 rounded-full"
              src="@images/jevgeni_lipin.webp"
              alt=""
            />
            <h4 class="my-3 text-2xl">Jevgeni Lipin</h4>
            <div class="space-y-2">
              <h6 class="font-piazolla font-medium text-base">{{ $t('Müügiesindaja') }}</h6>
              <div class="flex items-center gap-1 justify-center text-primary-900">
                <p class="font-sans font-bold">EE</p>
                <p class="font-sans font-bold">EN</p>
                <p class="font-sans font-bold">RU</p>
              </div>
              <a href="tel:+372 5307 0330" class="font-piazolla block font-medium">+372 5307 0330</a>
              <a href="mailto:jevgeni@hausers.ee" class="font-piazolla font-medium">
                jevgeni@hausers.ee
              </a>
            </div>
          </div>
          <div class="text-center flex flex-col items-center flex-1">
            <img
              class="max-w-[120px] lg:max-w-[180px] border border-primary-200 rounded-full"
              src="@images/andra_helena_nigol.webp"
              alt=""
            />
            <h4 class="my-3 text-2xl">Andra Helena Nigol</h4>
            <div class="space-y-2">
              <h6 class="font-piazolla font-medium text-base">{{ $t('Müügiesindaja') }}</h6>
              <div class="flex items-center gap-1 justify-center text-primary-900">
                <p class="font-sans font-bold">EE</p>
                <p class="font-sans font-bold">EN</p>
                <p class="font-sans font-bold">RU</p>
              </div>
              <a href="tel:+372 5333 8399" class="font-piazolla block font-medium">+372 5333 8399</a>
              <a href="mailto:andra@hausers.ee" class="font-piazolla font-medium">
                andra@hausers.ee
              </a>
            </div>
          </div>
        </div>
      </div>
      <div
        class="md:pl-20 w-full max-w-[690px] border-t md:border-t-0 md:border-l mt-10 lg:mt-0 py-10 border-primary-200 space-y-3"
      >
        <h2>{{ $t('Võta ühendust') }}</h2>
        <p class="max-w-[690px] text-lg">
          {{
            $t(
              'Olete huvitatud UusLoo korterite müügist või soovite rohkem teavet projekti kohta? Täitke allolev päringuvorm ja vastame teile peagi. Aitame leida just teie vajadustele sobiva korteri.'
            )
          }}
        </p>
        <form action="" class=" ">
          <div class="grid sm:grid-cols-2 gap-6 mt-10">
            <div>
              <InputText
                name="firstname"
                v-model="form.firstName"
                class="w-full placeholder:uppercase placeholder:font-sans !border-primary-200"
                :class="{ '!border-red-500': form.errors.firstName }"
                type="text"
                size="small"
                :placeholder="$t('Eesnimi')"
              />
            </div>
            <InputText
              name="lastname"
              v-model="form.lastName"
              class="w-full placeholder:uppercase placeholder:font-sans !border-primary-200"
              :class="{ '!border-red-500': form.errors.lastName }"
              type="text"
              size="small"
              :placeholder="$t('Perekonnanimi')"
            />
            <InputText
              name="phone"
              v-model="form.phone"
              class="w-full placeholder:uppercase placeholder:font-sans !border-primary-200"
              :class="{ '!border-red-500': form.errors.phone }"
              type="number"
              size="small"
              :placeholder="$t('Telefon')"
            />
            <InputText
              name="email"
              v-model="form.email"
              class="w-full placeholder:uppercase placeholder:font-sans !border-primary-200"
              :class="{ '!border-red-500': form.errors.email }"
              type="email"
              size="small"
              :placeholder="$t('E-post')"
            />
          </div>
          <Textarea
            class="block w-full mt-5 placeholder:uppercase"
            :placeholder="$t('Kirja sisu')"
            v-model="form.comments"
            rows="5"
          />
          <PrimaryButton class="!font-medium mt-5" type="submit" size="small" @click="contact">
            {{ $t('Saada kiri') }}
          </PrimaryButton>
        </form>
        <div v-if="form.errors" class="mt-4">
          <p v-for="error in form.errors">{{ error }}</p>
        </div>
      </div>
    </div>
  </section>
</template>
