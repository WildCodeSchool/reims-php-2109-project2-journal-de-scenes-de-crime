ALTER TABLE `crime_scene` CHANGE description description TEXT;
INSERT INTO crime_scene 
    (
    name,
    title,
    adress,
    description,
    date,
    victim) 
    VALUES 
    (
    "Watson",
    "Le mysthère de la chambre rouge",
    "3 Lauriston Gardens Londre",
    "C’était le cadavre d’un homme d’environ quarante-trois, de taille moyenne,avec des cheveux noirs et une barbe de trois jours. L’agonie avait dû être douloureuse ! Son visage rigide conservait une expression d’horreur.",
    "2021-01-01",
    "le cadavre d’Enoch J. Drebber");
