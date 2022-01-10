# STI Projet 2 - Analyse des menaces

**Auteurs : Lucas Gianinetti & Christian Zaccaria**

**Date : 04.01.2022**

[TOC]

# Description du système

## Objectifs

L’application doit permettre la mise en œuvre d’une messagerie électronique au sein d’une entreprise. Cette messagerie sera une application Web uniquement et se base sur l’interaction avec une base de données (pas de SMTP ou autres protocoles de communication).

Une authentification simple (à l'aide de comptes utilisateurs) sera nécessaire afin d’accéder à l’application. Seule la page de login sera accessible sans être authentifié.

Chaque utilisateur peut se connecter et envoyer des messages destinés à un autre utilisateur du système. Deux types de rôles existent : `Administrateur` et `Collaborateur`. Un collaborateur est restreint à ne pouvoir qu’envoyer des messages tandis qu’un administrateur peut créer des comptes, les modifier, les supprimer et modifier les rôles.

## Hypothèses de sécurité

Utilisé uniquement dans un réseau interne (au sein d'une entreprise). 

On part de l'hypothèse que le système d'exploitation, serveur web, navigateur internet et langage de programmation utilisé sont tous à jour et de confiance.

## Exigences de sécurité

- Utilisation d'un compte (actif) pour utiliser l'application
- Les informations des utilisateurs sont protégées
- Les messages envoyés/ reçus sont confidentiels et protégés (intégrité garantie)
- Le contenu doit être protégé et non modifiable (intégrité garantie)
- Non-répudiation de l’origine/ l’arrivée des messages
- La création/ modification/ suppression de comptes est limitée aux administrateurs (actifs) et aucun autre rôle présent dans l’application ne doit pouvoir effectuer ces tâches.
- Service qui doit être disponible à tout le temps (99,9999% du temps)

## Identification du système

### Base données utilisateurs / rôles

Comptes utilisateurs (`administrateurs / collaborateurs`) permettant de pouvoir interagir avec l'application : 

- Nom d'utilisateur (unique)
- Mot de passe
- Compte actif (détermine si il est possible d'utiliser l'application)
- Rôle (détermine si un compte est `administrateur` ou pas)

### Base données messages

Les messages envoyés au sein et à l'aide de l’application : ils sont sécurisés et lisibles que par la personne qui le reçoit/envoi.

- Date réception
- Emetteur 
- Destinataire
- Sujet du message
- Message

## Rôles utilisateurs

### Administrateur

- Envoi / réception de messages
- Création d’utilisateurs
- Modification d’utilisateurs
- Suppression d’utilisateurs

### Collaborateur

- Envoi / réception de messages

- Modification du profil (mot de passe)

# Liste de biens à protéger

- Infrastructure
- Base de données (Utilisateurs / Messages / Logs)

# DFD

![](media/dfd.png)

# Identification des sources de menaces

## Script-kiddies / Hackers

Les manipulations effectuées sont facilement retrouvés dans les logs de l'application. Ces attaques sont effectuées à la main ou par des robots dans le but de tester des applications de manières « génériques » et sans but précis afin de voir si des failles s’y trouvent.

C’est donc une menace courante et élevée pour notre application.

- **Potentialité : Haute**
- Motivation : s'amuser, gloire
- Cible : n'importe quel élément actif 

## Cybercrime (SPAM, Maliciels)

Ayant une application de petite taille qui devra être utilisé uniquement au sein d'une entreprise, elle n'est pas forcément très intéressant pour des attaques destinées à voler des informations. La seule vrai ressource de nos applications (outre que les adresses e-mail) sont les messages (pouvant contenir des informations sensible)

- **Potentialité : Moyenne**
- Motivation : Financières
- Cible : Vol d’informations sur les utilisateurs, spam

## Utilisateurs avertis

Les utilisateurs de l’application sont une source de menace élevées car ils ont accès aux fonctionnalités avancées. Par exemple, un employé mécontant d'un collègue peut tenter de saboter l’application en essayant de comprendre la structure de nos URL ou les fonctionnalités proposés par le service de messagerie. Un autre exemple : une plaisanterie entre collègues peut aussi mal tourner et amener un disfonctionnement dans l’application.

- **Potentialité : Elevée**
- Motivation : Lire des messages non destinés, modifier des messages
- Cible : Messages

## Concurrents

L’application étant destinée à envoyer des messages simples, contenant peut d'informations exploitables, une attaque pour les voler ne devrait pas avoir un impact élevé sur le business. Néanmoins, cela dépend encore une fois des messages qui sont échangés.

- **Potentialité : Moyenne**
- Motivation : Saboter le projet
- Cible n’importe quel élément

# Scénarios d'attaque

> Chaque scénario est décrit dans sa globalité (en gros), néanmoins des captures d’écran de notre application pour les parties contre-mesures et exemples d’attaques sont présents afin de montrer quel genre de corrections nous avons effectué. 
>
> A noter que les corrections ne sont pas exhaustives, une modification de code pour éviter une injection ne sera montrée qu’à un seul endroit dans ce document mais la correction peut survenir à de nombreux endroits dans le projet.

## Scénario 1 - Intrusion dans le système par bruteforce

|              Cible               | Source de la menace |                       Motivation                        |                    Impact sur le business                    |
| :------------------------------: | :-----------------: | :-----------------------------------------------------: | :----------------------------------------------------------: |
| Système interne de l'application |       Hackers       | Défi, curiosité, revente d'informations confidentielles | **Impact élevé !**<br />Vol d'identité, perte de confidentialité |

**<u>Scénario d'attaque :</u>** 

Un utilisateur (non connecté) va bruteforce la page de login pour pouvoir se connecter.

**<u>Exemple d'attaque :</u>** 

Connection à la page de login et utilisation d'un dictionnaire permettant d'essayer tout type de mots de passe en faisant des essais tant que nous restons sur la page de login.

**<u>Contre-mesure :</u>** 

- Mise en place d'un `Captcha` afin d'éviter ce genre d'attaque.

![](media/attack1-1.PNG)

Modification formulaire HTML :

![](media/attack1-2.PNG)

Modification code PHP :

![](media/attack1-3.PNG)

- Augmenter la complexité des mots de passe (politique de mot de passe) afin d'augmenter le temps le temps de réussite de l'attaque.

*PAS mis en place dans ce projet car on ne gère pas la création de nouveau utilisateur, mais ceci peut être une bonne idée...*

- Filtrage IP (permettant ainsi la connexion uniquement au sein de l'entreprise) 

*PAS mis en place dans ce projet car on travail avec `localhost`, mais ceci peut être une bonne idée...*




# Conclusion

Il serait une bonne pratique de hash et saler les mots de passes des utilisateurs, mais cela dépasse le cadre de ce projet où ne devions que nous occuper de la sécurité au niveau applicatif. Hors que le mot de passe soit hashé avant d'être sauvegarder en BDD ou non ne change rien aux risques et failles existant sur notre WebApp.
