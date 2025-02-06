<template>
    <div class="file h-full bg-gray-50 hover:bg-gray-100 rounded-md"
       :data-file="JSON.stringify(file)"
       :data-url="url"
         @click="showFileDetail"
    >
        <template v-if="file.is_image">
            <div class="thumbnail !h-4/5" :style="getThumbnailStyle()"></div>
        </template>
        <template v-else>

        </template>

        <span class="text-sm font-normal mt-2">{{ file.name }}</span>
    </div>

</template>
<script>
export default {
    name: "FileCell",
    inject: ["bus"],
    props: {
        file: {
            type: Object,
            required: true,
        },
        url:{
            type: String,
            required: true,
        },
        previewUrl:{
            type: String,
            required: true,
        },

    },
    methods: {
        getThumbnailStyle() {
            return {
                backgroundImage: `url(${this.previewUrl})`,
            };
        },
        showFileDetail() {
            this.bus.$emit("fileDetail", {
                file : this.file,
                url : this.url,
            });
        }
    }
}
</script>


