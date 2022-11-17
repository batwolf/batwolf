<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

const props = defineProps(['userCount']);

const linkClicked = (url) => {
    window.location.href = url;
};

</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h3>Dashboard</h3>
        </template>
        <div class="row">
            <div class="col-2 block-card">
                <div class="alert alert-success clickable" role="alert" @click="linkClicked(route('users.index'))">
                    <div class="alert-heading" >
                        <vue-feather type="users" fill="#000000" /><br /> {{ props.userCount }} Users
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
.block-card {
    text-align: center;
    /*background: #eee;*/
    padding-bottom: 2px;
}

.link-button {
    background: #cccccc;
    padding: 0;
    margin: 0;
}

.block-card h5 {
    width: 100%;
    height: 30px;
    margin: 0;
    font-size: 16px;
    background: #333;
    color: #ffffff;
    padding-top: 5px;
}

.block-card p {
    font-size: 18px;
    padding: 0 0 0 0;
    margin: 8px 0 8px 0;
}

.clickable {
    cursor: pointer;
}
</style>
