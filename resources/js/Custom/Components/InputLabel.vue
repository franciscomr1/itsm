<script setup>
defineProps({
    value: {
        type: String,
        default: 'Input Label',
    },
});
</script>
<template>
    <label class="block text-sm text-left font-medium text-light-primary dark:text-dark-primary pt-1">
        {{ value }}
    </label>
</template>