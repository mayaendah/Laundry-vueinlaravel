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
          <h4 class="modal-title mb-4" style="color: #ffffff">Tambah Outlet</h4>
        </div>
        <div class="modal-body">
          <form @submit.prevent="simpanOutlet" method="post">
            <div class="row">
              <div class="col-md-12" style="text-align: left">
                <div class="form-group">
                  <label><h5>Nama Outlet</h5></label>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Nama"
                    v-model="nama"
                  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" style="text-align: left">
                <div class="form-group">
                  <label><h5>Alamat Outlet</h5></label>
                  <input
                    type="text"
                    class="form-control mt-2"
                    placeholder="Alamat"
                    v-model="alamat"
                  />
                </div>
              </div>
              <div class="col-md-12" style="text-align: left">
                <div class="form-group">
                  <label><h5>Telephone</h5></label>
                  <input
                    type="text"
                    class="form-control mt-2"
                    placeholder="Telephon"
                    v-model="telephone"
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
import { ref } from "vue";

export default {
  props:{
    tampilOutlet: Function,
   },
  setup(props) {
    const nama = ref([]);
    const alamat = ref([]);
    const telephone = ref([]);
    // const closeModal = ref([]);



    const simpanOutlet = async () => {
      await axios
        .post(
          "/simpanoutlet",
          {
            nama_outlet: nama.value,
            alamat_outlet: alamat.value,
            tlp_outlet: telephone.value,
          }
          // ,{
          //       headers: {
          //           Authorization: 'Bearer ' + localStorage.getItem('token')
          //       }
          // }
        )
        .then((res) => {
          console.log(res.data.data);
          alert("Simpan data Outlet berhasil");
          props.tampilOutlet();

        })
        .catch((error) => {
          console.log(error);
        });
    };

    return {
        nama,
        alamat,
        telephone,
        simpanOutlet
    };
  },
};
</script>
