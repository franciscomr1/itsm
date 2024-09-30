<script setup>
import AppLayout from '@/Custom/Layouts/AppLayout.vue';
import ContentContainer from '@/Custom/Components/ContentContainer.vue';
import ResourceTable from '@/Pages/Custom/Templates/ResourceTable.vue';

const props = defineProps({
    title: {
        type: String,
        required:true
    },
    resource: {
        type: String,
        required:true
    },
    columns: {
        type: Array,
        required:true
    }
});
</script>

<template>
    <AppLayout :title="title">
        <template #content>
            <ResourceTable :title="title" :resource="resource" :columns="columns" />
        </template>
    </AppLayout>
</template>