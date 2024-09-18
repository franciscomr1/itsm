<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        name:{
            type:String,
            default:'poo'
        },
        size:{
            type:String,
            default:'lg'
        },
        isFilled:{
            type:Boolean,
            default:true
        }
    });

    const iconList = {
        'arrow-left':'fa-arrow-left',
        'arrow-right':'fa-arrow-right',
        'arrow-up':'fa-arrow-up',
        'arrow-down':'fa-arrow-down',
        'bars':'fa-bars',
        'bell':'fa-bell',
        'book':'fa-book',
        'building':'fa-building',
        'chevron-down':'fa-chevron-down',
        'chevron-right':'fa-chevron-right',
        'chevron-up':'fa-chevron-up',
        'circle-user':'fa-circle-user',
        'database':'fa-database',
        'desktop': 'fa-desktop',
        'excel':'fa-file-excel',
        'floppy-disk':'fa-floppy-disk',
        'gear':'fa-gear',
        'handshake-angle':'fa-handshake-angle',
        'heart':'fa-heart',
        'house':'fa-house',
        'inbox':'fa-inbox',
        'magnifying-glass':'fa-magnifying-glass',
        'moon':'fa-moon',
        'paper-plane':'fa-paper-plane',
        'plus':'fa-plus',
        'poo':'fa-poo',
        'share':'fa-share',
        'star':'fa-star',
        'trash':'fa-trash-can',
        'user':'fa-user',
        }

    const  sizeList = {
        'xs':'fa-xs',
        'sm':'fa-sm',
        'lg':'fa-lg',
        '2x':'fa-2x',
        '3x':'fa-3x',
        '5x':'fa-5x',
        '7x':'fa-7x',
        '10x':'fa-10x',
    }

    const styleList = {
        'true':'fa-solid',
        'false':'fa-regular',
    }

    const icon = computed(()=>iconList[props.name] ? styleList[props.isFilled] + ' ' + iconList[props.name] : 'fa-solid fa-poo');
    const iconSize = computed(() => sizeList[props.size] ||  'fa-lg');
</script>

<template>
     <i :class="[icon,iconSize]" ></i>
</template>