<?php


include 'bdViajeFeliz.php'; 
include 'Empresa.php';
include 'Viaje.php'; 
include 'Persona.php';
include 'ResponsableV.php';
include 'Pasajero.php';

$bd = new bdViajeFeliz();

if ($bd->Iniciar()){
    $objPersona = new Persona();
    $objViaje = new Viaje();
    $objResponsable = new ResponsableV();
    $objPasajero = new Pasajero();
    $objEmpresa = new Empresa();

function menuPrincipal(){
    echo "
    |*************************************************************************|                                                                         
    |                         MENU PRINCIPAL                                  |
    |                  1) Cargar empresa precargada.                          |
    |                  2) Crear una empresa desde 0.                          |
    |                  3) Agregar Viaje (necesita una empresa cargarda).      |          
    |                  4) Cerrar programa.                                    |       
    |                                                                         |
    |*************************************************************************|
    \n";
}

function menuEmpresa(){
    echo "
    |*************************************************************************|                                                                         
    |                           MENU DE LA EMPRESA                            |
    |                        1) MENU del viaje:                               |
    |                        2) MENU del pasajero:                            |      
    |                        3) MENU del responsable:                         |
    |                        4) Volver:                                       | 
    |                                                                         |
    |*************************************************************************|
    \n";
}

function menuViaje(){
    echo "
    |*************************************************************************|                                                                         
    |                   Modificar | eliminar el viaje                         |
    |                   1) Eliminar viaje:                                    |
    |                   2) Modificar viaje:                                   |
    |                   3) Volver:                                            |
    |                                                                         |
    |*************************************************************************|
    \n";
}


function menuResponsable(){
    echo "
    |*************************************************************************|                                                                         
    |                        MENU RESPONSABLE                                 |
    |                        1 ) Modificar al resposanble:                    |
    |                        2 ) Volver:                                      | 
    |                                                                         |
    |*************************************************************************|
    \n";
}

function menuPasajero(){
    echo "
    |*************************************************************************|                                                                         
    |                        MENU PASAJERO                                    |
    |                        1) Agregar pasajero:                             |
    |                        2) Eliminar el pasajero:                         |
    |                        3) Modificar el pasajero:                        |
    |                        4) Volver:                                       | 
    |                                                                         |
    |*************************************************************************|
    \n";
}

