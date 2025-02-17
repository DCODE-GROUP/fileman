<template>
    <fileman-popup-layout
        :is-visible="isVisible"
        @close="closePopup"
    >
        <template #title>
            {{$t('fileman.words.rename_file')}}
        </template>
        <template #subtitle>
            {{$t('fileman.words.rename_file_subtitle')}}
        </template>
        <template #content>
            <div class="mt-4">
                <input
                    v-model="fileName"
                    type="text"
                    class="w-full border border-gray-300 rounded-md p-2"
                    :placeholder="$t('fileman.words.rename_file_placeholder')"
                >
            </div>
        </template>
        <template #left-btn>
            <button
                @click="closePopup"
                class="py-2.5 w-full border border-gray-300 rounded-full"
            >
                {{ $t('fileman.buttons.cancel') }}
            </button>
        </template>
        <template #right-btn>
            <button
                @click="renameFile"
                :disabled="!checkIfValidFileName(fileName)"
                class="py-2.5 rounded-full w-full text-white bg-brand-primary disabled:bg-gray-200 disabled:text-gray-400"
            >
                {{ $t('fileman.buttons.confirm') }}
            </button>
        </template>
    </fileman-popup-layout>
</template>
<script>
export default {
    name: "RenameFilePopup",
    inject: ["bus"],
    data() {
        return {
            isVisible: false,
            fileName: null,
            url: null,
        };
    },
    created() {
        this.bus.$on("renameFile", (data) => {
            this.fileName = data.name;
            this.url = data.actions.update.url;
            this.showPopup();
        });

    },
    methods: {
        closePopup() {
            this.isVisible = false;
        },
        renameFile() {
            axios.put(this.url, {
                name: this.fileName,
            }).then(response => {
                this.closePopup();
                if(response.data.data.redirect != null){

                    window.location.href = response.data.data.redirect;
                }else{
                    location.reload();
                }
            }).catch(error => {
                alert(error.response.data.message)
            });
        },
        showPopup() {
            this.isVisible = true;
        },
        checkIfValidFileName(fileName){
            return fileName != null && fileName.trim().length > 0;
        }
    }
}
</script>

