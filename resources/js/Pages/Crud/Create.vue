<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import {Head, useForm} from '@inertiajs/inertia-vue3';
    import {getSlashedRoute} from '@/Components/Routes.vue';
    import {ref} from "vue";
    const props = defineProps(['data', 'columns', 'name', 'fields', 'postRoute']);
    const currentPage = ref(1);
    const capitalize = (str) => {
        return str[0].toUpperCase() + str.slice(1)
    }
    const form = useForm(props.data);
    const submit = () => {
        form.post(route(props.postRoute, props.data));
    };
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
        <form @submit.prevent="submit">
            <input type="hidden" name="user" :value="data.id" />
            <div class="card col-6">
                <div class="card-body">
                    <div v-for="(value, key) in data" class="row">
                        <div class="row" v-if="columns[key]">
                            <div class="mb-3">
                                <label :for="key" class="form-label">{{ columns[key]['label'] }}</label>
                                <input v-model="form[key]"  :type="columns[key]['type']" class="form-control" :id="key" :name="key" :required="columns[key]['required']" :placeholder="columns[key]['placeholder']">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 mt-2 col-12">
                            <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" type="submit" class="btn btn-dark">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
