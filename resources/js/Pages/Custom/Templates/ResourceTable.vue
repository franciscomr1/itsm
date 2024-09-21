<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import jszip from 'jszip';
import 'datatables.net-buttons-dt';
import 'datatables.net-buttons/js/buttons.html5.mjs';   
import 'datatables.net-buttons/js/buttons.print.mjs';
 
window.JSZip = jszip;
DataTable.use(DataTablesCore);

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
    },
    options: {
        type: Object,
        default: (props) => ({
            responsive: true,
            order: [0, 'desc'],
            layout: {  
                topStart: null,
                topEnd: null,
                top: {
                    className: 'dt-top',
                    features: {
                        div: {
                            text: props.title,
                            className: 'dt-title',
                        },
                        buttons: {
                            buttons: [ 
                                {
                                    text: '<i class="fa-solid fa-plus fa-lg"></i>',
                                    className:'dt-filled',
                                    action: function (dt) {
                                        console.log('My custom button!');
                                    }   
                                },
                                { extend: 'excel', text: 'Exportar',className:'dt-export' }
                            ]
                        }
                    }
                }
            }
        })
    }
});
 
const ajax = route(props.route);
</script>

<template>
    <DataTable
        :ajax="ajax"
        :columns="columns"
        :options="options"
        class="display"
    />
</template>

<style>

:root {
    --primary: #2f4074;
    --on-primary: #ffffff;
    --primary-hover: #59699b;
}

@media (prefers-color-scheme: dark) {
  :root {
        --primary: #b4c5ff;
        --on-primary: #1b2d60;
        --primary-hover: #93a3d0;
  }
}


.dt-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.dt-title {
    font-size: 1.25rem;
line-height: 1.75rem; 
font-weight: 700; 
}
.dt-filled {
    background-color: var(--primary);
    border-radius: 9999px; font-size: 0.875rem;
    line-height: 1.25rem; 
    font-weight: 500; 
    color: var(--on-primary);
    width: 2.5rem; 
    height: 2.5rem; 
    display: flex; 
    align-items: center; 
    justify-content: center;
}
.dt-filled:hover {
    background-color: var(--primary-hover);
}
</style>