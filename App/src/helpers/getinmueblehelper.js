import axios from 'axios'

const getInmueble = (id) =>{
   //return axios.post('http://localhost/api/users/login.php',
   return axios.get(process.env.VUE_APP_RUTA_API+'inmueble/readone.php?IdInmueble='+id,
       {headers:  {
         'Content-Type': 'application/json'}
       }) 
 }
 
 export default getInmueble