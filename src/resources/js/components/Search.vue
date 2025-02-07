<template>
    <div class="relative w-full h-10 flex flex-row py-2 px-3 gap-2 border border-gray-300 rounded-lg hover:border hover:border-brand-300 hover:shadow-brand-primary/200">
        <search-lg class="w-5 h-5"/>
        <input class="flex-1 outline-none" v-model="keyword"
               @keydown.down.prevent="navigateDown"
               @keydown.up.prevent="navigateUp"
               @keydown.enter.prevent="selectItem()"
        >
        <ul class="absolute w-full bg-white border left-0 border-gray-300 rounded-lg z-10 top-10 max-h-[21rem] overflow-y-auto" v-if="Object.keys(resultList).length > 0">
            <li v-for="(result, index) in resultList" :key="index" :class="{ 'bg-gray-200': activeIndex === index }
"  class="p-2 hover:bg-gray-100 cursor-pointer"  @click="selectItem(index)">
                <div class="w-full flex flex-row items-center">
                    <file v-if="result.type === 'File'" class="w-5 h-5 stroke-gray-500">
                    </file>
                    <folder v-else class="w-5 h-5 stroke-gray-500">
                    </folder>
                    <div class="flex-1 ml-2">
                        <div class="text-sm text-gray-800">{{ result.name }}</div>
                        <div class="text-xs text-gray-500">{{ result.path }}</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
import SearchLg from "@fileman/src/resources/assets/img/svg/search-lg.svg" ;
import debounce from "lodash/debounce";
import File from "@fileman/src/resources/assets/img/svg/file-05.svg";
import Folder from "@fileman/src/resources/assets/img/svg/folder.svg";

export default {
    name: "Search",
    components: { SearchLg, File, Folder },
    props: {
        searchUrl: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            keyword: "",
            resultList: {},
            activeIndex: 0,
        }
    },
    watch: {
        keyword: "debouncedSearch"
    },
    methods: {
        search() {
            if(this.keyword.length < 3) {
                return;
            }
            axios.get(this.searchUrl, {
                params: {
                    keyword: this.keyword
                }
            }).then(response => {
                this.resultList = response.data.data;
            }).catch(error => {
            });
        },
        debouncedSearch: debounce(function() {
            this.search();
        }, 500),
        navigateDown() {
            if (this.activeIndex < this.resultList.length - 1) {
                this.activeIndex++;
            }
            this.scrollToActiveItem();
        },
        navigateUp() {
            if (this.activeIndex > 0) {
                this.activeIndex--;
            }
            this.scrollToActiveItem();
        },
        scrollToActiveItem() {
            this.$nextTick(() => {
                const activeItem = this.$el.querySelector('.bg-gray-200');
                if (activeItem) {
                    activeItem.scrollIntoView({
                        block: 'nearest',
                    });
                }
            });
        },
        selectItem(index = null) {
            if (index !== null) {
                this.activeIndex = index;
            }
            this.result = this.resultList[this.activeIndex];
            this.resultList = {}; // Hide the list after selection
            this.activeIndex = -1;
            location.assign(this.result.url);
        },
    }
}
</script>
