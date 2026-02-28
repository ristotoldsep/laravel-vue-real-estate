<script setup>
  import { Head } from '@inertiajs/vue3'
  import GuestLayout from '@/Layouts/GuestLayout.vue'
</script>

<template>
  <Head title="Müügiinfo | Uus Loo | Saha tee 8 | Korterid ja äripinnad Loo alevikus" />

  <GuestLayout>
    <section class="max-w-screen-md mx-auto py-10">
      <h1 class="text-3xl">{{$t('Müügiinfo')}}</h1>

      <div class="w-full mt-10 ms-6 md:ml-0">
        <ol class="relative border-s w-[90%] md:w-full border-primary-200">
          <li class="mb-10 pl-8">
            <span
              class="absolute flex items-center justify-center w-6 h-6 bg-primary-300 rounded-full -start-3 ring-8 ring-primary-100"
            >
              <svg
                class="w-2.5 h-2.5 text-primary-600"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                />
              </svg>
            </span>
            <h3 class="flex items-center mb-1 text-lg font-semibold text-primary-800">
              {{$t('Broneerimine')}}
            </h3>

            <p class="mb-4 text-base font-medium text-primary-600">
              {{$t('Kõik algab meelepärase korteri valikust. Kui see on tehtud, võta meie müügiesindajaga ühendust ja teata korteri broneerimise huvist. Suusõnaline broneering on tasuta ja kehtib kuni 7 päeva (ei kajastada veebilehel). Kirjaliku broneeringu tegemiseks sõlmitakse lihtkirjalik broneerimisleping tasuga 3000 eur, mis kehtib järgmise etapini – notariaalne võlaõigusleping.')}}
            </p>
          </li>
          <li class="mb-10 pl-8">
            <span
              class="absolute flex items-center justify-center w-6 h-6 bg-primary-300 rounded-full -start-3 ring-8 ring-primary-100"
            >
              <svg
                class="w-2.5 h-2.5 text-primary-600"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                />
              </svg>
            </span>
            <h3 class="flex items-center mb-1 text-lg font-semibold text-primary-800">
              {{$t('Võlaõigusleping (VÕL)')}}
            </h3>

            <p class="mb-4 text-base font-medium text-primary-600">
              {{$t('Enne ehituse algust või hoone ehitusjärgus sõlmitakse Ostjaga notariaalne võlaõigusleping, millega tasutakse 10% korteri hinnast. Kui eelnevalt on sõlmitud broneerimisleping, siis broneerimistasu arvestatakse sissemaksu sisse. Võlaõiguslikus müügilepingus lepitakse kokku täpsemad müügitingimused ja ajagraafik.')}}
            </p>
          </li>
          <li class="mb-10 pl-8">
            <span
              class="absolute flex items-center justify-center w-6 h-6 bg-primary-300 rounded-full -start-3 ring-8 ring-primary-100"
            >
              <svg
                class="w-2.5 h-2.5 text-primary-600"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                />
              </svg>
            </span>
            <h3 class="flex items-center mb-1 text-lg font-semibold text-primary-800">
              {{$t('Asjaõigusleping (AÕL)')}}
            </h3>

            <p class="mb-4 text-base font-medium text-primary-600">
              {{$t('Kui korter ja hoone on valmis, sõlmitakse notariaalne asjaõiguslik leping, millega kaasneb lepingu objekti omandiõiguse üleminek, antakse üle korteri valdus koos võtmetaga. AÕL-ga tuleb kliendil tasuda korteri ostuhinna jääki 90%. Pangafinantseerimise kaasamisel osaleb antud lepingus ka pangaesindaja ning maksab välja laenulepingujärgse summa.')}}
            </p>
            <h6 class="text-base">{{$t('Korteri hinnas sisaldub:')}}</h6>
            <ul class="font-piazolla list-disc list-inside mt-3">
              <li>{{$t('Hoone ja korteri valmidus vastavalt projektile ja siseviimistlustabelile;')}}</li>
              <li>{{$t('Standard viimistlusmaterjalid vastavalt kliendi valikule;')}}</li>
              <li>{{$t('Vannitoa sanitaartehnika;')}}</li>
              <li>{{$t('Ehituslik garantii 2 aastat;')}}</li>
              <li>{{$t('Tasu tehnovõrkude (elektri-, vee- ja kanalisatsioonitrasside) rajamise ning nendega liitumise eest;')}}</li>
              <li>{{$t('Käibemaks;')}}</li>
            </ul>
            <h6 class="text-base mt-10">{{$t('Korteri hinnas ei sisaldu:')}}</h6>
            <ul class="font-piazolla list-disc list-inside mt-3">
              <li>{{$t('Isiklik parkimiskoht tõkkepuuga parklas hinnaga 4900€ (valikuline);')}}</li>
              <li>{{$t('Isiklik panipaik hoone 1. korrusel hinnaga 3900€ (valikuline);')}}</li>
              <li>{{$t('Köögimööbel (valikuline lisatasu alusel või müügikampaania raames);')}}</li>
              <li>{{$t('Siseviimistluspakettide lisatasu valikud;')}}</li>
              <li>{{$t('Müügilepingu sõlmimisega seotud notaritasu ja riigilõiv;')}}</li>
              <li>
                {{$t('Liitumistasu telefoniside, andmeside, kaabeltelevisioonivõrguga ja valvesignalisatsiooniga liitumiseks;')}}
              </li>
            </ul>
          </li>
          <li class="mb-10 ms-8">
            <span
              class="absolute flex items-center justify-center w-6 h-6 bg-primary-300 rounded-full -start-3 ring-8 ring-primary-100"
            >
              <svg
                class="w-2.5 h-2.5 text-primary-600"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                />
              </svg>
            </span>
            <h3 class="flex items-center mb-1 text-lg font-semibold text-primary-800">
              {{$t('Finantseerimine')}}
            </h3>

            <p class="mb-4 text-base font-medium text-primary-600">
              {{$t('Kui kaasate kodu ostmiseks laenu, siis soovitame alustada laenuvõimalusi kaardistada enne või hiljemalt broneerimise ajal. Laenuleping on võimalik sõlmida etteulatuvalt, ehituse ajal või paar kuud enne hoone valmimist. Kusjuures laenu tagasimaksmine algab alles pärast laenusumma väljamaksmist, mis toimub pärast korteri valmimist asjaõiguslepingu sõlmimisega.')}}
            </p>
          </li>
          <li class="mb-10 ms-8">
            <span
              class="absolute flex items-center justify-center w-6 h-6 bg-primary-300 rounded-full -start-3 ring-8 ring-primary-100"
            >
              <svg
                class="w-2.5 h-2.5 text-primary-600"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                />
              </svg>
            </span>
            <h3 class="flex items-center mb-1 text-lg font-semibold text-primary-800">
              {{$t('Koduvahetus')}}
            </h3>

            <p class="mb-4 text-base font-medium text-primary-600">
              {{$t('Kui rahastad uue kodu ostu oma vana kodu müügist, siis tasub protsessi kaasata oma ala professionaalid. Vajadusel suuname oma koostööpartnerite juurde, kus kinnisvaramaakler aitab hinnata teie vara väärtust, eeldatavat müügiperioodi ning millal müügiga alustada, et hiljemalt uue kodu valmimiseks oleks vana müüdud.')}}
            </p>
          </li>
          <li class="mb-10 ms-8">
            <span
              class="absolute flex items-center justify-center w-6 h-6 bg-primary-300 rounded-full -start-3 ring-8 ring-primary-100"
            >
              <svg
                class="w-2.5 h-2.5 text-primary-600"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
              >
                <path
                  d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                />
              </svg>
            </span>
            <h3 class="flex items-center mb-1 text-lg font-semibold text-primary-800">
              {{$t('Valitud korteritel erihinnad')}}
            </h3>

            <p class="mb-4 text-base font-medium text-primary-600">
              {{$t('Kampaania! Kodud kuni 8 000€ allahindlusega! Pakkumine kehtib kuni 28.02.2026.')}}
            </p>
          </li>
        </ol>
      </div>
    </section>
    <Kontaktivorm />
  </GuestLayout>
</template>
