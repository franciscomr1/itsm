<script setup>
import AppLayout from '@/Custom/Layouts/AppLayout.vue';
import ResourceForm from '@/Pages/Custom/Templates/ResourceForm.vue';
import { ref, onMounted } from 'vue';

const props = defineProps({
    title: {
        type: String,
    },
    recource:{
        type:String
    },
    fields:{

    },
    values:{

    }



    
    
});
const formData = ref(
{                        'id':'subject',
                        'label': 'titulo',
                        'type' :'input',
                        'propierties' : {

                            'type' : 'text',
                            'required': true
                        }
                    }

);
</script>

    <template>
    <AppLayout :title="title">
        <template #content>
            <div class="w-full h-full">
            <div class="  flex items-center justify-center  h-full ">

        
    
                        <ResourceForm class="max-w-md"  :fields="props.fields" :field-values="props.values" :resource="'tickets'" :is-new-record="true" />

                </div>

            
    

            </div>
                
        </template>
    </AppLayout>
</template>
