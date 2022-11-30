<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

import InputLabel from "@/Components/Form/InputLabel.vue";
import CheckboxInput from "@/Components/Form/CheckboxInput.vue";
import TextInput from "@/Components/Form/TextInput.vue";
import PrimaryButton from "@/Components/Form/PrimaryButton.vue";
import FormError from "@/Components/Form/FormError.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div v-if="status" class="alert alert-success">
            {{ status }}
        </div>
        <FormError :message="form.errors.email" />
        <FormError :message="form.errors.password" />
        <form @submit.prevent="submit">
            <h1 class="h3 mb-3 fw-normal text-center">LOGIN</h1>
            <div class="form-floating">
                <TextInput id="email" type="email" class="form-control" v-model="form.email" required placeholder="name@example.com" />
                <InputLabel for="email" value="Email Address" />
            </div>
            <div class="form-floating">
                <TextInput id="password" type="password" class="form-control" v-model="form.password" required placeholder="password" />
                <InputLabel for="password" value="Password" />
            </div>
            <div class="checkbox mb-3">
                <label>
                    <CheckboxInput name="remember" v-model:checked="form.remember" value="Remember me" /> Remember me
                </label>
            </div>
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Login
            </PrimaryButton>
            <Link :href="route('register')" class="text-sm text-gray-600 hover:text-gray-900">
                No Account?
            </Link>
        </form>
    </GuestLayout>
</template>

<style scoped>

html, body {
    height: 100%;
    background: #ffffff;
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

.form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
    margin-bottom: 10px;
    border-bottom-right-radius: 12px;
    border-bottom-left-radius: 12px;

}
</style>
