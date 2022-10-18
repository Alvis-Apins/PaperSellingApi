import {createRouter, createWebHistory} from "vue-router";

import PartnersIndex from '../components/partners/PartnersIndex.vue'
import PartnersCreate from '../components/partners/PartnersCreate.vue'
import PartnersEdit from '../components/partners/PartnersEdit.vue'

const routes = [
    {
        path: '/',
        name: 'partners.index',
        component: PartnersIndex
    },
    {
        path: '/partners/create',
        name: 'partners.create',
        component: PartnersCreate
    },
    {
        path: '/partners/:id/edit',
        name: 'partners.edit',
        component: PartnersEdit,
        props: true
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
