<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import axios from "axios";

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'POST',
    company_name: "",
    company_tax_id: "",
    contact_number: "",
    address: ""
});

const handleSubmitMerchant = () => {
    const token = document.cookie
    .split('; ')
    .find(row => row.startsWith('XSRF-TOKEN='))
    .split('=')[1];

    console.log('token', token)

    axios.post(route('merchant.create'), form.data(), { headers: {
        authorization: `Bearer ${token}`
    }}).then((result) => {
        console.log("result", result)
    })
    console.log('form', form)
    // form.post(route('merchant.create'), {
    //     // errorBag: 'handleSubmitMerchant',
    //     preserveScroll: true,
    //     onSuccess: () => clearInputs(),
    // });
};

const clearInputs = () => {
    console.log("succeess")
}

</script>

<template>
    <FormSection @submitted="handleSubmitMerchant">
        <template #title>
            Merchant Information
        </template>

        <template #description>
            Add Merchant Information
        </template>

        <template #form>
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

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
