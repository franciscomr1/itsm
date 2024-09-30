<script setup>
    defineProps({
        title: {
            type: String,
            default: null,
        },
    });
</script>

<template>
    <div class="bg-light-background dark:bg-dark-container-variant w-full rounded-lg p-4">
        <div class="pb-4">
            <slot name="header" />
        </div>
        <div>
            <slot name="content" />
        </div>
    </div>
</template>

<!--

<template>
    <div class="bg-light-surf.container dark:bg-dark-surf.container p-4 rounded-lg w-full md:max-w-md">
        <div v-if="title">
            <h2  class="text-2xl font-bold text-light-on.surface.var dark:text-dark-on.surface.var py-2">{{ title }}</h2>
        </div>
        <div v-else class="py-2">
            <slot  />
        </div>
        <div>
            <slot name="form-content" />
        </div>
    </div>
</template>
-->
