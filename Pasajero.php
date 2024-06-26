<?php
class Pasajero extends Persona
{
    private $idViaje;    

    public function __construct()
    {
    parent::__construct();  //nombre varchar(150), apellido varchar(150), documento varchar, ptelefono varchar
    $this->idViaje = '';
    }

    public function cargar($datos) {
        parent::cargar($datos);
        $this->setIdViaje($datos['idViaje']);
    }

public function setIdViaje($idViaje) {
    $this->idViaje = $idViaje;
}

public function getIdViaje() {
    return $this->idViaje;
}

public function getmensajeoperacion(){
    return $this->mensajeoperacion;
}

public function setmensajeoperacion($mensajeoperacion)
{
    $this->mensajeoperacion = $mensajeoperacion;
}

    public function Buscar($documento)
    {
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM pasajero WHERE pdocumento = " . $documento;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($documento);
                    $this->setIdViaje($row2['idviaje']);
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

    public function listar($condicion = ""){
        $arregloPasajero = [];
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM pasajero ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " order by pdocumento ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloPasajero = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Pasajero();
                    $obj->Buscar($row2['pdocumento']);
                    array_push($arregloPasajero, $obj);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloPasajero;
    }

    public function insertar()
    {
        $base = new bdViajeFeliz();
        $resp = false;

        if (parent::insertar()) {
            $consultaInsertar = "INSERT INTO pasajero(pdocumento, idviaje ) VALUE
            ('" .  parent::getDocumento() . "'," . $this->getIdViaje().")";
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaInsertar)) {
                    $resp = true;
                }else{
                    $this->setmensajeoperacion($base->getError());
                }
            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    public function modificar(){
        $resp = false;
        $base = new bdViajeFeliz();
        if (parent::modificar()) {
            $consultaModificar = "UPDATE pasajero SET idviaje = " . $this->getIdViaje() . " WHERE pdocumento = " . parent::getDocumento();
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaModificar)) {
                    $resp = true;
                }else{
                    $this->setmensajeoperacion($base->getError());
                }
            }else{
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    public function eliminar() 
    {
        $base = new bdViajeFeliz();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM pasajero WHERE pdocumento =" . parent::getDocumento();
            if ($base->Ejecutar($consultaBorra)) {
                if (parent::eliminar()) {
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

public function __toString()
{
    $resp = parent::__toString();
    $resp .= "\nid viaje: " . $this->getIdViaje();
    return $resp;
}

}