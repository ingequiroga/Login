import { jsPDF } from "jspdf";

export function generarpdf(data){
      
  let y = 30
  const doc = new jsPDF('p', 'px');
  let width = doc.internal.pageSize.getWidth();
      
  doc.setFontSize(18)
  doc.text('Logo', 30, y)
  //Etiquetas
  doc.setFont("Montserrat", "bold"); //Tipo de fuente
  doc.setFontSize(12)
  doc.text('Nombre del Agente:', 120, y)
  doc.text('Fecha:', 320, y)
    
  let currentDate = new Date();
  let day = currentDate.getDate();
  let month = currentDate.getMonth() + 1;
  let year = currentDate.getFullYear();
  let formattedDate = day.toString().padStart(2, '0') + '/' + month.toString().padStart(2, '0') + '/' + year.toString();
   
  let yFichaT = 300
  let yCaract = 300
  let yFoot = 480
    //Datos
  doc.setFont("Montserrat", "normal");
  doc.text(data.persona.nombre + ' '+ data.persona.apellido, 205, 30)
  doc.text(formattedDate, 350, 30)


  var imag = document.createElement('img');
  imag.src = data.imagenes[0].data;
  imag.alt = "Imagen";
  doc.addImage(imag, "JPG", 30, 60, width-60, 200);

    
  doc.setFont("Montserrat", "bold");
  doc.setFontSize(14)
  doc.text('FICHA TÉCNICA', 30, yFichaT)
  doc.text('CARACTERISTICAS', 260, yCaract)
  doc.text('DESCRIPCION', 30, yCaract + 120)
  doc.text('PRECIO',width/2,yFoot,'center')
  doc.setFontSize(12)
  doc.text('Ubicacion:', 30, yFichaT+20)
  doc.text('Municipio:', 30, yFichaT+40)
  doc.text('Medidas:', 30, yFichaT+60)
  doc.text('Estatus:', 30, yFichaT+80)
  doc.text('Tipo de Inmueble:', 260, yCaract + 20)
  doc.text('Dormitorios:', 260, yCaract + 40)
  doc.text('Baños:', 260, yCaract + 60)
  doc.text('Cochera:', 260, yCaract + 80)
    
    
  doc.setFont("Montserrat", "normal");
  doc.text(data.inmueble.Colonia, 80, yFichaT+20) //ubicacion
  doc.text(data.inmueble.NomMunic, 80, yFichaT+40) //Municipio

    let texto = data.inmueble.m2superficie + " m"

    doc.text(texto, 70, yFichaT+60) //superficie
    let posiciónFinalTexto = doc.getTextDimensions(texto);
    doc.setFontSize(7);
    doc.text("2", 70 + posiciónFinalTexto.w, yFichaT+55); //superindice para m2 
    doc.setFontSize(12)
    doc.text(' de superficie', 75 + posiciónFinalTexto.w, yFichaT+60) //superficie
    doc.text(data.estatus, 65, yFichaT+80) //Estatus
    doc.text(data.tipo, 335, yCaract + 20) //Tipo de Inmueble
    doc.text(data.inmueble.Dormitorios.toString(), 315, yCaract + 40) //Dormitorios
    doc.text(data.inmueble.Banos.toString(), 290, yCaract + 60) //Baños
    doc.text('Baños', 300, yCaract + 60) //Baños
    doc.text(data.inmueble.Cochera.toString(), 300, yCaract + 80) //Cochera
    doc.text('Autos', 310, yCaract + 80) //Cochera

    //Descripcion Adicional
    doc.setFontSize(14);
    let lines = doc.splitTextToSize(data.inmueble.DescripcionAdicional, (width-60))
    doc.text(lines, 30, yCaract + 140) 

   
    //Footer
    doc.setFontSize(14)
    doc.text('$ ' + data.inmueble.montoVenta,width/2,yFoot+20,'center');
    doc.text('Solo Contado',width/2,yFoot+40,'center');



  let binary = doc.output();
  let objpdf = binary ? btoa(binary) : "";
    
  return objpdf;


  //console.log(data);
}