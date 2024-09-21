<script setup>
    defineProps({
        title: {
            type: String,
            default: 'title',
        },
    });

</script>
<template>
    <div class="mx-2 py-2 hidden md:block text-sm font-medium text-light-on.surface.variant dark:text-dark-on.surface.variant">{{ title }}</div>
    <div>
        <slot name="sidebar-section-content" />
    </div>
</template>