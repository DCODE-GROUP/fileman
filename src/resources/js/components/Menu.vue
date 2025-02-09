<template>
    <div class="relative w-4 h-4">
        <DotsVertical @click.prevent="showMenu" v-click-away="hideMenu" class="w-5 h-5 stroke-gray-700"></DotsVertical>
        <div class="bg-white border border-gray-200 rounded-lg absolute z-10 p-1" v-if="isVisible">
            <fileman-menu-item :item="item" v-for="item in object.actions" :key="item.id" :object="object" :class="{'hidden':item.hidden}"></fileman-menu-item>
        </div>

    </div>
</template>

<script>
import DotsVertical from "@fileman/src/resources/assets/img/svg/dots-vertical.svg";
export default {
    name: "Menu",
    components: {DotsVertical},
    props: {
        object: {
            type: Object,
            required: false
        }
    },
    data() {
        return {
            isVisible: false
        }
    },
    methods: {
        showMenu() {
            this.isVisible = true;
        },
        hideMenu() {
            this.isVisible = false;
        }
    }
}
</script>


