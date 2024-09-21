<script setup>
defineProps({
    columns: {
        type: Number,
        default: 1
    }
})
</script>
<template>
    <div class="w-full h-full">
        <div v-if="columns === 1" class="w-full h-full  rounded-lg p-4">
            <slot name="content-column-1" />
        </div>
        <div v-if="columns === 2" class="h-full w-full flex space-x-4">
            <div class="flex-col w-2/3 h-full  rounded-lg">
                <slot name="content-column-1" />
            </div>
            <div class="flex-col w-1/3 h-full  rounded-lg">
                <slot name="content-column-2" />
            </div>
        </div>
        <div v-if="columns === 3" class="h-full">
            <div class="w-1/3 h-full  rounded-lg">
                <slot name="content-column-1" />
            </div>
            <div class="w-1/3 h-full  rounded-lg">
                <slot name="content-column-2" />
            </div>
            <div class="w-1/3 h-full rounded-lg">
                <slot name="content-column-3" />        
            </div>  
        </div>

    </div>
</template>