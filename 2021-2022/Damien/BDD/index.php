<!-- Thème jeux video, Il s'agit de définir la base de donnée d'un jeu de gestion d'une ville en ligne & Multijoueur:
- Chaque joueur peut avoir plusieurs ville
- Dans les villes on retrouve differents batiment (avec différentes caractéristique: consomation elec, consomation eau, pollution, population max, surface/taille, position (le positionnement des batiments est customisable)) (batiment de service / d'industrie / de production)
- La population de chaque ville évolue de manière aléatoire
- Il doit y avoir des graphique d'evolutions des différente statistique du jeu, des villes, des joueurs
- Les joueurs peuvent être amis entre eux et s'envoyer des messages
- Il y a une notion d'alliance (Groupe de joueurs)
- Il y a du commerce entre les villes (et donc des notion de ressources & d'argent)
- Attention a ne pas oublier que c'est un jeu en ligne multijoueur (donc compte user & accés)
- Dans le jeu il y a une notion d'abonnement (paiement réel...) pour pouvoir jouer (sinon limité dans le jeu)
- On peut acheter des pass premium (pass de saison) afin d'avoir des bonus supplémentaires -->


City

id (PK)
user_id (FK)
building_id (FK)
population (INT) // inhabitant.id WHERE inhabitant.city_id = city.id
ressource_id (FK)


Trade

id (PK)
city1_id (FK city_id)
city2_id (FK city_id)
ressource_id (VARCHAR) // Always from city1 to city2
quantity (INT)


Ressource

id (PK)
name (VARCHAR = 255)
city_id (FK)


Building

id (PK)
electrecityConsumption (FLOAT)
waterConsumption (FLOAT)
pollution (FLOAT)
maxPopulation (INT)
area (FLOAT)
fonction_id (FK)


Slot (Positions prédéfinies, le joueur peut choisir de déplacer un bâtiment dans un autre slot)

id (PK)
building_id (FK)
position (FLOAT)
area (FLOAT)


Fonction 

id (PK)
fonctionName (VARCHAR = 255)


Inhabitant

id (PK) // crontab ( each 5 minutes a new inhabitant is added to a random city with alive property = 1)
city_id (FK can be NULL if dead)
age (INT) // crontab (each 1 hour : age + 1)
alive (BOOLEAN) // crontab ( if age > 85 alive property = 0)


User

id (PK)
pseudo (VARCHAR = 25)
password (VARCHAR = 255)
mail (VARCHAR = 255)
alliance_id (FK)
subscribe_id (FK)
premiumPass_id (FK)


Subscribe

id (PK)
tier (INT)
price (INT)
startingDate (DATE)
finishingDate (DATE)
advantage (TEXT)


PremiumPass

id (PK)
startingDate (DATE)
finishingDate (DATE)
bonus_id (FK)


Bonus

id (PK)
premiumPass_id (FK)
name (VARCHAR = 255)
info (TEXT)


Friend

user1_id (FK user_id)
user2_id (FK user_id)


Message

id (PK)
sendingTime (DATE)
content (VARCHAR = 255)
user1_id (FK)
user2_id (FK)


Alliance

id (PK)
name (VARCHAR = 25)


Graphic

id (PK)
name (VARCHAR = 255) // game - city - user
city_id
user_id
curve (INT) // crontab ( each 10 minutes, add a point on the appropriate curve with the number of users on the game, of  cities, and the population of each city )
date (DATE)