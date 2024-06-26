<?php

class Viaje
{
    private $idViaje;                                       //idviaje varchar AUTO_INCREMENT,
    private $destino;                                       //vdestino varchar(150),
    private $cantidadMaximaPasajeros;                       //vcantmaxpasajeros int,
    private $objEmpresa;                                     //objEmpresa varchar,
    private $objResponsableV;                               //rnumeroempleado varchar,                                      
    private $ColeccionObjsPasajeros;                        
    private $mensajeoperacion;                    

    public function __construct()
    {
        $this->objResponsableV ='' ;
        $this->idViaje = '';
        $this->destino = '';
        $this->cantidadMaximaPasajeros ='';
        $this->ColeccionObjsPasajeros = [];
    }

    public function cargar($datos)
    {
        $this->setIdViaje($datos['idViaje']);
        $this->setDestino($datos['destino']);
        $this->setCantidadMaximaPasajeros($datos['cantidadMaximaPasajeros']);
        $this->setobjEmpresa($datos['objEmpresa']);
        $this->setResponsableV($datos['objEmpleado']);
        $this->setColeccionPasajero($datos['coleccionPasajeros']);
    }

    public function getIdViaje()
    {
        return $this->idViaje;
    }

    public function getDestino()
    {
        return $this->destino;
    }

    public function getCantidadMaximaPasajeros()
    {
        return $this->cantidadMaximaPasajeros;
    }

    public function getResponsableV()
    {
        return $this->objResponsableV;
    }

    public function getColeccionObjsPasajeros()
    {
        return $this->ColeccionObjsPasajeros;
    }

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function getobjEmpresa()
    {
        return $this->objEmpresa;
    }  

    public function setColeccionPasajero($newColeccionPasajero){
        $this->ColeccionObjsPasajeros = $newColeccionPasajero;
    }
    
    public function setobjEmpresa($newobjEmpresa)
    {
        $this->objEmpresa = $newobjEmpresa;
    }

    public function setIdViaje($newIdViaje)
    {
        $this->idViaje = $newIdViaje;
    }

    public function setDestino($newDestino)
    {
        $this->destino = $newDestino;
    }

    public function setCantidadMaximaPasajeros($newCantidadMaximaPasajeros)
    {
        $this->cantidadMaximaPasajeros = $newCantidadMaximaPasajeros;
    }

    public function setResponsableV($newResponsableV)
    {
        $this->objResponsableV = $newResponsableV;
    }

    public function setmensajeoperacion($newMensajeOperacion)
    {
        $this->mensajeoperacion = $newMensajeOperacion;
    }

    public function cantidadPasajerosActual(){
        return count($this->ColeccionObjsPasajeros);
    }

