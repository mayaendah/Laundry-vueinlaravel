<template>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">100 Awesome Nucleo Icons</h5>
                        <p class="category">
                            Handcrafted by our friends from
                            <a href="https://nucleoapp.com/?ref=1712"
                                >NucleoApp</a
                            >
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div
                                class="col-lg-3 col-md-3 col-sm-4 col-xs-6 col-xs-6"
                                v-for="getPaket in getPakets"
                                :key="getPaket.id"
                            >
                                <div class="row mb-4">
                                    <div class="col">
                                        <img
                                            :src="`http://localhost:8000/storage/${getPaket.gbr_paket}`"
                                            width="100"
                                            height="100"
                                        />
                                    </div>
                                    <div class="col">
                                        <p style="font-size: 10pt">
                                            {{ getPaket.nama_paket }}<br />
                                            Harga : Rp. {{ getPaket.harga_paket
                                            }}<br />
                                            <router-link
                                                :to="{
                                                    name: 'detailpesanan',
                                                    params: { id: getPaket.id },
                                                }"
                                                class="btn btn-primary btn-sm"
                                                ><i class="bi bi-cart"></i>
                                                Pesan</router-link
                                            >
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";

const getPakets = ref({});

const tampilPaket = async () => {
    await axios
        .get("/tampiltransaksi")
        .then((res) => {
            // console.log(res.data.data);
            getPakets.value = res.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
};
onMounted(() => {
    tampilPaket();
});
</script>
