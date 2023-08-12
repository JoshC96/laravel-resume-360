<template>
    <Teleport to="body">
        <Transition leave-active-class="duration-200">
            <div v-show="show" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50 md:mt-16 " scroll-region>
                <Transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click.stop="$emit('close')">
                        <div class="absolute inset-0 bg-gray-500 opacity-75" />
                    </div>
                </Transition>

                <Transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        v-show="show"
                        class="modal mb-6 bg-white rounded-lg overflow-y-scroll shadow-xl transform transition-all sm:w-full sm:mx-auto"
                        :class="maxWidthClass"
                    >
                        <div class="border-b border-light">
                            <div class="px-6 py-5 flex justify-between items-center text-slate-500">
                                <div class="text-slate-900">
                                    <slot name="header">

                                    </slot>
                                </div>
                                <button class="modal-default-button text-slate-500" @click="$emit('close')">
                                    <svg class="w-4 fill-current" fill="none" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="10px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M443.6,387.1L312.4,255.4l131.5-130c5.4-5.4,5.4-14.2,0-19.6l-37.4-37.6c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4  L256,197.8L124.9,68.3c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4L68,105.9c-5.4,5.4-5.4,14.2,0,19.6l131.5,130L68.4,387.1  c-2.6,2.6-4.1,6.1-4.1,9.8c0,3.7,1.4,7.2,4.1,9.8l37.4,37.6c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1L256,313.1l130.7,131.1  c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1l37.4-37.6c2.6-2.6,4.1-6.1,4.1-9.8C447.7,393.2,446.2,389.7,443.6,387.1z"/></svg>
                                </button>
                            </div>
                        </div>
                        <div :class="containerClasses">
                            <div>
                                <slot name="content">

                                </slot>
                            </div>
                        </div>
                        <div :class="{'hidden' : hideButtons, 'flex': !hideButtons}" class="justify-end gap-3 py-6 px-5">
                            <slot name="buttons"></slot>
                            <button 
                                @click.stop="$emit('close')"
                                :disabled="disableClose"
                                class="transition duration-100 bg-gray-500 hover:bg-gray-400 text-white font-medium focus:outline-none py-2 rounded-md px-5 mr-6">
                                {{ closeText }}
                            </button>
                            <button 
                                v-if="!hideConfirm"
                                @click.stop="$emit('confirm')"
                                :disabled="disableConfirm"
                                class="transition duration-100 bg-indigo-500 hover:bg-indigo-400 text-white font-medium focus:outline-none py-2 rounded-md px-5 mr-6">
                                {{ confirmText }}
                            </button>
                        </div>                 
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    closeText: {
        type: String,
        default: 'Close',
    },
    confirmText: {
        type: String,
        default: 'Confirm',
    },
    disableClose: {
        type: Boolean,
        default: false,
    },
    disableConfirm: {
        type: Boolean,
        default: false,
    }, 
    hideButtons: {
        type: Boolean,
        default: false,
    },
    hideConfirm: {
        type: Boolean,
        default: false,
    },
    containerClasses: {
        type: String,
        default: 'p-8',
    },
});

const emit = defineEmits(['close', 'confirm']);

watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = null;
        }
    }
);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
    return {
        sm: 'sm:max-w-sm',
        md: 'sm:max-w-md',
        lg: 'sm:max-w-lg',
        xl: 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
    }[props.maxWidth];
});
</script>

<style scoped>

/* Hide scrollbar for Chrome, Safari and Opera */
.modal::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.modal {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}

</style>