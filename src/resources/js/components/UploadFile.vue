<template>
    <div>
        <!-- Drag-and-Drop Upload Area -->
        <div
            class="flex flex-col items-center justify-center h-full border border-gray-200 rounded-lg px-6 py-4 aspect-square"
            @dragover.prevent="onDragOver"
            @dragleave.prevent="onDragLeave"
            @drop.prevent="onDrop"
            :class="{ 'drop-active': isActive }"
            @click="$refs.fileInput.click()"
        >
            <div v-if="!file" class="flex flex-col items-center justify-center text-center">
                <div class="w-10 h-10 flex items-center justify-center border border-gray-200 rounded-lg">
                    <UploadCloud class="w-5 h-5 stroke-gray-600 " ></UploadCloud>
                </div>
                <p class="mt-3 text-sm font-normal text-gray-600" v-html="$t('fileman.words.click_to_upload')"></p>
                <p class="text-xs font-normal text-gray-600">
                    {{ $t('fileman.words.format') }}
                </p>

            </div>
            <div v-else class="mt-auto">
                <p class="break-all">File Selected: {{ file.name }}</p>
                <p>File Size : {{formatBytes(file.size)}} </p>

            </div>
            <input
                type="file"
                ref="fileInput"
                class="hidden"
                @change="onFileSelect"
            />
            <div v-if="progress > 0" class="w-full flex flex-row gap-3 h-2  items-center">
                <div class="bg-gray-200 h-full flex-1">
                    <div
                        class="progress-bar bg-brand-600 h-full w-0 rounded-md text-center text-white transition-all duration-200 ease-in"
                        :style="{ width: `${progress}%` }"
                    ></div>
                </div>
                <p>{{ Math.round(progress) }}%</p>
            </div>
        </div>
        <!-- Progress Bar -->


        <!-- Submit Button -->
        <button
            @click="uploadFile"
            :disabled="!file || uploading"
            class="hidden"
        >
            {{ uploading ? "Uploading..." : "Upload File" }}
        </button>
    </div>
</template>

<script>
import UploadCloud from "../../assets/img/svg/upload-cloud-02.svg";
export default {
    name: "UploadFile",
    components: { UploadCloud },
    props:{
        uploadUrl: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            file: null, // Selected file for upload
            isActive: false, // Drag hover status
            progress: 0, // Upload progress percentage
            uploading: false, // Uploading status
        };
    },
    methods: {
        onDragOver() {
            this.isActive = true;
        },
        onDragLeave() {
            this.isActive = false;
        },
        onDrop(event) {
            this.isActive = false;
            const files = event.dataTransfer.files;
            if (files.length > 0) {
                this.file = files[0];
            }
            this.uploadFile();
        },
        onFileSelect(event) {
            const files = event.target.files;
            if (files.length > 0) {
                this.file = files[0];
            }
            this.uploadFile();
        },
        async uploadFile() {
            if (!this.file) return;

            const formData = new FormData();
            formData.append("file", this.file);

            this.uploading = true;
            this.progress = 0;

            try {
                // Use axios to track progress
                const response = await axios.post(this.uploadUrl, formData, {
                    headers: { "Content-Type": "multipart/form-data" },
                    onUploadProgress: (progressEvent) => {
                        const total = progressEvent.total || 1; // Avoid division by 0
                        this.progress = (progressEvent.loaded / total) * 100;
                    },
                });

                if (response.status === 200) {
                    location.reload()
                    this.file = null; // Reset file
                } else {
                    alert("Failed to upload the file.");
                }
            } catch (error) {
                alert("Failed to upload the file.");
            } finally {
                this.uploading = false;
                this.progress = 0; // Reset progress
            }
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
};
</script>
