
SET FOREIGN_KEY_CHECKS=0;


TRUNCATE TABLE utente;
TRUNCATE TABLE serie;
TRUNCATE TABLE attore;
TRUNCATE TABLE serie_attore;
TRUNCATE TABLE genere;
TRUNCATE TABLE serie_genere;
TRUNCATE TABLE consiglio;
TRUNCATE TABLE voto;
TRUNCATE TABLE preferiti;
TRUNCATE TABLE episodio;
TRUNCATE TABLE visto;
TRUNCATE TABLE post;
TRUNCATE TABLE commento;

-- utente
-- INSERT INTO Utente VALUES(id, user, pass, mail,fotoprofilo, nome, cognome, dataNasc, tipo);
INSERT INTO utente VALUES ('1', 'admin', '8C6976E5B5410415BDE908BD4DEE15DFB167A9C873FC4BB8A81F6F2AB448A918', 'admin@support.it', '../img/fotoProfilo/user.png', 'Lorenzo', 'Busin', '1997/05/16', 'admin');
INSERT INTO utente VALUES ('2', 'user', '04F8996DA763B7A969B1028EE3007569EAF3A635486DDAB211D512C85B9DF8FB', 'rossiluca@gmail.com','../img/fotoProfilo/user.png', 'Luca', 'Rossi', '1997/04/21', 'user');
INSERT INTO utente VALUES ('3', 'user1', 'user1', 'cornish3@google.com.br' ,'../img/fotoProfilo/user.png', 'Annamaria', 'Cornish', '1988/02/21', 'user');
INSERT INTO utente VALUES ('4', 'user2', 'user2', 'cchinghnam@yahoo.com','../img/fotoProfilo/user.png', 'Cyndi', 'Highnam', '1997/01/08', 'user');
INSERT INTO utente VALUES ('5', 'user3', 'user3', 'johnslo@gmail.com','../img/fotoProfilo/user.png', 'John', 'Slowan', '1994/09/06', 'user');


