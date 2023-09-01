import { createRouter,createWebHistory } from "vue-router";
import invoiceIndex from '@/components/invoices/index.vue';
import NewInvoice from '@/components/invoices/new.vue';
import notFound from '@/components/notFound.vue';
const routes =[
    {
        path: '/vue/index',
        component:invoiceIndex
    },
    {
        path: '/invoice/new',
        component:NewInvoice
    },
    {
        path: '/:pathMatch(.*)*',
        component:notFound
    },
]
const router=createRouter({
    history: createWebHistory(),
    routes,
})
export default router
