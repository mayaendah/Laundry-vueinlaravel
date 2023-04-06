import { createRouter, createWebHistory, useRouter } from "vue-router";

const userouter=useRouter()

import Login from '@/components/auth/Login.vue';
import Register from '@/components/auth/Register.vue';


import Home from "@/components/dashboard/Home.vue";
import Dashboard from "@/components/dashboard/Dashboard.vue";
import Outlet from "@/components/dashboard/Outlet.vue";
import Pengguna from "@/components/dashboard/Pengguna.vue";
import Product from "@/components/dashboard/Product.vue";
import Laporan from "@/components/dashboard/Laporan.vue";
import PesananBerhasil from "@/components/dashboard/PesananBerhasil.vue";
import Transaksi from "@/components/dashboard/Transaksi.vue";
import DetailPesanan from "@/components/cart/DetailPesanan.vue";
import Keranjang from "@/components/cart/Keranjang.vue";



const routes = [
    {
        path:'/home',
        name:'home',
        component:Home,
        children:[

            {
                path: "/home",
                name: "dashboard",
                component: Dashboard,
                meta: {
                    requiresAuth: true
                  },
            },
            {
                path: "/outlet",
                name: "outlet",
                component: Outlet,
                meta: {
                    requiresAuth: true
                  },
            },
            {
                path: "/pengguna",
                name: "pengguna",
                component: Pengguna,
                meta: {
                    requiresAuth: true
                  },
            },
            {
                path: "/product",
                name: "product",
                component: Product,
                meta: {
                    requiresAuth: true
                  },
            },
            {
                path: "/transaksi",
                name: "transaksi",
                component: Transaksi,
                meta: {
                    requiresAuth: true
                  },
            },
            {
                path: "/laporan",
                name: "laporan",
                component: Laporan,
                meta: {
                    requiresAuth: true
                  },
            },
            {
                path: "/detailpesanan/:id",
                name: "detailpesanan",
                component: DetailPesanan,
                meta: {
                    requiresAuth: true
                  },
            },
            {
                path: "/keranjang",
                name: "keranjang",
                component: Keranjang,
                meta: {
                    requiresAuth: true
                  },
            },
            {
                path: "/pesanansuccess",
                name: "pesanansuccess",
                component: PesananBerhasil,
                meta: {
                    requiresAuth: true
                  },
            },

        ]

    },
    {
        path:'/',
        name:'login',
        component :Login,

    },
    {
        path:'/register',
        name:'register',
        component :Register,

    },

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});
router.beforeEach((to,from,next)=>{
    let currentUser=JSON.parse(localStorage.getItem('role'));
    // console.log(currentUser);
    let token = localStorage.getItem('token') != null;

    if(to.name==='login' && token){
        next({path:'/home'})

    }else if(to.name==='register' && token){
        next({path:'/home'})
    }
    else if(to.matched.some(record=>record.meta.requiresAuth)){
        if(!token){
            next({
                path:'/',
                query:{redirect:to.fullPath}
            })

        }else if(to.name==='outlet' && currentUser==='kasir'){
            next({name:'home'})
        }else if(to.name==='product' && currentUser==='kasir'){
            next({name:'home'})
        }else if(to.name==='pengguna' && currentUser==='kasir'){
            next({name:'home'})
        }
        else if(to.name==='outlet' && currentUser==='owner'){
            next({name:'home'})
        }else if(to.name==='product' && currentUser==='owner'){
            next({name:'home'})
        }else if(to.name==='pengguna' && currentUser==='owner'){
            next({name:'home'})
        }
        next()
    }else{
        next()
    }
})

export default router;
