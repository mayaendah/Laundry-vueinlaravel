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
          <h4 class="modal-title mb-4" style="color: #ffffff">Tambah Member</h4>
        </div>
        <div class="modal-body">
          <form @submit.prevent="simpanMember" method="post">
            <div class="row">
              <div class="col-md-12" style="text-align: left">
                <div class="form-group">
                  <label><h5>Nama Member</h5></label>
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
                  <label><h5>Alamat Member</h5></label>
                  <input
                    type="text"
                    class="form-control mt-2"
                    placeholder="Alamat"
                    v-model="alamat"
                  />
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="text-align: left">
                  <div class="form-group">
                    <label><h5>Jenis Kelamin</h5></label>
                    <input
                      type="text"
                      class="form-control mt-2"
                      placeholder="Alamat"
                      v-model="jk"
                    />
                  </div>
              </div>
            <div class="row">
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
    tampilMember: Function,
   },
  setup(props) {
    const nama = ref([]);
    const alamat = ref([]);
    const jk = ref([]);
    const telephone = ref([]);
    // const closeModal = ref([]);



    const simpanMember = async () => {
      await axios
        .post(
          "/simpanmember",
          {
            nama_member: nama.value,
            alamat_member: alamat.value,
            jenis_kelamin: jk.value,
            tlp_member: telephone.value,
          }
        )
        .then((res) => {
          console.log(res.data.data);
          alert("Simpan data member berhasil");
          props.tampilMember();

        })
        .catch((error) => {
          console.log(error);
        });
    };

    return {
        nama,
        alamat,
        jk,
        telephone,
        simpanMember
    };
  },
};
</script>
