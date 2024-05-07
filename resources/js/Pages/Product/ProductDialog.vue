<script setup>
import { ref, watch } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import ProductForm from "@/Pages/Product/ProductForm.vue";
import DangerButton from '@/Components/DangerButton.vue';
import ConfirmDialog from "@/Components/ConfirmDialog.vue";
import { useForm, usePage } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';

const page = usePage();
const productForm = ref(null);
const showProductDialog = ref(false);
const processing = ref(false);
const productId = ref(null);
const productData = ref(null);
const showConfirmationDialog = ref(false);
const responseMessage = ref("");

const form = useForm({});

const handleSubmitProduct = async () => {
    productForm.value?.handleSubmitProduct();
};

const handleShowDialog = (product) => {
    if (product) {
        productId.value = product.uuid;

        productData.value = product;
    }
    else {
        // productForm.value?.resetForm();
        productId.value = null;

        productData.value = null;
    }
    
    showProductDialog.value = true;
}

const onSuccess = (type = "") => {
    // showProductDialog.value = false;
    // productId.value = null;
    // productData.value = null;

    console.log('type', type)

    if (type === "create") {
        showProductDialog.value = false;
        productData.value = null;
        productId.value = null;
    }

    showResponseMessage();
}

const showResponseMessage = () => {
    if (page.props.flash.message) {
        responseMessage.value = page.props.flash.message;

        setTimeout(() => {
            responseMessage.value = "";
        }, 1000);
    }
}

const onConfirmDeletion = () => {
    showConfirmationDialog.value = false;
    console.log('onConfirmDeletion')
    form.delete(route('product.delete', { merchant_uuid: page.props.merchant_id, uuid: productId.value }), {
        onSuccess: () => {
            showProductDialog.value = false;
            form.reset();
        }
    })
}

watch(() => page.props.flash.message, (newValue) => {
    showResponseMessage();
})

defineExpose({
    handleShowDialog
})

</script>

<template>
    <DialogModal :show="showProductDialog" @close="showProductDialog = false">
        <template #title>
            {{ productId ? "Update" : "Create" }} Product
        </template>

        <template #content>
            <div class="grid grid-cols-6 gap-6">
                <ProductForm ref="productForm" v-model:processing="processing" :data="productData" :successCallback="onSuccess" />
            </div>
        </template>

        <template #footer>
            <ActionMessage :on="responseMessage ? true : false" class="flex items-center me-3">
                <span class="sr-only">Info</span> {{ responseMessage }}
            </ActionMessage>
            <DangerButton class="ms-3 float-start" @click="showConfirmationDialog = true">
                Delete
            </DangerButton>

            <SecondaryButton class="ms-3" @click="showProductDialog = false">
                Cancel
            </SecondaryButton>

            <PrimaryButton
                class="ms-3"
                :class="{ 'opacity-25': processing }"
                :disabled="processing"
                @click="handleSubmitProduct"
            >
                {{ productId ? "Update" : "Save" }}
            </PrimaryButton>
        </template>
    </DialogModal>

    <ConfirmDialog 
        title="Confirmation"
        message="Are you sure you want to delete this product?"
        :onConfirm="onConfirmDeletion"
        :onCancel="() => showConfirmationDialog = false"
        :show="showConfirmationDialog"
    />
</template>
