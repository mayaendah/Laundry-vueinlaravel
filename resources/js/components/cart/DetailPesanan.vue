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
                    <div class="card-body all-icons">
                        <div class="font-icon-detail">
                            <div class="row">
                                <div class="col-sm-4 mb-4">
                                    <img
                                        :src="`http://localhost:8000/storage/${getPaketById.gbr_paket}`"
                                        width="200"
                                        height="200"
                                        style="margin-left: 20px"
                                    />
                                </div>
                                <div class="col-sm-8">
                                    <form
                                        @submit.prevent="simpanKeranjang"
                                        method="post"
                                    >
                                        <div
                                            class="form-group"
                                            style="
                                                text-align: left;
                                                margin-right: 25px;
                                                margin-left: 25px;
                                            "
                                        >
                                            <label><h5>Nama Paket</h5></label
                                            ><br />
                                            {{ getPaketById.nama_paket }}
                                        </div>
                                        <div
                                            class="form-group"
                                            style="
                                                text-align: left;
                                                margin-right: 25px;
                                                margin-left: 25px;
                                            "
                                        >
                                            <label><h5>Harga Paket</h5></label
                                            ><br />
                                            {{ getPaketById.harga_paket }}
                                        </div>

                                        <div
                                            class="form-group"
                                            style="
                                                text-align: left;
                                                margin-right: 25px;
                                                margin-left: 25px;
                                            "
                                        >
                                            <label><h5>Berat</h5></label>
                                            <input
                                                type="number"
                                                class="form-control mt-2"
                                                placeholder="Berat "
                                                v-model="beratPaket"
                                            />
                                        </div>

                                        <div
                                            class="form-group"
                                            style="
                                                text-align: left;
                                                margin-right: 25px;
                                                margin-left: 25px;
                                            "
                                        >
                                            <label><h5>Keterangan</h5></label>

                                            <textarea class="form-control mb-4" id="exampleFormControlTextarea1" placeholder="Keterangan" v-model="ketPaket"></textarea>
                                            <!-- <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Keterangan "
                                            v-model="ketPaket"
                                        /> -->

                                            <div class="footer float-right">
                                                <button
                                                    type="submit"
                                                    class="btn btn-fill btn-primary btn-md"
                                                >
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- {{ getPaketById }} -->
                            <!-- <Keranjang @heroes="heroes"/> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import Keranjang from "@/components/cart/Keranjang.vue";
import { ref, onMounted,computed } from "vue";
import { useRoute } from "vue-router";

const getPaketById = ref({});
const beratPaket = ref([]);
const ketPaket = ref([]);
// const randcode=ref([]);
const rd=ref(0);
const route = useRoute();

function heroes(hero){
    rd.value= rd.value+hero
            alert(`calling ${rd.value}`)

}


onMounted(() => {
    axios
    .get(`/detailtransaksi/${route.params.id}`)
    .then((response) => {
        console.log(response);
        getPaketById.value = response.data.data;

    });
});



const simpanKeranjang = async () => {

    await axios
        .post("/simpantransaksi", {
            berat_paket: beratPaket.value,
            ket_paket: ketPaket.value,
            paket: getPaketById.value.id,
        })
        .then((res) => {
            console.log(res.data.data);
            alert("Simpan data keranjang berhasil");
        })
        .catch((error) => {
            console.log(error);
        });
};
</script>
