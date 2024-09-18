<script setup>
defineProps({
    size: {
        type: String,
        default: "md",
    },
});
const image = {
    xs: "h-10 w-auto",
    sm: "h-12 w-auto",
    md: "h-16 w-auto",
    lg: "h-24 w-auto",
    xl: "h-32 w-auto",
    "2xl": "h-40 w-auto",
    "3xl": "size-auto",
};
</script>
<template>
    <img
        :class="image[size] || 'h-24 w-auto'"
        src="/images/logo.png"
        alt="Logo"
    />
</template>