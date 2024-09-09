//importar boostrap
import './bootstrap';

//importar select2
import select2 from 'select2';

//importar css select2
import 'select2/dist/css/select2.css';

//inicializar select2
select2();

//importar generalidades
import './generalidades.js';

//importar proyectoIndex
import './proyectoIndex.js';

//importar tareasIndex
import './tareasIndex.js';

//Si la ruta coincide con el patrón '/proyectos/###', importa el archivo JS específico
if (window.location.pathname.match(/^\/proyectos\/\d+$/)) {
    import ('./proyectoShow.js');
}

//importar jquery
import $ from "jquery";

//inicializar bootstrap
import * as bootstrap from 'bootstrap';

//inicializar popovers
const popoverTriggerList = $('[data-bs-toggle="popover"]');
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

//inicializar tooltip
const tooltipTriggerList = $('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
