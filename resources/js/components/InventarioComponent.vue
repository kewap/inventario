@extends('layouts.app')
<template>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Inventario Extendido</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-1">
            <button class="btn btn-primary" v-on:click="btnPistolear">Pistolear</button>
            
        </div>
        <div class="col">
            <button class="btn btn-primary" v-on:click="btnProducto">Agregar Stock</button>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12 my-5">

            <table class="table">
                            <thead>
                                <tr>
                                    <th>Stock</th>
                                    <th>Despachado</th>
                                    <th>Nombre Producto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="evento in eventos" :key="evento">
                                    <td>{{ evento.stock }}</td>
                                    <td>{{ evento.despachado }}</td>
                                    <td>{{ evento.nombre_producto }}</td>
                                </tr>
                            </tbody>
                        </table>

           
            
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
  created() {
    console.log('created');
    console.log('adios')
  },
  methods:{
      
    async guardar() {
      axios.post("http://34.199.55.97/pistolear/"+this.message).then((result) => {
        this.message = '';
        this.message2 = 'despachado';
        console.log(result.data);
    })
    },

    async getproducto(){
        axios.get("http://34.199.55.97/getpistolear/"+this.message).then((result) => {
        this.producto = result.data.nombre+result.data.descripcion;
        this.message2 = '';
        this.estado = result.data.estado;
        this.message3 = new Date(Date.parse(result.data.fecha)).toLocaleDateString('es-CL');
        console.log(result.data);
    })
    },
    async getproducto2(){
        axios.get("http://34.199.55.97/productosall").then((result) => {
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
