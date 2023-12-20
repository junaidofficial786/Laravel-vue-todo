import {createRouter, createWebHistory} from 'vue-router';
import addItemForm from './addItemForm.vue'
import listItem from './listItem.vue'

const routes = [
    { path: "/add-item", component: addItemForm },
    { path: "/list-item", component: listItem }
]

const router = createRouter({
    // 4. Provide the history implementation to use. We are using the  history for simplicity here.
    history: createWebHistory(),
    routes, // short for `routes: routes`
})
export default router;
