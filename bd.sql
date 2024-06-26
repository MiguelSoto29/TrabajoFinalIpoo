CREATE DATABASE bdviajes;

CREATE TABLE empresa(
    idempresa bigint AUTO_INCREMENT,
    enombre varchar(150),
    edireccion varchar(150),
    PRIMARY KEY (idempresa)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

create table persona(
    nombre varchar(150),
    apellido varchar(150),
    documento varchar(15) PRIMARY KEY,
    ptelefono varchar(15)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE responsable (
    rnumeroempleado bigint AUTO_INCREMENT,
    rnumerolicencia varchar(15),
    rdocumento varchar(15),
    PRIMARY KEY (rnumeroempleado),
    FOREIGN KEY (rdocumento) REFERENCES persona (documento) on UPDATE CASCADE on DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE viaje (
    idviaje bigint AUTO_INCREMENT,
    vdestino varchar(150),
    vcantmaxpasajeros int,
    idempresa bigint,
    rnumeroempleado bigint,
    PRIMARY KEY (idviaje),
    FOREIGN KEY (idempresa) REFERENCES empresa (idempresa)  ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (rnumeroempleado) REFERENCES responsable (rnumeroempleado) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE pasajero (
    pdocumento varchar(15),
    idviaje bigint,
    PRIMARY KEY (pdocumento),
    FOREIGN KEY (idviaje) REFERENCES viaje (idviaje),
    FOREIGN KEY (pdocumento) REFERENCES persona (documento) on UPDATE CASCADE on DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8;