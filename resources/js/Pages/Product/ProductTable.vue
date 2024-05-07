<script setup>
import { computed } from 'vue';
import { router, usePage, Link } from '@inertiajs/vue3';
import PaginationLink from "@/Components/PaginationLink.vue";

const page = usePage();
const props = defineProps({
    onSelectItem: Function
});

const handleSelectItem = (product) => {
    props.onSelectItem(product)
}

// const redirectProductPage = (product = null) => {
//     router.get(route('product.select', { uuid: product.uuid }))
// }

const tables = computed(() => {
    return page.props.table?.data || [];
})

</script>

<template>
    <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Reference
                </th>
                <th scope="col" class="px-6 py-3">
                    Product Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantity
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Action</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                v-for="(product, index) in tables"
                :key="index"
            >
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ product.uuid || "-" }}
                </th>
                <td class="px-6 py-4">
                    {{ product.product_name || "-" }}
                </td>
                <td class="px-6 py-4">
                    {{ product.product_description || "-" }}
                </td>
                <td class="px-6 py-4">
                    {{ product.price || "0.00" }}
                </td>
                <td class="px-6 py-4">
                    {{ product.quantity || "0" }}
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" @click.stop="handleSelectItem(product)">Open</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                v-if="tables.length === 0"
            >
                <th scope="row" class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white"
                    colspan="6"
                >
                    No product found in this merchant
                </th>
            </tr>
        </tbody>
    </table>

    <div>
        <PaginationLink />
    </div>
</template>
