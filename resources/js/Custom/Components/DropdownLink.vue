<script setup>
import { Link } from '@inertiajs/vue3';

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
    <Link :href="route(routeName)" class="grid grid-cols-6 gap-2 hover:bg-light-secondary.container dark:hover:bg-dark-secondary.container py-2 rounded-lg w-full text-light-on.secondary.container dark:text-dark-on.secondary.container">
        <div class=" col-start-2 col-span-4 "><span class=" text-left text-sm font-medium">{{ label }}</span></div>
        <div v-if="hasBadge"  class="col-span-1  mx-auto"><span class="">{{ badgeValue }}</span></div>
    </Link>
</template>