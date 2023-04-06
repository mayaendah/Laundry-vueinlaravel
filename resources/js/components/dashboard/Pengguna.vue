<template>
    <div class="content">
        <div class="row">
            <!-- Modal Tambah-->
            <ModalTambah  v-if="isShowModal" :tampilMember="tampilMember"/>
            <!--end Modal -->

            <!-- Modal Edit -->
            <ModalEdit :byIdMember="byIdMember" :tampilMember="tampilMember"/>
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
                                        <th>Nama Member</th>
                                        <th>Alamat Member</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Telephon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(getMember, index) in getMembers"
                                        :key="getMember.id"
                                    >
                                        <td>
                                            {{ index + 1 }}
                                        </td>
                                        <td>
                                            {{ getMember.nama_member }}
                                        </td>
                                        <td>
                                            {{ getMember.alamat_member }}
                                        </td>
                                        <td>
                                            {{ getMember.jenis_kelamin }}
                                        </td>
                                        <td>
                                            {{ getMember.tlp_member }}
                                        </td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-default btn-sm"
                                                data-toggle="modal"
                                                data-target="#ModalEdit"
                                                @click="
                                                ubahMember(getMember.id)
                                            "
                                            >
                                                Edit
                                            </button>
                                            <button
                                                class="btn btn-neutral btn-sm"
                                                @click="
                                                    hapusMember(getMember.id)
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
import ModalTambah from "../modal/modal_member/ModalTambah.vue";
import ModalEdit from "../modal/modal_member/ModalEdit.vue";

// const idoutlet = ref([]);
// const nama = ref([]);
// const alamat = ref([]);
// const telephone = ref([]);
const getMembers = ref([]);
const byIdMember = ref([]);
const isShowModal = ref(false);


const tampilMember = async () => {
    await axios
        .get("/tampilmember")
        .then((res) => {
            console.log(res.data.data);
            getMembers.value = res.data.data;
        })
        .catch((error) => {
            console.log(error);
        });
};
onMounted(() => {
    tampilMember();
});



const hapusMember = async (id) => {
    await axios
        .delete(`/hapusmember/${id}`)
        .then((response) => {
            alert(response.data.pesan);
            // this.getProduct();
            // splice posts
            const index = getMembers.value.findIndex(
                (getMember) => getMember.id === id
            ); // find the post index
            if (~index) {
                // if the post exists in array
                getMembers.value.splice(index, 1);
            }
        })
        .catch((error) => {
            console.log(error);
        });
};
const ubahMember = async (id) => {
    await axios
        .get(`/ubahmember/${id}`)
        .then((response) => {
            console.log(response.data.data);
            byIdMember.value=response.data.data
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



