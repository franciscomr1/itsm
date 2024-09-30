<script setup>
import { onMounted, onBeforeMount } from 'vue';
import { useForm } from '@inertiajs/vue3';
import FormCard from '@/Custom/Components/FormCard.vue';
import ActionButton from '@/Custom/Components/ActionButton.vue';
import InputLabel from '@/Custom/Components/InputLabel.vue';
import TextInput from '@/Custom/Components/TextInput.vue';
import SelectInput from '@/Custom/Components/SelectInput.vue';
import InputError from '@/Custom/Components/InputError.vue';

const props = defineProps({
    title:{
        type: String,
    },
    resource:{
        type: String,
    },
    fieldPropierties :{
        type: Object
    },
    formFields :{
        type: Object
    },
    isNewRecord :{
        type: Boolean,
        default: true
    }
});

const form = useForm(
    props.formFields
);

const emit = defineEmits(['closeModal']);

const close = () => {
    emit('closeModal');
}



const submit = () => {
    if (props.isNewRecord) {
    form.post(route(props.resource +'.store'), {
        onSuccess: () => close(),
    });
    } else {
       //form.patch(route('companies.update',route().params.id))
    }
};



</script>

<template>
    <FormCard>
        <template #header>
        </template>
        <template #content>
  
                            
      <form @submit.prevent="submit">
                <div class="inline-flex justify-center items-center w-full">
                    <ActionButton label="Cancelar" :style="'secondary'" @click="close()" />
                    <h2 class="w-full text-center font-semibold text-light-primary dark:text-dark-primary">{{title}}</h2>
                    <ActionButton type="submit" :label="isNewRecord ? 'Guardar' : 'Actualizar'" :style="'primary'" 
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing"/>
                </div>


          <div v-for="field in fieldPropierties">

      
            
            
            <div v-if="field.type === 'select'">
                <InputLabel :for="field.id" :value="field.label" />
                <SelectInput :id="field.id"
                v-model="form[field.id]"
                :data="field.propierties.data"
                />
            </div>
            
            <div v-if="field.type === 'input'">
                <InputLabel :for="field.id" :value="field.label" />
                <TextInput
                    :id="field.id"
                    v-model="form[field.id]"
                    type="text"
                    required
                />
                <InputError  :message="form.errors[field.id]" />
            </div>
 
          </div>

      </form>
            
   









        </template>
    </FormCard>

</template>