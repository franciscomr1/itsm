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

    const menuIsVisible = ref(false);
</script>
<template>
    <div class=" w-full px-2">
        <button @click="menuIsVisible = !menuIsVisible" class="grid grid-cols-6 gap-1 py-1.5 rounded-lg w-full text-light-secondary dark:text-dark-secondary
         hover:bg-black/[4%]  hover:dark:bg-white/[4%] focus:bg-black/[8%] dark:focus:bg-white/[8%]">
            <div class="col-span-1 mx-auto"> 
                <Icon :name="iconName"  />
            </div>
            <div class="col-span-4 text-left text-sm font-medium">
                {{ label }}
            </div>
            <div class="col-span-1 mx-auto">
                <Icon name="caret-up" size="sm"   :class="{ 'transform rotate-180': menuIsVisible, 'transition-transform duration-150': true }"/>
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
            <div v-if="menuIsVisible" class="py-0.5">
                <slot name="dropdown-menu" />
            </div>
        </transition>

        
    </div>

</template>