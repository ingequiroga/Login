<template>
    <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">
              <div class="modal-body">
                 <button class="btn btn-primary" @click="$emit('close')">Cerrar</button>  
                 <div class="mt-5">
                     <embed id="embArchivo" type="application/pdf" style="width:100%; height:30rem;" />
                </div>           
              </div>
            </div>
          </div>
        </div>
</template>

<script>


export default {
 props:{
        imagen: {}
    },
 data(){
    return{
    }
 },
 methods:{
 },
   mounted(){
    console.log("mounted")
      var subs = this.imagen.data.split(',')
    var pdf = subs[1]
    
    var visoremb = document.getElementById('embArchivo');
    visoremb.src = "data:application/pdf;base64," + pdf;
    },
}
</script>

<style scoped>
    .modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-body{
    height: 100%;
}

.modal-container {
  width: 50rem;
  height: 50rem;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style>