<template>
<div class="flex flex-row items-center gap-2 min-w-36 p-2.5 hover:bg-gray-50 rounded-lg" @click="click">
    <component :is="item.icon" class="w-4 h-4 stroke-gray-500 " />
    <div class="text-sm font-medium text-gray-700">
        {{item.label}}
    </div>
</div>
</template>

<script>

import Pencil from "@fileman/src/resources/assets/img/svg/pencil-01.svg";
import Trash from "@fileman/src/resources/assets/img/svg/trash-01.svg";
import Plus from "@fileman/src/resources/assets/img/svg/plus.svg";
export default {
    name: "MenuItem",
    components: {Pencil, Trash, Plus},
    inject: ["bus"],
    props: {
        item: {
            type: Object,
            required: true
        },
        object: {
            type: Object,
            required: false
        }
    },
    methods: {
        click() {
            this.bus.$emit(this.item.action, this.object);
        }
    }
}
</script>


