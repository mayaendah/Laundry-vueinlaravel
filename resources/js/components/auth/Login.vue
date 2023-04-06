<template>
  <div class="container" style="height: 100vh">
    <div class="row d-flex justify-content-center h-100 align-items-center p-2">
      <div class="col-lg-4 col-md-8 col-sm-8">
        <div class="card border-top border-bottom">
          <div class="card-header">
            <center><h2 class="">Login</h2></center>
          </div>
          <div class="card-body p-4">
            <form @submit.prevent="login">
              <div class="row">
                <div class="col-md-12 mb-2">
                  <div class="form-group">
                    <label>Email</label>
                    <input
                      type="email"
                      class="form-control"
                      placeholder="Email"
                      v-model="email"
                    />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Password</label>
                    <input
                      type="password"
                      class="form-control"
                      placeholder="Password"
                      v-model="password"
                    />
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <center>
                  <button type="submit" class="btn btn-fill btn-primary">
                    Login</button
                  ><br /><br />
                  Belum Punya akun ?
                  <router-link to="/register">Daftar</router-link>
                </center>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";

const email = ref([]);
const password = ref([]);
const router = useRouter();

const login = async () => {
//   console.log(email.value);
//   console.log(password.value);

const formData=new FormData();
formData.append('email',email.value);
formData.append('password',password.value);

  await axios
    .post("/login",formData)
    .then((res) => {
      console.log(res.data.user);
      console.log(res.data.authorisation.token);
      if (res.data.status === "success") {
        email.value = "";
        password.value = "";

        localStorage.setItem("token", res.data.authorisation.token);
        localStorage.setItem("role", JSON.stringify(res.data.user.role));
        localStorage.setItem("user", JSON.stringify(res.data.user));

        let loginRole=res.data.user.role;

        // console.log(loginRole);

        // if(loginRole==='kasir'){
        //     router.push({path :'/dashboard'})
        // }else if(loginRole==='kasir'){

        // }

        router
        .push({path:'/home'})
        .then(() => {  window.location.reload() })
      }
    //   alert('Login berhasil');
    })
    .catch((err) => {
      console.log(err);
    });
};
</script>
