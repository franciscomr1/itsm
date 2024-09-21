<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Topbar from '@/Custom/Components/Topbar.vue';
import Logo from '@/Custom/Components/Logo.vue';
import ActionButton from '@/Custom/Components/ActionButton.vue';
import Menu from '@/Custom/Components/Menu.vue';
import MenuLink from '@/Custom/Components/MenuLink.vue';
import Sidebar from '@/Custom/Components/Sidebar.vue';
import SidebarSection from '@/Custom/Components/SidebarSection.vue';
import SidebarLink from '@/Custom/Components/SidebarLink.vue';
import Dropdown from '@/Custom/Components/Dropdown.vue';
import DropdownLink from '@/Custom/Components/DropdownLink.vue';
import ContentContainer from '@/Custom/Components/ContentContainer.vue';

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
        <div class="flex flex-col h-screen max-h-screen">
            <Topbar>
                <template #left>
                    <div class="flex items-center h-full w-full">
                        <div class="block md:hidden" >
                            <ActionButton id="menu-button" @click="toggleSidebar()" icon-name="bars" :isFilled="true" size="lg" />
                        </div>
                    </div>
                </template>
                <template #center>
                    <div class="h-full  flex">
                        <Logo size="sm" class="m-auto"/>
                    </div>
                </template>
                <template #right> 
                    <div class="flex items-center justify-end h-full w-full space-x-4">
                        <Menu >
                            <img src="/images/avatar.jpg" alt="profile" class="w-10 h-10 rounded-full">
                            <template #menu-items>
                                <MenuLink :route-name="'profile.show'">
                                    Profile
                                </MenuLink>
                                <MenuLink @click="logout()">
                                    Log Out
                                </MenuLink>
                            </template>
                        </Menu>
                    </div>
                </template>
            </Topbar>
            <div class="flex h-full w-full bg-[#c4c6d0] dark:bg-[#111318] overflow-hidden">
                <div :class="sidebarIsVisible ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" class="fixed md:static transition-all duration-300 ease-in-out md:block flex-shrink-0 h-full w-72">
                    <Sidebar>
                        <template #sidebar-content>
                            <SidebarSection title="Catálogos">
                                <template #sidebar-section-content>
                                    <Dropdown label="Empresa" iconName="building">
                                        <template #dropdown-content>
                                            <DropdownLink label="Inbox" routeName="dashboard" />
                                            <DropdownLink label="Outbox" routeName="dashboard" badge-value="1" :has-badge="true" />
                                            <DropdownLink label="Outbox" routeName="dashboard" badge-value="1" :has-badge="true" />
                                            <DropdownLink label="Outbox" routeName="dashboard" badge-value="1" :has-badge="true" />
                                            <DropdownLink label="Outbox" routeName="dashboard" badge-value="1" :has-badge="true" />
                                        </template>
                                    </Dropdown>
                                </template>
                            </SidebarSection>
                        </template>
                    </Sidebar>
                </div>

                <div class="flex h-full w-full bg-[#c4c6d0] dark:bg-[#111318] overflow-hidden p-4">
                        <slot />
                </div>
            </div>
        </div>
    </div>
</template>