    /*metodos de sql*/
    public function Buscar($idViaje)
    {
        $base = new bdViajeFeliz();
        $consultaViaje = "SELECT * FROM viaje WHERE idviaje=" . $idViaje;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaViaje)) {
                if ($row2 = $base->Registro()){
                    $objResponsableV = new ResponsableV();
                    $objEmpresa = new Empresa();
                    $objPasajero = new Pasajero();
                    
                    $objEmpresa->Buscar($row2['idempresa']);
                    $objResponsableV->Buscar($row2['rnumeroempleado']);
                    $objPasajero->Buscar("idviaje = " . $row2['idviaje']);

                    $this->setIdViaje($idViaje);
                    $this->setDestino($row2['vdestino']);
                    $this->setCantidadMaximaPasajeros($row2['vcantmaxpasajeros']);
                    $this->setobjEmpresa($objEmpresa);
                    $this->setResponsableV($objResponsableV);

                    $this->setColeccionPasajero($objPasajero->Listar("idviaje = " . $row2['idviaje']));
                    $resp = true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function listar($condicion = "")
    {
        $arreglo = null;
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM viaje ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " order by idviaje";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arreglo = [];
                while ($row2 = $base->Registro()) {
                    $obj = new Viaje();
                    $objResponsableV = new ResponsableV();
                    $objEmpresa = new Empresa();
                    $objPasajero = new Pasajero();
                    $objResponsableV->Buscar($row2['rnumeroempleado']);
                    $objEmpresa->Buscar($row2['idempresa']);
                    $obj->Buscar($row2['idviaje']);
                    $datos = [
                        'idViaje' => $row2['idviaje'],
                        'destino' => $row2['vdestino'],
                        'cantidadMaximaPasajeros' => $row2['vcantmaxpasajeros'],
                        'objEmpresa' => $objEmpresa,
                        'objEmpleado' => $objResponsableV,
                        'coleccionPasajeros' =>  $objPasajero->Listar("idviaje = " . $row2['idviaje'])
                    ];

                    $obj->cargar($datos);
                    array_push($arreglo, $obj);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }

        return $arreglo;
    }

    public function insertar()
    {
        $base = new bdViajeFeliz();
        $resp = false;
        $consultaInsertar = "INSERT INTO viaje(vdestino, vcantmaxpasajeros,idempresa,rnumeroempleado) VALUES 
        ('" . $this->getDestino() . "','" . $this->getCantidadMaximaPasajeros() . "','" . $this->getobjEmpresa()->getIdEmpresa() . "','" . $this->getResponsableV()->getNumeroEmpleado(). "')";
        
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdViaje($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new bdViajeFeliz();
        $consultaModifica = "UPDATE viaje SET vdestino ='{$this->getDestino()}', vcantmaxpasajeros = {$this->getCantidadMaximaPasajeros()}, idempresa = {$this->getobjEmpresa()->getIdEmpresa()}, rnumeroempleado = {$this->getResponsableV()->getNumeroEmpleado()} WHERE idviaje = {$this->getIdViaje()}";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp = true;
                $this->setDestino($this->getDestino());
                $this->setCantidadMaximaPasajeros($this->getCantidadMaximaPasajeros());
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }

        return $resp;
    }

    public function modificarResponsable($datos){
        $base = new bdViajeFeliz();
        $bandera = false;

        if($base->iniciar()){
            $responsable = new ResponsableV();
            $responsable->cargar($datos);

            if($responsable->modificar()){
                $bandera = true;
                $responsable->Buscar($datos['numeroEmpleado']);
                $this->setResponsableV($responsable);
            }else{
                $this->setmensajeoperacion($base->getError());
            }

        }else{
            $this->setmensajeoperacion($base->getError());
        }

        return $bandera;
    }


    public function eliminar()
    {
        $base = new bdViajeFeliz();
        $resp = false;

        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM viaje WHERE idviaje=" . $this->getIdViaje();
            if ($base->Ejecutar($consultaBorra)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function eliminarViajes()
    {
        $base = new bdViajeFeliz();
        $resp = false;

        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM viaje where 1";
            if ($base->Ejecutar($consultaBorra)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }


    /*fin de los metodos de sql*/
    /*Pasajero*/   
    
    public function hayPasajesDisponibles(){
        $base = new bdViajeFeliz();
        $consulta = "SELECT count(*) as cantidadPasajes FROM pasajero WHERE idviaje = '" . $this->getIdViaje()."'";
        $resp = false;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    if ($row2['cantidadPasajes'] < $this->getCantidadMaximaPasajeros()) {

                        $resp = true;
                    }
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function existePasajero($dni){
        $base = new bdViajeFeliz();
        $objPasajero = new Pasajero();
        $consulta = "SELECT * FROM pasajero WHERE pdocumento = " . $dni;
        $resp = false;

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    $objPasajero->Buscar($dni);
                    $resp = true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
        
    }
        
    public function crearPasajero($datos){
        $base = new bdViajeFeliz();
        $booleano = true;
        $pasajero = new Pasajero();

        if($base->Iniciar()){
            $pasajero->cargar($datos);

            if ($pasajero->insertar()) {
                $coleccionPasajeros = $this->getColeccionObjsPasajeros();
                array_push($coleccionPasajeros, $pasajero);
                $this->setColeccionPasajero($coleccionPasajeros);
                $booleano = true;

            } else {

                $booleano = false;

            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }
        return $booleano;
    }

    public function modificarPasajero($datos){
        $base = new bdViajeFeliz();
        $bandera = false;

        if($base->iniciar()){

            $pasajero = new Pasajero();
            $pasajero->cargar($datos);
            $pasajero->modificar();

            $this->setColeccionPasajero($pasajero->listar("idviaje = " . $this->getIdViaje()));
        }else{
            $this->setmensajeoperacion($base->getError());
        }

        return $bandera;
    }



    public function eliminarPasajero($dni){
        $base = new bdViajeFeliz();
        $resp = false;
        $pasajero = new Pasajero();

        if ($base->Iniciar()) {
            $pasajero->Buscar($dni);
            $pasajero->eliminar();
            $this->setColeccionPasajero($pasajero->listar("idviaje = " . $this->getIdViaje()));
            $resp = true;
        } else {
            $this->setmensajeoperacion($base->getError());
        }

        return $resp;
    }

    /*--- RESPONSABLE ---*/
    public function crearResponsableV($datos){
        //TESTEADO
        $base = new bdViajeFeliz();
        $booleano = true;
        $responsable = new ResponsableV();

        if($base->Iniciar()){
            $responsable->cargar($datos);
            if ($responsable->insertar()) {
                $this->setResponsableV($responsable);
                $booleano = true;
            } else {
                $booleano = false;
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }

        return $booleano;
    } 

    public function mostrarResponsable(){
        echo "entre en el reponsable\n";

        $base = new bdViajeFeliz();
        $objResponsableV = null;
        
        if($base->iniciar()){
            $objResponsable = new ResponsableV();
            if($coleccionResponsables = $objResponsable->listar()){
                $i=0;
                while($i < count($coleccionResponsables) && $objResponsableV == null){                    
                    if($coleccionResponsables[$i]->getNumeroEmpleado() == $this->getResponsableV()->getNumeroEmpleado()){

                        echo "encontre el reponsable\n";
                        $objResponsableV = $coleccionResponsables[$i];  
                    }
                    $i++;
                }
            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }
        
    return $objResponsableV;
    }
        
    public function eliminarResponsable($dni){
        $base = new bdViajeFeliz();
        $resp = false;
        $responsable = new responsableV();
    
        if ($base->Iniciar()) {
            $responsable->Buscar($dni);
            $responsable->eliminar();
            $this->setResponsableV($responsable);
            $resp = true;
        } else {
            $this->setmensajeoperacion($base->getError());
        }
    
        return $resp;
    }

    public function mostrarPasajeros(){
        $coleccionPasajeros = $this->getColeccionObjsPasajeros();
        $mostrar = " ";
        foreach ($coleccionPasajeros as $pasajero) {
            $mostrar .= "\n\033[0;35m\n" . $pasajero . "\n---------------------\033[0m";
        }
        return $mostrar;
    }

    public function __toString()
    {
        return "\n\033[0;34m\n{$this->getResponsableV()}\n-------------------\n\033[0;33m************\nDatos del viaje:\ncodigo del viaje: {$this->getIdViaje()}\ndestino: {$this->getDestino()}\ncantidad Maxima de pasajeros: {$this->getCantidadMaximaPasajeros()}\n************\033[0m";
    }
}