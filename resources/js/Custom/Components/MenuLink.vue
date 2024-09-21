<script setup>
import { Link } from '@inertiajs/vue3';
    defineProps({
        routeName: {
            type: String,
            default: null
        }
    });
</script>
<template>
    <Link v-if="routeName" :href="route(routeName)" class="block  text-sm text-light-on.surface.var dark:text-dark-on.surface.var">
        <div id="link-state-layer" class="w-full h-full hover:bg-light-on.surface/[0.08] dark:hover:bg-dark-on.surface/[0.08] px-4 py-2" >
            <slot />
        </div>
    </Link>
    <button type="button" v-else class="block w-full text-left  text-sm text-light-on.surface.var dark:text-dark-on.surface.var">
        <div id="buttonstate-layer" class="w-full h-full hover:bg-light-on.surface/[0.08] dark:hover:bg-dark-on.surface/[0.08] px-4 py-2" >
            <slot />
        </div>
    </button>
</template>