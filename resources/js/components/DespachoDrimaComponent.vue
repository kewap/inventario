@extends('layouts.app')
<template>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Despacho Drima</h1>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-1">
            <button class="btn btn-primary" v-on:click="btnHome">Home</button>
        </div>        
    </div>
    <div class="row">
        <div class="col-md-12 my-5">

            <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Producto</th>
                                    <th>Nombre Producto</th>
                                    <th>Plataforma</th>
                                    <th>Marca</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="evento in eventos" :key="evento">
                                    <td>{{ evento.id_inventario }}</td>
                                    <td>{{ evento.nombre_producto }}</td>
                                    <td>{{ evento.plataforma }}</td>
                                    <td>{{ evento.marca }}</td>
                                    <td>{{ evento.updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>

            <div>
  
</div>
            
        </div>
        
    </div>
    
</div>
</template>

<script>

import axios from "axios";
export default {
    name: 'table-evento-list-row',
    mounted: function () {
        console.log('hola');
        //this.test();
        this.getproducto2();
        console.log(process.env.MIX_API_URL+"/productosall")
      console.log('mounted: got here2');
      
    },
    data(){
        return{
            message:'',
            message2:'',
            producto:'',
            estado:'',
            eventos:[]
        }
    },
  async created() {
    this.url = process.env.MIX_API_URL;
  },
  methods:{
      
    async guardar() {
      axios.post(process.env.MIX_API_URL+"/pistolear/"+this.message).then((result) => {
        this.message = '';
        this.message2 = 'despachado';
        console.log(result.data);
    })
    },

    async getproducto(){
        axios.get(process.env.MIX_API_URL+"/getpistolear/"+this.message).then((result) => {
        this.producto = result.data.nombre+result.data.descripcion;
        this.message2 = '';
        this.estado = result.data.estado;
        this.message3 = new Date(Date.parse(result.data.fecha)).toLocaleDateString('es-CL');
        console.log(result.data);
    })
    },
    async getproducto2(){
        axios.get(process.env.MIX_API_URL+'/getdespachodrima').then((result) => {
        this.eventos = result.data;
        console.log(result.data);
    })
    },
    btnPistolear(){
        window.location.href = "zonapistola";
    },
    btnProducto(){
        window.location.href = "agregarproducto";
    },
    btnInventarioFabricalonline(){
        window.location.href = "inventariofullfabricalonline";
    },
    btnHome(){
        window.location.href = "home";
    },

    btnDespachoDrima(){
        window.location.href = "despachodrima";
    },
    btnDespachoFabricalonline(){
        window.location.href = "despachofabricalonline";
    },
    btnDespachoMercadoLibre(){
        window.location.href = "despachomercadolibre";
    },
    btnDespachoFalabella(){
        window.location.href = "despachofalabella";
    },
    


    test(){
        this.$http.get("/productosall").then((result) => {
        //this.eventos = result.data;
        console.log(result);
    })
    }
  }
};
</script>

<style scoped lang="scss">
</style>
