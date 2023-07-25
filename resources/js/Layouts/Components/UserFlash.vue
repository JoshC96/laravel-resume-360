<template>
    <div class="fixed bottom-0 right-0 border-t-2 px-8 py-3 flex flex-col justify-between items-center space-y-3">

        <Transition>
            <div 
                v-if="showSuccessFlash" 
                @click="showSuccessFlash = false" 
                ref="errorFlash"  
                class="flex rounded-lg items-center  bg-green-700 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p>{{ successMessage }}</p>
            </div>
        </Transition>

         <Transition>
            <div 
                v-if="showNoticeFlash" 
                @click="showNoticeFlash = false" 
                ref="noticeFlash"  
                class="flex rounded-lg items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p>{{ noticeMessage }}</p>
            </div>
        </Transition>

        <Transition>
            <div 
                v-if="showErrorFlash" 
                @click="showErrorFlash = false" 
                ref="successFlash"  
                class="flex rounded-lg items-center bg-red-600  text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                <p>{{ errorMessage }}</p>
            </div>
        </Transition>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { watch } from 'vue';
import { useUserFlashesStore } from '@/Stores/user-flashes-store.store';

const store = useUserFlashesStore();
const showSuccessFlash = ref(false);
const showNoticeFlash = ref(false);
const showErrorFlash = ref(false);
const errorMessage = ref('');
const successMessage = ref('');
const noticeMessage = ref('');


watch(store.errorFlashes, function() {
    errorMessage.value = store.errorFlashes[store.errorFlashes.length - 1]
    showErrorFlash.value = true;
    setTimeout(function() {
        showErrorFlash.value = false;
    }, 3000);
});

watch(store.successFlashes, function () {
    successMessage.value = store.successFlashes[store.successFlashes.length - 1]
    showSuccessFlash.value = true;
    setTimeout(function () {
        showSuccessFlash.value = false;
    }, 3000);
});


watch(store.noticeFlashes, function () {
    noticeMessage.value = store.noticeFlashes[store.noticeFlashes.length - 1]
    showNoticeFlash.value = true;
    setTimeout(function () {
        showNoticeFlash.value = false;
        console.log(noticeMessage.value)
    }, 3000);
});
</script>

<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>