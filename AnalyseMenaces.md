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



# Identification des sources de menaces

Script-kiddies / Hackers

Cybercrime

Utilisateurs avertis

Concurrents

# Scénarios d'attaque

# Conclusion

