import {createRouter, createWebHistory} from "vue-router";

import HomeIndex from '../components/main/HomeIndex.vue'
import PartnersIndex from '../components/partners/PartnersIndex.vue'
import PartnersCreate from '../components/partners/PartnersCreate.vue'
import PartnersEdit from '../components/partners/PartnersEdit.vue'
import SalesIndex from '../components/sales/SalesIndex.vue'
import SalesCreate from '../components/sales/SalesCreate.vue'


const routes = [
    {
        path: '/',
        name: 'home.index',
        component: HomeIndex
    },
    {
        path: '/partners',
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
    },
    {
        path: '/sales',
        name: 'sales.index',
        component: SalesIndex
    },
    {
        path: '/sales/create',
        name: 'sales.create',
        component: SalesCreate
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
})
