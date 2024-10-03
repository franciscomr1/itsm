<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import  Topbar  from '@/Custom/Components/Topbar.vue';
import  ActionButton  from '@/Custom/Components/ActionButton.vue';
import  Sidebar  from '@/Custom/Components/Sidebar.vue';
import  SidebarSection  from '@/Custom/Components/SidebarSection.vue';
import  SideBarMenu  from '@/Custom/Components/SideBarMenu.vue';
import  SidebarMenuLink  from '@/Custom/Components/SidebarMenuLink.vue';    
import  ContentContainer  from '@/Custom/Components/ContentContainer.vue';
import  Dropdown  from '@/Custom/Components/Dropdown.vue';
import  Logo  from '@/Custom/Components/Logo.vue';
import  SidebarLink  from '@/Custom/Components/SidebarLink.vue'; 
import  Icon  from '@/Custom/Components/Icon.vue';

defineProps({
    title: String,
});

const sidebarIsVisible = ref(false);

const toggleSidebar = () => {
    sidebarIsVisible.value = !sidebarIsVisible.value;
};
const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />
        <div class="flex h-screen">

            <div :class="sidebarIsVisible ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" 
                class="fixed md:static transition-all duration-300 ease-in-out md:block flex-shrink-0 h-full w-72">

                <Sidebar>
                    <template #header>
                        <div class="inline-flex items-center p-1 w-full ">
                        <div class="w-12">
                        </div>
                        <div class="w-full px-2 py-1.5  flex items-center justify-center">
                            <h2 class="font-semibold text-light-primary dark:text-dark-primary">Service Manager</h2>
                        </div>
                        <div class="w-12">
                            <ActionButton iconName="xmark" class="block md:hidden" @click="toggleSidebar()" />
                        </div>
                    </div>
                    </template>
                    <template #content>
                        <SidebarSection title="Catálogos">
                            <template #content>
                                <SideBarMenu label="Empresa" iconName="building">
                                    <template #dropdown-menu>
                                        <SidebarMenuLink label="Empresas" route-name="companies.index" />
                                        <SidebarMenuLink label="Departamentos" route-name="departments.index" />
                                    </template>
                                </SideBarMenu>
                                <SideBarMenu label="Activos" iconName="desktop">
                                    <template #dropdown-menu>
                                        <SidebarMenuLink label="Empresas"  :href="route('companies.index')" />
                                    </template>
                                </SideBarMenu>
                                <SidebarLink label="Perfil" iconName="user" :href="route('dashboard')" />
                            </template>
                        </SidebarSection>
                    </template>
                </Sidebar>

            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col bg-light-background dark:bg-dark-background overflow-hidden">
                <Topbar>
                    <template #left>
                        <ActionButton iconName="bars"  :style="'secondary'" class="block md:hidden" @click="toggleSidebar()" />
                    </template>
                    <template #center>
                        <Logo size="lg" class="mx-auto"/>
                    </template>
                    <template #right>
                        <ActionButton @click="logout()" iconName="power-off" :style="'secondary'" />
                    </template>
                </Topbar>

                <div class="flex p-4 h-full overflow-hidden">
                    


                    <div class="flex-1 h-full  bg-light-container dark:bg-dark-container rounded-lg border dark:border-neutral-800 shadow-sm overflow-auto">

                        <slot name="content"/>
            
  
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>


<!--


                 
                        <div class="flex items-center bg-white dark:bg-black">
                            <div class="h-10 w-10 bg-black/[0.04] dark:bg-white/[0.13]">1</div>
                            <div class="h-10 w-10 bg-black/[0] dark:bg-white/[0.16]">2</div>
                            <div class="h-10 w-10 bg-black/[0.08] dark:bg-white/[0.20]">3</div>
                        </div>
                        <div class="flex items-center bg-white dark:bg-black">
                            <div class="h-10 w-10 bg-black/[0.09] dark:bg-white/[0.12]">1 +5</div>
                            <div class="h-10 w-10 bg-black/[0.05] dark:bg-white/[0]">2 +5</div>
                            <div class="h-10 w-10 bg-black/[0.13] dark:bg-white/[0.20]">3 +5</div>
                        </div>

                        <ActionButton iconName="bars" label="Menu" />
                        <ActionButton label="Menu"   />
                        <ActionButton  :style="'secondary'" />
                        <ActionButton iconName="house" :style="'secondary'" />
-->

