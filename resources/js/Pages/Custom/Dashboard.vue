<script setup>
import AppLayout from '@/Custom/Layouts/AppLayout.vue';
import ContentContainer from '@/Custom/Components/ContentContainer.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <ContentContainer :columns="1">
            <template #content-column-1>
                <h1>Dashboard desde slot</h1>
            </template>
        </ContentContainer>
    </AppLayout>
</template>