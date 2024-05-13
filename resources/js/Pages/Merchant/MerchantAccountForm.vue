<script setup>
import { onMounted, ref, watch } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import FloatAlertMessage from "@/Components/FloatAlertMessage.vue";
import DangerButton from "@/Components/DangerButton.vue";

const page = usePage();
const props = defineProps({
    data: Object,
    merchantUuid: String,
    successCallback: Function,
});

const showAlertMessage = ref(false);
const form = useForm({
    name: page.props.merchant?.merchant_user?.user?.name || "",
    email: page.props.merchant?.merchant_user?.user?.email || "",
    password: "",
    user_uuid: page.props.merchant?.merchant_user?.user?.uuid || null,
});

const handleSubmitMerchantAccount = async () => {
    form.post(route("merchant.register", { uuid: props.merchantUuid }), {
        preserveScroll: true,
        onSuccess: onSuccessFormSubmission,
    });
};

const resetForm = () => {
    form.reset();
};

const generatedPassword = () => {
    const generated = Math.random().toString(36).slice(2);
    form.password = generated;
};

const onSuccessFormSubmission = (...params) => {
    form.clearErrors();
    
    console.log('params', params)

    showAlertMessage.value = true;
    form.password = "";
    form.user_uuid = page.props.merchant?.merchant_user?.user?.uuid || null;

    if (typeof props.successCallback === "function") {
        props.successCallback();
    }
};

defineExpose({
    resetForm,
    handleSubmitMerchantAccount,
});

onMounted(() => {
    // generatedPassword();
});
</script>

<template>
    <FloatAlertMessage
        v-model="showAlertMessage"
        :message="page.props.flash.message"
        :timeout="2000"
    />

    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-6 sm:col-span-6">
            <InputLabel for="name" value="Name" />
            <TextInput
                id="name"
                v-model="form.name"
                type="text"
                class="block w-full mt-1"
                required
                autocomplete="name"
            />
            <InputError :message="form.errors.name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
            <InputLabel for="email" value="Email" />
            <TextInput
                id="email"
                v-model="form.email"
                type="text"
                class="block w-full mt-1"
                required
                autocomplete="email"
            />
            <InputError :message="form.errors.email" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6">
            <InputLabel for="password" value="Generated Password" />
            <TextInput
                id="password"
                v-model="form.password"
                type="text"
                class="block w-full mt-1"
                required
                autocomplete="password"
            />
            <InputError :message="form.errors.password" class="mt-2" />
        </div>
    </div>

    <div class="mt-[15px] text-right justify-between flex">
        <DangerButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="generatedPassword"
        >
            Generate Password
        </DangerButton>
        <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="handleSubmitMerchantAccount"
        >
            Save
        </PrimaryButton>
    </div>
</template>
