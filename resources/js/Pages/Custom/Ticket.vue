<script setup>
import AppLayout from '@/Custom/Layouts/AppLayout.vue';

const props = defineProps({
    title: {
        type: String,
        default:'Crear Ticket'
    },

});
</script>

    <template>
    <AppLayout :title="title">
        <template #content>

                
        </template>
    </AppLayout>
</template>
