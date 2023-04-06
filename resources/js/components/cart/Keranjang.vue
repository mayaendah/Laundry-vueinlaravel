<template>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="title">Keranjang Member</h5>
                        <p class="category">

                            <a href="https://nucleoapp.com/?ref=1712"
                                >List Laundry</a
                            >
                        </p>
                    </div>
                    <div class="card-body all-icons">
                        <div class="row">
                            <div
                                class="font-icon-list col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xs-12"
                            >
                                <div class="font-icon-detail">
                                    <!-- {{  getKeranjang }} -->
                                    <table class="table tablesorter" id="">
                                        <thead class="text-primary">
                                            <tr>
                                                <th>Nama Paket</th>
                                                <th>Harga Paket</th>
                                                <th>Berat Paket</th>
                                                <th class="text-center">
                                                    Keterangan
                                                </th>
                                                <th class="text-center">
                                                    Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="cart in getKeranjang"
                                                :key="cart.id"
                                            >
                                                <td>
                                                    {{ cart.nama_paket }}
                                                </td>
                                                <td>
                                                    {{ cart.harga_paket }}
                                                </td>
                                                <td>
                                                    {{ cart.berat_paket }} Kg
                                                </td>
                                                <td class="text-center">
                                                    {{ cart.ket_paket }}
                                                </td>
                                                <td class="text-center">
                                                    Rp.
                                                    {{
                                                        cart.harga_paket *
                                                        cart.berat_paket
                                                    }}
                                                </td>
                                            </tr>
                                            <tr style="boder: none !important">
                                                <td colspan="5" align="right">
                                                    Rp. {{ totalHarga }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form method="post" @submit.prevent="checkout">
                                    <div
                                        class="form-group"
                                        style="
                                            text-align: left;
                                            margin-right: 25px;
                                            margin-left: 25px;
                                        "
                                    >
                                        <label><h5>Nama Member</h5></label>
                                        <input
                                            type="text"
                                            class="form-control mt-2"
                                            placeholder="Nama Member "
                                            v-model="namaMember"
                                        />
                                    </div>
                                    <div class="footer float-right">
                                        <button
                                            type="submit"
                                            class="btn btn-fill btn-primary btn-md"
                                        >
                                            Checkout
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script >
import { onMounted, ref} from "vue";
import {useRouter} from 'vue-router';
import axios from "axios";

export default{
    setup(){
        const getKeranjang = ref([]);
        const namaMember = ref([]);
        const totalHarga = ref([]);
        let router=useRouter()

        onMounted(() => {
            axios.get("/keranjang").then((response) => {
        // console.log(response.data.data);
                getKeranjang.value = response.data.data;

                totalHarga.value = getKeranjang.value.reduce(
                (total, item) => total + item.harga_paket * item.berat_paket,
                0
                );

            });
        });

        const checkout=async()=>{
            if (namaMember.value=="") {
                alert('Nama Tidak boleh kosong')
            }else{

                await axios.post('/pesanan',{
                nama_member:namaMember.value,
                harga_total: totalHarga.value,
                get_keranjangs:getKeranjang.value
                }).then(()=>{
                    getKeranjang.value.map(function (item) {
                    console.log(item.id);
                    return axios
                        .delete("/hapus/itemKeranjang/" + item.id)
                        .catch((error) => console.log(error));
                    });
                    alert("transaksi berhasil");
                    router.push({ path: "/pesanansuccess" })

                }).catch((err)=>{
                    console.log(err);
                })
            }

        }

        return{
            getKeranjang,
            namaMember,
            totalHarga,
            checkout
        }
    }
}






</script>
