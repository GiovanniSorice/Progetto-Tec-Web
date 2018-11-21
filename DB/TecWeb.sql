SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS utente;
CREATE TABLE utente (
  id int PRIMARY KEY,
  username char(30) NOT NULL,
  password char(30) NOT NULL,
  email char(30) NOT NULL,
  immagine varchar(500),
  nome char(30) NOT NULL,
  cognome char(30) NOT NULL,
  data_nascita date NOT NULL,
  tipo enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS serie;
CREATE TABLE serie (
  id int PRIMARY KEY,
  immagine varchar(500),
  titolo char(30) NOT NULL,
  distribuzione char(30) NOT NULL,
  descrizione varchar(500) NOT NULL,
  creatore char(30) NOT NULL,
  terminata boolean NOT NULL,
  consigliato int DEFAULT 0,
  non_consigliato int DEFAULT 0,
  preferiti int DEFAULT 0,
  voto int DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS preferiti;
CREATE TABLE preferiti (
  id_serie int,
  id_utente int,

  FOREIGN KEY (id_serie) REFERENCES serie(id) ,
  FOREIGN KEY (id_utente) REFERENCES utente(id),

  PRIMARY KEY (id_serie, id_utente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS consiglio;
CREATE TABLE consiglio (
  id_serie int,
  id_utente int,
  consigliato boolean NOT NULL,

  FOREIGN KEY (id_serie) REFERENCES serie(id) ,
  FOREIGN KEY (id_utente) REFERENCES utente(id),

  PRIMARY KEY (id_serie, id_utente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS post;
CREATE TABLE post (
  id int PRIMARY KEY,
  id_serie int,
  id_utente int,
  testo varchar (500) NOT NULL,

  FOREIGN KEY (id_serie) REFERENCES serie(id) ,
  FOREIGN KEY (id_utente) REFERENCES utente(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS commento;
CREATE TABLE commento (
  id int PRIMARY KEY,
  id_episodio int,
  id_utente int,
  immagine varchar(500),
  testo varchar (500) NOT NULL,

  FOREIGN KEY (id_episodio) REFERENCES episodio(id) ,
  FOREIGN KEY (id_utente) REFERENCES utente(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS risposta;
CREATE TABLE risposta (
  id int PRIMARY KEY,
  id_commento int,
  id_utente int,
  testo varchar (500) NOT NULL,

  FOREIGN KEY (id_commento) REFERENCES commento(id) ,
  FOREIGN KEY (id_utente) REFERENCES utente(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS attore;
CREATE TABLE attore (
  id int PRIMARY KEY,
  nome char(30) NOT NULL,
  cognome char(30) NOT NULL,
  bio varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS serie_attore;
CREATE TABLE serie_attore (
  id_serie int,
  id_attore int,

  FOREIGN KEY (id_serie) REFERENCES serie(id) ,
  FOREIGN KEY (id_attore) REFERENCES attore(id),

  PRIMARY KEY (id_serie, id_attore)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS genere;
CREATE TABLE genere (
  id int PRIMARY KEY,
  nome char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS serie_genere;
CREATE TABLE serie_genere (
  id_serie int NOT NULL,
  id_genere int NOT NULL,

  FOREIGN KEY (id_serie) REFERENCES serie(id) ,
  FOREIGN KEY (id_genere) REFERENCES genere(id),

  PRIMARY KEY (id_serie, id_genere)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS episodio;
CREATE TABLE episodio (
  id int PRIMARY KEY,
  titolo char(30) NOT NULL,
  descrizione varchar(500) NOT NULL,
  numero int NOT NULL,
  data date NOT NULL,
  stagione int NOT NULL,
  visualizzato int DEFAULT 0,
  voto int DEFAULT 0, 
  id_serie int NOT NULL,

  FOREIGN KEY (id_serie) REFERENCES serie(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS visto;
CREATE TABLE visto (
  id_episodio int,
  id_utente int,
  visualizzato boolean NOT NULL,

  FOREIGN KEY (id_episodio) REFERENCES episodio(id) ,
  FOREIGN KEY (id_utente) REFERENCES utente(id),

  PRIMARY KEY (id_episodio, id_utente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS voto;
CREATE TABLE voto (
  id_episodio int,
  id_utente int,
  valutazione int NOT NULL,

  FOREIGN KEY (id_episodio) REFERENCES episodio(id) ,
  FOREIGN KEY (id_utente) REFERENCES utente(id),

  PRIMARY KEY (id_episodio, id_utente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS segnalazione;
CREATE TABLE segnalazione (
  id int PRIMARY KEY,
  id_ref int UNIQUE,
  id_utente int,
  tipo enum ('post','commento','risposta'),

  FOREIGN KEY (id_utente) REFERENCES utente(id)
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;








