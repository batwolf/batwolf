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
    form.patch(route(props.postRoute, props.data));
};
const isTextInput = (obj) => {
    return obj === 'text' || obj === 'email' || obj === 'password';
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
                    <h3>Editing {{ capitalize(name) }}</h3>
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
                            <input type="hidden" name="user" :value="data.id" />
                            <div v-for="(value, key) in data" class="row">
                                <div v-if="typeof columns[key] !== 'undefined'">
                                    <div class="row" v-if="isTextInput(columns[key]['type'])">
                                        <div class="mb-3 col-4">
                                            <label :for="key" class="form-label">{{ columns[key]['label'] }}</label>
                                            <input v-model="form[key]" :type="columns[key]['type']" class="bg-dark form-control text-light" :id="key" :name="key" :required="columns[key]['required']" :placeholder="columns[key]['placeholder']">
                                        </div>
                                    </div>
                                    <div class="row" v-if="isCheckboxInput(columns[key]['type'])">
                                        <p class="subtitle">{{ columns[key]['name'] }}</p>
                                        <div class="mb-3 col-3" v-for="column in data[key]">
                                            <label class="switch">
                                                <input v-model="column['checked']" :value="column.id" :checked="isChecked(column['checked'])" class="form-check-input" name="permissions[]" type="checkbox" :id="column.id">
                                                <span class="slider"></span>
                                            </label>
                                            <p class="subtitle-label">{{ column.name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" class="btn btn-dark">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
