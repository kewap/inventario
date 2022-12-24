@extends('layouts.app')
<template>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>EL BODEGUERO</h1>
        </div>
    </div><hr>
    <div class="row">
        <div class="col">
            <button class="btn btn-primary" v-on:click="btnPistolear">Pistolear</button>
            <button class="btn btn-primary" v-on:click="btnProducto">Agregar Stock</button>
            <button class="btn btn-primary" v-on:click="btnAgregarArticulo">Agregar Producto</button>   
            <button class="btn btn-primary" v-on:click="btnAgregarArticuloDirecto">Agregar Producto Directo</button>           
        </div>
    </div><hr>
    <div class="row">
        <div class="col">
            <button class="btn btn-primary" v-on:click="btnInventarioDrima">Inventario Drima</button>
            <button class="btn btn-primary" v-on:click="btnInventarioFabricalonline">Inventario Fabricalonline</button>
        </div>        
    </div><hr>
    <div class="row">
        <div class="col">
            <button class="btn btn-primary" v-on:click="btnDespachoDrima">Despacho Drima</button>
            <button class="btn btn-primary" v-on:click="btnDespachoFabricalonline">Despacho Fabricalonline</button>
            <button class="btn btn-primary" v-on:click="btnDespachoMercadoLibre">Despacho MercadoLibre</button>
            <button class="btn btn-primary" v-on:click="btnDespachoFalabella">Despacho Falabella</button>
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
        axios.get(process.env.MIX_API_URL+'/productosall').then((result) => {
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
    btnInventarioDrima(){
        window.location.href = "inventariodrima";
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
    btnAgregarArticulo(){
        window.location.href = "agregararticulo";
    },
    btnAgregarArticuloDirecto(){
        window.location.href = "agregararticulodirecto";
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
