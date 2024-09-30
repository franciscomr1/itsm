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
    });
    const buttonStyleList = {
        'standard':'text-light-primary dark:text-dark-primary disabled:opacity-75 disabled:pointer-events-none',
        'primary':'bg-light-accent dark:bg-dark-accent text-white disabled:opacity-75 disabled:pointer-events-none',
        'secondary':'bg-black/[0.06] dark:bg-white/[0.10] text-light-primary dark:text-dark-primary  disabled:opacity-75 disabled:pointer-events-none',

    }
    const buttonStateList = {
        'standard':'hover:bg-black/[0.06] dark:hover:bg-white/[0.10] active:bg-black/[0.02] dark:active:bg-white/[0.08] transition ease-in-out duration-150',
        'primary':'hover:bg-black/[0.06] dark:hover:bg-white/[0.10] active:bg-black/[0.03] dark:active:bg-white/[0.03] transition ease-in-out duration-150',
        'secondary':'hover:bg-black/[0.05]  hover:dark:bg-white/[0.05] active:bg-black/[0.02] dark:active:bg-white/[0.03] transition ease-in-out duration-150',
    }

    const buttonClass = computed(() => buttonStyleList[props.style] || 'text-light-primary dark:text-dark-primary disabled:opacity-75 disabled:pointer-events-none');
    const buttonStateClass = computed(() => buttonStateList[props.style] || 'hover:bg-black/[0.06] dark:hover:bg-white/[0.10] active:bg-black/[0.02] dark:active:bg-white/[0.08] transition ease-in-out duration-150');
</script>

<template>
    <button :type="type"  :class="[buttonClass, label ? 'rounded-md h-min w-min' : 'rounded-md h-9 w-9']" :disabled="isDisabled">
        <div  id="state-layer" class="w-full h-full rounded-md " :class="buttonStateClass" >
            <div v-if="label" class="flex items-center justify-center rounded-md md:h-full md:w-full" :class="iconName ? 'h-9 w-9' : ''">
                <Icon v-if="iconName"  :name="iconName" class="block md:hidden "  />
                <span  class="text-sm font-medium" :class="iconName ? 'hidden md:block py-0 md:py-2 md:px-4' : 'py-2 px-4'">{{ label }}</span>  
            </div>

            <div v-else class="flex items-center justify-center rounded-md w-9 h-9">    
                <Icon v-if="iconName"  :name="iconName"  />
                <Icon v-else name="poo"  />
            </div>
        </div>
    </button>
</template>

<!--

    <button :type="type"  class="rounded-md h-10 w-10 " :disabled="isDisabled">
        <div id="state-layer" class="w-full h-full rounded-md hover:bg-black/[0.05] dark:hover:bg-white/[0.05]" >
            <div  class="flex items-center justify-center space-x-2 rounded-md w-full h-full">    
                <Icon v-if="iconName" class="dark:text-white" :name="iconName"  />
                <span v-if="label" class="text-sm font-medium">{{ label }}</span>
            </div>
        </div>
    </button>




        <button :type="type"  :class="[buttonClass, label ? 'rounded-md h-10 w-10 md:h-min md:w-min' : 'rounded-md h-10 w-10']" :disabled="isDisabled">
        <div  id="state-layer" class="w-full h-full rounded-md " :class="buttonStateClass" >
            <div v-if="label || iconName" class="flex items-center justify-center rounded-md w-full h-full">    
                <Icon v-if="iconName"  :name="iconName" :class="label ? 'block md:hidden' : ''"  />
                <span v-if="label" class=" py-2 px-4 text-sm font-medium hidden md:block">{{ label }}</span>
            </div>
            <div v-else class="flex items-center justify-center rounded-md w-full h-full">    
                <Icon   name="poo"  />
            </div>
        </div>
    </button>
-->