@extends('layouts.app')
<template>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Agregar Stock</h1>
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
                
                <div class="card-body">                    
                    <div class="col">
                        <label for="">Producto</label>
                        <select v-model="selected.person" class="form-control">
                            <option v-for="person in persons" :key="person.id" :value="person.id">
                                {{ person.nombre }}
                            </option>
                        </select>  
                    </div>       
                    <div class="col">
                        <label for="">Cantidad</label>
                        <input type="text" v-model="cantidad" class="form-control">
                    </div>      
                    
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" v-on:click="agregarstock">Agregar Lote Stock</button>
                                     
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
    mounted: function () {
      this.getPersons()
      console.log('mounted: got here')
    },
    data(){
        return{
            cantidad:'',
            message:'',
            message2:'',
            producto:'',
            estado:'',
            shirtSizes: [],
        shirtSizeOptions: [],
        inputproducto:'',
         persons: [],
        selected:{
            person:''
        },
        tipo:'',
        
        }
    },
  async created() {
    this.url = process.env.MIX_API_URL;
  },
  methods:{
        getPersons(){
            console.log('getPersons');
            axios.get('/productos')
                .then((response) => {
                    console.log( response.data );
                    this.persons = response.data;

                })
                .catch( resonse => {
                    console.log('error');
                })
            },
      setShirtSizeOptions: function () {
        this.$http.get('/productosall')
        .then(resp => {
        this.shirtSizes = resp.data
        for(var i = 0; i < this.shirtSizes.length; i++){
          var option = []
          for(var key in this.shirtSizes[i]){
          if(key == "id"){
            option["value"] = this.shirtSizes[i][key]
          }else if(key == "nombre"){
            option["text"] = this.shirtSizes[i][key]
          }
          
          }
          this. shirtSizeOptions.push(Object.assign({},option))
        }
        })
        .catch(err => {
        console.log(err)
        })
        
      },
      
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
    btnHome(){
        window.location.href = "home";
    },
    agregarstock(){
        console.log();
        window.location.href = "pdf/"+this.cantidad+'/'+this.selected.person;
    }
  }
};
</script>

<style scoped lang="scss">
</style>
