<template>
    <div>
        <Plus class="w-5 h-5" @click="showAddFolderPopup"></Plus>
    </div>
</template>

<script>
import Plus from "../../assets/img/svg/plus.svg";

export default {
    name: 'AddFolder',
    components: {Plus},
    inject: ["bus"],
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
        showAddFolderPopup() {
            this.bus.$emit("createFolder", {
                name: this.folderName,
                actions:{
                    create: {
                        url: this.createFolderUrl
                    }
                }
            });
        }
    }
}
</script>
