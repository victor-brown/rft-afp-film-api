# Rendszerterv

# A rendszer célja
Egy filmes adatbázis létrehozása, amiben kereshetőek és megfelelő jogosultásggal szerkeszthetőek az adatok.


## 2. Projektterv

### 2.1 Szerepkörök, felelősségek
Product Owner: 
+ Tompa Gábor
Meghatározza az üzleti igényeknek megfelelő fejlesztési feladatokat.

Scrum master: 
+ Barna Viktor
Megtervezi és nyomonköveti a fejlesztés részfelatatait, napi szinten kapcsolatot tart a fejlesztőkkel, esetlegesen felmerülő akadályok esetén beavatkozik, és segít megoldani.
A projekt indulásakor segít felállítani a prioritásait a feladatoknak, és a megfelelő sorrendben kerülnek a sprintekbe ezek.
A projekt végén retrospektivet tart a résztvevőkkel.

### 2.2 Projektmunkások és felelősségeik
Architecture: 
+ Barna Viktor

Development: 
+ Barna Viktor
+ Tompa Gábor

## 3. Követelmények
A filmek adatbázisa legyen elérhető API hívásokon keresztül.
Az API híváson keresztül minden film olvasható legyen.
Módosítani, Hozzáadni és törölni csak hitelesítés után lehessen.
A hitelesítéshez API kulcsot kell alkamazni.

## 5. Funkcionális terv

## 6. Fizikai környezet


## 8. Architekturális terv
MySQL adatbázis
Webszerver
PHP 8
A teszteléshez / használathoz ajánlott Postman használata

### 8.1 Architekturális tervezési minta

### 8.2 Az alkalmazás rétegei, fő komponensei, ezek kapcsolatai

## 9. Adatbázisterv  

||api_keys||
|-|---------|-|
|id|INT|PRIMARY|
|api_key|VARCHAR 255|UNIQUE|
|valid_until|DATE||

||directors||
|-|---------|-|
|id|INT|PRIMARY|
|name|VARCHAR 255|UNIQUE|
|about|TEXT||


||genres||
|-|---------|-|
|id|INT|PRIMARY|
|name|VARCHAR 45|UNIQUE|

||movies||
|-|---------|-|
|id|INT|PRIMARY|
|title|VARCHAR 100|UNIQUE|
|year|INT||
|image_url|VARCHAR 255||
|certificate|VARCHAR 45|NULL|
|runtime|INT|NULL|
|imdb_rating|FLOAT|NULL|
|description|TEXT||

||movies_directors||
|-|---------|-|
|movies_id|INT||
|directors_id|INT||

||movies_genres||
|-|---------|-|
|movies_id|INT||
|genres_id|INT||

||movies_stars||
|-|---------|-|
|movies_id|INT||
|stars_id|INT||

||stars||
|-|---------|-|
|id|INT|PRIMARY|
|name|VARCHAR 60|NULL|
|about|TEXT||

## 11. Tesztterv   

### 11.1 Tesztelt üzleti folyamatok látogatók számára:  

**Tesztesetek:**  

### 11.2 Tesztelt üzleti folyamatok adminisztrátorok számára:  

**Tesztesetek:**  
