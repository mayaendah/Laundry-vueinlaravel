<template>
    <div id="ModalEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        style="color: #ffffff"
                    >
                        &times;
                    </button>
                    <h4 class="modal-title mb-4" style="color: #ffffff">
                        Ubah Data Member
                    </h4>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateMember" method="post">
                        <div class="row">
                            <div
                                class="col-md-12"
                                style="text-align: left"
                            >
                            <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Nama"
                                        v-model="byIdMember.id"
                                    />

                                <div class="form-group">
                                    <label><h5>Nama Member</h5></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Nama"
                                        v-model="byIdMember.nama_member"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="col-md-12"
                                style="text-align: left"
                            >
                                <div class="form-group">
                                    <label
                                        ><h5>Alamat Outlet</h5></label
                                    >
                                    <input
                                        type="text"
                                        class="form-control mt-2"
                                        placeholder="Alamat"
                                        v-model="byIdMember.alamat_member"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="col-md-12"
                                style="text-align: left"
                            >
                                <div class="form-group">
                                    <label
                                        ><h5>Jenis Kelamin</h5></label
                                    >
                                    <input
                                        type="text"
                                        class="form-control mt-2"
                                        placeholder="Alamat"
                                        v-model="byIdMember.jenis_kelamin"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="col-md-12"
                                style="text-align: left"
                            >
                                <div class="form-group">
                                    <label><h5>Telephone</h5></label>
                                    <input
                                        type="text"
                                        class="form-control mt-2"
                                        placeholder="Telephon"
                                        v-model="byIdMember.tlp_member"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="footer float-right">
                            <button
                                type="submit"
                                class="btn btn-fill btn-primary btn-md"
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { ref } from "vue";

export default{
    props:{
    tampilMember: Function,
    byIdMember :[]
   },

   setup(props){
    const updateMember=async()=>{
    // console.log(props.byIdOutlets.nama_outlet);
        await axios
            .post("/updatemember",{
                    id_member:props.byIdMember.id,
                    nama_member: props.byIdMember.nama_member,
                    alamat_member:props.byIdMember.alamat_member ,
                    jenis_kelamin:props.byIdMember.jenis_kelamin ,
                    tlp_member:props.byIdMember.tlp_member ,
                })
            .then((res) => {
                console.log(res.data.data);
                alert(res.data.pesan);
                $('#ModalEdit').modal('hide');
                props.tampilMember();
            })
            .catch((error) => {
                console.log(error);
            });
}

    return{
        // byIdOutlets,
        // alamat,
        // telephone,
        updateMember
    }
   }
}
</script>
