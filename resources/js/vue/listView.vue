<script>

import {defineComponent} from "vue";
import ListItem from "@/vue/listItem.vue";

export default defineComponent({
    components: {ListItem},
    props: ['items'],
})
</script>

<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <list-item :item="item" class="item" v-on:itemChanged="$emit('reloadList')">

            </list-item>
        </div>
    </div>
</template>

<style scoped>
.item {
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>
