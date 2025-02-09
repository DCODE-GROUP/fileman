<template>
    <fileman-popup-layout
        :is-visible="isVisible"
        @close="closePopup"
    >
        <template #title>
            {{$t('fileman.words.delete_file')}}
        </template>
        <template #subtitle>
            {{$t('fileman.words.delete_file_subtitle')}}
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
                @click="destroy"
                class="bg-error-600 text-white rounded-md px-4 py-2"
            >
                {{ $t('fileman.buttons.delete') }}
            </button>
        </template>
    </fileman-popup-layout>
</template>
<script>
export default {
    name: "DeleteFilePopup",
    inject: ["bus"],
    data() {
        return {
            isVisible: false,
            url: null,
        };
    },
    created() {
        this.bus.$on("deleteFile", (data) => {
            this.url = data.actions.delete.url;
            this.showPopup();
        });
    },
    methods: {
        closePopup() {
            this.isVisible = false;
        },
        showPopup() {
            this.isVisible = true;
        },
        destroy() {
            axios.delete(this.url)
                .then((response) => {
                    this.closePopup();
                    if(response.data.data.redirect != null){
                        window.location.href = response.data.data.redirect;
                    }else{
                        location.reload();
                    }
                })
                .catch((error) => {

                    console.log(error.data.message);
                });
        }
    },

}
</script>


