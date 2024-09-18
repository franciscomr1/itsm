<script setup>
    import { computed } from 'vue';
    import Icon from '@/Custom/Components/Icon.vue';

    const props = defineProps({
        type: {
            type: String,
            default: 'button',
        },
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

    const buttonStyleList = {
        'filled':'bg-light-primary dark:bg-dark-primary disabled:opacity-75 disabled:pointer-events-none',
        'outlined':'border-2 border-light-outline dark:border-dark-outline disabled:opacity-75 disabled:pointer-events-none',
        'standard':'disabled:opacity-75 disabled:pointer-events-none',
        'tonal':'bg-light-secondary.container dark:bg-dark-secondary.container disabled:opacity-75 disabled:pointer-events-none'
    };

    const iconStyleList = {
        'filled':'text-light-on.primary dark:text-dark-on.primary',
        'outlined':'text-light-on.surface.variant dark:text-dark-on.surface.variant',
        'standard':'text-light-on.surface.variant dark:text-dark-on.surface.variant',
        'tonal':'text-light-on.secondary.container dark:text-dark-on.secondary.container'
    };

    const stateLayerStyleList = {
        'filled':'hover:bg-light-on.primary/[0.08] dark:hover:bg-dark-on.primary/[0.08] focus:bg-light-on.primary/[0.12] dark:focus:bg-dark-on.primary/[0.12] active:bg-light-on.primary/[0.12] dark:active:bg-dark-on.primary/[0.12] transition ease-in-out duration-150',
        'outlined':'hover:bg-light-on.surface.variant/[0.08] dark:hover:bg-dark-on.surface.variant/[0.08] focus:bg-light-on.surface.variant/[0.12] dark:focus:bg-dark-on.surface.variant/[0.12] active:bg-light-on.surface.variant/[0.12] dark:active:bg-dark-on.surface.variant/[0.12] transition ease-in-out  duration-150',
        'standard':'hover:bg-light-on.surface.variant/[0.08] dark:hover:bg-dark-on.surface.variant/[0.08] focus:bg-light-on.surface.variant/[0.12] dark:focus:bg-dark-on.surface.variant/[0.12] active:bg-light-on.surface.variant/[0.12] dark:active:bg-dark-on.surface.variant/[0.12] transition ease-in-out duration-150',
        'tonal':'hover:bg-light-on.secondary.container/[0.08] dark:hover:bg-dark-on.secondary.container/[0.08] focus:bg-light-on.secondary.container/[0.12] dark:focus:bg-dark-on.secondary.container/[0.12] active:bg-light-on.secondary.container/[0.12] dark:active:bg-dark-on.secondary.container/[0.12] transition ease-in-out duration-150'
    };

    const buttonClass = computed(() => buttonStyleList[props.style] || '');
    const iconClass = computed(() => iconStyleList[props.style] || '');
    const stateLayerClass = computed(() => stateLayerStyleList[props.style] || '');
    const isDisabled = computed(() => props.isDisabled || false);
</script>

<template>
    <button :type="type"  class="rounded-full " :class="[buttonClass, label ? '' : 'h-10 w-10']" :disabled="isDisabled">
        <div id="state-layer" class="w-full h-full rounded-full" :class="stateLayerClass">
            <div v-if="!iconName && !label" class="flex items-center justify-center w-full h-full text-stone-600 dark:text-stone-300">
                <Icon  />
            </div>
            <div v-else class="flex items-center justify-center space-x-2 w-full h-full" :class="[iconClass,label ? 'px-4 py-2' : '']">    
                <Icon v-if="iconName" :name="iconName" :isFilled="isFilled"  />
                <span v-if="label" class="text-sm font-medium">{{ label }}</span>
            </div>
        </div>
    </button>

</template>