<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import axios from "axios";

export default {
    data: function () {
        return {
            completedTask: this.item.completed == 1,
            editing: false, // Add an 'editing' flag to track whether editing is enabled
            editedItemName: this.item.name, // Add a variable to store the edited item name
        };
    },

    methods: {
        updateCheck() {
            axios
                .put("/api/item/" + this.item.id, {
                    item: { ...this.item, completed: this.completedTask == 1 },
                })
                .then((response) => {
                    if (response.status == 200) this.$emit("itemChanged");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        trashCan() {
            axios
                .delete("/api/item/" + this.item.id)
                .then((response) => {
                    this.$emit("itemChanged");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        editItem() {
            // Toggle the 'editing' flag on clicking the Edit button
            this.editing = !this.editing;
        },
        saveEdit() {
            // Save the edited item name and toggle off editing mode
            this.item.name = this.editedItemName;
            this.editing = false;

            // Make the API call to update the item name
            axios
                .post("/api/item/update-name/" + this.item.id, {
                    item: { ...this.item, name: this.editedItemName },
                })
                .then((response) => {
                    if (response.status == 200) this.$emit("itemChanged");
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        console.log(this.item);
    },

    components: { FontAwesomeIcon },
    props: ["item"],
};
</script>

<template>
    <div class="item">
        <input type="checkbox" v-if="!editing" @change="updateCheck()" v-model="completedTask" />
        <!-- Use a conditional rendering to display either a span or an input field based on 'editing' flag -->
        <span v-if="!editing" :class="[item.completed ? 'completed' : '', 'itemText']">{{ item.name }}</span>
        <input v-if="editing" v-model="editedItemName"/>
        <button @click="trashCan()" v-if="!editing" class="trashcan">
            <font-awesome-icon icon="trash"></font-awesome-icon>
        </button>
        <button @click="editItem()" class="editButton">
            {{ editing ? 'Cancel' : 'Edit' }} <!-- Change the button label based on 'editing' flag -->
        </button>
        <button v-if="editing" @click="saveEdit()"> Save </button>
    </div>
</template>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999999;
}
.itemText {
    width: 100%;
    margin-left: 20px;
}
.item {
    display: flex;
    justify-content: center;
    align-items: center;
}
.trashcan {
    background: #e6e6e6;
    border: none;
    color: red;
    outline: none;
}
</style>
