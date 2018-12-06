
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

-- utente
-- INSERT INTO Utente VALUES(id, user, pass, mail, fotoprofilo, nome, cognome, dataNasc, tipo);
INSERT INTO utente VALUES ('1', 'admin', 'admin', 'admin@support.it', '', 'Lorenzo', 'Busin', '1997/05/16', 'admin');
INSERT INTO utente VALUES ('2', 'user', 'user', 'abrook@live.it', '', 'Alyce', 'Brook', '1993/04/30', 'user');
INSERT INTO utente VALUES ('3', 'user1', 'user1', 'cornish3@google.com.br' , '', 'Annamaria', 'Cornish', '1988/02/21', 'user');
INSERT INTO utente VALUES ('4', 'user2', 'user2', 'cchinghnam@yahoo.com', '', 'Cyndi', 'Highnam', '1997/01/08', 'user');
INSERT INTO utente VALUES ('5', 'user3', 'user3', 'johnslo@gmail.com', '', 'John', 'Slowan', '1994/09/06', 'user');

-- serie
-- INSERT INTO serie VALUES(id, miniatura, background, titolo, distr, desc, creatore, flag_terminata, consigliato, non_cons, pref, voto);
INSERT INTO serie VALUES('1', 'http://tvhunter.altervista.org/public/img/miniature/narcos_min.jpg', 'http://tvhunter.altervista.org/public/img/showsBackgrounds/narcos_back.jpg', 'Narcos', 'Netflix', 'La serie racconta la storia vera della dilagante diffusione della cocaina tra Stati Uniti ed Europa negli anni ottanta. Le prime due stagioni sono incentrate sulla lotta delle autorità colombiane e della DEA contro il narcotrafficante Pablo Escobar e il cartello di Medellín, mentre la terza stagione è incentrata sulla lotta al cartello di Cali, guidato dai fratelli Gilberto e Miguel Rodríguez Orejuela.', 'Chris Brancato', '1', '0', '0', '0', '0' );
INSERT INTO serie VALUES('2', 'http://tvhunter.altervista.org/public/img/miniature/daredevil_min.jpg', '', 'Daredevil', 'Netflix', 'Matt Murdock, dopo aver perso la vista da bambino a causa di un incidente radioattivo, sviluppa dei sensi sovrumani e li utilizza per combattere il crimine per le strade della sua città nei panni del supereroe Daredevil. Nella prima stagione Matt affronta il potente signore del crimine Wilson Fisk, alias Kingpin, impegnato nella sua opera di riqualificazione del quartiere in combutta con vari esponenti della malavita della città.', 'Drew Goddard', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('3', '', '', 'The Walking Dead', 'AMC', 'Rick Graims è un vice sceriffo vittima di un incidente durante uno scontro a fuoco con dei fuorilegge: colpito alla schiena, va in coma, lasciando tra le lacrime la moglie Lori e il figlio Carl. Il risveglio, poco tempo dopo, è traumatico. Rick non ci metterà molto a capire la situazione: il virus che sembrava essere controllato prima del suo incidente, ha preso piede.', 'Frank Darabont', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('4', '', '', 'Hill House', 'Netflix', 'La serie racconta la storia di un gruppo di fratelli che, da bambini, sono cresciuti in quella che in seguito sarebbe diventata la casa infestata più famosa del paese. Ora adulti e costretti a stare di nuovo insieme di fronte alla tragedia, la famiglia deve finalmente affrontare i fantasmi del loro passato, alcuni dei quali sono ancora in agguato nelle loro menti.', 'Mike Flanagan', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('5', '', '', 'Gomorra', 'Sky', 'Liberamente ispirata al best seller di Roberto Saviano, la serie racconta le gesta di camorristi, spacciatori di droga, che agiscono nella periferia di Napoli. Nel contesto di organizzazioni criminali di stampo mafioso, con ramificazioni nel mondo degli affari e in quello della politica, i personaggi sono descritti con crudo realismo e presentano un complesso miscuglio di comportamenti talvolta brutali e avidi, talaltra pseudo sentimentali.', 'Roberto Saviano', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('6', 'http://tvhunter.altervista.org/public/img/miniature/breakingBad_min.jpg', '', 'Breaking Bad', 'AMC', 'Quando a Walter viene diagnosticato un cancro ai polmoni, i suoi problemi sembrano precipitare. Tuttavia, in seguito al casuale incontro con Jesse Pinkman, un suo ex studente diventato uno spacciatore di poco conto, Walter decide di cucinare i cristalli di metanfetamina. Il prodotto di Walter si rivela però di qualità nettamente superiore rispetto alla concorrenza, con una purezza del 99,1%, derivante dalle sue conoscenze chimiche. Decide quindi di sfruttare le sue capacità per prendere il controllo del mercato della droga.', 'Vince Gilligan', '1', '0', '0', '0', '0' );
INSERT INTO serie VALUES('7', 'http://tvhunter.altervista.org/public/img/miniature/mrRobot_min.jpg', '', 'Mr Robot', 'USA Network', 'Elliot viene avvicinato da Mr. Robot, un misterioso anarchico-insurrezionalista, che intende introdurlo in un gruppo di hacktivisti conosciuti con il nome di fsociety. Il manifesto di fsociety è liberare la popolazione dai debiti con le banche e smascherare i potenti che stanno distruggendo il mondo.', 'Sam Esmail', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('8', '', '', 'Sherlock', 'BBC', 'La serie è un libero adattamento dei romanzi e dei racconti di Sir Arthur Conan Doyle e vede come protagonista il detective Sherlock Holmes, affiancato dal suo amico e assistente, il dottor John Watson. Le avventure dei due si svolgono però nella Londra odierna, e non in quella presentata da Doyle. Watson è un reduce della guerra in Afghanistan e deve ancora ritrovare il suo posto nella società. Quando un amico gli suggerisce di trovarsi un coinquilino con cui dividere le spese di un appartamento, si ritrova a vivere con Sherlock Holmes, che col passare degli anni diventerà suo compagno di vita.', 'Steven Moffat', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('9', 'http://tvhunter.altervista.org/public/img/miniature/casaDePapel_min.jpg', '', 'La Casa de Papel', 'Netflix', 'Otto ladri si barricano nell\'edificio della Zecca spagnola con alcuni ostaggi, mentre una mente criminale manipola la polizia per mettere in atto il suo piano.', 'Alex Pina', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('10', 'http://tvhunter.altervista.org/public/img/miniature/heathers_min.jpg', '', 'Heathers', 'Paramount Network', 'La serie è stata pensata per essere un\'antologia, con ogni stagione che si svolge in un contesto completamente diverso.', 'Jason Micallef', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('11', 'http://tvhunter.altervista.org/public/img/miniature/blackMirror_min.jpg', '', 'Black Mirror', 'Netflix', 'Questa serie di fantascienza esplora un futuro prossimo, tecnologico e inquietante, nel quale le invenzioni più innovative si scontrano con i più oscuri istinti umani.', 'Charlie Brooker', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('12', 'http://tvhunter.altervista.org/public/img/miniature/elite_min.jpg', '', 'Elite', 'Netflix', 'Quando tre adolescenti figli di operai sono ammessi in una delle scuole private più esclusive della Spagna, lo scontro con i ricchi coetanei sfocia in un omicidio.', 'Carlos Montero', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('13', 'http://tvhunter.altervista.org/public/img/miniature/thePurge_min.jpg', '', 'The purge', 'Paramount Network', 'Ogni anno tutti i reati sono legali negli Stati Uniti per un periodo di 12 ore.', 'James DeMonaco', '0', '0', '0', '0', '0' );
INSERT INTO serie VALUES('14', 'http://tvhunter.altervista.org/public/img/miniature/limitless_min.jpg', '', 'Limitless', 'CBS', 'Brian Finch è un cittadino statunitense che, dopo aver assunto il farmaco sperimentale nootropo NZT, riesce a sfruttare le sue capacità neurali molto al di sopra della media, acquisendo una memoria e una capacità di comprensione e analisi sovrumane.', 'Craig Sweeny', '0', '0', '0', '0', '0' );




-- preferiti
-- INSERT INTO preferiti VALUES(id_serie, idutente);
INSERT INTO preferiti VALUES('1', '2');
INSERT INTO preferiti VALUES('1', '3');
INSERT INTO preferiti VALUES('1', '4');

-- consiglio
-- INSERT INTO consiglio VALUES(idserie, idutente, consigliato);
INSERT INTO consiglio VALUES('1', '2', '1');
INSERT INTO consiglio VALUES('1', '3', '1');
INSERT INTO consiglio VALUES('1', '4', '1');
INSERT INTO consiglio VALUES('1', '5', '0');




-- post
-- INSERT INTO post VALUES(id, nome, cognome, bio);

-- commento
-- INSERT INTO commento VALUES(id, nome, cognome, bio);

-- risposta
-- INSERT INTO risposta VALUES(id, nome, cognome, bio);

-- attore
-- INSERT INTO serie VALUES(id, img, nome, cognome, bio);
INSERT INTO attore VALUES('1', 'http://tvhunter.altervista.org/public/img/miniature/attori/wagner-moura_min.jpg', 'Wagner', 'Moura', 'Wagner Manicoba de Moura (Rodelas, 27 giugno 1976), è un attore brasiliano.');
INSERT INTO attore VALUES('2', 'http://tvhunter.altervista.org/public/img/miniature/attori/pedro-pascal_min.jpg', 'Pedro', 'Pascal', 'Jose Pedro Balmaceda Pascal (Santiago del Cile, 2 aprile 1975) è un attore cileno naturalizzato statunitense.');
INSERT INTO attore VALUES('3', '', 'Charli', 'Cox', 'Charlie Thomas Cox, meglio noto come Charlie Cox (Londra, 15 dicembre 1982), è un attore britannico, principalmente noto per aver interpretato Matt Murdock/Daredevil nella serie televisiva Daredevil');
INSERT INTO attore VALUES('4', '', 'Deborah', 'Ann Woll', 'Deborah Ann Woll (Brooklyn, 7 febbraio 1985) è una attrice statunitense');
INSERT INTO attore VALUES('5', '', 'Andrew', 'Lincoln', 'Andrew James Clutterbuck (Londra, 14 settembre 1973) è un attore britannico');
INSERT INTO attore VALUES('6', '', 'Norman', 'Reedus', 'Norman Mark Reedus (Hollywood, 6 gennaio 1969) è un attore e modello statunitense.');
INSERT INTO attore VALUES('7', '', 'Michiel', 'Huisman', 'Michiel Huisman è un attore, cantante e musicista olandese.');
INSERT INTO attore VALUES('8', '', 'Salvatore', 'Esposito', 'Salvatore Esposito (Napoli, 2 febbraio 1986) è un attore italiano. È noto principalmente per il ruolo di Gennaro "Genny" Savastano nella serie televisiva Gomorra.');
INSERT INTO attore VALUES('9', '', 'Bryan', 'Cranston', 'Bryan Lee Cranston (Los Angeles, 7 marzo 1956) è un attore, doppiatore, regista, sceneggiatore, produttore cinematografico e produttore televisivo statunitense.');
INSERT INTO attore VALUES('10', '', 'Aaron', 'Paul', 'Aaron Paul Sturtevant, noto semplicemente come Aaron Paul (Emmett, 26 agosto 1979) è un attore statunitense.');
INSERT INTO attore VALUES('11', 'http://tvhunter.altervista.org/public/img/miniature/attori/rami-malek_min.jpg', 'Rami', 'Malek', 'Rami Said Malek (Los Angeles, 12 maggio 1981) è un attore statunitense, noto principalmente per la sua interpretazione di Ahkmenrah nella saga di film Una notte al museo e di Elliot Alderson nella pluripremiata serie televisiva Mr. Robot, per la quale si aggiudica un Emmy per il miglior attore in una serie drammatica e riceve due nomination ai Golden Globe.');
INSERT INTO attore VALUES('12', '', 'Benedict', 'Cumberbatch', 'Benedict Timothy Carlton Cumberbatch (Londra, 19 luglio 1976) è un attore e doppiatore britannico. I ruoli più conosciuti da lui interpretati sono quelli di Sherlock Holmes nella serie televisiva omonima, di Alan Turing nel film The Imitation Game e del Dottor Strange nel Marvel Cinematic Universe.');


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
INSERT INTO genere VALUES('1', 'Azione');
INSERT INTO genere VALUES('2', 'Drammatico');
INSERT INTO genere VALUES('3', 'Thriller');
INSERT INTO genere VALUES('4', 'Horror');
INSERT INTO genere VALUES('5', 'Poliziesco');
INSERT INTO genere VALUES('6', 'Gangster');
INSERT INTO genere VALUES('7', 'Biografico');
INSERT INTO genere VALUES('8', 'Post apocalittico');

-- serie_genere
-- INSERT INTO genere VALUES(idserie, idgenere);
INSERT INTO serie_genere VALUES('1', '7');
INSERT INTO serie_genere VALUES('1', '2');
INSERT INTO serie_genere VALUES('1', '5');
INSERT INTO serie_genere VALUES('1', '6');
INSERT INTO serie_genere VALUES('2', '4');
INSERT INTO serie_genere VALUES('2', '1');
INSERT INTO serie_genere VALUES('3', '5');
INSERT INTO serie_genere VALUES('3', '2');
INSERT INTO serie_genere VALUES('3', '8');
INSERT INTO serie_genere VALUES('3', '4');
INSERT INTO serie_genere VALUES('4', '4');
INSERT INTO serie_genere VALUES('5', '3');
INSERT INTO serie_genere VALUES('5', '1');
INSERT INTO serie_genere VALUES('5', '6');
INSERT INTO serie_genere VALUES('6', '2');
INSERT INTO serie_genere VALUES('6', '3');
INSERT INTO serie_genere VALUES('6', '1');
INSERT INTO serie_genere VALUES('7', '3');
INSERT INTO serie_genere VALUES('7', '2');
INSERT INTO serie_genere VALUES('8', '5');
INSERT INTO serie_genere VALUES('8', '2');

-- episodio
-- INSERT INTO episodio VALUES(id, titolo, desc, num, data, stagione, visualizzato, voto, idserie);
INSERT INTO episodio VALUES('1', 'Discesa', 'Il chimico Cucaracha consegna un carico di stupefacenti al contrabbandiere Pablo Escobar.', '1', '2015/08/28', '1', '0', '0', '1');
INSERT INTO episodio VALUES('2', 'La spada di Simón Bolívar', 'l gruppo comunista radicale M-19 sfida i narcos, mentre Murphy scopre i metodi delle forze armate colombiane dal suo nuovo collega Peña.', '2', '2015/08/28', '1', '0', '0', '1');
INSERT INTO episodio VALUES('3', 'Finalmente libero', 'Dopo una massiccia operazione militare volta a catturare Pablo, la sua famiglia si riunisce e i suoi nemici si preoccupano. Steve e Connie discutono di sicurezza.', '1', '2016/09/02', '2', '0', '0', '1');
INSERT INTO episodio VALUES('4', 'La strategia del capo', 'I gentiluomini di Cali convocano i soci per un annuncio a sorpresa sul futuro della loro attività.', '1', '2017/09/01', '3', '0', '0', '1');
INSERT INTO episodio VALUES('5', 'Sul ring', 'Matt Murdock e il suo amico Foggy Nelson aprono uno studio legale indipendente: la loro prima cliente è una segretaria della Union Allied, Karen, accusata di omicidio.', '1', '2015/04/10', '1', '0', '0', '2');
INSERT INTO episodio VALUES('6', 'Bang!', 'Una nuova minaccia riempie il vuoto lasciato da Fisk a Hells Kitchen. Murdock e Foggy accettano un cliente dal passato discutibile.', '1', '2016/03/18', '2', '0', '0', '2');
INSERT INTO episodio VALUES('7', 'I giorni andati', 'Rick si sveglia in un ospedale, dopo aver avuto un incidente sul campo dove è rimasto ferito, e scopre la drammatica verità: la sua famiglia è scomparsa, tutti sono scomparsi. O peggio, strane e orribili creature assetate di sangue...', '1', '2010/10/31', '1', '0', '0', '3');
INSERT INTO episodio VALUES('8', 'La strada da percorrere', 'La seconda stagione si apre con Rick e il suo gruppo che scappano da Atlanta e vengono minacciati da un pericolo mai incontrato prima, altrove un gruppo cerca una persona scomparsa.', '1', '2011/10/16', '2', '0', '0', '3');
INSERT INTO episodio VALUES('9', 'Steven vede un fantasma', 'Indagando su una storia di fantasmi per il suo ultimo romanzo, uno scettico Steven riceve una telefonata dalla sorella che innesca una catena di eventi fatali.', '1', '2018/10/12', '1', '0', '0', '4');
INSERT INTO episodio VALUES('10', 'Il clan dei Savastano', 'Il controllo di Pietro Savastano, potente boss del Napoletano, è minacciato dal clan rivale di Salvatore Conte. Una serie di agguati e intimidazioni apre la guerra per il controllo del territorio.', '1', '2014/05/06', '1', '0', '0', '5');
INSERT INTO episodio VALUES('11', 'Questione di chimica', 'Dopo la diagnosi di cancro terminale ai polmoni, un insegnante di chimica del liceo si dà alla produzione di metanfetamine per garantire la sopravvivenza della famiglia.', '1', '2008/01/20', '1', '0', '0', '6');
INSERT INTO episodio VALUES('12', 'Tutto cambia', 'Mentre pianificano una grossa vendita finale di stupefacenti, Walt e Jesse si preoccupano del fatto che possano ucciderli.', '1', '2009/03/08', '2', '0', '0', '6');
INSERT INTO episodio VALUES('13', 'Ciao amico', 'Elliot Alderson è un ingegnere informatico, vive a New York e lavora presso una azienda di sicurezza informatica AllSafe Security. Soffre di paranoia ed è convinto di essere pedinato.', '1', '2015/06/24', '1', '0', '0', '7');
INSERT INTO episodio VALUES('14', 'Uno studio in rosa', 'Una donna in rosa è la quarta vittima di una serie di suicidi apparentemente scollegati, ma Sherlock Holmes capisce che in realtà si tratta di terribili omicidi.', '2', '2010/07/25', '1', '0', '0', '8');


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