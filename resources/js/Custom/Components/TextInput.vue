<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="w-full bg-light-container dark:bg-dark-container rounded-lg border-0
        ring-1 ring-inset ring-black/[0.16] dark:ring-white/[0.16]  text-light-primary dark:text-dark-primary text-sm
        focus:ring-2 focus:ring-inset focus:ring-light-accent/[0.50] dark:focus:ring-dark-accent/[0.50]"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>