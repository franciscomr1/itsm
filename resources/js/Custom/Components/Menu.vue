<script setup>
    import { ref } from 'vue';
    import ActionButton from '@/Custom/Components/ActionButton.vue';

    defineProps({
        isDisabled: {
            type: Boolean,
            default: false
        },
        label: {
            type: String,
            default: null
        },
        style: {
            type: String,
            default: 'standard'
        },
        iconName: {
            type: String,
            default: null
        },
        isFilled: {
            type: Boolean,
            default: false
        },
        size: {
            type: String,
            default: 'lg'
        }
    });
    const menuIsVisible = ref(false);

    const toggleMenu = () => {
        menuIsVisible.value = !menuIsVisible.value;
    };
</script>
<template>
    <ActionButton v-if=" label || iconName":label="label" :icon-name="iconName" :style="style" :is-filled="isFilled" :size="size" @click="toggleMenu" />
    
    <button type="button" v-else @click="toggleMenu">
        <slot />
    </button>

    <div class="relative">
        <div v-show="menuIsVisible" class="absolute top-8 right-0 mt-2 w-48 bg-light-surf.container dark:bg-dark-surf.container rounded-md shadow-lg py-2">
            <slot name="menu-items"></slot>
        </div>
    </div>

</template>