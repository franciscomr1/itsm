<script setup>

defineProps({
    message: String,
});

</script>

<template>
    <div class="h-4">
        <p v-if="message" class="text-left text-red-600 dark:text-red-300 text-sm">{{ message }}</p>
    </div>
</template>