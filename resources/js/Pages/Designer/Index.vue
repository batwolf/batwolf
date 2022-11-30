<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import {computed, onMounted, ref} from "vue";

const canvas = ref(null);
let html = ref("");

onMounted(() => {
    // console.log(canvas.value.clientWidth);
    // canvas.value.append("<img src='/watch/Hour.png' width='400' height='400' />");
    // html = "<img src='/watch/Hour.png' width='400' height='400' />";

    onMounted(() => {
        var canvas = document.getElementById('canvas'),
            context = canvas.getContext('2d');

        make_base(context);
    })

    function make_base(context)
    {
        let base_image = new Image();
        base_image.src = 'watch/Hour.png';
        base_image.onload = function(context){
            context.drawImage(base_image, 100, 100);
        }
    }
});

</script>

<template>
    <Head title="Designer" />
    <AuthenticatedLayout>
        <template #header>
            <h3>Designer</h3>
        </template>
        <div class="row">
            <div class="col-3">
                <div class="vstack gap-2 left-stack">
                    <h5>HANDS</h5>
                    <div class="border">Second</div>
                    <div class="border">Minute</div>
                    <div class="border">Hour</div>
                </div>
            </div>
            <div class="col-6">
                {{ html }}
                <canvas class="canvas"></canvas>
            </div>
            <div class="col-3">
                poi
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>

.canvas {
    background: #333333;
    border-radius: 50%;
    /*overflow: hidden;*/
    margin: auto;
    position: relative;
    top: 10px;
    /*left: 50%;*/
    /*transform: translate(-50%,0);*/
    width: 400px;
    height: 400px;
}

/*.stage {*/
/*    width: 100%;*/
/*    height: 600px;*/
/*}*/

.left-stack div {
    width: 100%;
    padding: 10px;
    background: #efefef;
    border-radius: 2px;
    font-size: 12px;
}

.left-stack h5 {
    color: #666666;
    text-transform: capitalize;
    font-size: 14px;
}
</style>
