<template>
<div>
    <form v-on:submit.prevent="storeRegistro" method="post" autocomplete="off">
        <div class="modal fade" id="nuevo">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Crear</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group">

                                        <label>
                                            <input type="radio"  name="enod" :value="true"  v-model="isEnod">
                                                Enod
                                        </label>

                                        <label>&nbsp;&nbsp;
                                            <input type="radio" name="cliente" :value="false" v-model="isEnod">
                                            Cliente
                                        </label>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre *</label>
                                    <input autocomplete="off" v-model="Registro.name" type="text" name="nombre" class="form-control" value="">
                                </div>
                            </div>

                            <div v-if="!isEnod">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Cliente *</label>
                                        <v-select v-model="cliente" label="razon_social" :options="clientes"></v-select>
                                    </div>
                                </div>
                           </div>

                            <div  v-if="isEnod" class="col-md-6">
                                <div class="form-group">
                                    <label for="name">DNI *</label>
                                    <input autocomplete="off" v-model="Registro.dni" type="number" name="dni" class="form-control" value="">
                                </div>
                            </div>
                            <div  v-if="isEnod" class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Film</label>
                                    <label for="tipo" style="float:right;">Habilitado Arn</label>
                                    <input type="checkbox" id="checkbox" v-model="Registro.habilitado_arn_sn" style="float:right;margin-right: 5px;">
                                    <input autocomplete="off" v-model="Registro.film" type="number" name="film" class="form-control" value="">
                                </div>
                            </div>

                        <div v-if="!isEnod" class="clearfix"></div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="usuario">email *</label>
                                <input autocomplete="nope" type="text" name="email" class="form-control" v-model="Registro.email" value="">
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div v-if="isEnod" class="col-md-6">
                            <div class="form-group">
                                <label>Informes a firmar</label>
                                <button type="button" class="btn btn-xs btn-primary" style="float:right" @click.stop="openFirmas('new')">Firmas</button>
                                <v-select multiple v-model="metodos_firmas" :options="metodos_no_importables" label='metodo'></v-select>

                            </div>
                        </div>

                        <div v-if="isEnod" class="clearfix"></div>

                        <input style="display:none" type="text" name="none-email" class="form-control" v-model="Registro.email" value="">

                         <div v-if="!isEnod" class="clearfix"></div>

                            <div class="col-md-6 top-buffer">
                                <div class="form-group">
                                    <label for="password">Contraseña *</label>
                                    <input autocomplete="new-password" type="password" name="password" class="form-control" v-model="Registro.password">
                                </div>
                            </div>

                            <input style="display:none" type="password" name="password" class="form-control" v-model="Registro.password">

                            <div class="col-md-6 top-buffer">
                                <div class="form-group">
                                    <label for="password2">Repetir Contraseña *</label>
                                    <input type="password" name="password2" class="form-control" v-model="password2">
                                </div>
                            </div>

                        <div v-if="isEnod">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Firma Digital</label>
                                    <input type="file" class="form-control" id="inputFile" ref="inputFile1" name="file" @change="onFileSelected($event)">
                                    <button class="hide" @click.prevent="onUpload()" >upload</button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p>Formatos soportados : png, bmp, jpg.</p>
                                    <P><strong>Relación 2:1 Ej: 400x200 Pixeles</strong></P>
                                    <div v-if="Registro.path">
                                        <img :src="'/' + Registro.path" class="margin zoom-in"  @click="openGallery()" alt="..." width="120" >
                                        <LightBox :images="images"  ref="lightbox"  :show-light-box="false" ></LightBox>
                                    </div>
                                    <progress-bar
                                        :options="options"
                                        :value="uploadPercentage"
                                        style="margin-top:5px;float: none;"
                                    />
                                </div>
                            </div>
                        </div>

                        <div v-if="isEnod">
                            <div class="col-md-12">
                                <div class="box box-widget">
                                    <div class="box-body well" style="margin-bottom: 0 !important;">
                                        <div class="container">
                                            <div class="col-md-12" style="margin-bottom: 10px;">
                                                <strong style="font-size: 16px;font-weight: 600;">Alarmas</strong>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <input type="checkbox" id="checkbox2"  v-model="Registro.exceptuar_notificar_doc_vencida_sn">
                                                    <label for="checkbox2">Exceptuar vencimiento doc.</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style="margin-left: 0px;">
                                                    <input type="checkbox" class="margin-left:20px" id="checkbox3"  v-model="Registro.exceptuar_notificar_demora_dosimetria_sn">
                                                    <label for="checkbox3">Exceptuar demora dosimetría.</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <input type="checkbox" id="checkbox4" v-model="Registro.notificar_por_web_sn">
                                                    <label for="checkbox4">Notificar por web.</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style="margin-left: 0px;">
                                                    <input type="checkbox" class="margin-left:20px" id="checkbox5" v-model="Registro.notificar_por_mail_sn">
                                                    <label for="checkbox5">Notificar por mail.</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <strong>Roles</strong>
                                <div v-for="(rol,k) in roles" :key="k" >
                                    <div class="col-sm-4 col-xs-12">
                                        <input type="checkbox" :id=" rol.name " :value="rol.name" v-model="user_rol" style="float:left" :disabled="(rol.name=='Usuario Cliente') || (rol.name == 'Usuario Enod')" >
                                        <label for="tipo" style="float:left;margin-left: 5px;">{{ rol.name }}</label>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <button type="button" class="btn btn-default" name="button" data-dismiss="modal" >Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <firmas-formN :metodos_ensayos='metodos_no_importables' @close-firmas1="updatefirmas($event)"> </firmas-formN>
