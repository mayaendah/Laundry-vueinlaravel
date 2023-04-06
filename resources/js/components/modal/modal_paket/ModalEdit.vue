<template>
    <div id="ModalEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="color: #ffffff">
                        &times;
                    </button>
                    <h4 class="modal-title mb-4" style="color: #ffffff">
                        Ubah Data Paket
                    </h4>
                </div>
                <div class="modal-body">
                    <!-- {{ getOutlets }} -->
                    <form @submit.prevent="updatePaket" method="post">
                        <input type="text" class="form-control" v-model="byIdaPaket.id" />
                        <div class="row">
                            <div class="col-md-12" style="text-align: left">
                                <div class="form-group">
                                    <label>
                                        <h5>Nama Outlet</h5>
                                    </label>

                                    <select v-model="id_outlet" @change="getIdoutlet($event)" class="form-control" id="">
                                        <!-- <option style="color:black" value="" disabled selected >Pilih Outlet</option> -->
                                        <option v-for="item in getOutlets" :value="item.id" :key="item.id"
                                            style="color: black">
                                            {{ item.nama_outlet }}
                                        </option>
                                    </select>

                                    <input type="text" class="form-control" v-model="byIdaPaket.id_outlet" />
                                    <input type="text" class="form-control" v-model="idOutlet" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: left">
                                <div class="form-group">
                                    <label>
                                        <h5>Nama Paket</h5>
                                    </label>
                                    <input type="text" class="form-control" v-model="byIdaPaket.nama_paket" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" style="text-align: left">
                                <div class="form-group">
                                    <label>
                                        <h5>Gambar Paket</h5>
                                    </label>
                                    <input type="text" class="form-control mt-2" v-model="byIdaPaket.gbr_paket" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12" style="text-align: left">
                                <div class="">
                                    <!-- <label><h5>Gambar</h5></label><br> -->
                                    <input type="file" class="btn btn-success btn-sm" placeholder="Alamat"
                                        @change="imgpaket" />
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12" style="text-align: left">
                                <div class="form-group">
                                    <label>
                                        <h5>Harga Paket</h5>
                                    </label>
                                    <input type="text" class="form-control mt-2" v-model="byIdaPaket.harga_paket" />
                                </div>
                            </div>
                        </div>
                        <div class="footer float-right">
                            <button type="submit" class="btn btn-fill btn-primary btn-md">
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
import { ref, onMounted } from "vue";

export default {
    props: {
        tampilPaket: Function,
        byIdaPaket: [],
    },

    setup(props) {
        const getOutlets = ref([]);
        const idOutlet = ref([]);
        const newIdOutlet = ref([]);
        const newImage = ref([]);
        const Image = ref([]);

        const imgpaket=(e)=>{
            newImage.value=e.target.files[0];
            // console.log(newImage.value);
        }

        const updatePaket = async () => {
            // console.log(props.byIdOutlets.nama_outlet);
            if (idOutlet.value != "") {
                console.log((newIdOutlet.value = idOutlet.value));
            } else {
                console.log((newIdOutlet.value = props.byIdaPaket.id_outlet));
            }


            let formData = new FormData();
                formData.append("id_paket", props.byIdaPaket.id);
                formData.append("id_outlet", newIdOutlet.value);
                formData.append("nama_paket", props.byIdaPaket.nama_paket);
                formData.append("gbr_paket",props.byIdaPaket.gbr_paket);
                formData.append("newImage",newImage.value);
                formData.append("harga_paket",  props.byIdaPaket.harga_paket);

        for (const value of formData.values()) {
            console.log(value);
        }

            await axios
                .post("/updatepaket", formData)
                .then((res) => {
                    console.log(res.data.data);
                    alert(res.data.pesan);
                    props.byIdaPaket.id="";
                    newIdOutlet.value="";
                    props.byIdaPaket.nama_paket="";
                    props.byIdaPaket.gbr_paket="";
                    newImage.value="";
                    props.byIdaPaket.harga_paket=""
                    $("#ModalEdit").modal("hide");
                    props.tampilPaket();
                })
                .catch((error) => {
                    console.log(error);
                });
        };



        const getIdoutlet = (event) => {
            idOutlet.value = event.target.value;
        };

        const tampilOutlet = async () => {
            await axios
                .get("/tampiloutlet")
                .then((res) => {
                    // console.log(res.data.data);
                    getOutlets.value = res.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        };
        onMounted(() => {
            tampilOutlet();
        });

        return {
            updatePaket,
            getOutlets,
            idOutlet,
            getIdoutlet,
            imgpaket,
            newImage,
            newIdOutlet,
            Image

        };
    },
};
</script>
