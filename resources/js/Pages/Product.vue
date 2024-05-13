<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ProductDialog from '@/Pages/Product/ProductDialog.vue';
import { computed, ref, watch } from 'vue';
import SimpleAlertMessage from "@/Components/SimpleAlertMessage.vue";
import ProductTable from './Product/ProductTable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { usePage, router } from '@inertiajs/vue3';

const productDialogRef = ref(null);
const page = usePage();
const handleShowCreateProductForm = (Product = null) => {
    productDialogRef.value?.handleShowDialog(Product);
}

const userRole = computed(() => {
    return page.props.auth.user?.role || "";
})

</script>

<template>
    <AppLayout title="Product">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Product
            </h2>

            <div>
                <SecondaryButton
                    class="ms-3"
                    @click="router.get(route('merchant.select', { uuid: page.props.merchant_id }))"
                    v-if="userRole === 'admin'"
                >
                    Back
                </SecondaryButton>

                <PrimaryButton
                    class="ms-3"
                    @click="handleShowCreateProductForm(null)"
                    v-if="userRole === 'admin'"
                >
                    Add Product
                </PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                <SimpleAlertMessage />

                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <ProductDialog ref="productDialogRef" />

                        <ProductTable :onSelectItem="handleShowCreateProductForm" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
