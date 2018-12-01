
-- utente aggiunge il suo consiglio
DROP TRIGGER IF EXISTS INCREMENT_CONS;
DELIMITER $$
CREATE TRIGGER INCREMENT_CONS AFTER INSERT ON consiglio
 FOR EACH ROW 
 BEGIN
 IF (new.consigliato = '1')
 THEN
 	UPDATE serie SET serie.consigliato = serie.consigliato + 1
	WHERE serie.id = new.id_serie;
ELSE
	UPDATE serie SET serie.non_consigliato = serie.non_consigliato + 1
	WHERE serie.id = new.id_serie;
	END IF;
END;
$$
DELIMITER ;


-- utente rimuove il suo consiglio
DROP TRIGGER IF EXISTS DECREMENT_CONS;
DELIMITER $$
CREATE TRIGGER DECREMENT_CONS AFTER DELETE ON consiglio
 FOR EACH ROW 
 BEGIN
 IF (old.consigliato = '1')
 THEN
 	UPDATE serie SET serie.consigliato = serie.consigliato - 1
	WHERE serie.id = old.id_serie;
ELSE
	UPDATE serie SET serie.non_consigliato = serie.non_consigliato - 1
	WHERE serie.id = old.id_serie;
	END IF;
END;
$$
DELIMITER ;


-- utente cambia idea sul consiglio
DROP TRIGGER IF EXISTS UPDATE_CONS;
DELIMITER $$
CREATE TRIGGER UPDATE_CONS AFTER UPDATE ON consiglio
 FOR EACH ROW 
 BEGIN
 IF (new.consigliato = '1')
 THEN
 	UPDATE serie SET serie.consigliato = serie.consigliato + 1
	WHERE serie.id = new.id_serie;
	UPDATE serie SET serie.non_consigliato = serie.non_consigliato - 1
	WHERE serie.id = new.id_serie;
ELSE
	UPDATE serie SET serie.non_consigliato = serie.non_consigliato + 1
	WHERE serie.id = new.id_serie;
	UPDATE serie SET serie.consigliato = serie.consigliato -1
	WHERE serie.id = new.id_serie;
	END IF;
END;
$$
DELIMITER ;



-- aggiunto ai preferiti
DROP TRIGGER IF EXISTS INCREMENT_FAV;
DELIMITER $$
CREATE TRIGGER INCREMENT_FAV AFTER INSERT ON preferiti
 FOR EACH ROW 
 BEGIN
 	UPDATE serie SET serie.preferiti = (SELECT COUNT(*) 
 										FROM preferiti
 										WHERE id_serie = new.id_serie)
	WHERE serie.id = new.id_serie;
END;
$$
DELIMITER ;


-- tolto dai preferiti
DROP TRIGGER IF EXISTS DELETE_FAV;
DELIMITER $$
CREATE TRIGGER DELETE_FAV AFTER DELETE ON preferiti
 FOR EACH ROW 
 BEGIN
 	UPDATE serie SET serie.preferiti = (SELECT COUNT(*) 
 										FROM preferiti
 										WHERE id_serie = old.id_serie)
	WHERE serie.id = old.id_serie;
END;
$$
DELIMITER ;



-- episodio votato
DROP TRIGGER IF EXISTS VOTE_EP;
DELIMITER $$
CREATE TRIGGER VOTE_EP AFTER INSERT ON voto
 FOR EACH ROW 
 BEGIN
 	UPDATE episodio SET episodio.voto = (SELECT AVG(valutazione)
 								   		 FROM voto
 								   		 WHERE id_episodio = new.id_episodio)
	WHERE episodio.id = new.id_episodio;
END;
$$
DELIMITER ;


-- cambiato voto episodio
DROP TRIGGER IF EXISTS UPDATE_VOTE_EP;
DELIMITER $$
CREATE TRIGGER UPDATE_VOTE_EP AFTER UPDATE ON voto
 FOR EACH ROW 
 BEGIN
 	UPDATE episodio SET episodio.voto = (SELECT AVG(valutazione)
 								   		 FROM voto
 								   		 WHERE id_episodio = new.id_episodio)
	WHERE episodio.id = new.id_episodio;
END;
$$
DELIMITER ;




-- aggiornato voro della serie
DROP TRIGGER IF EXISTS UPDATE_VOTE;
DELIMITER $$
CREATE TRIGGER UPDATE_VOTE AFTER UPDATE ON episodio
 FOR EACH ROW 
 BEGIN
 	UPDATE serie SET serie.voto = (SELECT AVG(voto)
 								   FROM episodio
 								   WHERE id_serie = new.id_serie)
	WHERE serie.id = new.id_serie;
END;
$$
DELIMITER ;


-- aggiunto ai visti
DROP TRIGGER IF EXISTS SEEN;
DELIMITER $$
CREATE TRIGGER SEEN AFTER INSERT ON visto
 FOR EACH ROW 
 BEGIN
 	UPDATE episodio SET episodio.visualizzato = (SELECT COUNT(*) 
 											     FROM visto
 											     WHERE id_episodio = new.id_episodio)
	WHERE episodio.id = new.id_episodio;
END;
$$
DELIMITER ;



-- tolto dai visti
DROP TRIGGER IF EXISTS DELETE_SEEN;
DELIMITER $$
CREATE TRIGGER DELETE_SEEN AFTER DELETE ON visto
 FOR EACH ROW 
 BEGIN
 	UPDATE episodio SET episodio.visualizzato = (SELECT COUNT(*) 
 											     FROM visto
 											     WHERE id_episodio = old.id_episodio)
	WHERE episodio.id = old.id_episodio;
END;
$$
DELIMITER ;
