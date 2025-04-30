<template>
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" v-if="isVisible">
        <div class="bg-white rounded-lg p-8 w-96">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">
                    <slot name="title">Add Folder</slot>
                </h3>
                <x-close class="w-6 h-6 path--stroke-gray-400 cursor-pointer z-10" @click="$emit('close')"></x-close>
            </div>
            <div class="text-sm font-normal text-gray-600 mt-3">
                <slot name="subtitle"></slot>
            </div>
            <slot name="content"></slot>
            <div class="mt-4 flex flex-row justify-between gap-3">
                <slot name="left-btn"></slot>
                <slot name="right-btn"></slot>
            </div>
        </div>
    </div>
</template>
<script>
import XClose from "../../assets/img/svg/x-close.svg";

export default {
    name: "PopupLayout",
    components: {XClose},
    props: {
        isVisible: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            folderName: ''
        };
    },
};
</script>
