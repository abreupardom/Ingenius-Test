//importar jquery
import $ from 'jquery';

//inicializar bootstrap
import * as bootstrap from 'bootstrap';

$(()=>{

    /**
     * mostrar el modal de insertar tareas si este presenta algun error
     */
    const modal = () => {
        var myModal = new bootstrap.Modal($('#staticBackdrop'));
        if ($('.invalid-feedback').css('display') === 'block') {
            myModal.show();
        }
    }

    //llama a la funcion de mostrar modal
    modal();
})


