# Követelményspecifikáció

## 1. Vezetői összefoglaló

- Egy open-source film API létrehozása hallgatói munkák támogatásához. Az API egy 1 hónapig érvényes API Kulccsal használható. Lehetőség van több száz film adatainak listázására, egyes filmek részleteinek lekérdezésére, rendezők, színészek és zsánerek lekérdezésére.
- A RESTFUL API szolgáltatást szeretnénk létrehozni.
- A minél nagyobb támogatottság és a gyors lekérdezések támogatása véget SQL alapú adatbázist szeretnénk használni.

## 2. Jelenlegi helyzet leírása

A jelenlegi legnépszerűbb online elérhető film-információkat tartalmazó weboldal az IMDB, sajnos azonban ennek a weboldalnak nincsen elérhető ingyenes API-ja, amivel hallgatók a beadandó feladataikon tudnának dolgozni.

## 3. Vágyálomrendszer leírása

A cél egy ingyenesen használható, open-source, RESTFUL API létrehozása, amely támogatja az alapvető CRUD műveleteket a következő témákhoz: Filmek, Film, Színészek, Rendezők, Zsánerek.
Az open-source kivitelezésnek köszönhetően, remélhetőleg a jövőben ennél részletesebb támogatást tud majd az API szolgáltatásunk nyújtani, de a cél, hogy egy jól működő alapot elkészítsünk, amire később könnyen és hatékonyan lehet építeni. Emiatt fontos a jól skálázhatóság és a robosztusság.

## 4. Funkcionális követelmények átfogó felsorolása

- Filmek
  - Create
  - Read
  - Update
  - Delete
- Film
  - Create
  - Read
  - Update
  - Delete
- Zsánerek
  - Create
  - Read
  - Update
  - Delete
- Színészek
  - Create
  - Read
  - Update
  - Delete
- Rendezők
  - Create
  - Read
  - Update
  - Delete

## 7. Követelménylista

| Modul     | Verzió | Név                                                                  | Kifejtés                                                                                                               |
| --------- | ------ | -------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------- |
| Adatbázis | V1.0   | Api kulcsok tárolása                                                 | Adatbázis a generálandó API kulcsok tárolására                                                                         |
| API       | V1.0   | GET végpont API kulcs generálásához                                  | Api kulcs generálása és mentés az adatbázisba                                                                          |
| Adatbázis | V2.0   | Zsánerek tárolása                                                    | Adatbázis a zsánerek tárolására.                                                                                       |
| Adatbázis | V3.0   | Színészek tárolása                                                   | Adatbázis a színészek tárolására.                                                                                      |
| Adatbázis | V4.0   | Rendezők tárolása                                                    | Adatbázis a rendezők tárolására.                                                                                       |
| Adatbázis | V5.0   | Filmek tárolása, összekötés a zsánerekkel, színészekkel, rendezőkkel | Adatbázis a filmek tárolására. A meglővő táblák összekapcsolása, hogy a komplex lekérdezések megvalósíthatóak legyenek |
| API       | V2.0   | CRUD műveletek a zsánerekhez                                         | Create,Read,Update,Delete műveletek/végpontok a zsánerekhez                                                            |
| API       | V3.0   | CRUD műveletek a színészekhez                                        | Create,Read,Update,Delete műveletek/végpontok a színészekhez                                                           |
| API       | V4.0   | CRUD műveletek a rendezőkhöz                                         | Create,Read,Update,Delete műveletek/végpontok a rendezőkhöz                                                            |
| API       | V5.0   | CRUD műveletek a filmekhez                                           | Create,Read,Update,Delete műveletek/végpontok a filmekhez                                                              |

## 9. Fogalomszótár

- **API**: Application Programmer Interface
- **CRUD**: Create, Read, Update, Delete műveletek támogatása
- **Endpoint/végpont**: Az az "URL", amit meghívva kérést indítunk az API szervernek
- **URL**: Uniform Resource Locator, ("webcím")