do {
    menuPrincipal();
    $opcionPrincipal = trim(fgets(STDIN));
    
    switch ($opcionPrincipal) {
        case 1:
            if ($coleccionEmpresas = $objEmpresa->listar()){
                $textoEmpresas = '';
                $i=0;
                foreach ($coleccionEmpresas as $empresa) {
                    if($i % 2 == 0){
                        echo "\033[36mEmpresa numero $i\n" . $empresa . "-------------------\n" . "y sus vuelos son: \n" . $empresa->mostrarViajes() . "\033[0m";
                    } else {
                        echo "\033[35mEmpresa numero $i\n" . $empresa . "-------------------\n" . "y sus vuelos son: \n" . $empresa->mostrarViajes() . "\033[0m";
                    }
                   $i++;
                }
            } else {
                echo "\033[42mCARGAMOS LA EMPRESA PRECARGADA\n\033[0m";
                
                    $datosEmpresa = ['idEmpresa' => null,'enombre' => 'empresa1','edireccion' => 'Lagos del Rios', 'coleccionViajes' => []];
                    $objEmpresa->cargar($datosEmpresa);
                    $objEmpresa->insertar();
                    $datosResponsable = ['documento' => 95984211,'rnumeroEmpleado' => null,'rnumeroLicencia' => '1','nombre' => 'Lourdes','apellido' => 'Gonzalez','ptelefono' => '77'];
                    $objResponsable->cargar($datosResponsable);
                    $objResponsable->cargar($datosResponsable);
                    $objResponsable->insertar();
                    
                    $datosViaje = ['idViaje' => null,'destino' => 'Buenos Aires','cantidadMaximaPasajeros' => 100,'objEmpresa' => $objEmpresa, 'objEmpleado' => $objResponsable,'coleccionPasajeros' => []];
                    $objViaje->cargar($datosViaje);
                    $objViaje->insertar();
                    
                    $coleccionPasajeros = [
                        ['nombre' => 'Miguel', 'apellido' => 'Soto', 'documento' => '1', 'ptelefono' => '1538', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Minato', 'apellido' => 'Namikaze', 'documento' => '2', 'ptelefono' => '1539', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Miles', 'apellido' => 'Morales', 'documento' => '3', 'ptelefono' => '1540', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Gwen', 'apellido' => 'Stacy', 'documento' => '4', 'ptelefono' => '1541', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Miguel', 'apellido' => 'Ohara', 'documento' => '5', 'ptelefono' => '1542', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Peter', 'apellido' => 'Parker', 'documento' => '6', 'ptelefono' => '1543', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Steve', 'apellido' => 'Rogers', 'documento' => '7', 'ptelefono' => '1544', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Tony', 'apellido' => 'Stark', 'documento' => '8', 'ptelefono' => '1545', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Satoru', 'apellido' => 'Gojo', 'documento' => '9', 'ptelefono' => '1546', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Levi', 'apellido' => 'Ackerman', 'documento' => '10', 'ptelefono' => '1547', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Rengoku', 'apellido' => 'Kyojuro', 'documento' => '11', 'ptelefono' => '1565', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Tanjiro', 'apellido' => 'Kamado', 'documento' => '12', 'ptelefono' => '1566', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Eren', 'apellido' => 'Jeager', 'documento' => '13', 'ptelefono' => '1567', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Armin', 'apellido' => 'Arlert', 'documento' => '14', 'ptelefono' => '1568', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Isagi', 'apellido' => 'Yoichi', 'documento' => '15', 'ptelefono' => '1569', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Bachira', 'apellido' => 'Meguru', 'documento' => '16', 'ptelefono' => '1570', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Aoi', 'apellido' => 'Todou', 'documento' => '17', 'ptelefono' => '1571', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Mai', 'apellido' => 'Sakurajima', 'documento' => '18', 'ptelefono' => '1572', 'idViaje' => $objViaje->getIdViaje()],
                        ['nombre' => 'Naruto', 'apellido' => 'Uzumaki', 'documento' => '19', 'ptelefono' => '1573', 'idViaje' => $objViaje->getIdViaje()],
                        ];

                    foreach ($coleccionPasajeros as $pasajero) {
                        $objPasajero->cargar($pasajero);
                        $objPasajero->insertar();
                    }

                    $objViaje->setColeccionPasajero($objPasajero->listar("idviaje = ". $objViaje->getIdViaje()));
                    
                    $viajes = $objEmpresa->getColeccionViajes();
                    array_push($viajes, $objViaje);
                    $objEmpresa->setColeccionViajes($viajes);
                
                    
                    echo "\033[32m*********************************\nLa empresa que está cargada es:\n" . $objEmpresa . "y sus viajes son:\033[0m";
                    $viajes = $objViaje->listar('idempresa = '. $objEmpresa->getIdEmpresa());
                    foreach ($viajes as $viaje) {
                        echo $viaje;
                    }
            }       
                do{

                echo "\033[33mIngrese el ID del viaje para cargar sus datos:\033[0m\n";
                $idViaje = trim(fgets(STDIN));

                if ($idViaje < 0 || !is_numeric($idViaje) || $objViaje->Buscar($idViaje) == false){
                    echo "\033[31mNo se encontro el viaje \033[0m\n";
                } else{
                    $objViaje->Buscar($idViaje);
                    echo "\033[32mSe encontro el viaje \033[0m\n";
                }
                } while($idViaje < 0 || !is_numeric($idViaje) || $objViaje->Buscar($idViaje) == false);

            do {
                
                menuEmpresa();
                $opcionDatos = trim(fgets(STDIN));
                
                switch($opcionDatos) {

                    case 1: 
                        $textoFallo = "No existe el viaje\n";
                        do {
                            if ($objViaje->Buscar($idViaje)) {
                                echo "\033[0;33m************\nDatos del viaje:\ncodigo del viaje: {$objViaje->getIdViaje()}\ndestino: {$objViaje->getDestino()}\ncantidad Maxima de pasajeros: {$objViaje->getCantidadMaximaPasajeros()}\n************\033[0m";

                                menuViaje();
                                $opcionViaje = trim(fgets(STDIN));
                                switch ($opcionViaje) {
                                    case 1: 

                                        echo "1) Eliminar el viaje:\n";
                                        echo "Para eliminar el viaje, vamos a tener que borrar el responsable y los pasajeros";

                                        foreach ($objViaje->getColeccionObjsPasajeros() as $pasajero) {
                                            $objPasajero->Buscar($pasajero->getDocumento());
                                            $objPasajero->eliminar();
                                        }
                                        $objResponsable->Buscar($objViaje->getResponsableV()->getDocumento());
                                        $objPersona->Buscar($objViaje->getResponsableV()->getDocumento());
                                        $objPersona->eliminar();
                                        $objResponsable->eliminar();
                                        $objViaje->eliminar();
                                        $textoFallo = "\n\033[32mEl viaje se eliminó correctamente \033[0m\n";
                                        break;
                                    case 2:
                                            echo "2) Modificar viaje:\n";
                                        do {
                                            echo "Ingrese el destino del viaje nuevo: ";
                                            $destinoNuevo = trim(fgets(STDIN));
                                            echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
                                            $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));

                                            if ($cantidadMaximaPasajerosNueva < 0 || !is_numeric($cantidadMaximaPasajerosNueva)) {
                                                echo "datos invalidos en la capacidad de pasajeros \n";
                                            }
                                        } while ($cantidadMaximaPasajerosNueva < 0 || !is_numeric($cantidadMaximaPasajerosNueva));

                                        $datosNuevos = ['idViaje' => $idViaje, 'destino' => $destinoNuevo, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosNueva, 'objEmpresa' => $objViaje->getobjEmpresa(), 'objEmpleado' => $objViaje->getResponsableV(), 'coleccionPasajeros' => $objViaje->getColeccionObjsPasajeros()];
                                        $objViaje->cargar($datosNuevos);

                                        if ($objViaje->modificar()) {
                                            echo "\033[32mSe modifico el viaje correctamente , sus nuevos datos son:\n\033[0m";
                                        } else {
                                            echo "Probablemente no existe una empresa creada \n";
                                        }
                                        break;
                                    case 3:
                                        break;
                                }
                            } else {
                                echo $textoFallo;
                                $opcionViaje = 3;
                            }
                        } while ($opcionViaje != 3);
                        break;

                    case 2: 
                        do {
                            if($objViaje->getColeccionObjsPasajeros() == []){
                                echo "\033[31mEste viaje no tiene pasajeros creados\033[0m\n";
                            } else {
                                echo $objViaje->mostrarPasajeros();
                            }
                            menuPasajero();
                            $opcionPasajero = trim(fgets(STDIN));
                            switch ($opcionPasajero) {
                                case 1:
                                    $objViaje->Buscar($idViaje);
                                    echo "1 - Agregar a un pasajero \n";
                                    if ($objViaje->cantidadPasajerosActual() < $objViaje->getCantidadMaximaPasajeros()) {
                                        do {
                                        echo "Ingrese el nombre del pasajero: ";
                                        $nombrePasajero = trim(fgets(STDIN));
                                        echo "Ingrese el apellido del pasajero: ";
                                        $apellidoPasajero = trim(fgets(STDIN));
                                        do{
                                            echo "Ingrese el documento del pasajero: ";
                                            $documentoPasajero = trim(fgets(STDIN));
                                            if ($documentoPasajero < 0 || !is_numeric($documentoPasajero) || $objPersona->Buscar($documentoPasajero)){
                                                echo "El documento ya existe o es invalido\n";
                                            }
                                        } while ($documentoPasajero < 0 || !is_numeric($documentoPasajero) || $objPersona->Buscar($documentoPasajero));
                                        echo "Ingrese el telefono del pasajero: ";
                                        $telefonoPasajero = trim(fgets(STDIN));
                                        if($telefonoPasajero < 0 || !is_numeric($telefonoPasajero) || $nombrePasajero == "" || $apellidoPasajero == "" || $documentoPasajero == "" || $telefonoPasajero == "" || is_numeric($nombrePasajero) || is_numeric($apellidoPasajero)){
                                            echo "Datos invalidos\n";
                                        }
                                        } while ($telefonoPasajero < 0 || !is_numeric($telefonoPasajero) || $nombrePasajero == "" || $apellidoPasajero == "" || $documentoPasajero == "" || $telefonoPasajero == "" || is_numeric($nombrePasajero) || is_numeric($apellidoPasajero));
                                        $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $telefonoPasajero, 'idViaje' => $idViaje];
                                        $objViaje->crearPasajero($datosPasajero);
                                    } else {
                                        echo "\033[31mNo se pueden agregar más pasajeros porque el viaje esta lleno\n\033[0m";
                                    }
                                    break;
                                case 2:
                                    echo "2) Eliminar pasajero\n";
                                    echo "Ingrese el DNI del pasajero que quiere eliminar:";
                                    $dniPasajero = trim(fgets(STDIN));
                                    if($objPersona->buscar($dniPasajero)){
                                        if($objViaje->eliminarPasajero($dniPasajero)){
                                            echo "\033[42mSe eliminó el pasajero correctamente\n\033[0m";
                                        } else {
                                            echo "\033[41m No se encontró el DNI del pasajero \n \033[0m";
                                        }
                                    } else {
                                        echo "\033[41m No se encontró el DNI del pasajero \n \033[0m";
                                    }

                                    break;
                                case 3:
                                    echo "3) Modificar pasajero:\n";
                                    echo "Ingrese el DNI del pasajero que quiera modificar:";
                                    $dniPasajero = trim(fgets(STDIN));

                                    if ($objPersona->Buscar($dniPasajero)) {
                                        echo "Ingrese el nuevo nombre:";
                                        $nuevoNombre = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo apellido:";
                                        $nuevoApellido = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo numero de telefono:";
                                        $nuevoNumTelefono = trim(fgets(STDIN));
                                        $datosPasajero = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $dniPasajero, 'ptelefono' => $nuevoNumTelefono, 'idViaje' => $idViaje];
                                        $objViaje->modificarPasajero($datosPasajero);

                                    } else {
                                        echo "\033[41m No se encontró el DNI del pasajero \n \033[0m";
                                    }
                                    break;
                                case 4:
                                    break;
                            }

                        } while ($opcionPasajero != 4);
                        break;
                        
                        
                    case 3:
                        do {
                            echo "\033[34m".$objViaje->getResponsableV()."\033[0m";

                            menuResponsable();
                            $opcionResponsable = trim(fgets(STDIN));      
                    
                            switch ($opcionResponsable) {
                                case 1:
                                    echo "\033[34m".$objViaje->getResponsableV()."\033[0m";
                                    echo "\033[33m\nModificar Responsable\n\033[0m";
                                        do{
                                        echo "Ingrese el nuevo nombre:";
                                        $nuevoNombre = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo apellido:";
                                        $nuevoApellido = trim(fgets(STDIN));
                                        echo "Ingrese el nuevo numero de telefono:";
                                        $nuevoNumTelefono = trim(fgets(STDIN));
                                        echo "Ingrese el numero de licencia nuevo:";
                                        $nuevaLicencia = trim(fgets(STDIN));
                                        if ($nuevoNumTelefono < 0 || !is_numeric($nuevoNumTelefono) || $nuevaLicencia < 0 || !is_numeric($nuevaLicencia) || $nuevoNombre == "" || $nuevoApellido == ""  || is_numeric($nuevoNombre) || is_numeric($nuevoApellido)){
                                            echo "Datos invalidos\n";
                                        }
                                        } while($nuevoNumTelefono < 0 || !is_numeric($nuevoNumTelefono) || $nuevaLicencia < 0 || !is_numeric($nuevaLicencia) || $nuevoNombre == "" || $nuevoApellido == ""  || is_numeric($nuevoNombre) || is_numeric($nuevoApellido));
                                        
                                        $datosResponsable = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $objViaje->getResponsableV()->getDocumento(), 'ptelefono' => $nuevoNumTelefono, 'rnumeroLicencia' => $nuevaLicencia, 'rnumeroEmpleado' => $objViaje->getResponsableV()->getNumeroEmpleado()];
                                        
                                        $objResponsable->cargar($datosResponsable);
                                        $objResponsable->modificar();
                                        $objViaje->setResponsableV($objResponsable);

                                    break;
                                default:
                                    break;
                            }
                        } while ($opcionResponsable != 2);
                        break;
                    case 4:
                        break;
                }
            } while ($opcionDatos != 4);
            break;

        case 2: 

            /*elimina el viaje el precargado*/
            if ($objEmpresa->listar()) {
                $tables = ['pasajero', 'responsable', 'persona', 'viaje', 'empresa'];
                foreach ($tables as $table) {
                    $consulta = "DELETE FROM $table WHERE 1";
                    if ($bd->Ejecutar($consulta)) {
                        echo "\033[42mSe eliminaron los datos precargados\n\033[0m";
                    } else {
                        echo "\033[41mNo se eliminaron los datos precargados\n\033[0m";
                    }
                }
                $objEmpresa->eliminarEmpresas();
            }

            echo "\033[42mSe eliminaron los datos precargados\n\033[0m";
            
            echo "\033[44m----| LA BASE DE DATOS ESTÁ EN VACÍA |----\033[0m\n";
            
            echo "CREEMOS LA BASE DE DATOS \n";
            do {
                echo "Ingrese el nombre de la empresa: ";
                $nombreEmpresa = trim(fgets(STDIN));
                echo "Ingrese la direccion de la empresa: ";
                $direccionEmpresa = trim(fgets(STDIN));
                if ($direccionEmpresa == "" || is_numeric($nombreEmpresa)) {
                    echo "\033[31mDatos inválidos \033[0m\n";
                }
            } while ($nombreEmpresa == "" || $direccionEmpresa == "" || is_numeric($nombreEmpresa));

            echo "\033[44m----| CARGAMOS EL RESPONSABLE DEL VIAJE: |----\033[0m\n";
            do {
                echo "Ingrese su nombre: ";
                $nombreResponsable = trim(fgets(STDIN));
                echo "Ingrese su apellido: ";
                $apellidoResponsable = trim(fgets(STDIN));

                if ($nombreResponsable == "" || $apellidoResponsable == "" || is_numeric($nombreResponsable) || is_numeric($apellidoResponsable)) {
                    echo "\033[41mDatos inválidos\nLos datos deben ser texto \033[0m\n";
                }
            } while ($nombreResponsable == "" || $apellidoResponsable == "" || is_numeric($nombreResponsable) || is_numeric($apellidoResponsable));
            do {
                echo "Ingrese su telefono: ";
                $numeroTelefonoResponsable = trim(fgets(STDIN));
                echo "Ingrese su numero documento: ";
                $numeroDocumentoResponsable = trim(fgets(STDIN));
                echo "Ingrese su numero de licencia: ";
                $numeroLicenciaResponsable = trim(fgets(STDIN));
                
                if ($numeroTelefonoResponsable < 0 || !is_numeric($numeroTelefonoResponsable) || $numeroDocumentoResponsable < 0 || !is_numeric($numeroDocumentoResponsable) || $numeroLicenciaResponsable < 0 || !is_numeric($numeroLicenciaResponsable)) {
                    echo "\033[41mDatos inválidos\nLos datos deben ser numéricos mayores a 0 \033[0m\n";
                }
            } while (!is_numeric($numeroTelefonoResponsable) || $numeroTelefonoResponsable < 0 || $numeroDocumentoResponsable < 0 || !is_numeric($numeroDocumentoResponsable) || $numeroLicenciaResponsable < 0 || !is_numeric($numeroLicenciaResponsable));

            echo "\033[44m----| CARGAMOS EL VIAJE |----\033[0m\n";
            do {
                echo "Ingrese su destino: ";
                $destinoViaje = trim(fgets(STDIN));
                echo "\033[44mIngrese la cantidad maxima de pasajeros: \033[0m\n";
                $cantidadMaximaPasajerosViaje = trim(fgets(STDIN));

                if ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje) || $destinoViaje == "" || is_numeric($destinoViaje) ) {
                    echo "Datos invalidos\n";
                }
            } while ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje) || $destinoViaje == "" || is_numeric($destinoViaje));

                
            $datosEmpresa = ['idEmpresa' => null,'enombre' => $nombreEmpresa, 'edireccion' => $direccionEmpresa, 'coleccionViajes' => []];
            $objEmpresa->cargar($datosEmpresa);
            $objEmpresa->insertar();


            $datosResponsable = ['documento' => $numeroDocumentoResponsable, 'rnumeroEmpleado' => null, 'rnumeroLicencia' => $numeroLicenciaResponsable, 'nombre' => $nombreResponsable, 'apellido' => $apellidoResponsable, 'ptelefono' => $numeroTelefonoResponsable];
            $objResponsable->cargar($datosResponsable);
            $objResponsable->insertar();


            $datosViaje = ['idViaje' => null, 'destino' => $destinoViaje, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosViaje, 'objEmpresa' => $objEmpresa, 'objEmpleado' => $objResponsable, 'coleccionPasajeros' => []];
            $objViaje->cargar($datosViaje);
            $objViaje->insertar();
            $objViaje->setResponsableV($objResponsable);

            
            echo "\033[44m----| CARGAMOS EL PASAJERO DEL VIAJE |----\033[0m\n";
            $coleccionPasajeros = [];
            echo "Cuantos pasajeros quiere ingresar?\n";
            $cantPasajeros = trim(fgets(STDIN));

            while ($cantPasajeros < 0 || $cantPasajeros > $cantidadMaximaPasajerosViaje) {
                echo "Ingrese un numero valido\n";
                $cantPasajeros = trim(fgets(STDIN));
            }

            for ($i = 0; $i < $cantPasajeros; $i++) {
                echo "\n";
                do{
                    echo "Ingrese su nombre: ";
                    $nombrePasajero = trim(fgets(STDIN));
                    echo "Ingrese su apellido: ";
                    $apellidoPasajero = trim(fgets(STDIN));
                    echo "Ingrese su telefono: ";
                    $numeroTelefonoPasajero = trim(fgets(STDIN));
                    if($nombrePasajero == "" || $apellidoPasajero == "" || $numeroTelefonoPasajero < 0 || !is_numeric($numeroTelefonoPasajero) || is_numeric($nombrePasajero) || is_numeric($apellidoPasajero)){
                        echo "Datos invalidos\n";
                    }
                } while ($nombrePasajero == "" || $apellidoPasajero == "" || $numeroTelefonoPasajero < 0 || !is_numeric($numeroTelefonoPasajero) || is_numeric($nombrePasajero) || is_numeric($apellidoPasajero));
                
                do {
                    echo "Ingrese su numero documento:";
                    $documentoPasajero = trim(fgets(STDIN));
                    if ($documentoPasajero == $numeroDocumentoResponsable || !is_numeric($documentoPasajero)) {
                        echo "documento invalido o repetido \n";
                    }
                } while ($documentoPasajero == $numeroDocumentoResponsable || !is_numeric($documentoPasajero));

                $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $numeroTelefonoPasajero, 'idViaje' => $objViaje->getIdViaje()];

                array_push($coleccionPasajeros, $datosPasajero);

                $objPasajero->cargar($datosPasajero);
                $objPasajero->insertar();
            }
            $objViaje->setColeccionPasajero($coleccionPasajeros);
            $coleccionViajes = $objEmpresa->getColeccionViajes();
            array_push($coleccionViajes,$objViaje);
            $objEmpresa->setColeccionViajes($coleccionViajes);

            if ($objEmpresa->listar()){
                echo "\033[42mSe cargó correctamente\033[0m\n";
            } else {
                echo "\033[41mNo se cargó\033[0m\n";
            }

            do {
                $salir= false;
                $viajes = $objViaje->listar( 'idempresa = '. $objEmpresa->getIdEmpresa());
                if(count($objViaje->listar()) == 0){
                    echo "No hay viajes, sera enviado al menu empresa luego de ingresar el input\n";
                    $salir = true;
                }  else{
                    echo "\n";
                    echo "*********************************\n";
                    echo "\033[32mLos viajes de la empresa son:\033[0m\n";
                    foreach ($viajes as $viaje) {
                        echo $viaje;
                    }
                }
                do{

                echo "\nIngrese el ID del viaje para cargar sus datos:";
                $idViaje = trim(fgets(STDIN));

                if(!$objViaje->Buscar($idViaje)){
                    echo "No se encontro el viaje\n";
                } else {
                    echo "\e[32mSe encontró el viaje \e[0m\n";
                }
                }while($objViaje->Buscar($idViaje) == false && !$salir);
                

                menuEmpresa();
                $opcionDatos = trim(fgets(STDIN));
                
                                
                switch ($opcionDatos) {

                    case 1: 
                        do {
                            if ($objViaje->Buscar($idViaje)) {
                                $viaje = $objViaje->listar()[0];
                                echo "\033[0;33m************\nDatos del viaje:\ncodigo del viaje: {$viaje->getIdViaje()}\ndestino: {$viaje->getDestino()}\ncantidad Maxima de pasajeros: {$viaje->getCantidadMaximaPasajeros()}\n************\033[0m";
                        menuViaje();
                        $opcionViaje = trim(fgets(STDIN));
                        switch($opcionViaje){
                            case 1:
                                if ($objViaje->Buscar($idViaje)){
                                    echo $objViaje;
                                    echo "3) Eliminar el viaje:\n";
                                    $coleccionPasajeros = $objViaje->getColeccionObjsPasajeros();
    
                                    foreach ($coleccionPasajeros as $pasajeroUnico) {
                                        $objViaje->eliminarPasajero($pasajeroUnico->getDocumento());
                                    }
                                    
                                    if($objViaje->eliminar()){
                                        echo "\nSe eliminó el viaje y el responsable correctamente";
                                    }else{
                                        echo "No se pudo eliminar\n";
                                    }
                                } else{
                                    echo "No se encontro el viaje\n";
                                }

                                
                                break;

                            case 2: 
                                        do {
                                            echo "Ingrese el destino del viaje nuevo: ";
                                            $destinoNuevo = trim(fgets(STDIN));
                                            echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
                                            $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));

                                            if ($cantidadMaximaPasajerosNueva < 0 || !is_numeric($cantidadMaximaPasajerosNueva)) {
                                                echo "datos invalidos en la capacidad de pasajeros \n";
                                            }
                                        } while ($cantidadMaximaPasajerosNueva < 0 || !is_numeric($cantidadMaximaPasajerosNueva));

                                        $datosNuevos = ['idViaje' => $idViaje, 'destino' => $destinoNuevo, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosNueva, 'objEmpresa' => $objViaje->getobjEmpresa(), 'objEmpleado' => $objViaje->getResponsableV(), 'coleccionPasajeros' => $objViaje->getColeccionObjsPasajeros()];
                                        $objViaje->cargar($datosNuevos);

                                        if ($objViaje->modificar()) {
                                            echo "\033[32mSe modifico el viaje correctamente , sus nuevos datos son:\n\033[0m";
                                        } else {
                                            echo "Probablemente no existe una empresa creada \n";
                                        }

                            case 3:
                                break;
                            break;
                        }
                        } else{
                            echo "No se encontro el viaje\n";
                        }
                    } while ($opcionViaje != 3);
                        break;

                    case 2: 
                        do {
                            
                            $texto = "-------------------\n";

                            echo $objViaje->mostrarPasajeros();
                            
                            menuPasajero();
                            $opcionPasajero = trim(fgets(STDIN));


                            if($opcionPasajero == "1"){


                                $objViaje->Buscar($idViaje);
                                echo "1) Agregar a un pasajero \n";
                                if ($objViaje->cantidadPasajerosActual() < $objViaje->getCantidadMaximaPasajeros()){
                                    echo "Ingrese el nombre del pasajero: ";
                                    $nombrePasajero = trim(fgets(STDIN));
                                    echo "Ingrese el apellido del pasajero: ";
                                    $apellidoPasajero = trim(fgets(STDIN));
                                    echo "Ingrese el documento del pasajero: ";
                                    $documentoPasajero = trim(fgets(STDIN));
                                    echo "Ingrese el telefono del pasajero: ";
                                    $telefonoPasajero = trim(fgets(STDIN));
                                    if($objPersona->Buscar($documentoPasajero)){
                                        echo "\033[41mEl documento pertenece a otra persona\033[0m\n";
                                    } else {
                                        $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $telefonoPasajero, 'idViaje' => $idViaje];
                                        $objViaje->crearPasajero($datosPasajero);
                                    }
                                } else {
                                    echo "No se pueden agregar mas pasajeros\n";
                                }
                                
                            }else if($opcionPasajero == "2"){


                                echo "2) Eliminar pasajero\n";
                                echo "Ingrese el DNI del pasajero que quiere eliminar:";
                                $dniPasajero = trim(fgets(STDIN));
                                $objViaje->eliminarPasajero($dniPasajero);
                                
                            }else if($opcionPasajero == "3"){
                                echo "3) Modificar pasajero:\n";
                                echo "Ingrese el DNI del pasajero que quiera modificar:";
                                $dniPasajero = trim(fgets(STDIN));

                                if($objPersona->Buscar($dniPasajero)){
                                    echo "Ingrese el nuevo nombre:";
                                    $nuevoNombre = trim(fgets(STDIN));
                                    echo "Ingrese el nuevo apellido:";
                                    $nuevoApellido = trim(fgets(STDIN));
                                    echo "Ingrese el nuevo numero de telefono:";
                                    $nuevoNumTelefono = trim(fgets(STDIN));
                                    $datosPersona = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $dniPasajero, 'ptelefono' => $nuevoNumTelefono, 'idViaje' => $idViaje];
                                    $objViaje->modificarPasajero($datosPersona);
                                }else{
                                    echo "No se encontro el DNI del pasajero\n";
                                }
                            }
                        } while ($opcionPasajero != 4);
                        break;

                    case 3:
                        do {
                            

                            echo "\033[34m".$objViaje->getResponsableV()."\033[0m";
                            
                            echo "\033[34m\n-------------------\n\033[0m";

                            menuResponsable();
                            $opcionResponsable = trim(fgets(STDIN));      
                    
                            if($opcionResponsable == 1){

                            echo "\033[34m".$objViaje->getResponsableV()."\033[0m";
                            echo "\033[33m\nModificar Responsable\n\033[0m";

                                do{
                                    echo "Ingrese el nuevo nombre:";
                                    $nuevoNombre = trim(fgets(STDIN));
                                    echo "Ingrese el nuevo apellido:";
                                    $nuevoApellido = trim(fgets(STDIN));
                                    echo "Ingrese el nuevo numero de telefono:";
                                    $nuevoNumTelefono = trim(fgets(STDIN));
                                    echo "Ingrese el numero de licencia nuevo:";
                                    $nuevaLicencia = trim(fgets(STDIN));

                                if ($nuevoNumTelefono < 0 || !is_numeric($nuevoNumTelefono) || $nuevaLicencia < 0 || !is_numeric($nuevaLicencia) || $nuevoNombre == "" || $nuevoApellido == ""  || is_numeric($nuevoNombre) || is_numeric($nuevoApellido)){
                                    echo "Datos invalidos\n";
                                }
                                } while($nuevoNumTelefono < 0 || !is_numeric($nuevoNumTelefono) || $nuevaLicencia < 0 || !is_numeric($nuevaLicencia) || $nuevoNombre == "" || $nuevoApellido == ""  || is_numeric($nuevoNombre) || is_numeric($nuevoApellido));
                                
                                $datosResponsable = ['nombre' => $nuevoNombre, 'apellido' => $nuevoApellido, 'documento' => $objViaje->getResponsableV()->getDocumento(), 'ptelefono' => $nuevoNumTelefono, 'rnumeroLicencia' => $nuevaLicencia, 'rnumeroEmpleado' => $objViaje->getResponsableV()->getNumeroEmpleado()];
                                
                                $objResponsable->cargar($datosResponsable);
                                $objResponsable->modificar();
                                $objViaje->setResponsableV($objResponsable);

                            }

                        } while ($opcionResponsable != 2);
                        break;
                }
            } while ($opcionDatos != 4);
            break;

        case 3: 
                if ($objEmpresa->listar()){
                echo "*********************************\n";
                echo "\033[36mLas empresas creadas son:\n";
                $empresas = $objEmpresa->listar();
                $txt = "";
                foreach($empresas as $empresa){
                    $txt .= $empresa . "\n";
                }
                echo $txt. "\033[0m";


                do{
                echo "\033[33mIngrese el ID de la empresa que va a pertenecer el Viaje:\n\033[0m";
                $idEmpresa = trim(fgets(STDIN));
                $objEmpresaEncontrado = new Empresa();
                $objEmpresaEncontrado = $objEmpresa->listar($idEmpresa)[0];
                
                if ($idEmpresa < 0 || !is_numeric($idEmpresa) || $objEmpresa->Buscar($idEmpresa) == false){
                    echo "Datos invalidos\n";
                }
                } while ($idEmpresa < 0 || !is_numeric($idEmpresa) || $objEmpresa->Buscar($idEmpresa) == false);

            
            echo "\033[44m----| CARGAMOS EL RESPONSABLE DEL VIAJE: |----\033[0m\n";
            do {
                echo "Ingrese su nombre: ";
                $nombreResponsable = trim(fgets(STDIN));
                echo "Ingrese su apellido: ";
                $apellidoResponsable = trim(fgets(STDIN));

                if ($nombreResponsable == "" || $apellidoResponsable == "" || is_numeric($nombreResponsable) || is_numeric($apellidoResponsable)) {
                    echo "\033[41mDatos inválidos\nLos datos deben ser texto \033[0m\n";
                }
            } while ($nombreResponsable == "" || $apellidoResponsable == "" || is_numeric($nombreResponsable) || is_numeric($apellidoResponsable));
            do {
                echo "Ingrese su telefono: ";
                $numeroTelefonoResponsable = trim(fgets(STDIN));
                echo "Ingrese su numero documento: ";
                $numeroDocumentoResponsable = trim(fgets(STDIN));
                echo "Ingrese su numero de licencia: ";
                $numeroLicenciaResponsable = trim(fgets(STDIN));
                
                if ($numeroTelefonoResponsable < 0 || !is_numeric($numeroTelefonoResponsable) || $numeroDocumentoResponsable < 0 || !is_numeric($numeroDocumentoResponsable) || $numeroLicenciaResponsable < 0 || !is_numeric($numeroLicenciaResponsable)) {
                    echo "\033[41mDatos inválidos\nLos datos deben ser numéricos mayores a 0 \033[0m\n";
                }
            } while (!is_numeric($numeroTelefonoResponsable) || $numeroTelefonoResponsable < 0 || $numeroDocumentoResponsable < 0 || !is_numeric($numeroDocumentoResponsable) || $numeroLicenciaResponsable < 0 || !is_numeric($numeroLicenciaResponsable));

            echo "\033[44m----| CARGAMOS EL VIAJE |----\033[0m\n";
            do {
                echo "Ingrese su destino: ";
                $destinoViaje = trim(fgets(STDIN));
                
                echo "\033[44mIngrese la cantidad maxima de pasajeros: \033[0m\n";
                $cantidadMaximaPasajerosViaje = trim(fgets(STDIN));

                if ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje) || $destinoViaje == "" || is_numeric($destinoViaje) ) {
                    echo "Datos invalidos\n";
                }
            } while ($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje) || $destinoViaje == "" || is_numeric($destinoViaje));

                
            $datosResponsable = ['documento' => $numeroDocumentoResponsable, 'rnumeroEmpleado' => null, 'rnumeroLicencia' => $numeroLicenciaResponsable, 'nombre' => $nombreResponsable, 'apellido' => $apellidoResponsable, 'ptelefono' => $numeroTelefonoResponsable];
            $objResponsable->cargar($datosResponsable);
            $objResponsable->insertar();
            
            
            $datosViaje = ['idViaje' => null, 'destino' => $destinoViaje, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosViaje, 'objEmpresa' => $objEmpresaEncontrado, 'objEmpleado' => $objResponsable, 'coleccionPasajeros' => []];
            $objViaje->cargar($datosViaje);
            $objViaje->insertar();
            $objViaje->setResponsableV($objResponsable);

            
            echo "\033[44m----| CARGAMOS EL PASAJERO DEL VIAJE |----\033[0m\n";
            $coleccionPasajeros = [];

            echo "Cuantos pasajeros quiere ingresar?\n";
            $cantPasajeros = trim(fgets(STDIN));

            while ($cantPasajeros < 0 || $cantPasajeros > $cantidadMaximaPasajerosViaje) {
                echo "Ingrese un numero valido\n";
                $cantPasajeros = trim(fgets(STDIN));
            }

            for ($i = 0; $i < $cantPasajeros; $i++) {
                echo "\n";
                do{
                    echo "Ingrese su nombre: ";
                    $nombrePasajero = trim(fgets(STDIN));
                    echo "Ingrese su apellido: ";
                    $apellidoPasajero = trim(fgets(STDIN));
                    echo "Ingrese su telefono: ";
                    $numeroTelefonoPasajero = trim(fgets(STDIN));
                    if($nombrePasajero == "" || $apellidoPasajero == "" || $numeroTelefonoPasajero < 0 || !is_numeric($numeroTelefonoPasajero) || is_numeric($nombrePasajero) || is_numeric($apellidoPasajero)){
                        echo "Datos invalidos\n";
                    }
                } while ($nombrePasajero == "" || $apellidoPasajero == "" || $numeroTelefonoPasajero < 0 || !is_numeric($numeroTelefonoPasajero) || is_numeric($nombrePasajero) || is_numeric($apellidoPasajero));
                do {
                    echo "Ingrese su numero documento:";
                    $documentoPasajero = trim(fgets(STDIN));
                    if ($documentoPasajero == $numeroDocumentoResponsable || !is_numeric($documentoPasajero)) {
                        echo "documento invalido o repetido \n";
                    }
                } while ($documentoPasajero == $numeroDocumentoResponsable || !is_numeric($documentoPasajero));

                $datosPasajero = ['nombre' => $nombrePasajero, 'apellido' => $apellidoPasajero, 'documento' => $documentoPasajero, 'ptelefono' => $numeroTelefonoPasajero, 'idViaje' => $objViaje->getIdViaje()];

                array_push($coleccionPasajeros, $datosPasajero);

                $objPasajero->cargar($datosPasajero);
                $objPasajero->insertar();
            }

            $objViaje->setColeccionPasajero($coleccionPasajeros);
            $coleccionViajes = $objEmpresa->getColeccionViajes();
            array_push($coleccionViajes,$objViaje);
            $objEmpresa->setColeccionViajes($coleccionViajes);


                do{//while grande
                    
                        $salir = false;
                        $viajes = $objViaje->listar( 'idempresa = '. $objEmpresa->getIdEmpresa());

                        if(count($objViaje->listar()) == 0){
                            echo "No hay viajes, sera enviado al menu empresa luego de ingresar el input\n";
                            $salir = true;
                        }      else{
                            echo "\n";
                            echo "*********************************\n";
                            echo "\033[32mLos viajes de la empresa son:\033[0m\n";
                            foreach ($viajes as $viaje) {
                                echo $viaje."\n";
                            }
                        }
                    
                        do{

                        echo "\nIngrese el ID del viaje para buscar y cargar:";
                        $idViaje = trim(fgets(STDIN));

                        if(!$objViaje->Buscar($idViaje)){
                                echo "No se encontro el viaje\n";
                        } else {
                            echo "\e[32mSe encontró el viaje \e[0m\n";
                        }
                        }while($objViaje->Buscar($idViaje) == false && !$salir);

                    menuViaje();
                    $opcion = trim(fgets(STDIN));

                    switch ($opcion) {
                        case 1: 

                            echo "1) Eliminar viaje:\n";
                            
                            echo "Vamos eliminar el viaje, tendremos que borrar el responsable y los pasajeros\n";
                            echo "Ingrese el ID del viaje que quiere eliminar:\n";
                            $idViajeEliminar = trim(fgets(STDIN));
                            
                            if ($objViaje->Buscar($idViajeEliminar)){
                                echo "3) Eliminar el viaje:\n";
                                $coleccionPasajeros = $objViaje->getColeccionObjsPasajeros();

                                foreach ($coleccionPasajeros as $pasajeroUnico) {
                                    $objViaje->eliminarPasajero($pasajeroUnico->getDocumento());
                                }
                                
                                if($objViaje->eliminar()){
                                    echo "\nSe eliminó el viaje y el responsable correctamente";
                                }else{
                                    echo "No se pudo eliminar\n";
                                }
                            } else{
                                echo "No se encontro el viaje\n";
                            }

                        break;
                        case 2: 

                            echo "2) Modificar viaje:\n";   
                                do{
                                echo "Ingrese el nuevo destino del viaje: ";
                                $destinoNuevo = trim(fgets(STDIN));

                                do{
                                    echo "Ingrese la cantidad maxima de pasajeros nuevo: ";
                                    $cantidadMaximaPasajerosNueva = trim(fgets(STDIN));
                                    if($cantidadMaximaPasajerosViaje < 0 || !is_numeric($cantidadMaximaPasajerosViaje)){
                                        echo "Datos invalidos\n";
                                    }
                                }while($cantidadMaximaPasajerosNueva < 0 || !is_numeric($cantidadMaximaPasajerosViaje));

                                echo "\033[36mLas empresas creadas son:\033[0m\n";
                                $empresas = $objEmpresa->listar();
                                $txt = "";
                                foreach($empresas as $empresa){
                                    $txt .= $empresa . "\n";
                                }
                                echo $txt;

                                echo "Ingrese el ID de la empresa a la que va a pertenecer:\n";
                                $idEmpresaNuevo = trim(fgets(STDIN));

                                if ($idEmpresaNuevo < 1 || $objEmpresa->Buscar($idEmpresaNuevo) == false){
                                    echo "No se encontro la empresa y/o hay datos invalidos en la capacidad de pasajeros \n";
                                }
                                
                            } while ($idEmpresaNuevo < 1 || $objEmpresa->Buscar($idEmpresaNuevo) == false);
                            
                            $objEmpresa->Buscar($idEmpresaNuevo);
                            $empresa = new Empresa();
                            $empresa = $objEmpresa->listar()[0];
                            
                            
                            $datosNuevos = ['idViaje' => $idViaje, 'destino' => $destinoNuevo, 'cantidadMaximaPasajeros' => $cantidadMaximaPasajerosNueva, 'objEmpresa' => $objViaje->getobjEmpresa(), 'objEmpleado' => $objViaje->getResponsableV(), 'coleccionPasajeros' => $objViaje->getColeccionObjsPasajeros()];                            
                            echo "Se modifico el viaje correctamente \n";
                            $objViaje->cargar($datosNuevos);

                            if($objViaje->modificar()){
                                echo "Se modifico el viaje correctamente !!";
                            
                            }else{
                                echo "Probablemente no existe una empresa creada \n";
                            }
                            
                            break;
                        case 3:
                            break;
                    }
                    }while ($opcion != 3);

                } else {
                    echo "\033[31mNo hay empresas cargadas\033[0m";
                }
                
            break;
        case 4:
            echo "Gracias por usar nuestro servicio.\n";
            break;
            
    }//fin del switch    
    
} while ($opcionPrincipal != 4);
} else {
    echo "Conexion fallida";
}