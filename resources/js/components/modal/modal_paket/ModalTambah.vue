<template>
  <div id="myModal" class="modal fade" role="dialog">
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
          <h4 class="modal-title mb-4" style="color: #ffffff">Tambah Paket</h4>
        </div>
        <div class="modal-body">
          <form @submit.prevent="simpanPaket" method="post">
            <div class="row">
              <div class="col-md-12" style="text-align: left">
                <div class="form-group">
                  <label><h5>Nama Outlet</h5></label>
                  <select v-model="id_outlet" class="form-control">
                    <option style="color:black" value="" disabled selected >Pilih Outlet</option>
                    <option v-for="item in getOutlets" :value="item.id" :key="item.id" style="color:black">{{item.nama_outlet}}</option>
                </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" style="text-align: left">
                <div class="form-group">
                  <label><h5>Nama Paket</h5></label>
                  <input
                    type="text"
                    class="form-control mt-2"
                    placeholder="Nama Paket"
                    v-model="nama_paket"
                  />
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-sm-12" style="text-align: left">
                  <div class="">
                    <label><h5>Gambar</h5></label><br>
                    <input
                      type="file"
                      class="btn btn-success btn-sm "
                      placeholder="Alamat"
                      @change="imgpaket"
                    />
                  </div>
            </div>
            <div class="row">
              </div>
              <div class="col-md-12" style="text-align: left">
                <div class="form-group mt-2">
                  <label><h5>Harga</h5></label>
                  <input
                    type="text"
                    class="form-control mt-2"
                    placeholder="Harga"
                    v-model="harga_paket"
                  />
                </div>
              </div>

            </div>
            <div class="footer float-right">
              <button type="submit" class="btn btn-fill btn-primary btn-md">
                Simpan
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
import { ref ,onMounted} from "vue";

export default {
  props:{
    tampilPaket: Function,
    getOutlets:[]
   },
  setup(props) {
    const id_outlet = ref([]);
    const nama_paket = ref([]);
    const gbr_paket = ref([]);
    const harga_paket = ref([]);


    // const closeModal = ref([]);

    const imgpaket=(e)=>{
        gbr_paket.value=e.target.files[0];
        console.log(gbr_paket.value);
    }

    const simpanPaket = async () => {

        let formData = new FormData();
        formData.append("id_outlet", id_outlet.value);
        formData.append("nama_paket", nama_paket.value);
        formData.append("gbr_paket", gbr_paket.value);
        formData.append("harga_paket",  harga_paket.value);

        for (const value of formData.values()) {
            console.log(value);
        }

      await axios
        .post(
          "/simpanpaket",formData
        )
        .then((res) => {
          console.log(res.data.data);
          alert("Simpan data paket berhasil");
            //  id_outlet.value = "";
            //  nama_paket.value = "";
            //  gbr_paket.value = "";
            //  harga_paket.value = "";
          props.tampilPaket();
        })
        .catch((error) => {
          console.log(error);
        });
    };


// onMounted(() => {
//     props.tampilOutlet();
// });

    return {
        id_outlet,
        nama_paket,
        gbr_paket,
        harga_paket,
        simpanPaket,
        imgpaket

    };
  },
};
</script>
