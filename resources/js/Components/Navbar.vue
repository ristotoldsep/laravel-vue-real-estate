<script setup>
  import { Head, Link, router } from '@inertiajs/vue3'
  import { ref } from 'vue'
  import { useI18n } from 'vue-i18n'

  const { locale, setLocaleMessage } = useI18n()

  const selectedLanguage = ref(locale.value)
  const visibleLeft = ref(false)

  //Infinity scroll for banner

  const changeLanguage = async (lang = null) => {
    if (lang) {
      selectedLanguage.value = lang
    }

    if (typeof window !== 'undefined') {
      try {
        router.visit(route('language.switch', { locale: selectedLanguage.value }), {
          async: true,
        })

        // Load new translations
        const messages = await import(`../../../lang/${selectedLanguage.value}.json`)
        setLocaleMessage(selectedLanguage.value, messages.default)

        appStore.locale = selectedLanguage.value
      } catch (error) {
        console.error('Failed to switch language:', error)
      }
    }
  }
</script>

<template>
  <nav>
    <!-- Banner -->
    <div class="bg-primary-700">
      <div class="banner-wrapper mx-auto px-5 py-2">
        <p class="marquee text-sm uppercase text-primary-100 text-center">
          {{$t('Kampaania! Kodud kuni 8 000€ allahindlusega!')}}
        </p>
      </div>
    </div>
    <!-- Top Nav -->
    <div class="border-b border-primary-100">
      <!-- Mobile top bar -->
      <div class="lg:hidden flex justify-between py-3 px-3 bg-primary-100">
        <a href="tel:+372 5307 0330" class="flex items-center gap-2">
          <svg
            width="18"
            height="18"
            viewBox="0 0 18 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <g clip-path="url(#clip0_186_212)">
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M6.12924 11.8717C9.01299 14.7555 11.6852 15.0712 12.4697 15.1005C13.4177 15.135 14.3852 14.361 14.8037 13.5682C14.1362 12.7852 13.267 12.1777 12.3152 11.5192C11.7535 12.0802 11.0612 13.1227 10.1395 12.7492C9.61524 12.5385 8.32074 11.9422 7.18974 10.8105C6.05799 9.67947 5.46249 8.38497 5.25024 7.86147C4.87674 6.93822 5.92224 6.24447 6.48399 5.68272C5.82549 4.71522 5.22849 3.82347 4.44699 3.18972C3.64299 3.60972 2.86449 4.56972 2.89974 5.53047C2.92899 6.31497 3.24474 8.98722 6.12924 11.8717ZM12.4142 16.5997C11.3342 16.56 8.27349 16.137 5.06799 12.9322C1.86324 9.72672 1.44099 6.66672 1.40049 5.58597C1.34049 3.93897 2.60199 2.33922 4.05924 1.71447C4.23473 1.6387 4.42689 1.60985 4.61689 1.63075C4.80689 1.65166 4.98819 1.7216 5.14299 1.83372C6.34899 2.71347 7.18074 4.04622 7.89549 5.09022C8.04418 5.30731 8.1123 5.56955 8.08805 5.83155C8.06381 6.09356 7.94874 6.33885 7.76274 6.52497L6.74574 7.54272C6.98199 8.06397 7.46274 8.96247 8.25024 9.74997C9.03774 10.5375 9.93624 11.0182 10.4582 11.2545L11.4745 10.2375C11.6613 10.0511 11.9076 9.93616 12.1705 9.91273C12.4334 9.88929 12.6961 9.95883 12.913 10.1092C13.978 10.8472 15.229 11.667 16.141 12.8347C16.2622 12.9906 16.3393 13.1763 16.3643 13.3722C16.3892 13.5681 16.361 13.7671 16.2827 13.9485C15.655 15.4132 14.0665 16.6605 12.4142 16.5997Z"
                fill="#2A2622"
              />
            </g>
            <defs>
              <clipPath id="clip0_186_212">
                <rect width="18" height="18" fill="white" />
              </clipPath>
            </defs>
          </svg>
          <span class="text-sm font-medium font-piazolla">+372 5307 0330</span>
        </a>
        <a
          href="https://maps.app.goo.gl/9Uzo5UfJE8w65bxS9"
          target="_blank"
          class="flex items-center gap-2 font-piazolla text-sm font-medium"
        >
          <svg
            width="18"
            height="18"
            viewBox="0 0 18 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M9 1.68752C6.20508 1.68752 3.9375 3.84577 3.9375 6.50393C3.9375 9.56252 7.3125 14.4095 8.55176 16.0837C8.6032 16.1543 8.67062 16.2118 8.74852 16.2515C8.82642 16.2911 8.91259 16.3118 9 16.3118C9.08741 16.3118 9.17358 16.2911 9.25148 16.2515C9.32938 16.2118 9.3968 16.1543 9.44824 16.0837C10.6875 14.4102 14.0625 9.56498 14.0625 6.50393C14.0625 3.84577 11.7949 1.68752 9 1.68752Z"
              stroke="#2A2622"
              stroke-width="1.125"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
            <path
              d="M9 8.43752C9.93198 8.43752 10.6875 7.682 10.6875 6.75002C10.6875 5.81804 9.93198 5.06252 9 5.06252C8.06802 5.06252 7.3125 5.81804 7.3125 6.75002C7.3125 7.682 8.06802 8.43752 9 8.43752Z"
              stroke="#2A2622"
              stroke-width="1.125"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <span class="font-piazolla">Saha tee 8, Loo alevik</span>
        </a>
      </div>
      <div class="py-5 justify-between px-5 flex max-w-screen-xl mx-auto">
        <a href="tel:+37253070330" class="items-center gap-2 hidden lg:flex">
          <svg
            width="18"
            height="18"
            viewBox="0 0 18 18"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <g clip-path="url(#clip0_186_212)">
              <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M6.12924 11.8717C9.01299 14.7555 11.6852 15.0712 12.4697 15.1005C13.4177 15.135 14.3852 14.361 14.8037 13.5682C14.1362 12.7852 13.267 12.1777 12.3152 11.5192C11.7535 12.0802 11.0612 13.1227 10.1395 12.7492C9.61524 12.5385 8.32074 11.9422 7.18974 10.8105C6.05799 9.67947 5.46249 8.38497 5.25024 7.86147C4.87674 6.93822 5.92224 6.24447 6.48399 5.68272C5.82549 4.71522 5.22849 3.82347 4.44699 3.18972C3.64299 3.60972 2.86449 4.56972 2.89974 5.53047C2.92899 6.31497 3.24474 8.98722 6.12924 11.8717ZM12.4142 16.5997C11.3342 16.56 8.27349 16.137 5.06799 12.9322C1.86324 9.72672 1.44099 6.66672 1.40049 5.58597C1.34049 3.93897 2.60199 2.33922 4.05924 1.71447C4.23473 1.6387 4.42689 1.60985 4.61689 1.63075C4.80689 1.65166 4.98819 1.7216 5.14299 1.83372C6.34899 2.71347 7.18074 4.04622 7.89549 5.09022C8.04418 5.30731 8.1123 5.56955 8.08805 5.83155C8.06381 6.09356 7.94874 6.33885 7.76274 6.52497L6.74574 7.54272C6.98199 8.06397 7.46274 8.96247 8.25024 9.74997C9.03774 10.5375 9.93624 11.0182 10.4582 11.2545L11.4745 10.2375C11.6613 10.0511 11.9076 9.93616 12.1705 9.91273C12.4334 9.88929 12.6961 9.95883 12.913 10.1092C13.978 10.8472 15.229 11.667 16.141 12.8347C16.2622 12.9906 16.3393 13.1763 16.3643 13.3722C16.3892 13.5681 16.361 13.7671 16.2827 13.9485C15.655 15.4132 14.0665 16.6605 12.4142 16.5997Z"
                fill="#2A2622"
              />
            </g>
            <defs>
              <clipPath id="clip0_186_212">
                <rect width="18" height="18" fill="white" />
              </clipPath>
            </defs>
          </svg>
          <span class="text-sm font-medium font-piazolla">+372 5307 0330</span>
        </a>
        <Link :href="$route('avaleht')" class="">
          <svg class="w-28" viewBox="0 0 120 47" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_186_227)">
              <path
                d="M36.5951 40.0828H21.8638V1.9155H15.6133V46.3265H43.3134C40.7373 44.6385 38.4594 42.5234 36.5951 40.076V40.0828Z"
                fill="#2C2825"
              />
              <path
                d="M5.95264 14.8775C4.07478 14.8775 2.61723 14.3623 1.56644 13.3318C0.522436 12.3014 -0.00634766 10.8506 -0.00634766 8.97273V1.9155H3.58667V8.86426C3.58667 9.94216 3.79683 10.715 4.22392 11.1896C4.64424 11.6641 5.23403 11.8946 5.98653 11.8946C6.73903 11.8946 7.32205 11.6573 7.73559 11.1896C8.14912 10.7218 8.35928 9.94216 8.35928 8.86426V1.9155H11.9184V8.97273C11.9184 10.8506 11.3896 12.3014 10.3321 13.3318C9.27448 14.3623 7.81016 14.8775 5.94586 14.8775H5.95264Z"
                fill="#2C2825"
              />
              <path
                d="M5.95264 30.7206C4.07478 30.7206 2.61723 30.2054 1.56644 29.175C0.522436 28.1445 -0.00634766 26.6938 -0.00634766 24.8159V17.7587H3.58667V24.7074C3.58667 25.7853 3.79683 26.5582 4.22392 27.0327C4.64424 27.5073 5.23403 27.7378 5.98653 27.7378C6.73903 27.7378 7.32205 27.5005 7.73559 27.0327C8.14912 26.5649 8.35928 25.7853 8.35928 24.7074V17.7587H11.9184V24.8159C11.9184 26.6938 11.3896 28.1445 10.3321 29.175C9.27448 30.2054 7.81016 30.7206 5.94586 30.7206H5.95264Z"
                fill="#2C2825"
              />
              <path
                d="M5.81706 46.8147C4.76627 46.8147 3.75616 46.6858 2.7935 46.4215C1.83084 46.1571 1.05122 45.8317 0.461426 45.4317L1.64102 42.7606C2.21048 43.1267 2.86807 43.425 3.60701 43.6623C4.35273 43.8996 5.09167 44.0148 5.83061 44.0148C6.33906 44.0148 6.73904 43.9741 7.03733 43.886C7.33561 43.8047 7.55255 43.6826 7.68814 43.5199C7.82372 43.364 7.89829 43.1742 7.89829 42.9572C7.89829 42.6793 7.76271 42.4556 7.49832 42.2929C7.23393 42.1302 6.8814 41.9878 6.45431 41.8726C6.02721 41.7573 5.55944 41.6488 5.05778 41.5472C4.55611 41.4455 4.04088 41.3099 3.52566 41.1404C3.00366 40.9709 2.53588 40.7472 2.10879 40.4693C1.6817 40.1913 1.34273 39.8252 1.08512 39.3778C0.827507 38.9304 0.691921 38.3677 0.691921 37.6897C0.691921 36.9372 0.8953 36.2593 1.30884 35.6356C1.72237 35.0187 2.34607 34.5238 3.17992 34.1442C4.01377 33.7713 5.05778 33.5815 6.29838 33.5815C7.13224 33.5815 7.95253 33.6764 8.75926 33.8662C9.566 34.0561 10.2778 34.334 10.8947 34.7069L9.80327 37.3576C9.19992 37.0186 8.59656 36.7678 8.00676 36.6118C7.41697 36.4559 6.84073 36.3746 6.28483 36.3746C5.78994 36.3746 5.38996 36.4288 5.08489 36.5373C4.77983 36.6457 4.56289 36.7881 4.43408 36.9576C4.30528 37.1271 4.23748 37.3101 4.23748 37.4999C4.23748 37.7914 4.37307 38.0152 4.63746 38.1779C4.90185 38.3406 5.2476 38.4761 5.67469 38.5778C6.09501 38.6795 6.56956 38.788 7.078 38.8965C7.59323 39.0049 8.10167 39.1405 8.61012 39.3032C9.11856 39.4659 9.58634 39.6829 10.0134 39.954C10.4405 40.2252 10.793 40.5845 11.0574 41.0252C11.3218 41.4658 11.4574 42.0217 11.4574 42.6861C11.4574 43.425 11.2473 44.1029 10.8337 44.7266C10.4134 45.3503 9.78971 45.852 8.95586 46.2249C8.12201 46.5977 7.07122 46.7875 5.81706 46.7875V46.8147Z"
                fill="#2C2825"
              />
              <path
                d="M97.317 0.90538C88.9785 0.90538 81.7043 5.44072 77.7588 12.1522C73.8132 5.44072 66.5323 0.90538 58.2006 0.90538C45.6928 0.90538 35.5171 11.0811 35.5171 23.5888C35.5171 36.0966 45.6928 46.2723 58.2006 46.2723C66.5391 46.2723 73.82 41.737 77.7588 35.0187C81.6975 41.737 88.9785 46.2723 97.317 46.2723C109.825 46.2723 120 36.0966 120 23.5888C120 11.0811 109.825 0.90538 97.317 0.90538ZM58.2006 40.0218C49.1367 40.0218 41.7676 32.6527 41.7676 23.5888C41.7676 14.5249 49.1367 7.15587 58.2006 7.15587C67.2644 7.15587 74.6335 14.5249 74.6335 23.5888C74.6335 32.6527 67.2644 40.0218 58.2006 40.0218ZM97.317 40.0218C88.2531 40.0218 80.884 32.6527 80.884 23.5888C80.884 14.5249 88.2531 7.15587 97.317 7.15587C106.381 7.15587 113.75 14.5249 113.75 23.5888C113.75 32.6527 106.381 40.0218 97.317 40.0218Z"
                fill="#2C2825"
              />
            </g>
            <defs>
              <clipPath id="clip0_186_227">
                <rect width="120" height="45.9093" fill="white" transform="translate(0 0.905365)" />
              </clipPath>
            </defs>
          </svg>
        </Link>

        <div class="flex gap-10 items-center">
          <div class="flex gap-5 font-piazolla text-sm font-medium">
            <a
              href="https://maps.app.goo.gl/9Uzo5UfJE8w65bxS9"
              target="_blank"
              class="items-center gap-2 hidden lg:flex"
            >
              <svg
                width="18"
                height="18"
                viewBox="0 0 18 18"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M9 1.68752C6.20508 1.68752 3.9375 3.84577 3.9375 6.50393C3.9375 9.56252 7.3125 14.4095 8.55176 16.0837C8.6032 16.1543 8.67062 16.2118 8.74852 16.2515C8.82642 16.2911 8.91259 16.3118 9 16.3118C9.08741 16.3118 9.17358 16.2911 9.25148 16.2515C9.32938 16.2118 9.3968 16.1543 9.44824 16.0837C10.6875 14.4102 14.0625 9.56498 14.0625 6.50393C14.0625 3.84577 11.7949 1.68752 9 1.68752Z"
                  stroke="#2A2622"
                  stroke-width="1.125"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
                <path
                  d="M9 8.43752C9.93198 8.43752 10.6875 7.682 10.6875 6.75002C10.6875 5.81804 9.93198 5.06252 9 5.06252C8.06802 5.06252 7.3125 5.81804 7.3125 6.75002C7.3125 7.682 8.06802 8.43752 9 8.43752Z"
                  stroke="#2A2622"
                  stroke-width="1.125"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              <span class="">Saha tee 8, Loo alevik</span>
            </a>
          </div>
          <div class="flex justify-center gap-2">
            <button :class="{ 'text-primary-300': $i18n.locale !== 'et' }" @click="changeLanguage('et')">EE</button>
            <button :class="{ 'text-primary-300': $i18n.locale !== 'en' }" @click="changeLanguage('en')">EN</button>
            <button :class="{ 'text-primary-300': $i18n.locale !== 'ru' }" @click="changeLanguage('ru')">RU</button>
          </div>
          <svg
            @click="visibleLeft = true"
            class="lg:hidden size-10"
            viewBox="0 0 48 48"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M7.5 13.5H40.5M7.5 24H40.5M7.5 34.5H40.5"
              stroke="#39322D"
              stroke-width="3"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
        </div>
      </div>
    </div>
    <!-- Bottom Nav -->
    <ul class="hidden lg:flex justify-center text-primary-400 gap-10 py-3 font-bold">
      <Link
        :class="{
          '  text-primary-700': $routeCurrent('asukoht'),
        }"
        :href="$route('asukoht')"
        class="hover:text-primary-900"
        href=""
        v-smooth-scroll
      >
        {{ $t('Asukoht') }}
      </Link>
      <Link
        :class="{
          '  text-primary-700': $routeCurrent('hinnad-plaanid'),
        }"
        :href="$route('hinnad-plaanid')"
        class="hover:text-primary-900"
        href=""
        v-smooth-scroll
      >
        {{ $t('Hinnad & plaanid') }}
      </Link>
      <Link
        :class="{
          '  text-primary-700': $routeCurrent('interjoor'),
        }"
        :href="$route('interjoor')"
        class="hover:text-primary-900"
        v-smooth-scroll
      >
        {{ $t('Interjöör') }}
      </Link>
      <Link
        :class="{
          '  text-primary-700': $routeCurrent('galerii'),
        }"
        :href="$route('galerii')"
        class="hover:text-primary-900"
        href=""
        v-smooth-scroll
      >
        {{ $t('Galerii') }}
      </Link>
      <Link
        :class="{
          '  text-primary-700': $routeCurrent('aripinnad'),
        }"
        :href="$route('aripinnad')"
        class="hover:text-primary-900"
        href=""
        v-smooth-scroll
      >
        {{ $t('Äripinnad') }}
      </Link>
      <Link
        :class="{
          '  text-primary-700': $routeCurrent('ehitusinfo'),
        }"
        :href="$route('ehitusinfo')"
        class="hover:text-primary-900"
        href=""
        v-smooth-scroll
      >
        {{ $t('Ehitusinfo') }}
      </Link>
      <Link
        :class="{
          '  text-primary-700': $routeCurrent('muugiinfo'),
        }"
        :href="$route('muugiinfo')"
        class="hover:text-primary-900"
        href=""
        v-smooth-scroll
      >
        {{ $t('Müügiinfo') }}
      </Link>
    </ul>
    <Sidebar v-model:visible="visibleLeft" header="Menüü">
      <template #container="{ closeCallBack }">
        <div class="p-4 h-full overflow-y-auto">
          <Link :href="$route('avaleht')" class="">
            <svg class="w-28" viewBox="0 0 120 47" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_186_227)">
                <path
                  d="M36.5951 40.0828H21.8638V1.9155H15.6133V46.3265H43.3134C40.7373 44.6385 38.4594 42.5234 36.5951 40.076V40.0828Z"
                  fill="#2C2825"
                />
                <path
                  d="M5.95264 14.8775C4.07478 14.8775 2.61723 14.3623 1.56644 13.3318C0.522436 12.3014 -0.00634766 10.8506 -0.00634766 8.97273V1.9155H3.58667V8.86426C3.58667 9.94216 3.79683 10.715 4.22392 11.1896C4.64424 11.6641 5.23403 11.8946 5.98653 11.8946C6.73903 11.8946 7.32205 11.6573 7.73559 11.1896C8.14912 10.7218 8.35928 9.94216 8.35928 8.86426V1.9155H11.9184V8.97273C11.9184 10.8506 11.3896 12.3014 10.3321 13.3318C9.27448 14.3623 7.81016 14.8775 5.94586 14.8775H5.95264Z"
                  fill="#2C2825"
                />
                <path
                  d="M5.95264 30.7206C4.07478 30.7206 2.61723 30.2054 1.56644 29.175C0.522436 28.1445 -0.00634766 26.6938 -0.00634766 24.8159V17.7587H3.58667V24.7074C3.58667 25.7853 3.79683 26.5582 4.22392 27.0327C4.64424 27.5073 5.23403 27.7378 5.98653 27.7378C6.73903 27.7378 7.32205 27.5005 7.73559 27.0327C8.14912 26.5649 8.35928 25.7853 8.35928 24.7074V17.7587H11.9184V24.8159C11.9184 26.6938 11.3896 28.1445 10.3321 29.175C9.27448 30.2054 7.81016 30.7206 5.94586 30.7206H5.95264Z"
                  fill="#2C2825"
                />
                <path
                  d="M5.81706 46.8147C4.76627 46.8147 3.75616 46.6858 2.7935 46.4215C1.83084 46.1571 1.05122 45.8317 0.461426 45.4317L1.64102 42.7606C2.21048 43.1267 2.86807 43.425 3.60701 43.6623C4.35273 43.8996 5.09167 44.0148 5.83061 44.0148C6.33906 44.0148 6.73904 43.9741 7.03733 43.886C7.33561 43.8047 7.55255 43.6826 7.68814 43.5199C7.82372 43.364 7.89829 43.1742 7.89829 42.9572C7.89829 42.6793 7.76271 42.4556 7.49832 42.2929C7.23393 42.1302 6.8814 41.9878 6.45431 41.8726C6.02721 41.7573 5.55944 41.6488 5.05778 41.5472C4.55611 41.4455 4.04088 41.3099 3.52566 41.1404C3.00366 40.9709 2.53588 40.7472 2.10879 40.4693C1.6817 40.1913 1.34273 39.8252 1.08512 39.3778C0.827507 38.9304 0.691921 38.3677 0.691921 37.6897C0.691921 36.9372 0.8953 36.2593 1.30884 35.6356C1.72237 35.0187 2.34607 34.5238 3.17992 34.1442C4.01377 33.7713 5.05778 33.5815 6.29838 33.5815C7.13224 33.5815 7.95253 33.6764 8.75926 33.8662C9.566 34.0561 10.2778 34.334 10.8947 34.7069L9.80327 37.3576C9.19992 37.0186 8.59656 36.7678 8.00676 36.6118C7.41697 36.4559 6.84073 36.3746 6.28483 36.3746C5.78994 36.3746 5.38996 36.4288 5.08489 36.5373C4.77983 36.6457 4.56289 36.7881 4.43408 36.9576C4.30528 37.1271 4.23748 37.3101 4.23748 37.4999C4.23748 37.7914 4.37307 38.0152 4.63746 38.1779C4.90185 38.3406 5.2476 38.4761 5.67469 38.5778C6.09501 38.6795 6.56956 38.788 7.078 38.8965C7.59323 39.0049 8.10167 39.1405 8.61012 39.3032C9.11856 39.4659 9.58634 39.6829 10.0134 39.954C10.4405 40.2252 10.793 40.5845 11.0574 41.0252C11.3218 41.4658 11.4574 42.0217 11.4574 42.6861C11.4574 43.425 11.2473 44.1029 10.8337 44.7266C10.4134 45.3503 9.78971 45.852 8.95586 46.2249C8.12201 46.5977 7.07122 46.7875 5.81706 46.7875V46.8147Z"
                  fill="#2C2825"
                />
                <path
                  d="M97.317 0.90538C88.9785 0.90538 81.7043 5.44072 77.7588 12.1522C73.8132 5.44072 66.5323 0.90538 58.2006 0.90538C45.6928 0.90538 35.5171 11.0811 35.5171 23.5888C35.5171 36.0966 45.6928 46.2723 58.2006 46.2723C66.5391 46.2723 73.82 41.737 77.7588 35.0187C81.6975 41.737 88.9785 46.2723 97.317 46.2723C109.825 46.2723 120 36.0966 120 23.5888C120 11.0811 109.825 0.90538 97.317 0.90538ZM58.2006 40.0218C49.1367 40.0218 41.7676 32.6527 41.7676 23.5888C41.7676 14.5249 49.1367 7.15587 58.2006 7.15587C67.2644 7.15587 74.6335 14.5249 74.6335 23.5888C74.6335 32.6527 67.2644 40.0218 58.2006 40.0218ZM97.317 40.0218C88.2531 40.0218 80.884 32.6527 80.884 23.5888C80.884 14.5249 88.2531 7.15587 97.317 7.15587C106.381 7.15587 113.75 14.5249 113.75 23.5888C113.75 32.6527 106.381 40.0218 97.317 40.0218Z"
                  fill="#2C2825"
                />
              </g>
              <defs>
                <clipPath id="clip0_186_227">
                  <rect
                    width="120"
                    height="45.9093"
                    fill="white"
                    transform="translate(0 0.905365)"
                  />
                </clipPath>
              </defs>
            </svg>
          </Link>
          <h6 class="text-2xl mt-10 uppercase">{{ $t('Menüü') }}</h6>
          <ul
            class="flex mt-2 flex-col justify-center text-primary-400 gap-4 text-lg py-3 font-piazolla"
          >
            <Link
              :class="{
                '  text-primary-700': $routeCurrent('asukoht'),
              }"
              :href="$route('asukoht')"
              class="hover:text-primary-900"
              href=""
              v-smooth-scroll
            >
              {{ $t('Asukoht') }}
            </Link>
            <Link
              :class="{
                '  text-primary-700': $routeCurrent('hinnad-plaanid'),
              }"
              :href="$route('hinnad-plaanid')"
              class="hover:text-primary-900"
              href=""
              v-smooth-scroll
            >
              {{ $t('Hinnad & plaanid') }}
            </Link>
            <Link
              :class="{
                '  text-primary-700': $routeCurrent('interjoor'),
              }"
              :href="$route('interjoor')"
              class="hover:text-primary-900"
              v-smooth-scroll
            >
              {{ $t('Interjöör') }}
            </Link>
            <Link
              :class="{
                '  text-primary-700': $routeCurrent('galerii'),
              }"
              :href="$route('galerii')"
              class="hover:text-primary-900"
              href=""
              v-smooth-scroll
            >
              {{ $t('Galerii') }}
            </Link>
            <Link
              :class="{
                '  text-primary-700': $routeCurrent('aripinnad'),
              }"
              :href="$route('aripinnad')"
              class="hover:text-primary-900"
              href=""
              v-smooth-scroll
            >
              {{ $t('Äripinnad') }}
            </Link>
            <Link
              :class="{
                '  text-primary-700': $routeCurrent('ehitusinfo'),
              }"
              :href="$route('ehitusinfo')"
              class="hover:text-primary-900"
              href=""
              v-smooth-scroll
            >
              {{ $t('Ehitusinfo') }}
            </Link>
            <Link
              :class="{
                '  text-primary-700': $routeCurrent('muugiinfo'),
              }"
              :href="$route('muugiinfo')"
              class="hover:text-primary-900"
              href=""
              v-smooth-scroll
            >
              {{ $t('Müügiinfo') }}
            </Link>
          </ul>

          <div class="mt-8 pt-4 border-t border-primary-200">
            <p class="text-sm text-primary-600 mb-3">Language / Язык / Keel</p>
            <div class="flex gap-4">
              <button class="text-lg font-semibold" :class="{ 'text-primary-300': $i18n.locale !== 'et' }" @click="changeLanguage('et')">EE</button>
              <button class="text-lg font-semibold" :class="{ 'text-primary-300': $i18n.locale !== 'en' }" @click="changeLanguage('en')">EN</button>
              <button class="text-lg font-semibold" :class="{ 'text-primary-300': $i18n.locale !== 'ru' }" @click="changeLanguage('ru')">RU</button>
            </div>
          </div>
        </div>
      </template>
    </Sidebar>
  </nav>
</template>

<style>
  @keyframes marquee {
    0% {
      margin-left: 100%;
      transform: translateX(0%);
    }
    100% {
      margin-left: 0;
      transform: translateX(-100%);
    }
  }

  .banner-wrapper {
    overflow: hidden;
  }

  @media (max-width: 640px) {
    .banner-wrapper .marquee {
      display: inline-block;
      white-space: nowrap;
      animation: marquee 20s linear infinite;
    }

    .banner-wrapper .marquee:hover {
      animation-play-state: paused;
    }
  }
</style>
