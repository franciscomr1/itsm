<script setup>
</script>
<template>
    <div class="h-full w-full bg-light-container-variant dark:bg-dark-container-variant overflow-hidden">
        <div>
            <slot name="header" />
        </div>
        <div class="overflow-auto">
            <slot name="content" />
        </div>

        <div class="">
            <slot name="footer" />
        </div>
    </div>
</template>