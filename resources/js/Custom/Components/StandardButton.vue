<script setup>
import Icon from '@/Custom/Components/Icon.vue';
import { computed } from 'vue';

const props = defineProps({
    label: {
        type: String,
        required: true
    }
</script>

<template>
    <button class="bg-light-container dark:bg-dark-container h-8 w-8 rounded-md">
        <Icon name="bars"/>
    </button>
</template>