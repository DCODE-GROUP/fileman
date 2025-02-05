<template>
    <div>
        <Plus class="w-5 h-5" @click="showPopup"></Plus>
            <!--  pop up -->
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

    </div>
</template>

<script>
import Plus from "../../assets/img/svg/plus.svg";

export default {
    name: 'AddFolderPopup',
    components: {Plus},
    props: {
        folder: {
            type: Object,
            default: () => {
                return {
                    name: '',
                    id: null
                }
            }
        },
        createFolderUrl: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            folderName: '',
            id: this.folder.id,
            isVisible: false,
        }
    },
    methods: {
        addFolder() {
            axios.post(this.createFolderUrl, {
                name: this.folderName,
            }).then(response => {
                this.closePopup();
                // refresh the page
                location.reload();
            }).catch(error => {
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
