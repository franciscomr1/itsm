<script setup>
import AppLayout from '@/Custom/Layouts/AppLayout.vue';
import ContentContainer from '@/Custom/Components/ContentContainer.vue';
import ResourceTable from '@/Pages/Custom/Templates/ResourceTable.vue';

const props = defineProps({
    title: {
        type: String,
        required:true
    },
    route: {
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
        <ContentContainer :columns="1">
            <template #content-column-1>
                <ResourceTable :title="title" :route="route" :columns="columns" />
            </template>
        </ContentContainer>
    </AppLayout>
</template>