<template>
    <div>
        <div class="w-full flex gap-2 text-sm font-semibold py-2 justify-between pr-9 pl-2 " :class="{'bg-gray-200 rounded-md':(directoryList.id === folder)}">
            <div class="flex gap-2 w-full" >
                <Folder class="w-5 h-5 stroke-gray-500" v-if="directoryList.childrenCount <= 0 " />
                <template v-else>
                    <ChevronRight class="w-5 h-5 rotate-90 stroke-gray-500" v-if="directoryList.open" @click="toggleFolderDisplay(directoryList)" />
                    <ChevronRight class="w-5 h-5 stroke-gray-500" v-else @click="toggleFolderDisplay(directoryList)" />
                </template>
                <a :href="directoryList.url" class="w-[calc(100%-2rem)]">{{ directoryList.name }}</a>

            </div>
            <div class="text-xs font-medium border border-gray-300 rounded-md h-5 leading-5 px-1.5">
                {{ directoryList.count }}
            </div>
        </div>
        <ul v-if="directoryList.open">
            <li v-for="subDirectory in directoryList.children">
                <DirectoryList :directory="subDirectory" :folder="folder"/>
            </li>
        </ul>
    </div>
</template>
<script>

import ChevronRight from "../../assets/img/svg/chevron-right.svg";
import Folder from "../../assets/img/svg/folder.svg";

export default {
    name: "DirectoryList",
    components: {ChevronRight, Folder},
    props: {
        directory: {
            type: Array,
            required: true,
        },
        folder: {
            type: String,
            required: false,
        }
    },
    data() {
        return {
            directoryList: {}
        };
    },
    mounted() {
        this.directoryList = this.directory;
    },
    methods: {
        toggleFolderDisplay(directoryList, open = null) {
            if(open !== null) {
                directoryList.open = open;
            }else{
                directoryList.open = !directoryList.open;
            }
            if(!directoryList.open && directoryList.children.length > 0) {
                for(let i = 0; i < directoryList.children.length; i++) {
                    this.toggleFolderDisplay(directoryList.children[i], false);
                }
            }
        },

    },
}
</script>
