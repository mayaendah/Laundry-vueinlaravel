<template>
    <div class="content">
        <div class="row">
            <!-- Modal Tambah-->
            <ModalTambah  v-if="isShowModal" :tampilOutlet="tampilOutlet"/>
            <!--end Modal -->

            <!-- Modal Edit -->
            <ModalEdit :byIdOutlets="byIdOutlets" :tampilOutlet="tampilOutlet"/>
            <!-- end modal edit -->

            <!-- tabel -->
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <h4 class="card-title">DAFTAR OUTLET</h4>
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
                                        <th>Nama Oulet</th>
                                        <th>Alamat Outlet</th>
                                        <th>Telephone</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(getOutlet, index) in getOutlets"
                                        :key="getOutlet.id"
                                    >
                                        <td>
                                            {{ index + 1 }}
                                        </td>
                                        <td>
                                            {{ getOutlet.nama_outlet }}
                                        </td>
                                        <td>
                                            {{ getOutlet.alamat_outlet }}
                                        </td>
                                        <td>
                                            {{ getOutlet.tlp_outlet }}
                                        </td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-default btn-sm"
                                                data-toggle="modal"
                                                data-target="#ModalEdit"
                                                @click="
                                                ubahOutlet(getOutlet.id)
                                            "
                                            >
                                                Edit
                                            </button>
                                            <button
                                                class="btn btn-neutral btn-sm"
                                                @click="
                                                    hapusOutlet(getOutlet.id)
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
import ModalTambah from "../modal/modal_outlet/ModalTambah.vue";
import ModalEdit from "../modal/modal_outlet/ModalEdit.vue";


const getOutlets = ref([]);
const byIdOutlets = ref([]);
const isShowModal = ref(false);


const tampilOutlet = async () => {
    await axios
        .get("/tampiloutlet")
        .then((res) => {
            console.log(res.data.data);
            getOutlets.value = res.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
};
onMounted(() => {
    tampilOutlet();
});



const hapusOutlet = async (id) => {
    await axios
        .delete(`/hapusoutlet/${id}`)
        .then((response) => {
            alert(response.data.pesan);
            // this.getProduct();
            // splice posts
            const index = getOutlets.value.findIndex(
                (getOutlet) => getOutlet.id === id
            ); // find the post index
            if (~index) {
                // if the post exists in array
                getOutlets.value.splice(index, 1);
            }
        })
        .catch((error) => {
            console.log(error);
        });
};
const ubahOutlet = async (id) => {
    await axios
        .get(`/ubahoutlet/${id}`)
        .then((response) => {
            console.log(response.data.data);
            byIdOutlets.value=response.data.data
            console.log(byIdOutlets.value);
            // idoutlet.value=response.data.data.id
            // nama.value = response.data.data.nama_outlet;
            // alamat.value = response.data.data.alamat_outlet;
            // telephone.value = response.data.data.tlp_outlet;

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
