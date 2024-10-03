<script setup>
import { Link } from '@inertiajs/vue3';
import Icon from '@/Custom/Components/Icon.vue'

defineProps({
    label:{
        type:String,
        default:'label'
    },
    routeName:{
        type:String,
        default:'dashboard'
    },
    hasBadge:{
        type:Boolean,
        default:false
    },
    badgeValue:{
        type:String,
        default:'0'
    }
});
</script>
<template>
    <div class="w-full">
        <Link :href="route(routeName)" class="grid grid-cols-6 gap-2 py-1.5 rounded-lg w-full text-light-secondary dark:text-dark-secondary hover:bg-black/[0.05]  hover:dark:bg-white/[0.05] ">
            <div class=" col-start-2 col-span-4 "><span class="text-sm text-left">{{ label }}</span></div>
            <div v-if="hasBadge"  class="col-span-1  mx-auto"><span class="">{{ badgeValue }}</span></div>
        </Link>
    </div>
</template>