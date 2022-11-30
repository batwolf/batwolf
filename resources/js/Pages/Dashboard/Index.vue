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
            <div class="col-2">
                <div class="alert block-card clickable" role="alert" @click="linkClicked(route('users.index'))">
                    <vue-feather type="users" /><br /> {{ props.userCount }} Users
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
.block-card {
    text-align: center;
    border: 1px solid #00f0ff;
    background: #00f0ff11;
    color: #00f0ff;
}

.link-button {
    background: #cccccc;
    padding: 0;
    margin: 0;
}

/*.block-card h5 {*/
/*    width: 100%;*/
/*    height: 30px;*/
/*    margin: 0;*/
/*    font-size: 16px;*/
/*    background: #333;*/
/*    color: #ffffff;*/
/*    padding-top: 5px;*/
/*}*/

/*.block-card p {*/
/*    font-size: 18px;*/
/*    padding: 0 0 0 0;*/
/*    margin: 8px 0 8px 0;*/
/*}*/

.clickable {
    cursor: pointer;
}



</style>
