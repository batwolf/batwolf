<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import {getSlashedRoute} from '@/Components/Routes.vue';
import {onMounted, ref} from "vue";
const props = defineProps(['data', 'columns', 'name', 'fields', 'postRoute']);
const currentPage = ref(1);
const capitalize = (str) => {
    return str[0].toUpperCase() + str.slice(1)
}
const form = useForm(props.data);
const submit = () => {
    form.post(route(props.postRoute, props.data));
};
const isTextInput = (obj) => {
    return obj === 'text' || obj === 'email' || obj === 'password';
}
const isTextAreaInput = (obj) => {
    return obj === 'textarea';
}
const isCheckboxInput = (obj) => {
    return obj === 'checkbox';
}
const isFileInput = (obj) => {
    return obj === 'file';
}
const isChecked = (str) => {
    return str === 'checked';
}
</script>

<template>
    <Head :title="capitalize(name)" />
    <AuthenticatedLayout>
        <template #header>
            <div class="row">
                <div class="col-10">
                    <h3>Creating {{ capitalize(name) }}</h3>
                </div>
                <div class="col-2">
                    <a :href="getSlashedRoute(name)" class="btn btn-dark" ><vue-feather type="arrow-left" /> Back to {{ capitalize(name) }}</a>
                </div>
            </div>
        </template>
        <form @submit.prevent="submit" class="bg-dark">
            <div class="row">
                <div class="col-12">
                    <div class="card dark">
                        <div class="card-header">
                            {{ capitalize(name) }}
                        </div>
                        <div class="card-body">
                            <div v-for="(value, key) in data" class="row">
                                <div v-if="typeof columns[key] !== 'undefined'">
                                    <div class="row" v-if="isTextInput(columns[key]['type'])">
                                        <div class="mb-3 col-4">
                                            <label :for="key" class="form-label">{{ columns[key]['label'] }}</label>
                                            <input v-model="form[key]" :type="columns[key]['type']" class="bg-dark form-control text-light" :id="key" :name="key" :required="columns[key]['required']" :placeholder="columns[key]['placeholder']">
                                        </div>
                                    </div>
                                    <div class="row" v-if="isCheckboxInput(columns[key]['type'])">
                                        <p>{{ columns[key]['name'] }}</p>
                                        <div class="mb-3 col-3" v-for="column in data[key]">
                                            <div class="form-check" >
                                                <input v-model="column['checked']" :value="column.id" :checked="isChecked(column['checked'])" class="form-check-input" name="permissions[]" type="checkbox" :id="column.id">
                                                <label class="form-check-label" :for="column.id">
                                                    {{ column.name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" v-if="isTextAreaInput(columns[key]['type'])">
                                        <div class="mb-3 col-4">
                                            <label :for="key" class="form-label">{{ columns[key]['label'] }}</label>
                                            <textarea rows="5" v-model="form[key]" class="bg-dark form-control text-light" :id="key" :name="key" :required="columns[key]['required']" :placeholder="columns[key]['placeholder']"></textarea>
                                        </div>
                                    </div>
                                    <div class="row" v-if="isFileInput(columns[key]['type'])">
                                        <div class="mb-3 col-4">
                                            <label :for="key" class="form-label">{{ columns[key]['label'] }}</label>
                                            <input class="bg-dark form-control text-light" type="file" :id="key" :name="key" :required="columns[key]['required']" :placeholder="columns[key]['placeholder']">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" class="btn btn-dark">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
