<template>
    <div class="content">
        <div class="row">
            <!-- Modal Tambah-->
            <ModalTambah  v-if="isShowModal" :tampilPaket="tampilPaket" :getOutlets="getOutlets"/>
            <!--end Modal -->

            <!-- Modal Edit -->
            <ModalEdit :byIdaPaket="byIdaPaket" :tampilPaket="tampilPaket" :getPakets="getPakets"/>
            <!-- end modal edit -->

            <!-- tabel -->
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">DAFTAR PAKET</h4>
                            </div>
                            <!-- button tambah modal -->
                            <div class="col">
                                <button
                                    type="button"
                                    class="btn btn-primary btn-sm float-right"
                                    data-toggle="modal"
                                    data-target="#myModal"
                                    @click="toggleModal"
                                >
                                    Outlet<i
                                        class="tim-icons icon-simple-add"
                                    ></i>
                                </button>
                                <!-- button tambah modal -->
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <table class="table tablesorter" id="">
                                <thead class="text-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Id Outlet</th>
                                        <th>Nama Paket</th>
                                        <th>Gambar Paket</th>
                                        <th>Harga Paket</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(getPaket, index) in getPakets"
                                        :key="getPaket.id"
                                    >
                                        <td>
                                            {{ index + 1 }}
                                        </td>
                                        <td>
                                            {{ getPaket.nama_outlet }}
                                        </td>
                                        <td>
                                            {{ getPaket.nama_paket }}
                                        </td>
                                        <td>
                                            <img
                                                :src="`http://localhost:8000/storage/${getPaket.gbr_paket}`"
                                                width="100"
                                                height="100"
                                            />
                                        </td>
                                        <td>
                                            {{ getPaket.harga_paket }}
                                        </td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-default btn-sm"
                                                data-toggle="modal"
                                                data-target="#ModalEdit"
                                                @click="
                                                ubahPaket(getPaket.id)
                                            "
                                            >
                                                Edit
                                            </button>
                                            <button
                                                class="btn btn-neutral btn-sm"
                                                @click="
                                                hapusPaket(getPaket.id)
                                                "
                                            >
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import axios from "axios";
import { onMounted, ref } from "vue";
import ModalTambah from "../modal/modal_paket/ModalTambah.vue";
import ModalEdit from "../modal/modal_paket/ModalEdit.vue";


const getOutlets = ref([]);
const getPakets = ref([]);
const byIdaPaket = ref([]);
const isShowModal = ref(false);


const tampilPaket = async () => {
    await axios
        .get("/tampilpaket")
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
    tampilOutlet();
});



const hapusPaket = async (id) => {
    await axios
        .delete(`/hapuspaket/${id}`)
        .then((response) => {
            alert(response.data.pesan);
            // this.getProduct();
            // splice posts
            const index = getPakets.value.findIndex(
                (getPaket) => getPaket.id === id
            ); // find the post index
            if (~index) {
                // if the post exists in array
                getPakets.value.splice(index, 1);
            }
        })
        .catch((error) => {
            console.log(error);
        });
};
const ubahPaket = async (id) => {
    await axios
        .get(`/ubahpaket/${id}`)
        .then((response) => {
            console.log(response.data.data);
            byIdaPaket.value=response.data.data
            console.log(byIdaPaket.value);
            // idoutlet.value=response.data.data.id
            // nama.value = response.data.data.nama_outlet;
            // alamat.value = response.data.data.alamat_outlet;
            // telephone.value = response.data.data.tlp_outlet;

        })
        .catch((error) => {
            console.log(error);
        });
};

const tampilOutlet = async () => {
    await axios
        .get("/tampiloutlet")
        .then((res) => {
            // console.log(res.data.data);
            getOutlets.value = res.data.data;
            console.log( getOutlets.value);
        })
        .catch((error) => {
            console.log(error);
        });
};



const toggleModal=()=>{
    isShowModal.value = !isShowModal.value;
}
</script>

<style>
.modal-content {
    background-color: #27293d;
    border-color: #e14eca;
}
.modal-header {
    background-color: #e14eca !important;
}
.modal-dialog {
    margin-right: 0;
    margin-top: 0;
}

</style>


