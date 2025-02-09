<template>
    <fileman-popup-layout
        :is-visible="isVisible"
        @close="closePopup"
    >
        <template #title>
            {{$t('fileman.words.rename_folder')}}
        </template>
        <template #subtitle>
            {{$t('fileman.words.rename_folder_subtitle')}}
        </template>
        <template #content>
            <div class="mt-4">
                <input
                    v-model="name"
                    type="text"
                    class="w-full border border-gray-300 rounded-md p-2"
                    :placeholder="$t('fileman.words.rename_folder_placeholder')"
                >
            </div>
        </template>
        <template #left-btn>
            <button
                @click="closePopup"
                class="bg-gray-300 text-gray-700 rounded-md px-4 py-2"
            >
                {{ $t('fileman.buttons.cancel') }}
            </button>
        </template>
        <template #right-btn>
            <button
                @click="renameFile"
                :disabled="!checkIfValidFileName(name)"
                class="bg-brand-primary text-white rounded-md px-4 py-2"
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
            name: null,
            url: null,
        };
    },
    created() {
        this.bus.$on("renameFolder", (data) => {
            console.log(data);
            this.name = data.name;
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
                name: this.name,
            }).then(response => {
                console.log(response);
                this.closePopup();
                if(response.data.data.redirect != null){
                    console.log(response.data.data.redirect);
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

