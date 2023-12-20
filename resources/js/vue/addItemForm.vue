<script>
export default {
    data: function () {
        return {
            item: {
                name: ''
            }
        }
    },
    methods: {
        addItem() {
            if (!this.item.name.length) alert('Field is empty')
            axios.post('/api/item/store', {name: this.item.name}).then(response => {
                if(response.status==201)
                {
                    this.item.name = ""
                    this.$emit('reloadList');
                }
            }).catch(error=>{console.log(error)})
        }
    }
}
</script>

<template>
    <div class="addItem">
        <input type="text" placeholder="Enter a todo" v-model="item.name">
        <font-awesome-icon icon="plus-square" @click="addItem()" :class="[item.name.length ? 'active' : 'inactive', 'plus']" />
    </div>
</template>

<style scoped>
.addItem {
    display: flex;
    justify-content: center;
}
input {
    background: #f7f7f7;
    border: 0px;
    outline: none;
    padding: 5px;margin-right: 10px;
    width: 100px;
}
.plus {
    font-size: 20px;
}
.active {
    color: #00ce25;
}
.inactive{
    color: #999999;
}
</style>
