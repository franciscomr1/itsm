<script setup>
import AppLayout from '@/Custom/Layouts/AppLayout.vue';

import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

defineProps({
    title:{
      type:String,
      default:'Gráficas de Tickets'
    },
    chartDataPriority: {
        type:Object,
      },
      chartOptions: {
        responsive: true
      },
      chartDataIssue:{
        type: Object

      },
      chartDataUser: {
        type:Object,
      },
});

</script>
<template>
      <AppLayout :title="title">
        <template #content>
          <div class="p-6">
            <div class="flex w-full">
              <div class="w-1/2">
                <Bar
                  id="my-chart-id"
                  :options="chartOptions"
                  :data="chartDataIssue"
                />
              </div>

              <div class="w-1/2">
                <Bar
                  id="my-chart-id"
                  :options="chartOptions"
                  :data="chartDataPriority"
                />
              </div>


          </div>

          <div class="flex w-full">

              
              <div class="w-1/2">
                <Bar
                  id="my-chart-id"
                  :options="chartOptions"
                  :data="chartDataUser"
                />
              </div>

          </div>
          </div>

        </template>
    </AppLayout>
</template>