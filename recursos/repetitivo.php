<?php
    function getFooter(){
        $footer = "<footer id='footer'>
                        <div class='contenedor-footer'>
                            <h3>GRH</h3>
                            
                            <h4><p>Contacto: <strong>abelardo96.work@gmail.com</strong></p></h4>
                            <p>Sitio desarrollado por Abelardo Aqui.</p>
                            <p>2019</p>
                            <div>Icons made by <a href='https://www.flaticon.es/autores/freepik' target='_blank' rel='noopener noreferrer' title='Freepik'>Freepik</a> from <a href='https://www.flaticon.es/'             title='Flaticon' target='_blank' rel='noopener noreferrer'>www.flaticon.com</a></div>
                        </div>
                    </footer>";
        return $footer;
    }
    function getHeader(){
        $header = "
            <nav>
                <div class='abrir'>
                    <img class='logo' align='left' src='img/logoSup64px.png' alt='GRH'>
                    <span >GRH |  </span>
                    <i id='menu' class='fa fa-bars' ></i>
                </div>
                <ul id='lista'>
                    <li><a href='datos-personales'>Datos personales</a></li>
                    <li><a href='empleadores'>Empleadores</a></li>
                    <li><a href='actividades'>Actividades</a></li>
                    <li><a href='reportes'>Reportes</a></li>
                    <li><a href='#' id='btnCerrarSesion'>Cerrar sesión</a></li>
                    <li><a href='#footer'>Contacto</a></li>
                </ul>
            </nav>
        ";
        return $header;
    }
?>