<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import InertiaDropdown from "@/Components/InertiaDropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')" class="">
                                    <svg
                                        class="w-28"
                                        viewBox="0 0 120 47"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
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
                            </div>

                            <!-- Navigation Links -->
                            <div
                                class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"
                            >
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Hinnad & plaanid
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <InertiaDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Logi välja
                                        </DropdownLink>
                                    </template>
                                </InertiaDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="
                                    showingNavigationDropdown =
                                        !showingNavigationDropdown
                                "
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex':
                                                !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex':
                                                showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Hinnad & plaanid
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Logi välja
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
