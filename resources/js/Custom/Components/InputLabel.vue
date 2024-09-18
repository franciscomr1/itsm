<script setup>
defineProps({
    value: {
        type: String,
        default: 'Input Label',
    },
});
</script>
<template>
    <label class="block text-sm font-medium text-light-on.surface dark:text-dark-on.surface">
        {{ value }}
    </label>
</template>