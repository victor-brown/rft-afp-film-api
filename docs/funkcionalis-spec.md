# Funkcionális specifikáció

## 1. A rendszer céljai

A fejlesztlés célja egy filmeket katalogizáló rendszer létrehozása, ahol a filmeket különböző módon van lehetőség megjeleníteni, kategorizálni és a filmek adatait megfelelő jogosultsággal szerkeszteni vagy akár törölni is.
A rendszerben két jogosultsági szint kerül meghatározásra. Az olavasó felhasználó a meglévő rendszerben tudja böngészni az adatokat, míg az adminisztrátornak ezen felül lehetősége van szerkeszetni vagy akár törölni is. Az adatok REST APi-n keresztül érhetőek el.

## 2. Felhasználók

A rendszert használók két csoportra bonthatóak:

- olvasó
- adminisztrátor
  A csoportokhoz tartozó jogosultságok:
- olvasó
  Az alkalmazásban található valamennyi adathoz hozzáfér, kereshet köztük, kilistázhatja azokat.
- adminisztrátor
  Az alkalmazásban található valamennyi adathoz hozzáfér, kereshet köztük, kilistázhatja azokat, továbbá az oldal valamennyi adatához rendelkezik jogosultsággal a szerkesztésére, törlésére vagy új elem felvételére.

## 3. Funkciók

- F1.1 - Az oldalon lehetőség van **listázni** a rendezőket.
- F1.2 - Az oldalon lehetőség van **keresni** a rendezők között.
- F1.3 - Az oldalon lehetőség van **hozzáadni** új rendezőt.
- F1.4 - Az oldalon lehetőség van **módosítani** meglévő rendező adatait.
- F1.5 - Az oldalon lehetőség van **törölni** meglévő rendezőt.

---

- F2.1 - Az oldalon lehetőség van **listázni** a stílusokat.
- F2.2 - Az oldalon lehetőség van **keresni** a stílusok között.
- F2.3 - Az oldalon lehetőség van **hozzáadni** új stílust.
- F2.4 - Az oldalon lehetőség van **módosítani** meglévő stílus adatait.
- F2.5 - Az oldalon lehetőség van **törölni** meglévő stílust.

---

- F3.1 - Az oldalon lehetőség van **listázni** a filmeket.
- F3.2 - Az oldalon lehetőség van **keresni** a filmek között.
- F3.3 - Az oldalon lehetőség van **hozzáadni** új filmet.
- F3.4 - Az oldalon lehetőség van **módosítani** meglévő film adatait.
- F3.5 - Az oldalon lehetőség van **törölni** meglévő filmet.

---

- F4.1 - Az oldalon lehetőség van **listázni** a szereplőket.
- F4.2 - Az oldalon lehetőség van **keresni** a szereplők között.
- F4.3 - Az oldalon lehetőség van **hozzáadni** új szereplőt.
- F4.4 - Az oldalon lehetőség van **módosítani** meglévő szereplő adatait.
- F4.5 - Az oldalon lehetőség van **törölni** meglévő szereplőt.

---

- F5.1 - Az oldalon lehetőség van API klucsot generálni.
- F5.2 - Az oldalon lehetőség van belépni az adminisztrátoroknak.

## 4. Az alkalmazás felépítése

Az alkalmazás **REST API**-n keresztül érhető el.
Minden funckiónak funkciónak külön URL-je van, ahol a megadott paraméterek segítségével lehet a műveleteket végrehajtani. A kérésekre adott válaszok JSON formátumban érkeznek a szerverről.

## 5. Az alkalmazás kezdeti beállításai

Az alkalmazáshoz mellékelve van egy adatbázis, amelyet importálva már kezdeti adatokkal használható a rendszer.

## 6. Funkció-Követelmény megfeleltetés

| ID   | Verzió | Követelmény                                                          | Funkció                                                                                                                                                                                                                                                                                                                         |
| ---- | ------ | -------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| DB0  | V1.0   | Api kulcsok tárolása                                                 | Adatbázis rendelkezik táblával és a szükséges kapcsolatokkal az adatok tárolására                                                                                                                                                                                                                                               |
| API0 | V1.0   | GET végpont API kulcs generálásához                                  | A megadott végpont meghívásával a felhasználó kap egy egyedi kulcsot, illetve egy dátumot ameddig a kulcsal használhatja a védett műveleteket is. (nyitott adminisztrátori jog) Ilyen joggal nem rendelkező felhasználó, csak lekérdezni tud adatokat. Ha rendelkezik kulccsal, akor tud adatot Törölni, Frissíteni, Létrehozni |
| DB1  | V2.0   | Zsánerek tárolása                                                    | Adatbázis rendelkezik táblával és a szükséges kapcsolatokkal az adatok tárolására                                                                                                                                                                                                                                               |
| DB2  | V3.0   | Színészek tárolása                                                   | Adatbázis rendelkezik táblával és a szükséges kapcsolatokkal az adatok tárolására                                                                                                                                                                                                                                               |
| DB3  | V4.0   | Rendezők tárolása                                                    | Adatbázis rendelkezik táblával és a szükséges kapcsolatokkal az adatok tárolására                                                                                                                                                                                                                                               |
| DB4  | V5.0   | Filmek tárolása, összekötés a zsánerekkel, színészekkel, rendezőkkel | Adatbázis rendelkezik táblával és a szükséges kapcsolatokkal az adatok tárolására                                                                                                                                                                                                                                               |
| API1 | V2.0   | CRUD műveletek a zsánerekhez                                         | Create,Read,Update,Delete műveletek/végpontok a zsánerekhez                                                                                                                                                                                                                                                                     |
| API2 | V3.0   | CRUD műveletek a színészekhez                                        | Create,Read,Update,Delete műveletek/végpontok a színészekhez                                                                                                                                                                                                                                                                    |
| API3 | V4.0   | CRUD műveletek a rendezőkhöz                                         | Create,Read,Update,Delete műveletek/végpontok a rendezőkhöz                                                                                                                                                                                                                                                                     |
| API4 | V5.0   | CRUD műveletek a filmekhez                                           | Create,Read,Update,Delete műveletek/végpontok a filmekhez                                                                                                                                                                                                                                                                       |
