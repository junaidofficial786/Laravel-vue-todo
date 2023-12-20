<style>
.todoListContainer {
    width: 350px;
    margin: auto;
}
.heading {
    background: #e6e6e6;
    padding: 10px;
}
#title {
    text-align: center;
}
</style>


<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Todo List</h2>
            <add-item-form
                v-on:reloadList="getItems()"></add-item-form>
        </div>
        <list-view :items="items"
                   v-on:reloadList="getItems()"
        ></list-view>
    </div>
</template>

<script>
    import addItemForm from './addItemForm.vue';
    import listView from './listView.vue';

    export default  {
        components: {
            addItemForm,
            listView
        },
        data: function () {
            return {
                items: []
            }
        },
        methods: {
            getItems() {
                axios.get('/api/items').then(response => {
                    this.items = response.data;
                })
            },
        },
        created() {
            this.getItems();
        }
    }
</script>
