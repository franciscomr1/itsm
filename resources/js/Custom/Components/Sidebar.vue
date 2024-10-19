<script setup>
</script>
<template>
    <div id="nav" class="flex flex-col h-full w-full bg-light-container-variant dark:bg-dark-container-variant">
        <div>
            <slot name="header" />
        </div>
        <div class="flex-1 overflow-y-auto">
            <slot name="content" />
        </div>

        <div id="footer" class="px-2 py-4">
            <slot name="footer" />
        </div>
    </div>

</template>