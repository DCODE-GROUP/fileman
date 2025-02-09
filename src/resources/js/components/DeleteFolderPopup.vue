<template>
    <fileman-popup-layout
        :is-visible="isVisible"
        @close="closePopup"
    >
        <template #title>
            {{$t('fileman.words.delete_folder')}}
        </template>
        <template #subtitle>
            {{$t('fileman.words.delete_folder_subtitle')}}
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
                @click="destroy"
                class="py-2.5 rounded-full w-full text-white bg-error-600 disabled:bg-gray-200 disabled:text-gray-400"
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
        this.bus.$on("deleteFolder", (data) => {
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
                        console.log(response.data.data.redirect);
                        window.location.href = response.data.data.redirect;
                    }else{
                        location.reload();
                    }
                })
                .catch((error) => {
                    alert(error.response.data.message);
                });
        }
    },

}
</script>


