<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import MerchantDialog from '@/Pages/Merchant/MerchantDialog.vue';
import { ref, watch } from 'vue';
import SimpleAlertMessage from "@/Components/SimpleAlertMessage.vue";
import MerchantTable from './Merchant/MerchantTable.vue';

const merchantDialogRef = ref(null);

const handleShowCreateMerchantForm = (merchant = null) => {
    merchantDialogRef.value?.handleShowDialog(merchant);
}

</script>

<template>
    <AppLayout title="Merchant">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Merchant
            </h2>

            <PrimaryButton
                    class="ms-3"
                    @click="handleShowCreateMerchantForm(null)"
                >
                Add Merchant
            </PrimaryButton>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                <SimpleAlertMessage />

                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        <MerchantDialog ref="merchantDialogRef" />

                        <MerchantTable :onSelectItem="handleShowCreateMerchantForm" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
