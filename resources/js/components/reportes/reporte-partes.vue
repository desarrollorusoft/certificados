
<template>
    <div class="row">
        <div class="col-md-3">
            <div class="box box-custom-enod">
                <div class="box-body box-profile">
                    <div v-if="cliente && cliente.path" style="text-align:center">
                        <img :src="'/' + cliente.path" alt="..." width="120">
                    </div>
                    <h4 v-if="cliente" class="profile-username text-center">
                        {{cliente.nombre_fantasia}}
                    </h4>

                    <p v-if="ot" class="text-muted text-center">
                        {{ot.proyecto}}
                    </p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item pointer">
                            <div v-show="!selCliente">
                                <span class="titulo-li">Cliente</span>
                                <a @click="selCliente = !selCliente" class="pull-right">
                                    <div v-if="cliente">{{cliente.nombre_fantasia}}</div>
                                    <div v-else><span class="seleccionar">Seleccionar</span></div>
                                </a>
                            </div>
                            <v-select v-show="selCliente" v-model="cliente" label="nombre_fantasia" :options="clientesOperador" @input="CambioCliente()" ></v-select>

                        </li>
                        <li class="list-group-item pointer">
                            <div v-show="!selOt">
                                <span class="titulo-li">OT</span>
                                <a @click="selOt = !selOt" class="pull-right">
                                    <div v-if="ot">{{ot.numero}}</div>
                                    <div v-else><span class="seleccionar">Seleccionar</span></div>
                                </a>
                            </div>
                            <v-select v-show="selOt" v-model="ot" label="numero" :options="ots" @input="CambioOt()" ></v-select>
                        </li>
                        <li class="list-group-item pointer">
                            <div v-show="!selObra">
                                <span class="titulo-li">Obra</span>
                                <a @click="seleccionarObra()" class="pull-right">
                                    <div v-if="obra || ot.obra">
                                        {{obra.obra}}
                                    </div>
                                    <div v-else>
                                        <span class="seleccionar">Seleccionar</span>
                                    </div>
                                </a>
                            </div>
                            <v-select v-show="selObra" v-model="obra" label="obra" :options="obras" @input="CambioObra()"></v-select>
                        </li>
                        <li class="list-group-item pointer">
                            <div v-show="!selGenerador">
                                <span class="titulo-li">Generador</span>
                                <a @click="selGenerador = !selGenerador" class="pull-right">
                                    <div v-if="generador">{{generador.name}}</div>
                                    <div v-else><span class="seleccionar">Seleccionar</span></div>
                                </a>
                            </div>
                            <v-select v-show="selGenerador" v-model="generador" label="name" :options="users_empresa" @input="selGenerador = !selGenerador"></v-select>

                        </li>
                        <li class="list-group-item pointer">
                            <span class="titulo-li">Solo sin certificado</span>  <input class="checkbox-right" type="checkbox" v-model="filtrado" >
                        </li>
                        <li class="list-fecha list-group-item pointer">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <date-picker v-model="fecha_desde" value-type="YYYY-MM-DD" format="DD-MM-YYYY" placeholder="Desde" ></date-picker>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <date-picker v-model="fecha_hasta" value-type="YYYY-MM-DD" format="DD-MM-YYYY" placeholder="Hasta" ></date-picker>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <a  @click="Buscar()">
                        <button class="btn btn-enod  btn-block"><span class="fa fa-search"></span>
                            Buscar
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-9">

            <tabs :options="{ useUrlFragment: false }">
                 <tab name="Partes">
                    <div  v-if="(tablaPartes.data && tablaPartes.data.length)">
                        <div class="row">
                            <div class="col-lg-4">
                                <button @click="exportarPdf">Exportar PDF</button>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 25px;">
                        <div class="col-lg-12">
                        <div v-if="(tablaPartes.data && tablaPartes.data.length)">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Detalle</h3>
                                </div>
                                <div class="box-body">
                                <div class="table-responsive">
                            <table class="table table-striped table-condensed">
                              <tbody>
                                  <tr>
                                      <th class="col-md-1">Fecha</th>
                                      <th  style="text-align:center" class="col-md-1">Parte</th>
                                      <th style="text-align:center" class="col-md-2">Cliente</th>
                                      <th style="text-align:center" class="col-md-2">Generador</th>
                                      <th style="text-align:center" class="col-md-1">Obra</th>
                                      <th style="text-align:center" class="col-md-1">Ot</th>
                                      <th style="text-align:center" class="col-md-1">N°Certificado</th>
                                  </tr>
                                  <tr v-for="(item,k) in tablaPartes.data" :key="k">
                                      <td> {{ item.fecha}}</td>
                                      <td style="text-align:center">
                                        <a :href="'/pdf/parte/' + item.numero + '/final' " target="_blank" title="Informe"><span>{{ item.numero_formateado }}</span></a>
                                      </td>
                                      <td style="text-align:center"> {{ item.cliente}}</td>
                                      <td style="text-align:center"> {{ item.generador}}</td>
                                      <td style="text-align:center"> {{ item.obra}}</td>
                                      <td style="text-align:center"> {{ item.ot}}</td>
                                      <td style="text-align:center">
                                        <a :href="'/pdf/certificado/' + item.certificado + '/final' " target="_blank" title="Informe"><span>{{ item.certificado_formateado }}</span></a>
                                      </td>
                                  </tr>
                              </tbody>
                            </table>
                                </div>
                                </div>
                          </div>
                        </div>
                    <div v-else>
                        <h4>No hay datos para mostrar</h4>
                    </div>
                        </div>
                    </div>
                </tab>
            </tabs>
          <pagination :data="tablaPartes" @pagination-change-page="Buscar" :limit="3"><span slot="prev-nav">&lt; Previous</span>
          <span slot="next-nav">Next &gt;</span> </pagination>
        </div>

         <loading
            :active.sync="isLoading"
            :loader="'bars'"
            :color="'red'">
         </loading>
    </div>
