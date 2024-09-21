<script setup>
import { ref } from 'vue';
import Icon from '@/Custom/Components/Icon.vue';
    defineProps({
        label: {
            type: String,
            default: 'title',
        },
        iconName: {
            type: String,
            default: 'heart',
        },
    });

    const isShown = ref(false);
</script>
<template>
    <div class=" w-full px-2">
        <button @click="isShown = !isShown" class="grid grid-cols-6 gap-1 hover:bg-light-secondary.container dark:hover:bg-dark-secondary.container py-2 rounded-lg w-full text-light-on.secondary.container dark:text-dark-on.secondary.container">
            <div class="col-span-1 mx-auto"> 
                <Icon :name="iconName"  />
            </div>
            <div class="col-span-4 text-left text-sm font-medium">
                {{ label }}
            </div>
            <div class="col-span-1 mx-auto">
                <Icon name="chevron-up" size="sm"   :class="{ 'transform rotate-180': isShown, 'transition-transform duration-150': true }"/>
            </div>
        </button>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-85"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-175"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-85"
        >
            <div v-if="isShown">
                <slot name="dropdown-content" />
            </div>
        </transition>

        
    </div>

</template>