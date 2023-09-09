<template>
    <div class="text-right">
        <p class="text-sm mb-3">
            Showing {{ data.from }} to {{ data.to }} of {{ data.total }} results
        </p>
        <nav>
            <ul class="inline-flex -space-x-px text-base h-10">

                <li class="page-item" v-for="link in data.links">
                    <a href="#" 
                        @click="handlePageChange(link.url)"
                        :class="{
                            'pointer-events-none opacity-70': !link.url,
                            'pointer-events-none bg-gray-100': link.active
                        }" 
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        v-html="link.label"
                        >
                    </a>
                </li> 
            
            </ul>
        </nav>
    </div>

</template>


<script setup>
import { onMounted } from 'vue';
import { computed } from 'vue';
import { watch } from 'vue';
import { ref } from 'vue';

const props = defineProps({
    paginationData: {
        required: true,
        type: Object
    }
});
const emit = defineEmits(['changePage']);

const data = ref();
const perPage = ref(20);

watch(props, (newValue) => {
    data.value = newValue.paginationData;
}, { deep: true, immediate: true })

const handlePageChange = function (url) {
    const newPage = Number((new URLSearchParams(url.split('?')[1])).get('page'))

    emit('changePage', {
        link: url,
        perPage: perPage.value,
        newPage: newPage
    })
}

</script>

<style scoped>

@media screen and ( max-width: 1330px ){
    li.page-item {

        display: none;
    }
    .page-item:first-child,
    .page-item:last-child {

        display: block;
    }
}
</style>