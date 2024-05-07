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

const props = defineProps({
    title: String,
    message: String,
    processing: Boolean,
    confirmText: String,
    cancelText: String,
    onConfirm: Function,
    onCancel: Function,
    show: Boolean
})

const emits = defineEmits(['show']);

const onConfirm = async () => {
    if (typeof props.onConfirm === "function") {
        props.onConfirm();
    }
};

const onClose = () => {
    if (typeof props.onCancel === "function") {
        props.onCancel();
    }
}

</script>

<template>
    <DialogModal :show="props.show" @close="onClose">
        <template #title>
            {{ props.title || "Confirmation" }}
        </template>

        <template #content>
            {{ props.message || "Confirmation" }}
        </template>

        <template #footer>
            <SecondaryButton @click="onClose">
                {{ props.cancelText || "Cancel" }}
            </SecondaryButton>

            <PrimaryButton
                class="ms-3"
                :class="{ 'opacity-25': props.processing }"
                :disabled="props.processing"
                @click="onConfirm"
            >
                {{ props.confirmText || "Continue" }}
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
