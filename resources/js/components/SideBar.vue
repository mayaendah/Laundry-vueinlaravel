<template>
    <div class="sidebar">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
      -->
        <div class="sidebar-wrapper">
          <div class="logo">
            <a href="javascript:void(0)" class="simple-text logo-mini">
              CT
            </a>
            <a href="javascript:void(0)" class="simple-text logo-normal">
              Creative Tim
            </a>
          </div>
          <ul class="nav">
            <li>
              <router-link to="/" v-if="home">
                <i class="tim-icons icon-chart-pie-36"></i>
                <p>Dashboard</p>
              </router-link>
            </li>
            <li class=" ">
              <router-link to="/outlet" v-if="outlet">
                <i class="tim-icons icon-bank"></i>
                <p>Outlet</p>
              </router-link>
            </li>
            <li class=" ">
                <router-link to="/product" v-if="product">
                    <i class="tim-icons icon-molecule-40"></i>
                  <p>Product</p>
                </router-link>
              </li>
            <li>
              <router-link to="/pengguna" v-if="pengguna">
                <i class="tim-icons icon-single-02"></i>
                <p>Pengguna</p>
              </router-link>
            </li>
            <li>
              <router-link to="/laporan" v-if="laporan">
                <i class="tim-icons icon-paper"></i>
                <p>Laporan</p>
              </router-link>
            </li>
            <li>
              <router-link to="/transaksi" v-if="transaksi">
                <i class="tim-icons icon-money-coins"></i>
                <p>Transaksi</p>
              </router-link>
            </li>

          </ul>
        </div>
      </div>
</template>

<script setup>
import {ref} from 'vue'
import { useRouter } from 'vue-router'


const home=ref(true)
const outlet=ref(false)
const product=ref(false)
const pengguna=ref(false)
const transaksi=ref(false)
const laporan=ref(false)

let currentUser=JSON.parse(localStorage.getItem('role'));

if(currentUser==='owner'){
      laporan.value=true
    }else if(currentUser==='kasir'){
      transaksi.value=true;
      laporan.value=true;
    //   registrasi.value=true;
    }else if(currentUser==='admin'){
     outlet.value=true;
     product.value=true;
     pengguna.value=true;
     transaksi.value=true;
     laporan.value=true;
    }

</script>

<style scoped>

</style>
