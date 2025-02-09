<template>
    <div class="file h-full bg-gray-50 hover:bg-gray-100 rounded-md relative group"
       :data-file="JSON.stringify(file)"
       :data-url="file.url"

    >
        <img :src="file.previewUrl" class="thumbnail !h-4/5 object-contain"  :alt="file.name" v-if="file.is_image" @click="showFileDetail">
        <div class="flex flex-col items-center justify-center h-full w-full relative" @click="showFileDetail" v-else>
            <div class="h-20 w-20 relative">
                <file-page class="h-20 w-16 ml-auto"></file-page>
                <div :style="{background:file.file_type_color.background,color:file.file_type_color.text}"
                     class="absolute text-center p-0.5 left top-8 min-w-12 rounded-md"
                >
                    {{file.file_extension}}
                </div>
            </div>
        </div>
        <div class="flex flex-row mt-2 p-2 items-center">
            <div class="text-sm font-normal flex-1 ">{{ file.name }}</div>
            <fileman-menu  :object="file" class="invisible group-hover:visible" ></fileman-menu>
        </div>



    </div>

</template>
<script>
import FilePage from "@fileman/src/resources/assets/img/svg/file-page.svg";

export default {
    name: "FileCell",
    components: {FilePage},
    inject: ["bus"],
    props: {
        file: {
            type: Object,
            required: true,
        },
    },
    methods: {
        showFileDetail() {
            this.bus.$emit("fileDetail", {
                file : this.file,
                url :  this.file.url,
            });
        }
    }
}
</script>


