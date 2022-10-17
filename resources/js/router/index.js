import {createRouter, createWebHistory} from "vue-router";

import PartnersIndex from '../components/partners/PartnersIndex.vue'

const routes = [
    {
        path: '/',
        name: 'partners.index',
        component: PartnersIndex
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
