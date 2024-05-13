<script setup>
import { ref, watch } from 'vue';
import { usePage, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import MerchantForm from './MerchantForm.vue';
import ConfirmDialog from '@/Components/ConfirmDialog.vue';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import MerchantAccountForm from './MerchantAccountForm.vue';
import FloatAlertMessage from '@/Components/FloatAlertMessage.vue';

const page = usePage();
const props = defineProps({
    user: Object,
    paginate: Object,
    merchant: Object
});

const form = useForm({});
const processing = ref(false);
const merchantForm = ref(null);
const showConfirmationDialog = ref(false);
const showAlertMessage = ref(false);

const handleUpdateMerchant = () => {
    merchantForm.value?.handleSubmitMerchant();
}

const onSuccess = () => {
    showResponseMessage();
}

const showResponseMessage = () => {
    showAlertMessage.value = true;
}

const onConfirmDeletion = () => {
    showConfirmationDialog.value = false;
    form.delete(route('merchant.delete', { uuid: page.props.merchant.uuid }), {
        onSuccess: () => {
            showAlertMessage.value = true;
        }
    })
}

const handleDeleteMerchant = () => {
    showConfirmationDialog.value = true;
}

</script>

<template>
    <FloatAlertMessage
        v-model="showAlertMessage"
        :message="page.props.flash.message"
        :timeout="2000"
    />

   <FormSection @submitted="handleUpdateMerchant">
        <template #title>
            Merchant Information
        </template>

        <template #description>
            Update merchant information and manage products

            <div class="mt-[20px]">
                <div
                    id="alert-additional-content-3"
                    class="p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                    role="alert"
                >
                    <div class="flex items-center">
                        <svg
                            class="flex-shrink-0 w-4 h-4 me-2"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                            />
                        </svg>
                        <span class="sr-only">Info</span>
                        <h3 class="text-lg font-medium">Products</h3>
                    </div>
                    <div class="mt-2 mb-4 text-sm">
                        There are <b>{{ page.props.merchant.products_count || "0" }}</b> products listed in this merchant
                    </div>
                    <div class="flex">
                        <button
                            type="button"
                            class="text-green-800 bg-transparent border border-green-800 hover:bg-green-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-green-600 dark:border-green-600 dark:text-green-400 dark:hover:text-white dark:focus:ring-green-800"
                            data-dismiss-target="#alert-additional-content-3"
                            aria-label="Close"
                            @click="router.get(route('product.get', { merchant_uuid: page.props.merchant.uuid }))"
                        >
                            Manage Products
                        </button>
                    </div>
                </div>
            </div>

            <!-- <div class="px-4 py-5 bg-white shadow sm:p-6 sm:rounded-tl-md sm:rounded-tr-md"> -->
            <div class="mt-[20px]">
                <h3 class="text-lg font-medium text-gray-900 mb-[15px]">
                    Account Information
                </h3>
                <MerchantAccountForm 
                    :merchantUuid="page.props.merchant.uuid"
                />
            </div>
        </template>

        <template #form>
            <MerchantForm ref="merchantForm" v-model:processing="processing" :data="page.props.merchant" :successCallback="onSuccess" />
        </template>

        <template #actions>
            <DangerButton class="ms-3" type="button" :class="{ 'opacity-25': processing }" :disabled="processing"
                @click.stop="handleDeleteMerchant"
            >
                Delete
            </DangerButton>

            <PrimaryButton class="ms-3" :class="{ 'opacity-25': processing }" :disabled="processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>

    <ConfirmationModal :show="showConfirmationDialog" @close="showConfirmationDialog = false">
        <template #title>
            Delete Merchant Data
        </template>

        <template #content>
            {{ page.props.merchant.products_count > 0 ? `There are ${page.props.merchant.products_count} products listed in this merchant. Are you sure you want to delete this?` : 'Are you sure you want to delete this merchant?' }}
        </template>

        <template #footer>
            <SecondaryButton @click="showConfirmationDialog = false">
                Cancel
            </SecondaryButton>

            <DangerButton
                class="ms-3"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                @click="onConfirmDeletion"
            >
                Delete
            </DangerButton>
        </template>
    </ConfirmationModal>

    <!-- <ConfirmDialog 
        title="Confirmation"
        :message="`${page.props.merchant.products_count > 0 ? `There are ${page.props.merchant.products_count} products listed in this merchant. Are you sure you want to delete this?` : 'Are you sure you want to delete this merchant?'}`"
        :onConfirm="onConfirmDeletion"
        :onCancel="() => showConfirmationDialog = false"
        :show="showConfirmationDialog"
    /> -->
</template>
