@extends('layouts.app')
<template>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Zona Pistoleo</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-1">
            <button class="btn btn-primary" v-on:click="btnHome">Home</button>
        </div>
        
    </div>
    <div class="row">
        <div class="col my-5">
            <div class="card">
                <div class="card-header">
                    
                    <input class="form-control" v-model="message" v-on:keyup.enter="getproducto"/>
                    <!--<button class="btn btn-primary" v-on:click="getproducto">Buscar</button>-->
                </div>
                <div class="card-body">   
                    <p>{{ id_producto }}</p>                 
                    <p>{{ producto }}</p>
                    
                </div>
                <div class="card-footer">
                    <div v-if="estado === '0'">
                        <button class="btn btn-primary" v-on:click="guardar">Despachar</button><p>{{ message2 }}</p>
                    </div>
                    <div v-if="estado === '1'">
                        <p>producto ya despachado el {{ message3 }}</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col"></div>
    </div>
</div>
</template>

<script>
import axios from "axios";
export default {
    data(){
        return{
            message:'',
            message2:'',
            producto:'',
            estado:'',
            id_producto:''
        }
    },
  created() {
    
  },
  methods:{
      
    async guardar() {
      axios.post("http://34.199.55.97/pistolear/"+this.id_producto).then((result) => {
        console.log('returnnn')
        console.log(result)
        console.log('asdasd')
        this.message = '';
        this.message2 = 'despachado';
        console.log(result.data);
    })
    },

    async getproducto(){
        axios.get("http://34.199.55.97/getpistolear/"+this.message).then((result) => {
        this.id_producto = this.message;
        this.producto = result.data.nombre+' / '+result.data.descripcion;
        this.message2 = '';
        this.estado = result.data.estado;
        this.message3 = new Date(Date.parse(result.data.fecha)).toLocaleDateString('es-CL');
        console.log(result.data);
        this.message = '';
    })
    },
    btnHome(){
        window.location.href = "home";
    }
  }
};
</script>

<style scoped lang="scss">
</style>