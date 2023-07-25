import guardarInmueblehelper from '../../helpers/guardarInmueble'
import getInmueblehelper from '../../helpers/getinmueblehelper'
//import getProcesohelper from '../../helpers/getProcesoHelper'
//import finsubetapahelper from '../../helpers/finsubetapahelper'
//import guardarImageneshelper from '../../helpers/guardarImageneshelper'
import inmueblesApi from '@/Api/InmueblesApi'



export const guardarInmueble = async ({commit},inmueble) => {   
     const {data} = await guardarInmueblehelper(inmueble)    
     commit('setConfirmacion',data)
  }

  export const getInmueble = async ({commit},id) => {   
     const {data} = await getInmueblehelper(id)   
   commit('setInmueble',data)
   return data;
  }

  export const getInmuebles = async ({commit})=> {
    const {data} = await inmueblesApi.get('inmueble/readall.php')
    const {datos} = data
    console.log(datos);
    commit('setInmuebles',datos)
    //return datos;
   }

   
export const getDescCatalogo = async ({commit},id)=> {
   //const {data} = inmueblesApi.get('catalogos/getxid.php?IdDet='+id) 
   const {data} = await inmueblesApi.get('catalogos/getxid.php?IdDet='+id) 
   console.log(data)
   console.log(commit)
   return data
  }


export const getImagenes = async ({commit},id)=> {
   let iddefault = 0;
   const {data} = await inmueblesApi.get('imagenes/getbyinmueble.php?IdInmueble='+id)
   const {imagenes} = data
   if (imagenes.length == 0) {
      let resp = await inmueblesApi.get('imagenes/getbyinmueble.php?IdInmueble='+iddefault)
      let imgdefault = resp.data.imagenes

      return imgdefault
   }
   console.log(imagenes);
   // for (let id of data){
   //    imags.push({
   //       ...data[id]
   // })
   console.log(commit);
   //console.log(imags);
   return imagenes
  //}
}

//   export const finSubEtapa = async ({commit},subetapa) => {   
//    subetapa.datos.cerrada = "1"
//    const {data} = await finsubetapahelper(subetapa.datos)   
//    subetapa.imagenes.forEach(element => {
//       let obj = guardarImageneshelper(subetapa.datos,element) 
//       console.log(obj);
//    });
//      console.log(data);
//      console.log(subetapa);
//  //commit('setSubEtapa',subetapa)   

// }