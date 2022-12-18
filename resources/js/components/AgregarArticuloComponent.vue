@extends('layouts.app')
<template>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Agregar Producto</h1>
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
                        <label for="">Nombre completo producto</label>
                        <input type="text" v-model="nombre_producto" class="form-control">
                    </div>   
                    <div class="col">
                        <label for="">Marca</label>
                        <select v-model="marca" class="form-control">
                            <option value="DRIMA">DRIMA</option>
                            <option value="FABRICALONLINE">FABRICALONLINE</option>                            
                        </select> 
                    </div>   
                    <hr>
                    <label for=""><b>Etiqueta</b></label><br>
                    <div class="col">
                        <label for="">Titulo producto</label>
                        <input type="text" v-model="etiquetatitulo" class="form-control">
                    </div>
                    <div class="col">
                        <label for="">Descripción producto</label>
                        <input type="text" v-model="etiquetadescripcion" class="form-control">
                    </div>  
                    <div class="col"><br>
                        <button class="btn btn-primary" v-on:click="prevetiqueta">Previsualizar</button>
                        <br><br>
                        {{prev_etiqueta}}
                    </div>      
                    <a href='http://labelary.com/viewer.html' target='_blank'>link</a>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" v-on:click="guardar">Agregar Producto</button>
                                     {{message2}}
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

nombre_producto:'',
marca:'',
etiquetatitulo:'',
etiquetadescripcion:'',
prev_etiqueta:''
        
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
      axios.post(process.env.MIX_API_URL+"/agregararticulo/"+this.nombre_producto+"/"+this.marca+"/"+this.etiquetatitulo+"/"+this.etiquetadescripcion).then((result) => {
        this.message = '';
        this.message2 = 'producto agregado';
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
,
    prevetiqueta(){
        if(this.marca == 'DRIMA'){
            this.prev_etiqueta = "^XA ^FO50,60^A0,30^FD DRIMA - ORTOPEDIA DIGITAL ^FS ^FO45, 110^ADN, 12, 7^FD "+this.etiquetatitulo+" ^FS ^FO45, 140^ADN, 12, 7^FD "+this.etiquetadescripcion+" ^FS ^FO90,180^BY4^BC,60,N,N,N,N^A1,20,^FD101^FS ^FO90, 260^ADN, 12, 7^FD www.drima.cl - La Serena ^FS ^FO25,25^GB435,275,2^FS ^XZ ^XA";
        }else{
            this.prev_etiqueta = "^XA ^FO90,60^A0,30^FD FABRICALONLINE.COM ^FS ^FO45, 110^ADN, 12, 7^FD "+this.etiquetatitulo+" ^FS ^FO45, 140^ADN, 12, 7^FD "+this.etiquetadescripcion+" ^FS ^FO90,180^BY4^BC,60,N,N,N,N^A1,20,^FD101^FS ^FO50, 260^ADN, 12, 7^FD www.fabricalonline.com - Chile ^FS ^FO25,25^GB435,275,2^FS ^XZ ^XA";
        
        }
    }
  }
};
</script>

<style scoped lang="scss">
</style>
