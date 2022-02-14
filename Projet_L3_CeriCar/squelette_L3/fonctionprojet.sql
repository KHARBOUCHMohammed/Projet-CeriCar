DROP FUNCTION recherche(character varying, character varying, integer, integer, character varying[], integer[]) cascade; 
create or replace function recherche(dep varchar,arr varchar,resplace integer,distance_totale integer, tabVisite varchar[], tabPred integer[]) 
RETURNS TABLE(id integer,depart varchar,arrivee varchar,distance integer,pred integer[]) as $$
DECLARE
	
	voy record;
	heure_arrivee integer;
	heure_depart integer;
	new_distance_totale integer;
	ville character varying;
	pred_id integer;
	recur record;
	copy_visite character varying[];
	copy_pred integer[];
	
BEGIN
/* Pour tout les voyages au depart de dep*/
FOR voy IN SELECT * FROM jabaianb.voyage JOIN jabaianb.trajet ON jabaianb.voyage.trajet = jabaianb.trajet.id
			WHERE jabaianb.trajet.depart = dep
LOOP

	new_distance_totale = distance_totale + voy.distance;
	SELECT array_position(tabVisite,voy.arrivee) INTO ville;
	
	/*Recuperation de l'heure d'arrivee du voyage precedant s'il existe*/
	SELECT tabPred[array_length(tabPred, 1)] INTO pred_id;
	IF(pred_id != NULL) THEN
		SELECT (heuredepart*60+distance)%1440 INTO heure_arrivee FROM jabaianb.voyage WHERE id = pred_id;
	ELSE
		heure_arrivee = -1;
	END IF;

	/*
	Si:
		-la ville d'arrivee n'a pas ete visitee
		-la distance totale du voyage est inferieure a 1440km
		-le nb de place disponible est >= au nb de place a reserver
		-l'heure d'arrivee du precedant voyage est inferieure a l'heure de depart du prochain voyage
	*/
	IF(ville IS NULL AND (new_distance_totale<1440) AND (resplace <= voy.nbplace) /*AND (heure_arrivee<voy.heuredepart)*/) THEN
		
		id = voy.id;
		depart = voy.depart;
		arrivee = voy.arrivee;
		distance = new_distance_totale;
			
		/* Si on a un trajet direct de dep à arr*/
		IF(voy.arrivee = arr) THEN
			pred = array_append(tabPred,voy.id);
			return next;
			
		ELSE
			copy_visite = tabVisite;
			copy_pred = tabPred;
			copy_visite = array_append(copy_visite,voy.depart);
			copy_visite = array_append(copy_visite,voy.arrivee);
			copy_pred = array_append(copy_pred,voy.id);

			pred = NULL;
			return next;
		
			/* Recuperation des resultats des appels recursifs*/
			FOR recur IN SELECT * FROM recherche(voy.arrivee,arr,resplace,new_distance_totale,copy_visite,copy_pred)
			LOOP
				id = recur.id;
				depart = recur.depart;
				arrivee = recur.arrivee;
				distance = recur.distance;
				pred = recur.pred;
				return next;
			END LOOP;
		END IF;
	END IF;
END LOOP;
END;

$$LANGUAGE plpgsql;


DROP FUNCTION main(character varying,character varying, integer) cascade;
create or replace function main(dep varchar,arr varchar, resplace integer) 
RETURNS TABLE(num_corres integer,id integer,depart varchar,arrivee varchar,heure_depart integer,heure_arrivee integer,distance integer) as $$
 
DECLARE
	visite character varying[];
	res record;
	voy record;
	voy_id integer;
	nbcorres integer;
	distance_totale integer;
BEGIN

nbcorres = 0;
FOR res IN SELECT * FROM recherche(dep,arr,resplace,0,visite,NULL) WHERE recherche.pred IS NOT NULL
LOOP
	distance_totale = 0;
	FOR voy_id IN SELECT * FROM unnest(res.pred)
	LOOP
	
		SELECT * INTO voy FROM jabaianb.voyage JOIN jabaianb.trajet ON jabaianb.voyage.trajet = jabaianb.trajet.id
			WHERE jabaianb.voyage.id = voy_id;
		distance_totale = distance_totale + voy.distance;
		
		num_corres = nbcorres;
		id = voy.id;
		depart = voy.depart;
		arrivee = voy.arrivee;
		heure_depart = voy.heuredepart;
		heure_arrivee = ((voy.heuredepart*60 + voy.distance)%1440)/60;
		distance = distance_totale;
		return next;
	END LOOP;
	nbcorres = nbcorres+1;
END LOOP;
END;

$$LANGUAGE plpgsql;

select * from main('Paris','Marseille',1);