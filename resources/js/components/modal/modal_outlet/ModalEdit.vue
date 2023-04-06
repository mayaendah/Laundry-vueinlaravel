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
                        Ubah Data Outlet
                    </h4>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="updateOutlet" method="post">
                        <div class="row">
                            <div
                                class="col-md-12"
                                style="text-align: left"
                            >
                            <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Nama"
                                        v-model="byIdOutlets.id"
                                    />

                                <div class="form-group">
                                    <label><h5>Nama Outlet</h5></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Nama"
                                        v-model="byIdOutlets.nama_outlet"
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
                                        v-model="byIdOutlets.alamat_outlet"
                                    />
                                </div>
                            </div>
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
                                        v-model="byIdOutlets.tlp_outlet"
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
    tampilOutlet: Function,
    byIdOutlets :[]
   },

   setup(props){
    const updateOutlet=async()=>{
    // console.log(props.byIdOutlets.nama_outlet);
        await axios
            .post("/updateoutlet",{
                    id_outlet:props.byIdOutlets.id,
                    nama_outlet: props.byIdOutlets.nama_outlet,
                    alamat_outlet:props.byIdOutlets.alamat_outlet ,
                    tlp_outlet:props.byIdOutlets.tlp_outlet ,
                })
            .then((res) => {
                console.log(res.data.data);
                alert(res.data.pesan);
                $('#ModalEdit').modal('hide');
                props.tampilOutlet();
            })
            .catch((error) => {
                console.log(error);
            });
}

    return{
        // byIdOutlets,
        // alamat,
        // telephone,
        updateOutlet
    }
   }
}
</script>
