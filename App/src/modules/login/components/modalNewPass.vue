<template>
    <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">
              <form @submit.prevent="handleSubmit">
              <div class="modal-header">
                <slot name="header">
                  Password Restablecido
                </slot>
              </div>
          
              <div class="modal-body">
               <div>
                    <div>
                        <p>Se restablecio el password para el usuario </p>
                        <h4>{{Email}}</h4>
                    </div>
                    <div>
                        <p>el nuevo password es:</p>
                        <h3>{{Pass}}</h3>
                    </div>
               </div>
                 
              </div>

              <div class="modal-footer">
                <slot name="footer">
                  
                    <button class="modal-default-button iu-boton iu-boton--rojo" @click="$emit('close')">
                    Continuar
                  </button>
                </slot>
              </div>
              </form>
            </div>
          </div>
        </div>
</template>

<script>

export default {
    props:{
        Pass:String,
        Email:String
  },
 data(){
    return{     
    
    }
 },
 mounted() {
    console.log(this.pass);
    console.log(this.email);
 }
}
</script>

<style>
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

.modal-container {
  width: 600px;
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