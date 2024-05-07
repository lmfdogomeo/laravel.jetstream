<script setup>
import { computed } from 'vue';
import { router, usePage, Link } from '@inertiajs/vue3';
import PaginationLink from "@/Components/PaginationLink.vue";

const page = usePage();
const props = defineProps({
    onSelectItem: Function
});

const handleSelectItem = (merchant) => {
    props.onSelectItem(merchant)
}

const redirectMerchantPage = (merchant = null) => {
    router.get(route('merchant.select', { uuid: merchant.uuid }))
}

const tables = computed(() => {
    return page.props.table?.data || [];
})

</script>

<template>
    <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Company Tax ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Company Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Contact Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Address
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                v-for="(merchant, index) in tables"
                :key="index"
                @click="redirectMerchantPage(merchant)"
            >
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ merchant.company_tax_id || "-" }}
                </th>
                <td class="px-6 py-4">
                    {{ merchant.company_name || "-" }}
                </td>
                <td class="px-6 py-4">
                    {{ merchant.contact_number || "-" }}
                </td>
                <td class="px-6 py-4">
                    {{ merchant.address || "-" }}
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" @click.stop="handleSelectItem(merchant)">Edit</a>
                </td>
            </tr>

            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                v-if="tables.length === 0"
            >
                <th scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white"
                    colspan="5"
                >
                    No merchant found
                </th>
            </tr>
        </tbody>
    </table>

    <div>
        <PaginationLink />
    </div>
</template>
