<template>
    <fileman-popup-layout
        :is-visible="isVisible"
        @close="closePopup"
    >
        <template v-slot:title>
            {{ $t('fileman.words.add_folder') }}
        </template>
        <template v-slot:subtitle>
            {{ $t('fileman.words.folder_name') }}
        </template>
        <template v-slot:content>
            <input
                type="text"
                v-model="folderName"
                class="w-full border border-gray-300 rounded-md h-10 px-2 mt-2"
            />
        </template>
        <template v-slot:left-btn>
            <button @click="closePopup" class="py-2.5 w-full border border-gray-300 rounded-full">
                {{ $t('fileman.buttons.cancel') }}
            </button>
        </template>
        <template v-slot:right-btn>
            <button @click="addFolder" :disabled="!checkIfValidFolderName(folderName)" class="py-2.5 rounded-full w-full text-white bg-brand-primary disabled:bg-gray-200 disabled:text-gray-400">
                {{ $t('fileman.buttons.confirm') }}
            </button>
        </template>
    </fileman-popup-layout>
</template>

<script>
export default {
    name: "AddFolderPopup",
    inject: ["bus"],
    data() {
        return {
            folderName: '',
            isVisible: false,
            url: null,
        }
    },
    created() {
        this.bus.$on("createFolder", (data) => {
            this.folderName = "";
            this.url = data.actions.create.url;
            this.showPopup();
        });
    },
    methods: {
        addFolder() {
            axios.post(this.url, {
                name: this.folderName,
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
        closePopup() {
            this.folderName = '';
            this.isVisible = false;
        },
        checkIfValidFolderName(folderName){
            return folderName != null && folderName.trim().length > 0;
        }
    }
}
</script>