-- serie
-- INSERT INTO serie VALUES(id, miniatura, background, titolo, distr, desc, creatore, flag_terminata, consigliato, non_cons, pref, voto);
INSERT INTO serie VALUES('1', '../img/miniature/narcos_min.jpg', '../img/showsBackgrounds/narcos_back.jpg', 'Narcos', 'Netflix', 'La serie racconta la storia vera della dilagante diffusione della cocaina tra Stati Uniti ed Europa negli anni ottanta. Le prime due stagioni sono incentrate sulla lotta delle autorit&agrave; colombiane e della DEA contro il narcotrafficante Pablo Escobar e il cartello di <span xml:lang="ES">Medellin</span>, mentre la terza stagione &egrave; incentrata sulla lotta al cartello di Cali, guidato dai fratelli <span xml:lang="ES">Gilberto e Miguel Rodriguez Orejuela</span>.', 'Chris Brancato', '1', '3400', '100', '0', '0' );
INSERT INTO serie VALUES('2', '../img/miniature/daredevil_min.jpg', '../img/showsBackgrounds/daredevil_back.jpg', '<span xml:lang="EN">Daredevil</span>', 'Netflix', '<span xml:lang="EN">Matt Murdock</span>, dopo aver perso la vista da bambino a causa di un incidente radioattivo, sviluppa dei sensi sovrumani e li utilizza per combattere il crimine per le strade della sua citt&agrave; nei panni del supereroe <span xml:lang="EN">Daredevil</span>. Nella prima stagione Matt affronta il potente signore del crimine <span xml:lang="EN">Wilson Fisk</span>, alias <span xml:lang="EN">Kingpin</span>, impegnato nella sua opera di riqualificazione del quartiere in combutta con vari esponenti della malavita della citt&agrave;.', '<span xml:lang="EN">Drew Goddard</span>', '0', '100', '20', '0', '0' );
INSERT INTO serie VALUES('3', '../img/miniature/twd_min.jpg', '../img/showsBackgrounds/twd_back.jpg', '<span xml:lang="EN">The Walking Dead</span>', '<span xml:lang="EN"><acronym>AMC</acronym></span>', '<span xml:lang="EN">Rick Graims</span> &egrave; un vice sceriffo vittima di un incidente durante uno scontro a fuoco con dei fuorilegge: colpito alla schiena, va in coma, lasciando tra le lacrime la moglie Lori e il figlio Carl. Il risveglio, poco tempo dopo, &egrave; traumatico. Rick non ci metter&agrave; molto a capire la situazione: il virus che sembrava essere controllato prima del suo incidente, ha preso piede.', '<span xml:lang="EN">Frank Darabont</span>', '0', '5000', '250', '0', '0' );
INSERT INTO serie VALUES('4', '../img/miniature/hillhouse_min.jpg', '../img/showsBackgrounds/hillhouse_back.jpg', '<span xml:lang="EN">Hill House</span>', 'Netflix', 'La serie racconta la storia di un gruppo di fratelli che, da bambini, sono cresciuti in quella che in seguito sarebbe diventata la casa infestata pi&ugrave; famosa del paese. Ora adulti e costretti a stare di nuovo insieme di fronte alla tragedia, la famiglia deve finalmente affrontare i fantasmi del loro passato, alcuni dei quali sono ancora in agguato nelle loro menti.', 'Mike Flanagan', '0', '68', '50', '0', '0' );
INSERT INTO serie VALUES('5', '../img/miniature/gomorra_min.jpg', '../img/showsBackgrounds/gomorra_back.jpg', 'Gomorra', 'Sky', 'Liberamente ispirata al best seller di Roberto Saviano, la serie racconta le gesta di camorristi, spacciatori di droga, che agiscono nella periferia di Napoli. Nel contesto di organizzazioni criminali di stampo mafioso, con ramificazioni nel mondo degli affari e in quello della politica, i personaggi sono descritti con crudo realismo e presentano un complesso miscuglio di comportamenti talvolta brutali e avidi, talaltra pseudo sentimentali.', 'Roberto Saviano', '0', '500', '400', '0', '0' );
INSERT INTO serie VALUES('6', '../img/miniature/breakingBad_min.jpg', '../img/showsBackgrounds/bb_back.jpg', '<span xml:lang="EN">Breaking Bad</span>', '<span xml:lang="EN"><acronym>AMC</acronym></span>', 'Quando a Walter viene diagnosticato un cancro ai polmoni, i suoi problemi sembrano precipitare. Tuttavia, in seguito al casuale incontro con <span xml:lang="EN">Jesse Pinkman</span>, un suo ex studente diventato uno spacciatore di poco conto, Walter decide di cucinare i cristalli di metanfetamina. Il prodotto di Walter si rivela per&ograve; di qualit&agrave; nettamente superiore rispetto alla concorrenza, con una purezza del 99,1%, derivante dalle sue conoscenze chimiche. Decide quindi di sfruttare le sue capacit&agrave; per prendere il controllo del mercato della droga.', 'Vince Gilligan', '1', '10000', '250', '0', '0' );
INSERT INTO serie VALUES('7', '../img/miniature/mrRobot_min.jpg', '../img/showsBackgrounds/mrrobot_back.jpg', 'Mr Robot', '<span xml:lang="EN"><acronym>USA</acronym> Network</span> ', 'Elliot viene avvicinato da Mr. Robot, un misterioso anarchico-insurrezionalista, che intende introdurlo in un gruppo di hacktivisti conosciuti con il nome di <span xml:lang="EN">fsociety</span>. Il manifesto di <span xml:lang="EN">fsociety</span> &egrave; liberare la popolazione dai debiti con le banche e smascherare i potenti che stanno distruggendo il mondo.', 'Sam Esmail', '0', '777', '50', '0', '0' );
INSERT INTO serie VALUES('8', '../img/miniature/sherlock_min.jpg', '../img/showsBackgrounds/sherlock_back.jpg', '<span xml:lang="EN">Sherlock</span>', '<span xml:lang="EN"><acronym>BBC</acronym></span>', 'La serie &egrave; un libero adattamento dei romanzi e dei racconti di <span xml:lang="EN">Sir Arthur Conan Doyle</span> e vede come protagonista il detective <span xml:lang="EN">Sherlock Holmes</span>, affiancato dal suo amico e assistente, il dottor <span xml:lang="EN">John Watson</span>. Le avventure dei due si svolgono per&ograve; nella Londra odierna, e non in quella presentata da <span xml:lang="EN">Doyle. Watson</span> &egrave; un reduce della guerra in Afghanistan e deve ancora ritrovare il suo posto nella societ&agrave;. Quando un amico gli suggerisce di trovarsi un coinquilino con cui dividere le spese di un appartamento, si ritrova a vivere con <span xml:lang="EN">Sherlock Holmes</span>, che col passare degli anni diventer&agrave; suo compagno di vita.', 'Steven Moffat', '0', '100', '78', '0', '0' );
INSERT INTO serie VALUES('9', '../img/miniature/casaDePapel_min.jpg', '../img/showsBackgrounds/casaDePapel_back.jpg', '<span xml:lang="ES">La Casa de Papel</span>', 'Netflix', 'Otto ladri si barricano nell\'edificio della Zecca spagnola con alcuni ostaggi, mentre una mente criminale manipola la polizia per mettere in atto il suo piano.', 'Alex Pina', '0', '1500', '177', '0', '0' );
INSERT INTO serie VALUES('10', '../img/miniature/heathers_min.jpg', '../img/showsBackgrounds/heaters_back.jpg', '<span xml:lang="EN">Heathers</span>', '<span xml:lang="EN">Paramount Network</span>', 'La serie &egrave; stata pensata per essere un\'antologia, con ogni stagione che si svolge in un contesto completamente diverso.', 'Jason Micallef', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('11', '../img/miniature/blackMirror_min.jpg', '../img/showsBackgrounds/blackmirror_back.jpg', '<span xml:lang="EN">Black Mirror</span>', 'Netflix', 'Questa serie di fantascienza esplora un futuro prossimo, tecnologico e inquietante, nel quale le invenzioni pi&ugrave; innovative si scontrano con i pi&ugrave; oscuri istinti umani.', 'Charlie Brooker', '0', '90', '6', '0', '0' );
INSERT INTO serie VALUES('12', '../img/miniature/elite_min.jpg', '../img/showsBackgrounds/elite_back.jpg', '<span xml:lang="EN">Elite</span>', 'Netflix', 'Quando tre adolescenti figli di operai sono ammessi in una delle scuole private pi&ugrave; esclusive della Spagna, lo scontro con i ricchi coetanei sfocia in un omicidio.', 'Carlos Montero', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('13', '../img/miniature/thePurge_min.jpg', '../img/showsBackgrounds/thePurge_back.jpg', '<span xml:lang="EN">The purge</span>', '<span xml:lang="EN">Paramount Network</span>', 'Ogni anno tutti i reati sono legali negli Stati Uniti per un periodo di 12 ore.', 'James DeMonaco', '0', '100', '10', '0', '0' );
INSERT INTO serie VALUES('14', '../img/miniature/limitless_min.jpg', '../img/showsBackgrounds/limitless_back.jpg', '<span xml:lang="EN">Limitless</span>', '<span xml:lang="EN"><acronym>CBS</acronym></span>', '<span xml:lang="EN">Brian Finch</span> &egrave; un cittadino statunitense che, dopo aver assunto il farmaco sperimentale nootropo NZT, riesce a sfruttare le sue capacit&agrave; neurali molto al di sopra della media, acquisendo una memoria e una capacit&agrave; di comprensione e analisi sovrumane.', 'Craig Sweeny', '0', '1000', '400', '0', '0' );




-- preferiti
-- INSERT INTO preferiti VALUES(id_serie, idutente);
INSERT INTO preferiti VALUES('1', '2');
INSERT INTO preferiti VALUES('4', '2');
INSERT INTO preferiti VALUES('6', '2');
INSERT INTO preferiti VALUES('11', '2');
INSERT INTO preferiti VALUES('9', '2');
INSERT INTO preferiti VALUES('2', '2');
INSERT INTO preferiti VALUES('3', '2');

-- consiglio
-- INSERT INTO consiglio VALUES(idserie, idutente, consigliato);
INSERT INTO consiglio VALUES('1', '2', '1');
INSERT INTO consiglio VALUES('3', '2', '1');
INSERT INTO consiglio VALUES('6', '2', '1');
INSERT INTO consiglio VALUES('7', '2', '0');





-- post
-- INSERT INTO post VALUES(id, idserie, idutente, testo);
INSERT INTO post VALUES('1', '1', '3', 'Wow');
INSERT INTO post VALUES('2', '1', '2', 'Aspettando la nuova stagione...');
INSERT INTO post VALUES('3', '1', '4', 'Stupendo!');
INSERT INTO post VALUES('4', '2', '4', 'Consigliatissimo!!!');
INSERT INTO post VALUES('5', '2', '2', 'Mi aspettavo qualcosa di meglio');
INSERT INTO post VALUES('6', '3', '2', 'Molto bello!');
INSERT INTO post VALUES('7', '3', '3', 'Gli zombie sembrano finti');
INSERT INTO post VALUES('8', '6', '3', 'La serie TV migliore in assoluto!');
INSERT INTO post VALUES('9', '6', '3', 'Sempre stupenda');
INSERT INTO post VALUES('10', '6', '3', 'Intramontabile!!');


-- commento
-- INSERT INTO commento VALUES(id, idepisodio, idutente, immagine, testo);
INSERT INTO commento VALUES('1', '1', '2', '', 'Ottimo inizio di stagione!');
INSERT INTO commento VALUES('2', '1', '3', '', 'Noioso');
INSERT INTO commento VALUES('4', '2', '4', '', 'xD xD');
INSERT INTO commento VALUES('5', '2', '3', '', 'hola pablo :)');
INSERT INTO commento VALUES('6', '3', '2', '', 'Ma pablo non c\'&egrave;');



-- risposta
-- INSERT INTO risposta VALUES(id, nome, cognome, bio);



-- attore
-- INSERT INTO attore VALUES(id, miniatura, nome, cognome, bio);
INSERT INTO attore VALUES('1', '../img/miniature/attori/wagner-moura_min.jpg', 'Wagner', 'Moura', 'Wagner Manicoba de Moura (Rodelas, 27 giugno 1976), &egrave; un attore brasiliano.');
INSERT INTO attore VALUES('2', '../img/miniature/attori/pedro-pascal_min.jpg', 'Pedro', 'Pascal', 'Jose Pedro Balmaceda Pascal (Santiago del Cile, 2 aprile 1975) &egrave; un attore cileno naturalizzato statunitense.');
INSERT INTO attore VALUES('3', '../img/miniature/attori/charli-cox_min.jpg', 'Charlie', 'Cox', 'Charlie Thomas Cox, meglio noto come Charlie Cox (Londra, 15 dicembre 1982), &egrave; un attore britannico, principalmente noto per aver interpretato Matt Murdock/Daredevil nella serie televisiva Daredevil');
INSERT INTO attore VALUES('4', '../img/miniature/attori/deborah-woll_min.jpg', 'Deborah', 'Ann Woll', 'Deborah Ann Woll (Brooklyn, 7 febbraio 1985) &egrave; una attrice statunitense');
INSERT INTO attore VALUES('5', '../img/miniature/attori/andrew-lincoln_min.jpg', 'Andrew', 'Lincoln', 'Andrew James Clutterbuck (Londra, 14 settembre 1973) &egrave; un attore britannico');
INSERT INTO attore VALUES('6', '../img/miniature/attori/norman-reedus_min.jpg', 'Norman', 'Reedus', 'Norman Mark Reedus (Hollywood, 6 gennaio 1969) &egrave; un attore e modello statunitense.');
INSERT INTO attore VALUES('7', '../img/miniature/attori/michiel-huisman_min.jpg', 'Michiel', 'Huisman', 'Michiel Huisman &egrave; un attore, cantante e musicista olandese.');
INSERT INTO attore VALUES('8', '../img/miniature/attori/salvatore-esposito_min.jpg', 'Salvatore', 'Esposito', 'Salvatore Esposito (Napoli, 2 febbraio 1986) &egrave; un attore italiano. &egrave; noto principalmente per il ruolo di Gennaro "Genny" Savastano nella serie televisiva Gomorra.');
INSERT INTO attore VALUES('9', '../img/miniature/attori/bryan-cranston_min.jpg', 'Bryan', 'Cranston', 'Bryan Lee Cranston (Los Angeles, 7 marzo 1956) &egrave; un attore, doppiatore, regista, sceneggiatore, produttore cinematografico e produttore televisivo statunitense.');
INSERT INTO attore VALUES('10', '../img/miniature/attori/aaron-paul_min.jpg', 'Aaron', 'Paul', 'Aaron Paul Sturtevant, noto semplicemente come Aaron Paul (Emmett, 26 agosto 1979) &egrave; un attore statunitense.');
INSERT INTO attore VALUES('11', '../img/miniature/attori/rami-malek_min.jpg', 'Rami', 'Malek', 'Rami Said Malek (Los Angeles, 12 maggio 1981) &egrave; un attore statunitense, noto principalmente per la sua interpretazione di Ahkmenrah nella saga di film Una notte al museo e di Elliot Alderson nella pluripremiata serie televisiva Mr. Robot, per la quale si aggiudica un Emmy per il miglior attore in una serie drammatica e riceve due nomination ai Golden Globe.');
INSERT INTO attore VALUES('12', '../img/miniature/attori/benedict-cumberbatch_min.jpg', 'Benedict', 'Cumberbatch', 'Benedict Timothy Carlton Cumberbatch (Londra, 19 luglio 1976) &egrave; un attore e doppiatore britannico. I ruoli pi&ugrave; conosciuti da lui interpretati sono quelli di Sherlock Holmes nella serie televisiva omonima, di Alan Turing nel film The Imitation Game e del Dottor Strange nel Marvel Cinematic Universe.');


-- serie_attore
-- INSERT INTO serie_attore VALUES(idserie, idattore);
INSERT INTO serie_attore VALUES('1', '1');
INSERT INTO serie_attore VALUES('1', '2');
INSERT INTO serie_attore VALUES('2', '3');
INSERT INTO serie_attore VALUES('2', '4');
INSERT INTO serie_attore VALUES('3', '5');
INSERT INTO serie_attore VALUES('3', '6');
INSERT INTO serie_attore VALUES('4', '7');
INSERT INTO serie_attore VALUES('5', '8');
INSERT INTO serie_attore VALUES('6', '9');
INSERT INTO serie_attore VALUES('6', '10');
INSERT INTO serie_attore VALUES('7', '11');
INSERT INTO serie_attore VALUES('8', '12');

-- genere
-- INSERT INTO genere VALUES(id, nome);
INSERT INTO genere VALUES('1', 'Nuove uscite');
INSERT INTO genere VALUES('2', 'Drammatico');
INSERT INTO genere VALUES('3', 'Thriller');
INSERT INTO genere VALUES('4', 'Horror');
INSERT INTO genere VALUES('5', 'Azione');
INSERT INTO genere VALUES('6', 'Gangster');
INSERT INTO genere VALUES('7', 'Biografico');
INSERT INTO genere VALUES('8', 'Post apocalittico');
INSERT INTO genere VALUES('9', 'Poliziesco');

-- serie_genere
-- INSERT INTO genere VALUES(idserie, idgenere);
INSERT INTO serie_genere VALUES('1', '7');
INSERT INTO serie_genere VALUES('1', '2');
INSERT INTO serie_genere VALUES('1', '9');
INSERT INTO serie_genere VALUES('1', '6');
INSERT INTO serie_genere VALUES('2', '5');
INSERT INTO serie_genere VALUES('3', '9');
INSERT INTO serie_genere VALUES('3', '2');
INSERT INTO serie_genere VALUES('3', '8');
INSERT INTO serie_genere VALUES('3', '4');
INSERT INTO serie_genere VALUES('4', '4');
INSERT INTO serie_genere VALUES('5', '3');
INSERT INTO serie_genere VALUES('5', '5');
INSERT INTO serie_genere VALUES('5', '6');
INSERT INTO serie_genere VALUES('6', '2');
INSERT INTO serie_genere VALUES('6', '3');
INSERT INTO serie_genere VALUES('6', '5');
INSERT INTO serie_genere VALUES('7', '3');
INSERT INTO serie_genere VALUES('7', '2');
INSERT INTO serie_genere VALUES('8', '9');
INSERT INTO serie_genere VALUES('8', '2');
INSERT INTO serie_genere VALUES('9', '2');
INSERT INTO serie_genere VALUES('9', '5');
INSERT INTO serie_genere VALUES('13', '1');
INSERT INTO serie_genere VALUES('12', '1');
INSERT INTO serie_genere VALUES('10', '1');
INSERT INTO serie_genere VALUES('14', '1');
INSERT INTO serie_genere VALUES('4', '1');



-- episodio
-- INSERT INTO episodio VALUES(id, titolo, desc, num, data, stagione, visualizzato, voto, idserie);
INSERT INTO episodio VALUES('1', 'Discesa', 'Il chimico Cucaracha consegna un carico di stupefacenti al contrabbandiere Pablo Escobar.', '1', '2015/08/28', '1', '0', '0', '1');
INSERT INTO episodio VALUES('2', 'La spada di Simon Bolivar', 'Il gruppo comunista radicale M-19 sfida i narcos, mentre Murphy scopre i metodi delle forze armate colombiane dal suo nuovo collega Peña.', '2', '2015/08/28', '1', '0', '0', '1');
INSERT INTO episodio VALUES('3', 'Finalmente libero', 'Dopo una massiccia operazione militare volta a catturare Pablo, la sua famiglia si riunisce e i suoi nemici si preoccupano. Steve e Connie discutono di sicurezza.', '1', '2016/09/02', '2', '0', '0', '1');
INSERT INTO episodio VALUES('4', 'La strategia del capo', 'I gentiluomini di Cali convocano i soci per un annuncio a sorpresa sul futuro della loro attivit&agrave;.', '1', '2017/09/01', '3', '0', '0', '1');
INSERT INTO episodio VALUES('5', 'Sul ring', 'Matt Murdock e il suo amico Foggy Nelson aprono uno studio legale indipendente: la loro prima cliente &egrave; una segretaria della Union Allied, Karen, accusata di omicidio.', '1', '2015/04/10', '1', '0', '0', '2');
INSERT INTO episodio VALUES('6', 'Bang!', 'Una nuova minaccia riempie il vuoto lasciato da Fisk a Hells Kitchen. Murdock e Foggy accettano un cliente dal passato discutibile.', '1', '2016/03/18', '2', '0', '0', '2');
INSERT INTO episodio VALUES('7', 'I giorni andati', 'Rick si sveglia in un ospedale, dopo aver avuto un incidente sul campo dove &egrave; rimasto ferito, e scopre la drammatica verit&agrave;: la sua famiglia &egrave; scomparsa, tutti sono scomparsi. O peggio, strane e orribili creature assetate di sangue...', '1', '2010/10/31', '1', '0', '0', '3');
INSERT INTO episodio VALUES('8', 'La strada da percorrere', 'La seconda stagione si apre con Rick e il suo gruppo che scappano da Atlanta e vengono minacciati da un pericolo mai incontrato prima, altrove un gruppo cerca una persona scomparsa.', '1', '2011/10/16', '2', '0', '0', '3');
INSERT INTO episodio VALUES('9', 'Steven vede un fantasma', 'Indagando su una storia di fantasmi per il suo ultimo romanzo, uno scettico Steven riceve una telefonata dalla sorella che innesca una catena di eventi fatali.', '1', '2018/10/12', '1', '0', '0', '4');
INSERT INTO episodio VALUES('10', 'Il clan dei Savastano', 'Il controllo di Pietro Savastano, potente boss del Napoletano, &egrave; minacciato dal clan rivale di Salvatore Conte. Una serie di agguati e intimidazioni apre la guerra per il controllo del territorio.', '1', '2014/05/06', '1', '0', '0', '5');
INSERT INTO episodio VALUES('11', 'Questione di chimica', 'Dopo la diagnosi di cancro terminale ai polmoni, un insegnante di chimica del liceo si d&agrave; alla produzione di metanfetamine per garantire la sopravvivenza della famiglia.', '1', '2008/01/20', '1', '0', '0', '6');
INSERT INTO episodio VALUES('12', 'Tutto cambia', 'Mentre pianificano una grossa vendita finale di stupefacenti, Walt e Jesse si preoccupano del fatto che possano ucciderli.', '1', '2009/03/08', '2', '0', '0', '6');
INSERT INTO episodio VALUES('13', 'Ciao amico', 'Elliot Alderson &egrave; un ingegnere informatico, vive a New York e lavora presso una azienda di sicurezza informatica AllSafe Security. Soffre di paranoia ed &egrave; convinto di essere pedinato.', '1', '2015/06/24', '1', '0', '0', '7');
INSERT INTO episodio VALUES('14', 'Uno studio in rosa', 'Una donna in rosa &egrave; la quarta vittima di una serie di suicidi apparentemente scollegati, ma Sherlock Holmes capisce che in realt&agrave; si tratta di terribili omicidi.', '2', '2010/07/25', '1', '0', '0', '8');

INSERT INTO episodio VALUES('15', 'Senza ritorno', '', '2', '2008-01-27', '1', '0', '0', '6');
INSERT INTO episodio VALUES('16', 'Conseguenze radicali', '', '3', '2008-02-10', '1', '0', '0', '6');
INSERT INTO episodio VALUES('17', 'Una malattia scomoda', '', '4', '2009-03-15', '1', '0', '0', '6');
INSERT INTO episodio VALUES('18', 'Grigliato', '', '2', '2009-03-20', '2', '0', '0', '6');
INSERT INTO episodio VALUES('19', 'Punto da un\'ape', '', '3', '2009-03-28', '2', '0', '0', '6');



-- visto
-- INSERT INTO visto VALUES(idepisodio, idutente);
INSERT INTO visto VALUES('1', '2');
INSERT INTO visto VALUES('1', '3');
INSERT INTO visto VALUES('1', '4');
INSERT INTO visto VALUES('1', '5');
INSERT INTO visto VALUES('2', '4');
INSERT INTO visto VALUES('2', '2');

-- voto
-- INSERT INTO voto VALUES(episodio, utente, voto);
INSERT INTO voto VALUES('1', '2', '3');
INSERT INTO voto VALUES('1', '3', '4');
INSERT INTO voto VALUES('1', '4', '3');
INSERT INTO voto VALUES('2', '2', '1');
INSERT INTO voto VALUES('2', '3', '5');
INSERT INTO voto VALUES('2', '4', '2');
INSERT INTO voto VALUES('2', '5', '5');


-- segnalazione
-- INSERT INTO segnalazione VALUES(id, nome, cognome, bio);