<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import {getSlashedRoute} from '@/Components/Routes.vue';
    const props = defineProps(['data', 'columns', 'name', 'fields', 'postRoute']);
    const capitalize = (str) => {
        return str[0].toUpperCase() + str.slice(1)
    }
</script>

<template>
    <Head :title="capitalize(name)" />
    <AuthenticatedLayout>
        <template #header>
            <div class="row">
                <div class="col-10">
                    <h3>Viewing {{ capitalize(name) }}: {{ capitalize(data.name) }}</h3>
                </div>
                <div class="col-2">
                    <a :href="getSlashedRoute(name)" class="btn btn-dark" ><vue-feather type="arrow-left" /> Back to {{ capitalize(name) }}</a>
                </div>
            </div>
        </template>
        <div v-for="(value, key) in columns" class="row">
            <div class="col-2 text-end">{{ value }}:</div>
            <div class="col-10">{{ data[value] }}</div>
        </div>
    </AuthenticatedLayout>
</template>