</template>

<script>
import moment from 'moment';
import { imgDataLogo } from './imagenes-reportes'
import Datepicker from 'vuejs-datepicker';
import {mapState} from 'vuex';
import {en, es} from 'vuejs-datepicker/dist/locale'
import Tabs from 'vue-tabs-component';
import Loading from 'vue-loading-overlay';
import ChartJsPluginDataLabels from 'chartjs-plugin-datalabels';
import DoughnutChart from '../chart.js/DoughnutChart.js'
import BarChart from '../chart.js/BarChart.js'
import jsPDF from 'jspdf';
import 'jspdf-autotable';
import PieChart from '../chart.js/PieChart.js'
import html2canvas from 'html2canvas-render-offscreen';
export default {

    components: {

      Datepicker,
      Loading,
      DoughnutChart,
      BarChart,
      PieChart,
      ChartJsPluginDataLabels
    },

    props: {

      user : {
        type : Object,
        required : true,
      },

    },

    data() { return {

        en: en,
        es: es,
        cliente:'',
        generador: '',
        filtrado: false,
        ots:[],
        ot:'',
        obras:[],
        obra:'',
        fecha_desde:null,
        fecha_hasta:null,
        selCliente:false,
        selGenerador:false,
        selOt:false,
        selObra:false,
        selComponente:false,
        fecha_actual: moment(new Date()).format('DD-MM-YYYY'),
        users_empresa: [],
        /* Tabla PARTES */
        tablaPartes:{},

        /* Tabla CERTIFICADOS */
        tablaCertificados:{},

     }

    },

    mounted() {

        this.$store.dispatch('loadClientesOperador',this.user.id);
        this.getUsersEmpresa();
    },

    computed :{

        ...mapState(['isLoading','clientesOperador','url']),
        filtrado_sn : function(){
            return (this.filtrado === true) ? 1 : 0
        },
    },

methods :{

    async exportarPdf (){
     console.log('entra')
     this.$store.commit('loading', true);
     let tablaPartesPdf = [];

        try {
            console.log('entra al try')
            let url8 = 'reporte-partes' + '/cliente/' + (this.cliente ? this.cliente.id : 'null') + '/user/' + (this.generador ? this.generador.id : 'null') + '/ot/' + (this.ot ? this.ot.id : 'null' )  + '/obra/' + (this.obra ? this.obra.obra.replace('/','--') : 'null' ) + '/fecha_desde/' + this.fecha_desde + '/fecha_hasta/' + this.fecha_hasta + '/filtrado/' + this.filtrado_sn + '/paginado_sn/' + 0 + '?api_token=' + Laravel.user.api_token;;
            let res8 = await axios.get(url8);
            console.log(res8)
            tablaPartesPdf = res8.data;
            console.log(tablaPartesPdf)

        }catch(error){

        }finally  {this.$store.commit('loading', false);}

        const doc = new jsPDF("landscape", "mm", "a4");
        doc.setFont("serif");
        console.log(tablaPartesPdf)
        doc.setFontSize(20);
        doc.autoTable({
            startY: 45,
            body: tablaPartesPdf,
            columns: [
                { header: 'Fecha', dataKey: 'fecha' },
                { header: 'Parte', dataKey: 'numero_formateado' },
                { header: 'Cliente', dataKey: 'cliente' },
                { header: 'Generador', dataKey: 'generador' },
                { header: 'Obra', dataKey: 'obra' },
                { header: 'Ot', dataKey: 'ot' },
                { header: 'N°Certificado', dataKey: 'certificado_formateado' },
            ],
            columnStyles: {
                0: { cellWidth: 30, fontSize: 8, halign: 'left' },
                1: { cellWidth: 40, fontSize: 8, halign: 'left' },
                2: { cellWidth: 60, fontSize: 8, halign: 'left' },
                3: { cellWidth: 40, fontSize: 8, halign: 'left' },
                4: { cellWidth: 40, fontSize: 8, halign: 'left' },
                5: { cellWidth: 30, fontSize: 8, halign: 'left' },
                6: { cellWidth: 30, fontSize: 8, halign: 'left' },
            },
            margin: { top: 45 },
            })
        this.prepareHeaderPdf(doc);
        window.open(doc.output('bloburl'));
    },
        prepareHeaderPdf(doc){
        var pageCount = doc.internal.getNumberOfPages();
            for(let i = 0; i < pageCount; i++) {
                doc.setPage(i);

                /* header logo */
                doc.setFontSize(16);
                doc.setFont("bold");
                doc.text("Reporte Partes", 125,15)
                doc.setFontSize(8);
                doc.text("FECHA :",245,13)
                doc.text("PAGINA:",245,18);
                doc.setFont("normal");
                doc.text(this.fecha_actual,267,13)
                doc.text(doc.internal.getCurrentPageInfo().pageNumber + " de " + pageCount,269,18);
                doc.addImage(imgDataLogo, 'PNG', 13, 10,39.12, 12);

                /* linea amarilla */

                doc.setLineWidth(0.8);
                doc.setDrawColor(255,204,0);
                doc.line(11, 25, 285, 25);

                /* header entre lineas */
                doc.setFontSize(10);
                doc.setFont("bold");

                doc.text("Cliente: ", 14, 30);
                doc.text("OT Nº:", 100, 30);
                doc.text("Desde:", 180, 30);
                doc.text("Hasta:", 245, 30);

                doc.text("Generador:", 14, 38);
                doc.text("Obra:", 100, 38);
                doc.text("Solo sin certificado:", 180, 38);

                /* Datos del header*/
                doc.setFont("normal");
                doc.setFont("italic");

                doc.text(this.ot ? this.ot.numero.toString() : '', 112, 30)
                doc.text((this.fecha_desde ? moment( this.fecha_desde).format("DD/MM/YYYY") : ' '), 192, 30)
                doc.text((this.fecha_hasta ? moment( this.fecha_hasta).format("DD/MM/YYYY") : ' '), 255, 30)
                doc.text(this.cliente ? this.cliente.nombre_fantasia : '', 32, 30)
                doc.text(this.generador ? this.generador.name : '', 32, 38)
                doc.text(this.obra ? this.obra.obra : '', 112, 38)
                doc.text(this.filtrado_sn ? 'SI' : 'NO', 210, 38)

                /* linea amarilla */

                doc.setLineWidth(0.8);
                doc.setDrawColor(255,204,0);
                doc.line(11, 42, 285, 42);
            }
    },
    async CambioCliente (){

        this.selCliente = !this.selCliente;
        this.ot = '';
        this.selOt =false;
        this.obra = '';
        this.selObra =false;
        this.componente = '';
        this.selComponente = false;
        this.fecha_desde = null;
        this.fecha_hasta = null;
        if(this.cliente){

            this.$store.commit('loading', true);
            var urlRegistros = 'clientes/' + this.cliente.id + '/ots/' +'?api_token=' + Laravel.user.api_token;
            try {
                let res = await axios.get(urlRegistros);
                this.ots = res.data;
            }catch(error){

            }finally {this.$store.commit('loading', false);}

        }
    },

    async CambioOt (){

        this.selOt = !this.selOt;
        this.obra = '';
        this.selObra = false;
        this.componente = '';
        this.selComponente = false;
        this.$store.commit('loading', true);
        var urlRegistros = 'ots/' + this.ot.id + '/obras/' +'?api_token=' + Laravel.user.api_token;
        try {
            let res = await axios.get(urlRegistros);
            this.obras = res.data;
        }catch(error){

        }finally  {this.$store.commit('loading', false);}

        if(this.ot.obra){
            this.obra = { obra : this.ot.obra}
        }
    },

   async Buscar(page = 1) {
     this.$store.commit('loading', true);
     this.tablaPartes = {};

        try {
            let url4 = 'reporte-partes' + '/cliente/' + (this.cliente ? this.cliente.id : 'null') + '/user/' + (this.generador ? this.generador.id : 'null') + '/ot/' + (this.ot ? this.ot.id : 'null' )  + '/obra/' + (this.obra ? this.obra.obra.replace('/','--') : 'null' ) + '/fecha_desde/' + this.fecha_desde + '/fecha_hasta/' + this.fecha_hasta + '/filtrado/' + this.filtrado_sn + '/paginado_sn/' + 1 + '?page='+ page + '&api_token=' + Laravel.user.api_token;
            let res4 = await axios.get(url4);
            this.tablaPartes = res4.data;

        }catch(error){

        }finally  {this.$store.commit('loading', false);}

   },

    getUsersEmpresa : function(){
        axios.defaults.baseURL = this.url ;
        var urlRegistros = 'users/empresa' + '?api_token=' + Laravel.user.api_token;
        axios.get(urlRegistros).then(response =>{
        this.users_empresa = response.data
        });
    },
   async seleccionarObra(){
        if(this.ot && !this.ot.obra){
            this.selObra = !this.selObra;
        }
    },

    async CambioObra (){

        this.obra = this.obra == null ? '' : this.obra;
        this.selObra = !this.selObra;

    },


}}

</script>
<style scoped>

 .checkbox-right {


    float: right ;
    margin-right: 15px;
  }
</style>
