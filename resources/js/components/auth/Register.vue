<template>
    <div class="container" style="height:100vh">
        <div class="row d-flex justify-content-center h-100 align-items-center p-2">
          <div class="col-md-6">
            <div class="card border-top border-bottom">
              <div class="card-header ">
                <h2 class="title text-center">Daftar</h2>
              </div>
              <div class="card-body p-4">
                <form @submit.prevent="daftar" method="post">
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Name" v-model="name">
                          </div>
                        </div>
                    </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" v-model="email">
                      </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" placeholder="Password" v-model="password">
                        </div>
                      </div>
                </div>
                <div class="card-footer float-right">
                    <button type="submit" class="btn btn-fill btn-primary">Daftar</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
        </div>

</template>
<script setup>

import {  ref,  } from 'vue';
import axios from 'axios';

const name=ref([]);
const email=ref([]);
const password=ref([]);

const daftar=async()=>{
    console.log(name.value);console.log(email.value);console.log(password.value);
    // const name=name.value;
    // let email=email.value;
    // let password=password.value;

    await axios.post('/register',{
        'name':name.value,
        'email':email.value,
        'password':password.value
    })
    .then((res)=>{
        console.log(res.data.user);
        alert('registrasi berhasil');
        name.value='';
        email.value='';
        password.value='';
    })
    .catch((err)=>{
        console.log(err);
    })
}



</script>


