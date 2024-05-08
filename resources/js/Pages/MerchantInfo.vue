<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import MerchantInfo from "@/Pages/Merchant/MerchantInfo.vue";

const page = usePage();

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
