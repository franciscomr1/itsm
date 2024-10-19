<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import FormCard from '@/Custom/Components/FormCard.vue';
    import Logo from '@/Custom/Components/Logo.vue';
    import InputLabel from '@/Custom/Components/InputLabel.vue';
    import TextInput from '@/Custom/Components/TextInput.vue';
    import InputError from '@/Custom/Components/InputError.vue';
    import ActionButton from '@/Custom/Components/ActionButton.vue';
    defineProps({
        //canResetPassword: Boolean,
        fortifyUsername: {
            type: String,
            required: true,
        },
    });

    const form = useForm({
        email: '',
        username: "",
        password: '',
        remember: false,
    });

    const submit = () => {
        form.transform(data => ({
            ...data,
            remember: form.remember ? 'on' : '',
        })).post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };

</script>   

<template>
    <Head title="Login" />
    <div class="min-h-screen flex flex-col justify-center items-center bg-light-container  dark:bg-dark-container">
        <div class="  w-full md:max-w-md">
            <FormCard class="border dark:border-neutral-800 shadow-sm">
                <template #header>
                    <Logo size="xl" class="mx-auto" />
                </template>
                <template #content>
                    <form @submit.prevent="submit">
                        <div class="space-y-2 mb-2">
                            <div v-if="fortifyUsername === 'email'">
                                <InputLabel value="Email" for="email"  />
                                <TextInput
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                <InputError :message="form.errors.email" />
                            </div>
    
                            <div v-else>
                                <InputLabel value="Username" for="username"  />
                                <TextInput
                                    id="username"
                                    v-model="form.username"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />
                                <InputError :message="form.errors.username" />
                            </div>
    
                            <div>
                                <InputLabel for="password" value="Password" />
                                <TextInput
                                    id="password"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    required
                                    autocomplete="current-password"
                                />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>
    
                            <div class="flex justify-end">
                                <ActionButton type="submit" label="Iniciar Sesión" :style="'primary'" />
                            </div>
                        </div>
                    </form>
                </template>
            </FormCard>
        </div>
    </div>
</template>
