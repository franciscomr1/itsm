<script setup>
import { Link } from '@inertiajs/vue3';
import Icon from '@/Custom/Components/Icon.vue'

defineProps({
    label:{
        type:String,
        default:'label'
    },
    iconName:{
        type:String,
        default:'heart'
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
    <div class="w-full px-2">
        <Link :href="route(routeName)" class="grid grid-cols-6 gap-2 py-1.5 rounded-lg w-full text-light-secondary dark:text-dark-secondary hover:bg-black/[0.05]  hover:dark:bg-white/[0.05] ">
            <div class="col-span-1 mx-auto"><Icon :name="iconName" /></div>
            <div class="col-span-4 "><span class=" text-left text-sm font-medium">{{ label }}</span></div>
            <div v-if="hasBadge"  class="col-span-1  mx-auto"><span class="">{{ badgeValue }}</span></div>
        </Link>
    </div>
</template>