<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active', 'method']);

const classes = computed(() => props.active
    ? 'nav-link dark-link active'
    : 'nav-link dark-link'
);
</script>

<template>
    <li class="nav-item">
        <Link :href="href" :class="classes" :method="method">
            <slot />
        </Link>
    </li>
</template>

<style>
.dark-link {
    color: #000000;
}
</style>
