<template>
    <div v-if="showModal" class="w-[34rem] pt-5 px-6 border-l border-gray-200 h-screen">
        <div class="flex flex-row">
            <div class="text-gray-900 text-md font-semibold flex-1 gap-3">
                {{$t("fileman.headings.preview")}}
            </div>
            <x-close class="w-6 h-6 path--stroke-gray-400 cursor-pointer" @click="closePopup"></x-close>
        </div>

        <section class="mt-3 w-full flex items-center justify-center">
            <div class=" border-gray-200 border rounded-2xl w-[32rem] h-[25rem]" @click="downloadUrl">
                <img :src="url" alt="file" class="w-full h-full rounded-2xl object-contain " v-if="file.is_image"/>
                <div class="flex flex-col items-center justify-center h-full w-full relative" v-else>
                    <div class="h-20 w-20 relative">
                        <file-page class="h-20 w-16 ml-auto"></file-page>
                        <div :style="{background:file.file_type_color.background,color:file.file_type_color.text}"
                             class="absolute text-center p-0.5 left top-8 min-w-12 rounded-md"
                        >
                            {{file.file_extension}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="flex flex-col mt-6 ">
            <!--   name         -->
            <div class="flex flex-row text-lg font-semibold gap-2 justify-start items-center  cursor-pointer h-11 w-full" @click="renameFile">

                <p class="break-all">{{file.name}}</p>
                <pencil class="w-5 h-5 stroke-gray-700" ></pencil>
            </div>

            <div class="flex flex-row text-sm font-normal text-gray-600 gap-2 justify-start items-center mt-4">
                <span class="text-sm font-normal text-gray-900 min-w-24">{{$t("fileman.fields.url")}}</span>
                <span class="flex-1 break-all ">{{url}}</span>
                <copy class="w-5 h-5 stroke-gray-700 cursor-pointer min-w-5" @click="copy"></copy>
            </div>
            <!-- File Type -->
            <div class="flex flex-row text-sm font-normal text-gray-600 gap-2 justify-start items-center mt-4">
                <span class="text-sm font-normal text-gray-900 w-24">{{$t("fileman.fields.file_type")}}</span>
                <span class="flex-1 ">{{file.type}}</span>
            </div>

            <!-- File Size -->
            <div class="flex flex-row text-sm font-normal text-gray-600 gap-2 justify-start items-center mt-4">
                <span class="text-sm font-normal text-gray-900 w-24">{{$t("fileman.fields.file_size")}}</span>
                <span class="flex-1">{{formatBytes(file.size) }}</span>
            </div>
        </section>
    </div>
</template>
<script>
import XClose from "@fileman/src/resources/assets/img/svg/x-close.svg";
import FilePage from "@fileman/src/resources/assets/img/svg/file-page.svg";
import Pencil from "@fileman/src/resources/assets/img/svg/pencil-01.svg";
import Copy from "@fileman/src/resources/assets/img/svg/copy-05.svg";

export default {
    name: "FileDetail",
    components: {
        XClose,
        FilePage,
        Pencil,
        Copy,
    },
    inject: ["bus"],
    data() {
        return {
            showModal: false,
            file: {},
            url: "",
        };
    },
    created() {
        this.bus.$on("fileDetail", (data) => {
            console.log(data);
            this.file = data.file;
            this.url = data.url;
            this.showModal = true;
        });
    },
    methods: {
        closePopup() {
            this.showModal = false;
        },
        downloadUrl() {
            window.open(this.replaceHttpWithHttps(this.url), "_blank");
        },
        replaceHttpWithHttps(url) {
            return url.replace("http://", "https://");
        },
        copy() {
            navigator.clipboard.writeText(this.url)
        },
        renameFile() {
            console.log("rename file");
            this.bus.$emit("renameFile", this.file);
        },
        formatBytes(bytes, decimals = 2) {
            if (bytes === 0) return "0 Bytes";
            const k = 1024;
            const dm = decimals < 0 ? 0 : decimals;
            const sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i];
        },
    },

}
</script>
