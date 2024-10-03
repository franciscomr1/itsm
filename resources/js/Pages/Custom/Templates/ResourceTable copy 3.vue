<script setup>
    import { ref, onMounted } from 'vue';
    import DataTable from 'datatables.net-vue3';
    import DataTablesCore from 'datatables.net';
    import jszip from 'jszip';
    import 'datatables.net-buttons-dt';
    import 'datatables.net-buttons/js/buttons.html5.mjs';   
    import 'datatables.net-buttons/js/buttons.print.mjs';
    import ResourceForm from '@/Pages/Custom/Templates/ResourceForm.vue';
    import Notification from '@/Custom/Components/Notification.vue';

    window.JSZip = jszip;
    DataTable.use(DataTablesCore);

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
        },
    });

    const options = {
                responsive: true,
                order: [0, 'desc'],
                layout: {  
                    topStart: null,
                    topEnd: null,
                    top2: {
                        className: 'dt-top',
                        features: {
                            pageLength: {
                                menu: [5, 10, 25, 50]
                            },
                            div: {
                                className: 'dt-title',
                                text:props.title,
                            },
                            buttons: {
                                buttons: [ 
                                {
                                    text: '<i class="fa-solid fa-plus"></i>',
                                    className:'dt-btn-create',
                                    action: function (e, dt, node, config) {
                                        openModal()
                                    }   
                                },
                                { 
                                    extend: 'excel',
                                    text: '<i class="fa-solid fa-download"></i>',
                                    className:'dt-btn-export' 
                                }
                                ]
                            }
                        }
                    },
                    top:{
                        className: 'dt-top-search',
                        features: {
                            search: {
                                //placeholder: 'Search here...',
                                text: 'Buscar _INPUT_'
                            }
                        }
                    },
                    bottomStart:null,
                    bottomEnd:null,
                    bottom: {
                        className: 'dt-bottom',
                        features: {
                            info: {
                                text: 'Mostrando: _START_ a _END_ de _TOTAL_ registros'
                            },
                            paging: {
                                numbers: true
                            }
                        }
                    }
                }
            }
        
    const formData = ref(null);
    const modalIsVisible = ref(false);
    const notificationIsVisible = ref(true);

    const getResourceData = async () => {
        try {
            const response = await axios.get(route('create.resource'),
            {
                params:
                {
                    'resource': props.resource,
                }
            });
            return response.data;
        } catch (error) {
            console.error('Error fetching resource data:', error);
            return null;
        }
    }

    const openModal = async () => {
        if (formData.value === null) {
            formData.value = await getResourceData();
        }
        modalIsVisible.value = true;
    }

    const closeModal = () => {
        modalIsVisible.value = false;
    }

    const hideNotification = () => {
        console.log('close')
        notificationIsVisible.value = false;
    }

    const ajax = route(props.resource+'.search');



    let dt;
const table = ref();
 
onMounted(function () {
  dt = table.value.dt;
});
 
function reloadTable() {
    dt.ajax.url(route(props.resource+'.search')).load();
}

const test = (val) => {
    console.log(val);
}


</script>

<template>
    <div v-if="modalIsVisible" class="relative z-10">
        <div class="fixed inset-0 bg-neutral-500 bg-opacity-50 transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden transition-all w-full md:max-w-md px-6 md:px-0">
                    <ResourceForm @close-modal="closeModal"  :title="title" :resource="resource" :formFields="formData['formFields']" :fieldPropierties="formData['fieldPropierties']" />
                </div>
            </div>
        </div>
    </div>

    <div class="relative">
        <div class="w-full">
            <Notification v-if="$page.props.flash.message" 
             v-show="notificationIsVisible" 
             @hide-notification="hideNotification" 
             @reload-table="reloadTable"
             :title="$page.props.flash.message.title"
             :description="$page.props.flash.message.description" />
        </div>

