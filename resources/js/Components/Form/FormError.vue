<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message">
        <p class="alert alert-danger">
            {{ message }}
        </p>
    </div>
</template>
