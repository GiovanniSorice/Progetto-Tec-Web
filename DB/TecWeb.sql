SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS utente;
CREATE TABLE utente (
  id int PRIMARY KEY,
  username char(30) NOT NULL,
  password char(30) NOT NULL,
  email char(30) NOT NULL,
  immagine varchar(200),
  nome char(30) NOT NULL,
  cognome char(30) NOT NULL,
  data_nascita date NOT NULL,
  tipo enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS serie;
CREATE TABLE serie (
  id int PRIMARY KEY,
  immagine varchar(200),
  titolo char(30) NOT NULL,
  distribuzione char(30) NOT NULL,
  descrizione varchar(50) NOT NULL,
  creatore char(30) NOT NULL,
  terminata boolean NOT NULL,
  consigliato int DEFAULT 0,
  non_consigliato int DEFAULT 0,
  preferiti int DEFAULT 0,
  voto int DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- serie

-- INSERT INTO serie VALUES(id, img, titolo, distr, desc, creatore, flag_terminata, consigliato, non_cons, pref, voto);
INSERT INTO serie VALUES('1', '', 'Narcos', 'Netflix', 'La serie racconta la storia vera della dilagante diffusione della cocaina tra Stati Uniti ed Europa negli anni ottanta. Le prime due stagioni sono incentrate sulla lotta delle autorità colombiane e della DEA contro il narcotrafficante Pablo Escobar e il cartello di Medellín, mentre la terza stagione è incentrata sulla lotta al cartello di Cali, guidato dai fratelli Gilberto e Miguel Rodríguez Orejuela.', 'Chris Brancato', '1', '0', '0', '0' );
INSERT INTO serie VALUES('2', '', 'Daredevil', 'Netflix', 'Matt Murdock, dopo aver perso la vista da bambino a causa di un incidente radioattivo, sviluppa dei sensi sovrumani e li utilizza per combattere il crimine per le strade della sua città nei panni del supereroe Daredevil. Nella prima stagione Matt affronta il potente signore del crimine Wilson Fisk, alias Kingpin, impegnato nella sua opera di riqualificazione del quartiere in combutta con vari esponenti della malavita della città.Nella seconda stagione Matt continua a cercare di gestire la sua doppia vita come avvocato e supereroe; il suo cammino lo porta ad incrociarsi con il freddo, violento e spietato vigilante Frank Castle, alias The Punisher,e con la sua vecchia fiamma Elektra, assieme alla quale affronta una antica e potente setta ninja, la Mano.', 'Drew Goddard', '0', '0', '0', '0' );
INSERT INTO serie VALUES('3', '', 'The Walking Dead', 'AMC', 'Rick Graims è un vice sceriffo vittima di un incidente durante uno scontro a fuoco con dei fuorilegge: colpito alla schiena, va in coma, lasciando tra le lacrime la moglie Lori e il figlio Carl. Il risveglio, poco tempo dopo, è traumatico. Rick non ci metterà molto a capire la situazione: il virus che sembrava essere controllato prima del suo incidente, ha preso piede.', 'Frank Darabont', '0', '0', '0', '0' );
INSERT INTO serie VALUES('4', '', 'Hill House', 'Netflix', 'La serie racconta la storia di un gruppo di fratelli che, da bambini, sono cresciuti in quella che in seguito sarebbe diventata la casa infestata più famosa del paese. Ora adulti e costretti a stare di nuovo insieme di fronte alla tragedia, la famiglia deve finalmente affrontare i fantasmi del loro passato, alcuni dei quali sono ancora in agguato nelle loro menti.', 'Mike Flanagan', '0', '0', '0', '0' );
INSERT INTO serie VALUES('5', '', 'Gomorra', 'Sky', 'Liberamente ispirata al best seller di Roberto Saviano, la serie racconta le gesta di camorristi, spacciatori di droga, che agiscono nella periferia di Napoli. Nel contesto di organizzazioni criminali di stampo mafioso, con ramificazioni nel mondo degli affari e in quello della politica, i personaggi sono descritti con crudo realismo e presentano un complesso miscuglio di comportamenti talvolta brutali e avidi, talaltra pseudo sentimentali.', 'Roberto Saviano', '0', '0', '0', '0' );
INSERT INTO serie VALUES('6', '', 'Breking Bad', 'AMC', 'Quando a Walter viene diagnosticato un cancro ai polmoni, i suoi problemi sembrano precipitare. Tuttavia, in seguito al casuale incontro con Jesse Pinkman, un suo ex studente diventato uno spacciatore di poco conto, Walter decide di cucinare i cristalli di metanfetamina. Il prodotto di Walter si rivela però di qualità nettamente superiore rispetto alla concorrenza, con una purezza del 99,1%, derivante dalle sue conoscenze chimiche. Decide quindi di sfruttare le sue capacità per prendere il controllo del mercato della droga.', 'Vince Gilligan', '1', '0', '0', '0' );
INSERT INTO serie VALUES('7', '', 'Mr Robot', 'UCB', 'Elliot viene avvicinato da Mr. Robot, un misterioso anarchico-insurrezionalista, che intende introdurlo in un gruppo di hacktivisti conosciuti con il nome di fsociety. Il manifesto di fsociety è liberare la popolazione dai debiti con le banche e smascherare i potenti che stanno distruggendo il mondo.', 'Sam Esmail', '0', '0', '0', '0' );
INSERT INTO serie VALUES('8', '', 'Sherlock', 'BBC', 'La serie è un libero adattamento dei romanzi e dei racconti di Sir Arthur Conan Doyle e vede come protagonista il detective Sherlock Holmes, affiancato dal suo amico e assistente, il dottor John Watson. Le avventure dei due si svolgono però nella Londra odierna, e non in quella presentata da Doyle. Watson è un reduce della guerra in Afghanistan e deve ancora ritrovare il suo posto nella società. Quando un amico gli suggerisce di trovarsi un coinquilino con cui dividere le spese di un appartamento, si ritrova a vivere con Sherlock Holmes, che col passare degli anni diventerà suo compagno di vita.', 'Steven Moffat', '0', '0', '0', '0' );

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
  testo varchar (200) NOT NULL,

  FOREIGN KEY (id_serie) REFERENCES serie(id) ,
  FOREIGN KEY (id_utente) REFERENCES utente(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS commento;
CREATE TABLE commento (
  id int PRIMARY KEY,
  id_episodio int,
  id_utente int,
  immagine varchar(200),
  testo varchar (200) NOT NULL,

  FOREIGN KEY (id_episodio) REFERENCES episodio(id) ,
  FOREIGN KEY (id_utente) REFERENCES utente(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS risposta;
CREATE TABLE risposta (
  id int PRIMARY KEY,
  id_commento int,
  id_utente int,
  testo varchar (200) NOT NULL,

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
  descrizione varchar(30) NOT NULL,
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








