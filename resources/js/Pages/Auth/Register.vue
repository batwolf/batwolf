<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
// import PrimaryButton from '@/Components/PrimaryButton.vue';
// import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import FormError from "@/Components/Form/FormError.vue";

import InputLabel from "@/Components/Form/InputLabel.vue";
import CheckboxInput from "@/Components/Form/CheckboxInput.vue";
import TextInput from "@/Components/Form/TextInput.vue";
import PrimaryButton from "@/Components/Form/PrimaryButton.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <div v-if="status" class="alert alert-success">
            {{ status }}
        </div>
        <FormError :message="form.errors.name" />
        <FormError :message="form.errors.email" />
        <FormError :message="form.errors.password" />
        <form @submit.prevent="submit">
            <h1 class="h3 mb-3 fw-normal text-center">SIGN UP</h1>
            <div class="form-floating">
                <TextInput id="name" type="text" class="form-control" v-model="form.name" required placeholder="Your Name" />
                <InputLabel for="name" value="Your Name" />
            </div>
            <div class="form-floating">
                <TextInput id="email" type="email" class="form-control" v-model="form.email" required placeholder="name@example.com" />
                <InputLabel for="email" value="Email Address" />
            </div>
            <div class="form-floating">
                <TextInput id="password" type="password" class="form-control" v-model="form.password" required placeholder="password" />
                <InputLabel for="password" value="Password" />
            </div>
            <div class="form-floating">
                <TextInput id="password_confirmation" type="password" class="form-control second" v-model="form.password_confirmation" required placeholder="repeat password" />
                <InputLabel for="password_confirmation" value="Confirm Password" />
            </div>
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Register
            </PrimaryButton>
            <Link :href="route('login')" class="text-sm text-gray-600 hover:text-gray-900">
                Already registered?
            </Link>
        </form>
    </GuestLayout>
</template>

<style scoped>

html, body {
    height: 100%;
}

body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
}

.form-signin {
    max-width: 400px;
    padding: 40px;
    position: relative;
    top: 15vh;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
    border-radius: 12px;
}

.form-signin .form-floating:focus-within {
    z-index: 2;
}

.form-signin input[type="text"] {
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

.form-signin input[type="email"] {
    margin-bottom: -1px;
    border-radius: 0;
}

.form-signin input[type="password"] {
    margin-bottom: -1px;
    border-radius: 0;
}

.form-signin input.second {
    margin-bottom: 10px;
    border-bottom-right-radius: 12px;
    border-bottom-left-radius: 12px;
}
</style>
