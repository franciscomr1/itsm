<script setup>
    import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Custom/Layouts/AppLayout.vue';
import ContentContainer from '@/Custom/Components/ContentContainer.vue';
import FormCard from '@/Custom/Components/FormCard.vue';
import ActionButton from '@/Custom/Components/ActionButton.vue';
import InputLabel from '@/Custom/Components/InputLabel.vue';
import TextInput from '@/Custom/Components/TextInput.vue';
import InputError from '@/Custom/Components/InputError.vue';
import SelectInput from '@/Custom/Components/SelectInput.vue';
const form = useForm({
        email: '',
        username: "",
        password: '',
        remember: false,
    });
</script>

<template>
    <AppLayout title="Dashboard">

            <template #content>
                <div class=" h-full w-full flex flex-col justify-center items-center">
                    <div class="w-full md:max-w-md px-6 md:px-0">
                        <FormCard>
                            <template #header>
                                <div class="inline-flex justify-center items-center w-full">
                                    <ActionButton label="Cancelar" :style="'secondary'" />
                                    <h2 class="w-full text-center font-semibold text-light-primary dark:text-dark-primary">Title</h2>
                                    <ActionButton label="Guardar" :style="'primary'" />
                                </div>
                            </template>
                            <template #content>
                                <div>
                                    <InputLabel  label="Nombre" for="nombre"  />
                                    <TextInput v-model="form.nombre" id="nombre"    />           
                                    <InputError :message="form.errors.nombre" />
                                </div>
                                <div>
                                    <InputLabel  label="Email" for="email"  />
                                    <TextInput v-model="form.email" id="email"    />           
                                    <InputError :message="form.errors.email" />
                                </div>
                                <div>
                                    <InputLabel  label="Puesto" for="puesto"  />
                                    <TextInput v-model="form.puesto" id="puesto"    />           
                                    <InputError :message="form.errors.puesto" />
                                </div>
                                <div>
                                    <InputLabel  label="Sucursal" for="sucursal"  />
                                    <SelectInput v-model="form.sucursal" id="sucursal"    />           
                                    <InputError :message="form.errors.sucursal" />
                                </div>
                            </template>
                        </FormCard>
                    </div>
                </div>
            </template>
    </AppLayout>
</template>