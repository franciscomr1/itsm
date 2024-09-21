<script setup>
</script>
<template>
    <div class="h-full w-full bg-light-container-variant dark:bg-dark-container-variant">
        <div>
            <slot name="header" />
        </div>
        <div>

            <slot name="content" />
        </div>
    </div>
</template>