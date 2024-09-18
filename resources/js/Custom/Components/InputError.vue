<script setup>

defineProps({
    message: String,
});

</script>

<template>
    <div class="h-4">
        <p v-if="message" class="text-light-error dark:text-dark-error text-sm">{{ message }}</p>
    </div>
</template>