</div>
</template>

<script>
require('vue-image-lightbox/dist/vue-image-lightbox.min.css')
import LightBox from 'vue-image-lightbox'
import {mapState} from 'vuex'
import { eventNewRegistro, eventModal} from '../../event-bus';
export default {

    components: {
            LightBox,
        },

    data() { return {

        Registro : {
            'name'  : '',
            'dni'   :'',
            'film'  :'',
            'habilitado_arn_sn':false,
            'exceptuar_notificar_doc_vencida_sn':false,
            'exceptuar_notificar_demora_dosimetria_sn':false,
            'notificar_por_web_sn':false,
            'notificar_por_mail_sn':false,
            'email' : '',
            'password' : '',
            'path':'',
            'firmas':[],
         },
        errors:{},
        isEnod:true,
        cliente:{},
        clientes:[],
        user_rol:[],
        metodos_firmas:[],
        password2:'',
        request : [],

        images:[
            {

            src: '',
            thumb: '',
            caption: 'caption to display. receive <html> <b>tag</b>', // Optional

          }
            ]   ,

        fullPage: false,
        isLoading_file: false,
        uploadPercentage: 0,
        selectedFile : null,
        HabilitarGuardar : true,

        options: {

            layout: {
                height: 20,
                width: 150,
                verticalTextAlign: 74,
                progressPadding: 0,
                },
            }
         }

    },
 created: function () {

    eventNewRegistro.$on('open', this.openModal)
    this.getClientes();
    this.$store.dispatch('loadMetodosEnsayos');

    },
    computed :{

         ...mapState(['url','roles','metodos_ensayos']),

        metodos_no_importables(){

             return this.metodos_ensayos.filter((metodo) => !metodo.importable_sn && metodo.metodo!='GRAL')
         }
    },

    watch : {

          Registro : function(val) {
                this.images[0].src ='/' + val.path;
                this.images[0].thumb  ='/' + val.path;
          },

          isEnod : function(val){
              if(val){
                  this.user_rol.splice('Cliente');
              }else {
                  this.user_rol.push(' Cliente')
              }
          },
    },

    methods: {

            openFirmas (mode,item)  {
              eventModal.$emit('open', mode,item);
            },

            updatefirmas: function (item){
                this.Registro.firmas = item
                console.log('new',this.Registro)
            },

            openGallery(index) {
                 this.$refs.lightbox.showImage(0)
            },

           openModal : function(){
                this.Registro = {
                        'name'  : '',
                        'dni'   :'',
                        'film'  :'',
                        'habilitado_arn_sn':false,
                        'exceptuar_notificar_doc_vencida_sn':false,
                        'exceptuar_notificar_demora_dosimetria_sn':false,
                        'notificar_por_web_sn':false,
                        'notificar_por_mail_sn':false,
                        'email' : '',
                        'password' : '',
                        'path':'',
                        'firmas':[],
                },
                this.password2='',
                this.isEnod=true,
                this.$refs.inputFile1.type = 'text';
                this.$refs.inputFile1.type = 'file';
                this.selectedFile =  null;
                this.user_rol=[],
                $('#nuevo').modal('show');
                $( document ).ready(function() {
                    setTimeout(function(){
                        $("#pass").attr('readonly', false);
                        $("#pass").focus();
                    },500);
                });
            },

            getClientes: function(){

                axios.defaults.baseURL = this.url ;
                var urlRegistros = 'clientes' + '?api_token=' + Laravel.user.api_token;
                axios.get(urlRegistros).then(response =>{
                this.clientes = response.data
                });
              },

            onFileSelected(event) {

            this.isLoading_file = true;
            this.HabilitarGuardar = false;

            this.selectedFile = event.target.files[0];

            let FileSize = this.selectedFile.size / 1024 / 1024; // in MB
            let FileType=this.selectedFile.type;
            console.log(FileType);

            if (!((FileType == 'image/jpeg') || (FileType == 'image/bmp') || (FileType == 'image/png'))) {

                    toastr.error('El tipo de archivo no es aceptado ');
                    this.$refs.inputFile1.type = 'text';
                    this.$refs.inputFile1.type = 'file';
                    this.selectedFile = null;
                    return;
             }

                console.log(this.selectedFile);

                if(FileSize > 20 ){
                    event.preventDefault();
                    toastr.error('Archivo demasiado grande. (Max 500 KB)');
                    this.$refs.inputFile1.type = 'text';
                    this.$refs.inputFile1.type = 'file';
                    this.selectedFile = null;
                    this.uploadPercentage = 0;
                    this.isLoading_file = false;
                }else{

                    this.onUpload();

                }

           },

            onUpload() {

              this.HabilitarGuardar = false
              let settings = { headers: { 'content-type': 'multipart/form-data' }, onUploadProgress: function( progressEvent ) {
                                                                                    this.uploadPercentage = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) );
                                                                                    }.bind(this) }
               const fd = new FormData();

               fd.append('archivo',this.selectedFile);

               axios.defaults.baseURL = this.url;
               var url = 'storage/firma-digital';
               console.log(fd);

               axios.post(url,fd,settings)
               .then (response => {
                  this.Registro.path = response.data;
                  this.isLoading_file = false
                  this.HabilitarGuardar = true;
                  this.images[0].src ='/' + response.data;
                  this.images[0].thumb  ='/' + response.data;
                  this.$forceUpdate();
               }).catch(response => {
                   this.errors = error.response.data.errors;
                   this.isLoading_file = false
                   this.HabilitarGuardar = true;
                })

            },

            storeRegistro: function(){

                if(this.Registro.password != this.password2){
                      toastr.error("Las contreseñas ingresadas no coinciden");
                      return;
                }

                axios.defaults.baseURL = this.url ;
                var urlRegistros = 'users';
                axios.post(urlRegistros, {

                'name'      : this.Registro.name,
                'email'     : this.Registro.email,
                'dni'       : this.Registro.dni,
                'film'      : this.Registro.film,
                'habilitado_arn_sn': this.Registro.habilitado_arn_sn,
                'exceptuar_notificar_doc_vencida_sn':this.Registro.exceptuar_notificar_doc_vencida_sn,
                'exceptuar_notificar_demora_dosimetria_sn':this.Registro.exceptuar_notificar_demora_dosimetria_sn,
                'notificar_por_web_sn' : this.Registro.notificar_por_web_sn,
                'notificar_por_mail_sn': this.Registro.notificar_por_mail_sn,
                'password'  : this.Registro.password,
                'cliente'   : this.cliente,
                'isEnod'    : this.isEnod,
                'path'      : this.Registro.path,
                'metodos_firmas' : this.metodos_firmas,
                'roles'     :this.user_rol,
                'firmas'    : this.Registro.firmas


                }).then(response => {
                  this.$emit('store');
                  this.errors=[];
                  $('#nuevo').modal('hide');
                  this.$showMessagePreset('success','code-store');
                  this.Registro={}

                }).catch(error => {
                    console.log(error);
                    this.errors = error.response.data.errors;
                    $.each( this.errors, function( key, value ) {
                        toastr.error(value);
                        console.log( key + ": " + value );
                    });

                     if((typeof(this.errors)=='undefined') && (error)){
                     this.$showMessagePreset('error','code-500');

                }
                });
              }
}

}
</script>

