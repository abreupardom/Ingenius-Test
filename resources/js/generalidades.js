//importar jquery
import $ from "jquery"

//inicializar jquery
$(() => {

    console.log('jquery esta listo')

    //cargar estilo a todos los componentes con clase .select2
    $('.select2').select2({
        placeholder: "Selecciona una opción",
        allowClear: true,
        language: {
            noResults: function () {
                return "No hay elementos"
            }
        }
    }).on('change', () => {
        //enviar por el formulario todos los datos de los filtros de las tablas en las vistas index.blade.php
        $('#filtro').submit()
    })

})
