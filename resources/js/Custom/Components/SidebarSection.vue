<script setup>
    defineProps({
        title: {
            type: String,
            default: 'title',
        },
    });

</script>
<template>
    <div class="mx-2 py-1 hidden md:block text-sm font-medium text-light-tertiary dark:text-dark-tertiary">{{ title }}</div>
    <div class="space-y-0,5">
        <slot name="content" />
    </div>
</template>