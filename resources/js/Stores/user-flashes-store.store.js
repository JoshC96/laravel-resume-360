import { defineStore } from "pinia";
import { ref } from "vue";


export const useUserFlashesStore = defineStore('userFlashes', () => {
    const successFlashes = ref([]);
    const noticeFlashes = ref([]);
    const errorFlashes = ref([]);

    function reportError(errorMessage) {
        console.error(errorMessage);
        errorFlashes.value.push(errorMessage);
    }

    function showNotice(noticeMessage) {
        console.log('notice')
        noticeFlashes.value.push(noticeMessage);
    }

    function showSuccess(successMessage) {
        console.log(successMessage);
        successFlashes.value.push(successMessage);
    }
  

    return { successFlashes, noticeFlashes, errorFlashes, reportError, showNotice, showSuccess }
}, { 
    persist: false
})