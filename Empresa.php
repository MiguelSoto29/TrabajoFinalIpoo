<?php

class Empresa{
    private $idEmpresa;             //idempresa bigint AUTO_INCREMENT,
    private $nombre;                //enombre varchar(150),
    private $direccion;             //edireccion varchar(150),
    private $coleccionViajes;       
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idEmpresa = '';
        $this->nombre = '';
        $this->direccion = '';
        $this->coleccionViajes = [];
    }

    public function getIdEmpresa()
    {
        return $this->idEmpresa;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getColeccionViajes()
    {
        return $this->coleccionViajes;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setIdEmpresa($newIdEmpresa)
    {
        $this->idEmpresa = $newIdEmpresa;
    }

    public function setNombre($newNombre)
    {
        $this->nombre = $newNombre;
    }

    public function setDireccion($newDireccion)
    {
        $this->direccion = $newDireccion;
    }

    public function setColeccionViajes($newColeccionViajes)
    {
        $this->coleccionViajes = $newColeccionViajes;
    }

    public function setMensajeOperacion($newMensajeOperacion)
    {
        $this->mensajeoperacion = $newMensajeOperacion;
    }

    public function cargar($datos)
    {
        $this->setIdEmpresa($datos['idEmpresa']);
        $this->setNombre($datos['enombre']);
        $this->setDireccion($datos['edireccion']);
        $this->setColeccionViajes($datos['coleccionViajes']);
    }

    public function Buscar($idEmpresa){
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM empresa WHERE idempresa = " . $idEmpresa;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdEmpresa($idEmpresa);
                    $this->setNombre($row2['enombre']);
                    $this->setDireccion($row2['edireccion']);
                    $resp = true;
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function listar($consulta = ''){

        $arregloEmpresas = null;
        $base = new bdViajeFeliz();
        $viaje = new Viaje();
        $consultaEmpresas = "SELECT * FROM empresa ";
        if ($consulta != "") {
            $consultaEmpresas = $consultaEmpresas . ' WHERE ' . $consulta;
        }
        $consultaEmpresas .= " order by idempresa";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaEmpresas)) {
                $arregloEmpresas = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Empresa();
                    $array = ['idEmpresa' => $row2['idempresa'], 'enombre' => $row2['enombre'], 'edireccion' => $row2['edireccion'], 'coleccionViajes' => $viaje->listar('idempresa = ' . $row2['idempresa'])];
                    //idempresa enombre edireccion
                    $obj->cargar($array);
                    array_push($arregloEmpresas, $obj);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arregloEmpresas;
    }

    public function insertar(){
        $base = new bdViajeFeliz();
        $resp = false;
        $consultaInsertar = "INSERT INTO empresa(enombre, edireccion) VALUES ('" . $this->getNombre() . "','" . $this->getDireccion() . "')";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdEmpresa($id);
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new bdViajeFeliz();
        $consultaModificar = "UPDATE empresa SET enombre = '" . $this->getNombre() . "', edireccion = '" . $this->getDireccion() . "' WHERE idempresa = '" . $this->getIdEmpresa()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModificar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar(){
        $base = new bdViajeFeliz();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorrar = "DELETE FROM empresa WHERE idempresa = '" . $this->getIdEmpresa()."'";
            if ($base->Ejecutar($consultaBorrar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function eliminarEmpresas(){
        $base = new bdViajeFeliz();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorrar = "DELETE FROM empresa WHERE 1";
            if ($base->Ejecutar($consultaBorrar)) {
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function mostrarViajes(){
        $coleccionViajes = $this->getColeccionViajes();
        $mostrar = " ";
        foreach ($coleccionViajes as $viaje) {
            $mostrar .= $viaje ."\n";
        }
        return $mostrar;
    }

    public function crearViaje($datos){
        //TESTEADO
        $base = new bdViajeFeliz();
        $booleano = true;
        $viaje = new Viaje();
    
        if($base->Iniciar()){
            $viaje->cargar($datos);
    
            if ($viaje->insertar()) {
                $coleccionViajes = $this->getColeccionViajes();
                array_push($coleccionViajes, $viaje);
                $this->setColeccionViajes($coleccionViajes);
                $booleano = true;
    
            } else {
    
                $booleano = false;
    
            }
        }else{
            $this->setmensajeoperacion($base->getError());
        }
        return $booleano;
    }

    public function __toString()
    {
        return "Id Empresa: " . $this->getIdEmpresa() . "\n" .
               "Nombre: " . $this->getNombre() . "\n" .
               "Direccion: " . $this->getDireccion()."\n";
    }
}
    