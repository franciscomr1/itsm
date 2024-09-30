<script setup>
</script>

<template>
    <div class="flex items-center w-full h-16 px-4">
        <div class="w-1/6"><slot name="left" /></div>
        <div class="w-4/6"><slot name="center" /></div>
        <div class="w-1/6 inline-flex items-center justify-end space-x-2"><slot name="right" /></div>
    </div>
</template>
