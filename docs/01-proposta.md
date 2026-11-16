# 🐾 PawCare – Proposta de projecte

> **Una plataforma web per facilitar la cura, la gestió i el benestar dels gossos.**

---

## 📋 Informació general

| Camp | Descripció |
|---|---|
| **Nom del projecte** | PawCare |
| **Tipus de projecte** | Aplicació web |
| **Backend** | Laravel i PHP |
| **Base de dades** | MySQL |
| **Frontend** | Blade, HTML, CSS, JavaScript i Bootstrap |
| **Control de versions** | Git i GitHub |
| **Membres de l'equip** | [Oscar Ruiz Fernández ] i [Yassine Khabar] |

---

## 📑 Índex

1. [Presentació del projecte](#1-presentació-del-projecte)
2. [Justificació del projecte](#2-justificació-del-projecte)
3. [Objectius del projecte](#3-objectius-del-projecte)
4. [Funcionalitats principals](#4-funcionalitats-principals)
5. [Tipus d'usuaris](#5-tipus-dusuaris)
6. [Tecnologies que utilitzarem](#6-tecnologies-que-utilitzarem)
7. [Abast de la primera versió (MVP)](#7-abast-de-la-primera-versió-mvp)
8. [Possibles millores futures](#8-possibles-millores-futures)
9. [Resultat esperat](#9-resultat-esperat)
10. [Conclusió](#10-conclusió)

---

## 1. Presentació del projecte

PawCare és una aplicació web pensada per a les persones que tenen gossos o que estan interessades en el seu benestar.

L'objectiu és crear una plataforma on els usuaris puguin gestionar la informació dels seus gossos i consultar diferents serveis relacionats amb ells, com ara parcs per a gossos, centres veterinaris i gossos disponibles per a l'adopció.

L'aplicació també disposarà d'un panell d'administració per gestionar la informació dels serveis i els anuncis d'adopció.

## 2. Justificació del projecte

Actualment, les persones que tenen gossos sovint han de buscar informació en diferents pàgines web per trobar llocs i serveis adequats per als seus animals.

Per exemple, poden necessitar trobar un parc per passejar el seu gos, consultar informació sobre una clínica veterinària o trobar un gos que necessiti una nova família.

Per aquest motiu, hem pensat a crear **PawCare**, una aplicació que reuneixi aquesta informació en un mateix lloc i permeti gestionar les dades dels gossos de manera senzilla.

## 3. Objectius del projecte

L'objectiu principal és desenvolupar una aplicació web que faciliti la gestió de la informació dels gossos i la consulta de serveis relacionats amb el seu benestar.

Els objectius específics són:

- Permetre als usuaris registrar-se i iniciar sessió.
- Permetre als usuaris gestionar el seu perfil personal.
- Afegir, consultar, modificar i eliminar la informació dels seus gossos.
- Consultar parcs per a gossos.
- Consultar centres i clíniques veterinaris.
- Consultar gossos disponibles per a l'adopció.
- Facilitar la cerca de serveis per nom o localitat.
- Disposar d'un panell d'administració per gestionar la informació de la plataforma.
- Desenvolupar una aplicació senzilla, intuïtiva i adaptable a diferents dispositius.

## 4. Funcionalitats principals

### 4.1. Registre i autenticació

Els usuaris podran crear un compte i iniciar sessió a l'aplicació mitjançant el seu correu electrònic i contrasenya.

També podran tancar la sessió de manera segura.

### 4.2. Perfil d'usuari

Cada usuari disposarà d'un perfil personal on podrà consultar i modificar les seves dades bàsiques, com ara el nom i el correu electrònic.

### 4.3. Gestió dels gossos

Els usuaris registrats podran afegir un o més gossos al seu perfil.

Cada gos tindrà informació com:

- **Nom**
- **Raça**
- **Edat**
- **Sexe**
- **Pes**
- **Fotografia**

Els usuaris podran consultar, modificar i eliminar les dades dels seus gossos.

> Cada usuari només podrà gestionar els seus propis gossos.

### 4.4. Parcs per a gossos

L'aplicació disposarà d'un apartat amb informació sobre diferents parcs on es poden portar els gossos.

Cada parc inclourà:

- Nom.
- Adreça o localitat.
- Descripció.
- Fotografia (si està disponible).

Els usuaris i visitants podran consultar els parcs i cercar-los per nom o localitat.

L'administrador serà el responsable d'afegir, modificar i eliminar la informació dels parcs.

### 4.5. Centres veterinaris

Els usuaris podran consultar una llista de clíniques i centres veterinaris.

Cada centre inclourà informació com:

- Nom.
- Adreça o localitat.
- Serveis que ofereix.
- Telèfon de contacte.
- Correu electrònic (si està disponible).

Els usuaris i visitants podran consultar els centres i cercar-los per nom o localitat.

L'administrador serà el responsable de gestionar la informació dels centres veterinaris.

### 4.6. Adopció de gossos

L'aplicació disposarà d'una secció dedicada als gossos que estan disponibles per a l'adopció.

Els usuaris i visitants podran consultar els gossos publicats i veure'n la informació detallada.

Cada anunci inclourà:

- Nom del gos.
- Raça.
- Edat.
- Sexe.
- Fotografia.
- Descripció.
- Estat de l'adopció (**Disponible** o **Adoptat**).
- Dades de contacte de la persona o entitat responsable.

Les persones interessades podran contactar directament amb la persona o entitat responsable mitjançant el telèfon o el correu electrònic publicat.

L'administrador serà l'encarregat de crear, modificar i eliminar els anuncis, així com d'actualitzar-ne l'estat.

> En aquesta primera versió no s'implementarà un sistema de sol·licituds d'adopció ni de missatgeria interna.

### 4.7. Panell d'administració

L'aplicació disposarà d'un panell d'administració des d'on l'administrador podrà:

- Consultar els usuaris registrats.
- Gestionar els parcs per a gossos.
- Gestionar els centres veterinaris.
- Gestionar els anuncis d'adopció.
- Actualitzar l'estat dels gossos en adopció.
- Afegir, modificar i eliminar informació de la plataforma.

L'accés a aquest panell estarà restringit als administradors.

## 5. Tipus d'usuaris

L'aplicació tindrà dos tipus principals d'usuaris registrats:

| Tipus d'usuari | Permisos principals |
|---|---|
| **Usuari** | Gestionar el seu perfil, afegir i gestionar els seus gossos, i consultar els parcs, els centres veterinaris i els anuncis d'adopció. |
| **Administrador** | Gestionar els parcs, els centres veterinaris i els anuncis d'adopció, així com consultar els usuaris registrats. |

Les persones que no tinguin compte també podran consultar la informació pública dels parcs, els centres veterinaris i els gossos disponibles per a l'adopció.

## 6. Tecnologies que utilitzarem

Per desenvolupar l'aplicació utilitzarem les tecnologies següents:

| Tecnologia | Ús |
|---|---|
| **Laravel** | Desenvolupament del backend i gestió de l'aplicació. |
| **PHP** | Llenguatge de programació del backend. |
| **MySQL** | Gestió de la base de dades. |
| **Blade** | Creació de les vistes de l'aplicació. |
| **HTML** | Estructura de les pàgines web. |
| **CSS** | Estils i disseny de l'aplicació. |
| **JavaScript** | Afegir funcionalitats interactives. |
| **Bootstrap** | Disseny adaptable a diferents dispositius. |
| **Git i GitHub** | Control de versions i treball en equip. |

## 7. Abast de la primera versió (MVP)

Per adaptar el projecte al temps disponible, la primera versió de PawCare se centrarà en les funcionalitats següents:

1. Registre i inici de sessió.
2. Gestió del perfil d'usuari.
3. Crear, consultar, modificar i eliminar gossos.
4. Consultar els parcs per a gossos.
5. Consultar els centres veterinaris.
6. Cercar parcs i centres veterinaris per nom o localitat.
7. Consultar els gossos disponibles per a l'adopció.
8. Gestionar els anuncis d'adopció des del panell d'administració.
9. Disposar d'un panell d'administració per gestionar la informació dels serveis.

Aquestes funcionalitats formaran part de la primera versió funcional de l'aplicació.

## 8. Possibles millores futures

En futures versions, es podrien afegir altres funcionalitats segons el temps disponible i les necessitats dels usuaris:

- Permetre als usuaris proposar nous parcs i centres veterinaris.
- Implementar un sistema de sol·licituds d'adopció.
- Permetre als usuaris proposar gossos per a l'adopció.
- Crear perfils per a criadors i ensinistradors.
- Afegir una comunitat per compartir publicacions i fotografies.
- Incorporar comentaris i m'agrada a les publicacions.
- Afegir un mapa interactiu amb la ubicació dels parcs.
- Calcular la distància entre l'usuari i els serveis disponibles.

> Aquestes funcionalitats no formen part de l'abast inicial del projecte.

## 9. Resultat esperat

Al final del projecte esperem tenir una aplicació web funcional, intuïtiva i accessible des d'Internet.

PawCare permetrà als usuaris gestionar la informació dels seus gossos i trobar informació útil sobre parcs, centres veterinaris i gossos que necessiten una nova llar des d'una mateixa plataforma.

A més, el projecte ens permetrà posar en pràctica els coneixements de Laravel, PHP, MySQL i desenvolupament web, així com treballar de manera col·laborativa mitjançant GitHub.

## 10. Conclusió

Hem escollit PawCare perquè és una idea relacionada amb una necessitat real: facilitar la gestió de la informació dels gossos i trobar serveis relacionats amb el seu benestar.

Volem desenvolupar una aplicació senzilla i útil, centrada en les funcionalitats més importants i adaptada al temps disponible.

El projecte ens permetrà aplicar els coneixements adquirits durant el curs i practicar el desenvolupament d'una aplicació web completa, des de la planificació fins al desplegament.

---

<p align="center">
  **PawCare – Cuidem dels nostres millors amics. 🐾**
</p>