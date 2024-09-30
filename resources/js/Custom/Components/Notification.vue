<script setup>
    import { computed, onMounted } from 'vue';
    import Icon from '@/Custom/Components/Icon.vue'

    const props = defineProps({
        title:{
            type:String,
            default:'Title'
        },
        description:{
            type:String,
            default:'Description'
        },
        iconName:{
            type:String,
            default:'poo'
        },
        type:{
            type:String,
            default:'success'
        },
        fadeTime: {
        type: Number,
        default: 4000
        }
    });

    const styleList = {
        'success':'bg-green-100 dark:bg-green-400/50 text-green-400 dark:text-green-200',
        'warning':'bg-yellow-100 dark:bg-yellow-400/50 text-yellow-400 dark:text-yellow-200',
        'danger':'bg-red-100 dark:bg-red-400/50 text-red-400 dark:text-red-200',
        'info':'bg-blue-100 dark:bg-blue-400/50 text-blue-400 dark:text-blue-200',
        'custom':'bg-neutral-200 dark:bg-neutral-400 text-neutral-400 dark:text-neutral-200',
    }

    const iconList = {
        'success':'check',
        'warning':'circle-exclamation',
        'danger':'triangle-exclamation',
        'info':'exclamation',
    }

    const style = computed(() => styleList[props.type] || '' );
    const icon = computed(()=>iconList[props.type] ?  iconList[props.type] : props.iconName);


   const emit =  defineEmits(['hideNotification','ReloadTable'])


const clearNotification = () => {
    emit('hideNotification')
    emit('ReloadTable')
}

const reload = () => {
    emit('ReloadTable')
}

    const fade = (timevar, ) => {
        setTimeout(function () {
        clearNotification()
      }, timevar);
    }

    
    onMounted(() => {
      fade(props.fadeTime)
    });




</script>
<template>
    <div class="absolute z-10 w-full p-4">

        <div class=" w-full md:max-w-md  bg-dark-container dark:bg-dark-container rounded-lg">
             <div class="bg-white/[0.96] dark:bg-white/[0.04] flex p-2 rounded-md w-full">
                 <div class="flex flex-col items-center justify-center w-1/12">
                     <div class="w-8 h-8 rounded-full flex items-center justify-center" :class="style">
     
                         <Icon :name="icon" size="lg" />
                     </div>
     
                 </div>
                 <div  class="pl-2  w-10/12 ">
                     <h2 class="text-sm font-medium text-light-primary dark:text-dark-primary">{{ title }}</h2>
                     <h3 class="text-sm text-light-secondary dark:text-dark-secondary">{{ description }}</h3>
                 </div>
                 <div class="flex flex-col items-center justify-center w-1/12">
                     <button @click="clearNotification()"  class="h-7 w-7 rounded-full text-light-primary dark:text-dark-primary hover:bg-black/[8%] dark:hover:bg-white/[8%] active:bg-black/[12%] dark:active:bg-white/[12%] focus:bg-black/[12%] dark:focus:bg-white/[12%] transition ease-in-out duration-150"><Icon :name="'xmark'" size="'sm'" /></button>
     
                 </div>
     
             </div>
     
        </div>
    </div>
</template>