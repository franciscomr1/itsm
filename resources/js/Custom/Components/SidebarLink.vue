<script setup>
import { Link } from '@inertiajs/vue3';
import Icon from '@/Custom/Components/Icon.vue'

defineProps({
    label:{
        type:String,
        default:'label'
    },
    icon:{
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
        <Link :href="route(routeName)" class="grid grid-cols-6 gap-2 hover:bg-light-secondary.container dark:hover:bg-dark-secondary.container py-2 rounded-lg w-full text-light-on.secondary.container dark:text-dark-on.secondary.container">
            <div class="col-span-1 mx-auto"><Icon :name="icon" /></div>
            <div class="col-span-4 "><span class=" text-left text-sm font-medium">{{ label }}</span></div>
            <div v-if="hasBadge"  class="col-span-1  mx-auto"><span class="">{{ badgeValue }}</span></div>
        </Link>
    </div>
</template>