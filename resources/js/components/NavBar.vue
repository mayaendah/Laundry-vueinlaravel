<template>
    <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <!-- <a class="navbar-brand" ><img src="{{asset('/assets/img/laundry_icon.png')}}" alt="" width="10" height="10">icon</a> -->
            <a class="navbar-brand" ><img src="/assets/img/laundry_icon.png" alt="" width="40" height="40"></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              <li class="search-bar input-group">
                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split" ></i>
                  <span class="d-lg-none d-md-block">Search</span>
                </button>
              </li>

              <li class="search-bar input-group">
                <a :href="$router.resolve({name: 'keranjang'}).href" class="btn btn-link"> <i class="tim-icons icon-cart"></i>
                  <span class="d-lg-none d-md-block">Search</span>
                </a>
              </li>

              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo" >

                    <div class="class" v-if="imgAdmin">
                        <img src="/assets/img/anime3.png" alt="Profile Photo">
                    </div>

                    <div class="class" v-if="imgKasir">
                        <img src="/assets/img/anime6.png" alt="Profile Photo">
                    </div>

                    <div class="class" v-if="imgOwner">
                        <img src="/assets/img/12345.png" alt="Profile Photo">
                    </div>


                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Profile</a></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Settings</a></li>
                  <li class="dropdown-divider"></li>
                  <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item" @click="Logout">Log out</a></li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- modal nav -->
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- end modal nav -->
</template>

<script setup>

import { useRouter } from 'vue-router'
import {ref} from 'vue'

const userLogin=ref("")
const imgAdmin=ref(false)
const imgKasir=ref(false)
const imgOwner=ref(false)

userLogin.value=JSON.parse(localStorage.getItem('role'));
if(userLogin.value==='admin'){
    imgAdmin.value=true
}else if(userLogin.value==='kasir'){
    imgKasir.value=true
}else{
    imgOwner.value=true
}


const router = useRouter();
    const Logout = async() => {
        // await axios.post('/logout')
        // .then(()=>{
            // console.log('logout barhasil');
            localStorage.clear();
            router.push({ path: '/' });
        // })
        // .catch((error)=>{
        //     console.log(error);
        // })

    };

</script>

  <style>
  .tim-icons{
    position: absolute;
    left: 10px;
    top: 10px;
    z-index: -1;
  }
  .no{
    color: rgba(247, 7, 199, 0.904);
    position: absolute;
    left: 33px;
    font-weight: bold;
    font-size: smaller;
  }
  </style>
