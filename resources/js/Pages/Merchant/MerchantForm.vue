<script setup>
import { onMounted, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    data: Object,
    processing: Boolean,
    successCallback: Function
});
const emits = defineEmits(['processing']);

const form = useForm({
    _method: 'POST',
    company_name: "",
    company_tax_id: "",
    contact_number: "",
    address: "",
});

const handleSubmitMerchant = async () => {
    if (props.data?.uuid) {
        form.put(route('merchant.update', {uuid: props.data?.uuid}), {
            preserveScroll: true,
            wantsJson: true,
            onSuccess: onSuccessFormSubmission,
            onStart: onStartFormSubmission
        });
    }
    else {
        form.post(route('merchant.create'), {
            preserveScroll: true,
            onSuccess: onSuccessFormSubmission,
            onStart: onStartFormSubmission
        });
    }
};

const resetForm = () => {
    form.reset();
}

const onStartFormSubmission = () => {
    emits('processing', true)
}

const onSuccessFormSubmission = () => {
    form.clearErrors();
    emits('processing', false)

    if (typeof props.successCallback === "function") {
        props.successCallback();
    }
}

defineExpose({
    resetForm,
    handleSubmitMerchant
})

onMounted(() => {
    form.company_name = props.data?.company_name || "";
    form.company_tax_id = props.data?.company_tax_id || "";
    form.contact_number = props.data?.contact_number || "";
    form.address = props.data?.address || "";
})

</script>

<template>
    <!-- Reference -->
    <div class="col-span-6 sm:col-span-4"
        v-if="data?.uuid"
    >
        <InputLabel for="reference" value="Reference" />
        <TextInput
            id="reference"
            :value="data?.uuid"
            type="text"
            class="block w-full mt-1"
            required
            autocomplete="reference"
            disabled
        />
    </div>

    <!-- Company Name -->
    <div class="col-span-6 sm:col-span-4">
        <InputLabel for="company-name" value="Company Name" />
        <TextInput
            id="company-name"
            v-model="form.company_name"
            type="text"
            class="block w-full mt-1"
            required
            autocomplete="company-name"
        />
        <InputError :message="form.errors.company_name" class="mt-2" />
    </div>

    <!-- Company Tax ID -->
    <div class="col-span-6 sm:col-span-4">
        <InputLabel for="company-tax-id" value="Company Tax ID" />
        <TextInput
            id="company-tax-id"
            v-model="form.company_tax_id"
            type="text"
            class="block w-full mt-1"
            required
            autocomplete="company-tax-id"
        />
        <InputError :message="form.errors.company_tax_id" class="mt-2" />
    </div>

    <!-- Contact Number-->
    <div class="col-span-6 sm:col-span-4">
        <InputLabel for="contact-number" value="Contact Number" />
        <TextInput
            id="contact-number"
            v-model="form.contact_number"
            type="text"
            class="block w-full mt-1"
            required
            autocomplete="contact-number"
        />
        <InputError :message="form.errors.contact_number" class="mt-2" />
    </div>

    <!-- address -->
    <div class="col-span-6 sm:col-span-4">
        <InputLabel for="address" value="Address" />
        <TextInput
            id="address"
            v-model="form.address"
            type="text"
            class="block w-full mt-1"
            required
            autocomplete="address"
        />
        <InputError :message="form.errors.address" class="mt-2" />
    </div>
</template>
