<template>
    <div class="container">
        <div class="card">
            <div class="card-header d-flex">
                <h1 class="justify-content-start flex-grow-1 mt-3 p-2"><b>Sistema Parqueadero</b></h1>
                <div class="justify-content-end p-2"><i class="float-right far fa-user fa-4x"></i></div>
                <img class="parking" src="/image/parqueadero.jpg" alt="" width="100px" height="100px">
            </div>
            <div class="card-body">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" v-bind:class="{active:isAgregar}">
                        <a @click="agregar" class="">Nuevo Vehiculo</a>
                    </li>
                    <li class="breadcrumb-item" v-bind:class="{active:isListado}">
                        <a @click="listado" class="">Listado de Vehiculos</a>
                    </li>
                    <li class="breadcrumb-item" v-bind:class="{active:isDemo}">
                        <a @click="demo" class="">Demo nueva funcionalidad</a>
                    </li>
                </ol>
                <hr>
                <div v-if="modoAgregar">
                    <small class="text-left font-italic">Por favor Escriba los datos del Vehiculo</small>
                    <br><br>
                    <div class="alert alert-primary" v-bind:hidden="isAlert" role="alert">
                        "{{message}}"
                    </div>

                    <form enctype="multipart/form-data" @submit.prevent="agregarVehiculo" class="form-group" >
                        <div class="form-group">
                            <label for="image">Imagen del Vehiculo</label>
                            <input type="file"  @change="getImagen" class="form-control-file" id="imagen" aria-describedby="">
                        </div>
                        <figure>
                            <img width="200" :src="imagen" height="200"  alt="Imagen del vehiculo">
                        </figure>
                        <div class="form-group">
                            <label for="example">Placa</label>
                            <input type="text" v-model="vehiculo.placa" class="form-control" id="placa" aria-describedby="">
                        </div>
                        <div class="form-group">
                            <label for="example">Marca</label>
                            <input type="text" v-model="vehiculo.marca" class="form-control" id="marca" aria-describedby="">
                        </div>
                        <div class="form-group">
                            <label for="example">Tipo</label>
                            <input type="text" v-model="vehiculo.tipo" class="form-control" id="tipo" aria-describedby="">
                        </div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" v-bind:class="{active:isNuevoP}">
                                <a @click="agregarP" class="">Nuevo Propietario</a>
                            </li>
                            <li class="breadcrumb-item" v-bind:class="{active:isListadoP}">
                                <a @click="listadoP" class="">Asociar a Propietario Registrado</a>
                            </li>
                            <div class="justify-content-end p-2"><i class="float-right far fa-user fa-4x"></i></div>
                        </ol>
                        <div v-if="modoAgregarP" class="form-group">
                            <div class="form-group">
                                <label for="example">Nombres y Apellidos</label>
                                <input type="text" v-model="vehiculo.propietario.nombre" class="form-control" id="nombre" aria-describedby="">
                            </div>
                            <div class="form-group">
                                <label for="example">Cedula</label>
                                <input type="text" v-model="vehiculo.propietario.cedula" class="form-control" id="cedula" aria-describedby="">
                            </div>
                        </div>
                        <div v-else class="form-group">
                            <div class="form-group">
                                <label for="example">Propietarios Registrados</label>
                                <select v-model="vehiculo.idP" id="inputState" class="form-control">
                                    <option :value="j.id" v-for="(j,index) in propietarios" :key="index"  selected>
                                        {{j.nombre}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="clearboth">&nbsp;</div>
                        <button type="submit" class="btn btn-primary">Registar Vehiculo</button>
                    </form>
                </div>

                <div v-else-if="modoListado" >
                    <h2>LISTA DE VEHICULOS REGISTRADOS</h2>
                    <hr>
                    <div v-if="vehiculos.length" class="col-md-12">
                        <nav class="navbar navbar-light bg-light mr-auto">
                            <form @submit.prevent="filtroVehiculos()" class="form-inline filter">
                                <select v-model="filter.marca" id="" class="form-control filter">
                                    <option value=""></option>
                                    <option :value="m" v-for="(m,index) in marcas" :key="index"  selected>
                                        {{m}}
                                    </option>
                                </select>
                                <button class="btn btn-outline-success m-2 " type="submit">Filtrar</button>
                            </form>
                        </nav>
                        <div class="clearboth">&nbsp;</div>
                        <div class="clearboth">&nbsp;</div>
                        <div class="row">
                            <div v-for="(i, index) in vehiculos" :key="index" class="thumbnail col-md-3 mr-0" style="border: #1d643b">
                                <img :src="'/image/' + i.imagen" alt="" width="100px" height="100px">
                                <div class="caption">
                                    <h3>{{i.placa}}</h3>
                                    <p>{{i.marca}}</p>
                                    <p><b>{{i.tipo}}</b></p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <p>Aun no tienes vehiculos registrados!</p>
                    </div>
                </div>

                <div v-else >
                    <h2>Demo Nueva funcionalidad</h2>
                    <hr>
                    <div class="">
                        <small>Estimado cliente, ingrese su Array </small>
                        <div class="clearboth">&nbsp;</div>
                        <div class="clearboth">&nbsp;</div>

                        <div class="row">
                            <form id="mi-form" class="mi-form" @submit.prevent="conversor" action="">
                                <div class="form-group">
                                    <button class="float-none btn btn-primary ml-2 " type="submit">Validar</button>
                                </div>
                                <div class="array row container">
                                    <input class="col-md-4 fecha m-2" id="fecha" type="date" data-date-format="YYYY-MM-DD" placeholder="fecha">
                                    <select id="zona" class="form-control col-md-2 zona m-2">
                                        <option value="AM">AM</option>
                                        <option VALUE="PM">PM</option>
                                    </select>
                                    <input class="col-md-2 id m-2" id="id" type="text" placeholder="id">
                                    <input class="col-md-2 valor m-2" id="valor" type="text" placeholder="valor">
                                </div>
                            </form>
                            <a @click="agregarDiv()" class="btn btn-info ml-2">+</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal-->
            <div class="modal fade" tabindex="-1" role="dialog" id="propietario" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Nuevo Propietario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    let moment = require('moment')
    let modal = require('modal-js')
    export default {
        name: 'VehiculoComponent',
        data() {
            return {
                total: 0,
                cantidad: 0,
                imagenMiniatura: '',
                moment,
                modal,
                vehiculos: [],
                propietarios: [],
                message: '',
                vehiculo: {
                    imagen: '',
                    placa: '',
                    marca: '',
                    tipo: '',
                    idP:'',
                    propietario: {
                        nombre:'',
                        cedula: ''
                    }
                },
                isAgregar: false,
                isListado: false,
                isDemo: false,
                modoAgregar: false,
                modoListado:false,
                isAlert: true,
                listCarrito: [],
                edit: {id: '', nombre:'', descripcion:'', precio:'', cantidad: '' },
                ids_productos: [],
                isNuevoP:false,
                isListadoP:false,
                modoAgregarP: false,
                modoListadoP:false,
                filter: {
                    marca: ''
                },
                marcas: [],
                fechas: [],
                zonas:[],
                ids:[],
                valores:[],
                final:[]
            }
        },
        created() {
            this.isAgregar = true
            this.modoAgregar = true
            isAlert: true
            this.getVehiculos()
            this.getPropietarios()
            this.isNuevoP = true
            this.modoAgregarP = true


        },
        computed:{
            imagen(){
                return this.imagenMiniatura
            }
        },
        methods: {
            agregar(){
                console.log('click Agregar')
                this.isAgregar == true
                this.isListado = false
                this.isDemo = false
                this.modoAgregar = true
            },
            listado(){
                this.getVehiculos()
                this.isAgregar == false
                this.isDemo = false
                this.isListado = true
                this.modoAgregar = false
                this.modoListado = true
            },
            demo(){
                this.getVehiculos()
                this.isAgregar == false
                this.isDemo = true
                this.isListado = false
                this.modoAgregar = false
                this.modoListado = false
            },
            agregarP(){
                console.log('click Agregar Propietario')
                this.isAgregarP == true
                this.isListadoP = false
                this.modoAgregarP = true
                this.modoListadoP = false
            },
            listadoP(){
                this.getPropietarios()
                this.isAgregarP == false
                this.isListadoP = true
                this.modoAgregarP = false
                this.modoListadoP = true
            },
            agregarVehiculo(){
                if(this.vehiculo.imagen == '' || this.vehiculo.placa == '' || this.vehiculo.marca == '' || this.vehiculo.tipo == '' || this.vehiculo.propietario == ''){
                    alert('Es necesario completar todos los campos')
                    return
                }

                const vehiculo = this.vehiculo
                console.log(vehiculo);
                //return
                this.vehiculo = {imagen: '', placa: '', marca: '', tipo: '',idP:'', propietario: {nombre:'',cedula:'' }};
                axios.post('/api/vehiculo/new', vehiculo).then(
                    data=> {
                        console.log(data)
                        this.message = 'Vehiculo Registrado!'
                        this.isAlert = false
                        setTimeout(()=>{this.isAlert = true},4000 )
                    }
                ).catch(
                    err=> {
                        console.log(err)
                    }
                )
            },
            getVehiculos(){
                this.vehiculos = []
                this.marcas = []
                axios.get('/api/vehiculos').then(
                    data => {
                        console.log(data.data);
                        this.vehiculos = data.data
                        for (const c  in data.data) {
                            this.marcas.push(data.data[c].marca)
                        }
                        console.log(this.marcas)

                    }
                ).catch(
                    err=> {
                        console.log(err)}
                )
            },
            getPropietarios(){
                axios.get('/api/propietarios').then(
                    data => {
                        console.log(data.data);
                        this.propietarios = data.data
                    }
                ).catch(
                    err=> {
                        console.log(err)}
                )
            },
            filtroVehiculos(){
                console.log('Esto es filtro: '+ this.filter.marca)
                if(this.filter.marca != ''){
                    this.vehiculos = []
                    axios.get('/api/vehiculos/filter/' +this.filter.marca ).then(
                        data => {
                            console.log(data.data);
                            this.vehiculos = data.data
                        }
                    ).catch(
                        err=> {
                            console.log(err)}
                    )
                }else{
                    console.log('el filtro esta vacio')
                    this.getVehiculos();
                }

            },
            conversor(form){
                this.zonas = []
                this.fechas = []
                this.ids = []
                this.valores = []
                var fechas = document.querySelectorAll("#mi-form input[type=date]")
                var zonas = document.querySelectorAll("#mi-form select[id=zona]")
                var ids = document.querySelectorAll("#mi-form input[id=id]")
                var valores = document.querySelectorAll("#mi-form input[id=valor]")

                for (var i = 0; i < fechas.length; i++) {
                    if(fechas[i].value == "") {
                        alert('Atencion! Todos los datos son obligatorios');
                        return;
                    }else{
                        this.fechas.push(fechas[i].value);
                    }
                }
                for (var i = 0; i < zonas.length; i++) {
                    if(zonas[i].value == "") {
                        alert('Atencion! Todos los datos son obligatorios');
                        return;
                    }else{
                        this.zonas.push(zonas[i].value)
                    }
                }

                for (var i = 0; i < ids.length; i++) {
                    if(ids[i].value == "") {
                        alert('Atencion! Todos los datos son obligatorios');
                        return;
                    }else{
                        this.ids.push(ids[i].value)
                    }
                }

                for (var i = 0; i < valores.length; i++) {
                    if(valores[i].value == "") {
                        alert('Atencion! Todos los datos son obligatorios');
                        return;
                    }else{
                        this.valores.push(valores[i].value)
                    }
                }

                for (var j = 0; j < zonas.length; j++) {
                    //this.final = this.fechas[j].concat(this.zonas[j], this.ids[j], this.valores[j]);
                    this.final.push(this.fechas[j],this.zonas[j],this.ids[j],this.valores[j] )
                }
                console.log(this.final);

            },

            agregarDiv(){
                $("#mi-form").append("<div class='row container'>\n" +
                    "    <input class='col-md-4 fecha m-2' id='fecha' type='date' data-date-format='YYYY-MM-DD' placeholder='fecha'>\n" +
                    "    <select id='zona' class='form-control col-md-2 zona m-2'>\n" +
                    "        <option value='AM'>AM</option>\n" +
                    "        <option VALUE='PM'>PM</option>\n" +
                    "    </select>\n" +
                    "    <input class='col-md-2 id m-2' id='id' type='text' placeholder='id'>\n" +
                    "    <input class='col-md-2 valor m-2' id='valor' type='text' placeholder='valor'>\n" +
                    "</div>");
            },
            getImagen(e){
                let file = e.target.files[0]
                console.log(file)
                //this.producto.imagen = file
                this.uploadImage(file)

            },
            uploadImage(file){
                let leer = new FileReader();
                leer.onload= (e) => {
                    this.imagenMiniatura = e.target.result;
                    this.vehiculo.imagen = e.target.result;
                }
                leer.readAsDataURL(file)
            }
        }
    }
</script>
<style scoped>
    .filter {
        width: 70%;
    }
    .parking {
        /* cambia estos dos valores para definir el tamaño de tu círculo */
        height: 100px;
        width: 100px;
        /* los siguientes valores son independientes del tamaño del círculo */
        background-repeat: no-repeat;
        background-position: 50%;
        border-radius: 50%;
        background-size: 100% auto;
    }

</style>
