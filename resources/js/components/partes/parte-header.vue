<template>
    <div>
        <div class="box box-custom-enod">
            <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="cliente">Cliente</label>
                        <input type="text" v-model="cliente.nombre_fantasia" class="form-control" id="cliente" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="proyecto">Proyecto</label>
                        <input type="text" v-model="otdata.proyecto" class="form-control" id="proyecto" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" >
                        <label for="obra">Obra N°</label>
                        <div v-if="otdata.obra">
                            <input type="text" v-model="obra" class="form-control" id="obra" min="0" maxlength="15" @input="inputObra" :disabled="otdata.obra || certificado_sn">
                        </div>
                        <div v-else>
                            <v-select v-model="obra" label="obra" :options="obras" :reduce="obras => obras.obra" @input="inputObra" id="obra"></v-select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ot">Orden de Trabajo N°</label>
                        <input type="number" v-model="otdata.numero" class="form-control" id="ot" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {eventEditRegistro} from '../event-bus';
import {eventHeaderParte} from '../event-bus';
import {mapState} from 'vuex';
export default {

    props :{

      otdata : {
        type : Object,
        required : true
      },

      certificado_sn : {
        type : Boolean,
        required : false,
        default : false,
      },

     },

    data() {return {

        cliente:'',
        obra:'',
        obras:[],


    }},

    created : function() {

      this.getCliente();
      this.getObras();
      eventEditRegistro.$on('refreshObra', this.setObra);
      eventHeaderParte.$on('set-obra-header',function(payload){
          this.obra = payload;
          console.log(payload);
          }.bind(this));

    },

    mounted : function() {

        this.setObra()

    },

    watch :{

      obra : function(val){

          this.$emit('set-obra',val)

      }
    },

    computed :{

        ...mapState(['url']),

     },

    methods : {


        inputObra : function(){

            console.log('mando el inputobra',this.obra);
            this.$emit('set-obra',this.obra)

        },

        setObra : function(){

           this.$forceUpdate();
            if(this.otdata.obra ){

               this.obra =  this.otdata.obra ;

            }else{

                this.obra =  '';

            }
        },

        getCliente : function(){

            axios.defaults.baseURL = this.url ;
            var urlRegistros = 'clientes/' + this.otdata.cliente_id + '?api_token=' + Laravel.user.api_token;
             console.log(urlRegistros);
            axios.get(urlRegistros).then(response =>{
            this.cliente = response.data


            });
        },

        getObras : function(){

            axios.defaults.baseURL = this.url ;
            var urlRegistros = 'ots/' + this.otdata.id + '/obras_por_tipo_soldaduras' + '?api_token=' + Laravel.user.api_token;
            axios.get(urlRegistros).then(response =>{
            this.obras = response.data
            });
        }

    }
}
</script>

<style scoped>

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
     background-color: #eee;
}

</style>
