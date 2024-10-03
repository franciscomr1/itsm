<script setup>
    import { computed } from 'vue';

    const props = defineProps({
        name:{
            type:String,
            default:'poo'
        },
        size:{
            type:String,
            default:'md'
        },
    });

    const iconList = {
        'arrow-left':'fa-solidfa-arrow-left',
        'arrow-right':'fa-solid fa-arrow-right',
        'arrow-up':'fa-solid fa-arrow-up',
        'arrow-down':'fa-solid fa-arrow-down',
        'bars':'fa-solid fa-bars',
        'bell':'fa-solid fa-bell',
        'book':'fa-solid fa-book',
        'building':'fa-solid fa-building',
        'caret-up':'fa-solid fa-caret-up',
        'check':'fa-solid fa-check',
        'chevron-down':'fa-solid fa-chevron-down',
        'chevron-right':'fa-solid fa-chevron-right',
        'chevron-up':'fa-solid fa-chevron-up',
        'circle-exclamation':'fa-solid fa-circle-exclamation',
        'circle-user':'fa-solid fa-circle-user',
        'database':'fa-solid fa-database',
        'desktop': 'fa-solid fa-desktop',
        'download':'fa-solid fa-download',
        'excel':'fa-solid fa-file-excel',
        'exclamation':'fa-solid fa-exclamation',
        'floppy-disk':'fa-solid fa-floppy-disk',
        'gear':'fa-solid fa-gear',
        'handshake-angle':'fa-solid fa-handshake-angle',
        'heart':'fa-solid fa-heart',
        'house':'fa-solid fa-house',
        'inbox':'fa-solid fa-inbox',
        'magnifying-glass':'fa-solid fa-magnifying-glass',
        'moon':'fa-solid fa-moon',
        'paper-plane':'fa-solid fa-paper-plane',
        'pencil':'fa-solid fa-pencil',
        'plus':'fa-solid fa-plus',
        'poo':'fa-solid fa-poo',
        'power-off':'fa-solid fa-power-off',
        'right-from-bracket':'fa-solid fa-right-from-bracket',
        'share':'fa-solid fa-share',
        'star':'fa-solid fa-star',
        'trash':'fa-solid fa-trash-can',
        'triangle-exclamation':'fa-solid fa-triangle-exclamation',
        'user':'fa-solid fa-user',
        'xmark':'fa-solid fa-xmark',
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

    const icon = computed(()=>iconList[props.name] ?  iconList[props.name] : 'fa-solid fa-poo');
    const iconSize = computed(() => sizeList[props.size] || '' );
</script>

<template>
     <i :class="[icon,iconSize]" ></i>
</template>