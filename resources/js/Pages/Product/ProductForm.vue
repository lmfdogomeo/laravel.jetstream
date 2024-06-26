<script setup>
import { computed, onMounted, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from "@/Components/TextArea.vue";

const page = usePage();
const props = defineProps({
    data: Object,
    processing: Boolean,
    successCallback: Function
});
const emits = defineEmits(['processing']);

const form = useForm({
    _method: 'POST',
    product_name: "",
    product_description: "",
    price: "",
    quantity: "",
});

const handleSubmitProduct = async () => {
    form.price = form.price ? Number(form.price).toFixed(2) : form.price;

    if (props.data?.uuid) {
        form.put(route('product.update', { merchant_uuid: page.props.merchant_id, uuid: props.data?.uuid }), {
            preserveScroll: true,
            onSuccess: () => onSuccessFormSubmission('update'),
            onStart: onStartFormSubmission
        });
    }
    else {
        form.post(route('product.create', { merchant_uuid: page.props.merchant_id }), {
            preserveScroll: true,
            onSuccess: () => onSuccessFormSubmission('create'),
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

const onSuccessFormSubmission = (type = "create") => {
    form.clearErrors();
    emits('processing', false)

    if (typeof props.successCallback === "function") {
        props.successCallback(type);
    }
}

const userRole = computed(() => {
    return page.props.auth.user?.role || "";
})

defineExpose({
    resetForm,
    handleSubmitProduct
})

onMounted(() => {
    form.product_name = props.data?.product_name || "";
    form.product_description = props.data?.product_description || "";
    form.price = props.data?.price?.toFixed(2).toString() || "";
    form.quantity = props.data?.quantity.toString() || "";
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

    <!-- Product Name -->
    <div class="col-span-6 sm:col-span-4">
        <InputLabel for="product-name" value="Product Name" />
        <TextInput
            id="product-name"
            v-model="form.product_name"
            type="text"
            class="block w-full mt-1"
            required
            autocomplete="product-name"
            :disabled="userRole === 'merchant'"
        />
        <InputError :message="form.errors.product_name" class="mt-2" />
    </div>

    <!-- Description -->
    <div class="col-span-6 sm:col-span-4">
        <InputLabel for="description" value="Description" />
        <TextArea
            id="description"
            v-model="form.product_description"
            class="block w-full mt-1"
            required
            autocomplete="description"
            rows="5"
            :disabled="userRole === 'merchant'"
        />
        <InputError :message="form.errors.product_description" class="mt-2" />
    </div>

    <!-- Price-->
    <div class="col-span-6 sm:col-span-4">
        <InputLabel for="price" value="Price" />
        <TextInput
            id="price"
            v-model="form.price"
            type="number"
            class="block w-full mt-1"
            required
            autocomplete="price"
            :disabled="userRole === 'merchant'"
        />
        <InputError :message="form.errors.price" class="mt-2" />
    </div>

    <!-- Quantity -->
    <div class="col-span-6 sm:col-span-4">
        <InputLabel for="quantity" value="Quantity" />
        <TextInput
            id="quantity"
            v-model="form.quantity"
            type="number"
            class="block w-full mt-1"
            required
            autocomplete="quantity"
            :disabled="userRole === 'merchant'"
        />
        <InputError :message="form.errors.quantity" class="mt-2" />
    </div>
</template>
