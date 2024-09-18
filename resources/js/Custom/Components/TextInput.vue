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
        class="bg-transparent rounded-lg border-0
        ring-1 ring-inset ring-light-outline dark:ring-dark-outline  text-light-on.surface.var dark:text-dark-on.surface.var
        focus:ring-2 focus:ring-inset focus:ring-light-primary dark:focus:ring-dark-primary"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>