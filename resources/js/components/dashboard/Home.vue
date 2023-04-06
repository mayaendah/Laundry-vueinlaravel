<template>
    <div class="wrapper">
        <!-- sidebar -->
        <SideBar/>
        <!-- end sidebar -->

        <div class="main-panel">
          <!-- Navbar -->
          <NavBar/>
          <!-- end Navbar -->


          <!-- router view -->
          <router-view/>
          <!-- end router view -->

          <!-- footer -->
          <Footer/>
          <!-- end footer -->
        </div>
      </div>


</template>

<script setup>
import SideBar from '@/components/SideBar.vue';
import NavBar from '@/components/NavBar.vue';
import Footer from '@/components/Footer.vue';



</script>
