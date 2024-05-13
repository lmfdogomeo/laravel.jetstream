<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { usePage } from "@inertiajs/vue3";
import { computed, onMounted } from "vue";

const page = usePage();

const userRole = computed(() => {
    return page.props.auth.user?.role || "";
})

const userUuid = computed(() => {
    return page.props.auth.user?.uuid || "";
})

onMounted(() => {
    console.log('page', page.props.auth.user)
})
</script>

<template>
    <div class="mt-16">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:gap-8">
            <a
                :href="route('merchant.get')"
                class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"
                v-if="userRole === 'admin'"
            >
                <div>
                    <div
                        class="flex items-center justify-center w-16 h-16 rounded-full bg-red-50 dark:bg-red-800/20"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="w-7 h-7 stroke-red-500"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                            />
                        </svg>
                    </div>

                    <h2
                        class="mt-6 text-xl font-semibold text-gray-900 dark:text-white"
                    >
                        Merchant
                    </h2>

                    <p
                        class="mt-4 text-sm leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        Manage Merchant Data: Add New, Edit, Delete, View Details, and Manage Product
                    </p>
                </div>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    class="self-center w-6 h-6 mx-6 shrink-0 stroke-red-500"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                    />
                </svg>
            </a>

            <a
            :href="userRole === 'merchant' ? route('product.get', { merchant_uuid: userUuid }) : '#'"
                class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"
            >
                <div>
                    <div
                        class="flex items-center justify-center w-16 h-16 rounded-full bg-red-50 dark:bg-red-800/20"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            class="w-7 h-7 stroke-red-500"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"
                            />
                        </svg>
                    </div>

                    <h2
                        class="mt-6 text-xl font-semibold text-gray-900 dark:text-white"
                    >
                        Product
                    </h2>

                    <p
                        class="mt-4 text-sm leading-relaxed text-gray-500 dark:text-gray-400"
                    >
                        Manage Merchant Products: Create, Edit Delete, and View Details
                    </p>
                </div>

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    class="self-center w-6 h-6 mx-6 shrink-0 stroke-red-500"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"
                    />
                </svg>
            </a>

        </div>
    </div>
</template>