</div>


    <div class="p-4">
        <div class="">
            <DataTable
            ref="table"
                id="table-resource"
                :ajax="ajax"
                :columns="columns"
                :options="options"
                class="display "


                
            >
            <template #action="props">
                <button type="button" class="btn btn-primary" @click="test(props.rowData['id'])">Edit</button>
        </template>

        </DataTable>
        </div>
    </div>

    
</template>

<style>

    :root {
        --base: 0,0,0;
        --container:#ffffff;
        --accent: #3584e4;
        --accent-alpha:53, 132, 228;
        --accent-hover: #458ee6;
        --accent-focus: #1c71d8;
        --primary: #0a0a0a;
        --secondary: #333333;
        --tertiary: #5c5c5c;
        --outline:#d6d6d6;
    }

    @media (prefers-color-scheme: dark) {
        :root {
            --base: 255,255,255;
            --container:#333333;
            --accent: #3584e4;
            --accent-alpha:53, 132, 228;
            --accent-hover: #458ee6;
            --accent-focus: #1c71d8;
            --primary: #f5f5f5;
            --secondary: #cccccc;
            --tertiary: #a3a3a3;
            --outline:#545454;
        }
    }

    .dt-top{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dt-top-search{
        margin-top: 1rem; 
    }

    .dt-length{
        width: 33.333333%; 
    }

    .dt-search label {
        font-size: 0.875rem; 
        line-height: 1.25rem; 
        color: var(--secondary);
    }

    .dt-search input{
        width: 16rem;
        background-color: var(--container);
        height: 2.25rem;
        border-radius: 0.375rem; 
        font-size: 0.875rem;
        line-height: 1.25rem; 
        border-width: 0; 
        box-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) rgba(var(--base), 0.16); 
        --tw-ring-inset: inset; 
        color: var(--primary);
    }

    .dt-search input:focus{
        box-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) rgba(var(--accent-alpha), 0.5);; 
        --tw-ring-inset: inset; 

    }

    .dt-search input:active{
        box-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) rgba(var(--accent-alpha), 0.5);; 
        --tw-ring-inset: inset; 

    }

    @media only screen and (max-width: 768px) {
        .dt-search  label{
            display: none;
        }
        .dt-search input{
            width: 100%;
        }
    }

    .dt-length select{
        background-color: var(--container);
        height: 2.25rem;
        border-radius: 0.375rem; 
        font-size: 0.875rem;
        line-height: 1.25rem; 
        border-width: 0; 
        box-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) rgba(var(--base), 0.16); 
        --tw-ring-inset: inset; 
        color: var(--primary);
    }

    .dt-length select:focus{
        box-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) rgba(var(--accent-alpha), 0.5);; 
        --tw-ring-inset: inset; 

    }

    .dt-length select:active{
        box-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) rgba(var(--accent-alpha), 0.5);; 
        --tw-ring-inset: inset; 

    }

    .dt-length  label{
        display: none;
    }

    .dt-title{
        width: 33.333333%; 
        text-align: center; 
        font-size: 1rem;
        line-height: 1.5rem; 
        font-weight: 600; 
        color: var(--primary);
    }

    .dt-buttons{
        width: 33.333333%; 
        display: flex; 
        justify-content: flex-end; 
        align-items: center;
        margin-left: 0.1rem; 
    }

    .dt-btn-create{
        height: 2.25rem;
        width: 2.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem; 
        background-color: var(--accent);
        color: white; 
        margin-left: 0.5rem;
        margin-right: 0.5rem; 
    }

    .dt-btn-create:hover{
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms; 
        transition-duration: 150ms; 
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); 
        background-color: var(--accent-hover);
    }

    .dt-btn-create:active, .dt-btn-create:focus{
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms; 
        transition-duration: 150ms; 
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); 
        background-color: var(--accent-focus);
    }

    .dt-btn-export{
        height: 2.25rem;
        width: 2.25rem; 
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem; 
        background: rgba(var(--base), 0.08);
        color: var(--primary); 
    }

    .dt-btn-export:hover{
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms; 
        transition-duration: 150ms; 
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); 
        background: rgba(var(--base), 0.12);
    }

    .dt-btn-export:active, .dt-btn-export:focus{
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms; 
        transition-duration: 150ms; 
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); 
        background: rgba(var(--base), 0.16);
    }

    .dt-bottom{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dt-paging{
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dt-paging-button {
        height: 2rem;
        width: 2rem; 
        background: rgba(var(--base), 0.08);
        color: var(--primary); 
        font-size: 0.875rem;
        line-height: 1.25rem; 
        margin-left: 0.25rem; 
        border-radius: 0.375rem; 
    }

    .dt-paging-button.current {
        cursor: default;
        background-color: var(--accent) !important;
        color:white;
    }
    
    .dt-paging-button.disabled {
        cursor: default;
        background: rgba(var(--base), 0.08);
        opacity: 0.7;
    }

    .dt-paging-button:not(.disabled , .current):hover {
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms; 
        transition-duration: 150ms; 
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); 
        background: rgba(var(--base), 0.12);
    }

    .dt-paging-button:not(.disabled , .current):focus {
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms; 
        transition-duration: 150ms; 
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); 
        background: rgba(var(--base), 0.16);
    }

    .ellipsis{
        color: var(--secondary)
    }

    .dt-info{
        font-size: 0.875rem; 
        line-height: 1.25rem; 
        color: var(--secondary);
    }

    #table-resource{
        margin-top: 1rem; 
        margin-bottom: 1rem;
    }
    #table-resource tr th:first-child {
          border-radius: 0.5rem 0 0 0;
    }

    #table-resource tr th:last-child {
          border-radius: 0 0.5rem 0 0;
    }

    #table-resource tr th{
        height: 3rem;
        background: rgba(var(--base), 0.08);
        height: 3rem; 
        font-size: 0.875rem;
        line-height: 1.25rem; 
        text-align: left; 
        color: var(--secondary);
        padding-left: 0.25rem;
        padding-right: 0.25rem; 
    }

    #table-resource tbody{
        -webkit-box-shadow:inset 0px 0px 0px 1px var(--outline) ;
        -moz-box-shadow:inset 0px 0px 0px 1px var(--outline);
        box-shadow:inset 0px 0px 0px 1px var(--outline);
    }
    #table-resource tr td{
        height: 3rem;
        font-size: 0.875rem;
        line-height: 1.25rem; 
        text-align: left; 
        color: var(--secondary);
        padding-left: 0.25rem;
        padding-right: 0.25rem; 
    }

    #table-resource tbody tr:hover{
        background: rgba(var(--base), 0.08);
    }

    table.dataTable thead .dt-column-order {
        top: 0.18em !important;
        right: 0.2em !important;
        font-family: 'Font Awesome 6 Free' !important;
        font-size:  0.875em !important;
    }
 
    table.dataTable thead .dt-column-order:before,
    table.dataTable thead .dt-column-order:after
    {
        content: "" !important;
    }

    table.dataTable thead > tr > th.dt-ordering-asc span.dt-column-order:after,
    table.dataTable thead > tr > td.dt-ordering-asc span.dt-column-order:after {
            content: "\f176" !important;
            color: var(--color-accent) !important;
            opacity: 1 !important;
            top: unset !important;
            bottom: 0.3em !important;
            line-height: unset !important;
            padding-left: 4px;
    }


    table.dataTable thead > tr > th.dt-ordering-desc span.dt-column-order:after,
    table.dataTable thead > tr > td.dt-ordering-desc span.dt-column-order:after {
        content: "\f175" !important;
        color: var(--color-accent) !important;
        opacity: 1 !important;
        top: unset !important;
        bottom: 0.3em !important;
        line-height: unset !important;
        padding-left: 4px;
    }

    

    /* Table 
    
    table.dataTable thead th, 
table.dataTable tbody td{
    color: var(--secondary);
    border-bottom-width: 1px;
    border-color: var(--tertiary);
    font-size: 0.875rem; 
    line-height: 1.25rem; 
    height: 3.5rem; 
    text-align: left;
}
    */



</style>