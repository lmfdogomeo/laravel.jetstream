<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import MerchantDialog from '@/Pages/Merchant/MerchantDialog.vue';
import { ref, watch } from 'vue';
import SimpleAlertMessage from "@/Components/SimpleAlertMessage.vue";
import MerchantTable from './Merchant/MerchantTable.vue';
import { router, usePage } from '@inertiajs/vue3';
import MerchantInfo from "@/Pages/Merchant/MerchantInfo.vue";

const merchantDialogRef = ref(null);
const page = usePage();

const handleShowCreateMerchantForm = (merchant = null) => {
    merchantDialogRef.value?.handleShowDialog(merchant);
}

</script>

<template>
    <AppLayout title="Merchant">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Merchant Information
                <p class="text-sm font-normal">Ref: {{ page.props.merchant?.uuid }}</p>
            </h2>

            <PrimaryButton
                class="ms-3"
                @click="router.get(route('merchant.get'))"
            >
                Back
            </PrimaryButton>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <MerchantInfo />
            </div>
        </div>
    </AppLayout>
</template>
