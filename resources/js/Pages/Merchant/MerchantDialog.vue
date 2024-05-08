<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import MerchantForm from "@/Pages/Merchant/MerchantForm.vue";

const merchantForm = ref(null);
const showMerchantDialog = ref(false);
const processing = ref(false);
const merchantId = ref(null);
const merchantData = ref(null);

const handleSubmitMerchant = async () => {
    merchantForm.value?.handleSubmitMerchant();
};

const handleShowDialog = (merchant) => {
    if (merchant) {
        merchantId.value = merchant.uuid;
        merchantData.value = merchant;
    }
    else {
        merchantId.value = null;
        merchantData.value = null;
    }
    
    showMerchantDialog.value = true;
}

const onSuccess = () => {
    showMerchantDialog.value = false;
    merchantId.value = null;
    merchantData.value = null;
}

defineExpose({
    handleShowDialog
})

</script>

<template>
    <DialogModal :show="showMerchantDialog" @close="showMerchantDialog = false">
        <template #title>
            {{ merchantId ? "Update" : "Create" }} Merchant
        </template>

        <template #content>
            <div class="grid grid-cols-6 gap-6">
                <MerchantForm ref="merchantForm" v-model:processing="processing" :data="merchantData" :successCallback="onSuccess" />
            </div>
        </template>

        <template #footer>
            <SecondaryButton @click="showMerchantDialog = false">
                Cancel
            </SecondaryButton>

            <PrimaryButton
                class="ms-3"
                :class="{ 'opacity-25': processing }"
                :disabled="processing"
                @click="handleSubmitMerchant"
            >
                {{ merchantId ? "Update" : "Save" }}
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
