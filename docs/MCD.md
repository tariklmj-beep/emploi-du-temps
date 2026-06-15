# MCD - Emploi du Temps

Ce modèle conceptuel de données reflète la structure actuelle du projet. Le compte `admin`, `professeur` et `etudiant` est géré dans la table `users` via le champ `role`.

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email
        string password
        string telephone
        string role
    }

    FILIERES {
        bigint id PK
        string nom_filiere
        string description
        string niveau
        string description_niveau
    }

    CLASSES {
        bigint id PK
        string nom
        string annee_scolaire
        bigint filiere_id FK
    }

    ETUDIANTS {
        bigint id PK
        string matricule
        string nom
        string prenom
        string email
        string telephone
        date date_naissance
        bigint filiere_id FK
        bigint classe_id FK
    }

    MATIERES {
        bigint id PK
        string nom_matiere
        integer volume_heure
        string niveau
        string description
        bigint filiere_id FK
    }

    ENSEIGNANTS {
        bigint id PK
        string nom
        string prenom
        string email
        string telephone
        string departement
        string grade
        string specialite
    }

    SALLES {
        bigint id PK
        string nom
        integer capacite
        string batiment
    }

    EMPLOIS_DU_TEMPS {
        bigint id PK
        string jour
        time heure_debut
        time heure_fin
        string salle
        string semestre
        string type_cours
        bigint filiere_id FK
        bigint matiere_id FK
        bigint enseignant_id FK
        bigint salle_id FK
    }

    NOTES {
        bigint id PK
        bigint etudiant_id FK
        bigint matiere_id FK
        decimal valeur
        date date_eval
        string type
    }

    ABSENCES {
        bigint id PK
        bigint etudiant_id FK
        bigint matiere_id FK
        date date_absence
        boolean justifie
        string motif
    }

    SUPPORTS_COURS {
        bigint id PK
        string titre
        string fichier
        bigint matiere_id FK
        bigint enseignant_id FK
    }

    DISPONIBILITES_ENSEIGNANTS {
        bigint id PK
        bigint enseignant_id FK
        string jour
        time heure_debut
        time heure_fin
    }

    FILIERES ||--o{ CLASSES : "contient"
    FILIERES ||--o{ ETUDIANTS : "regroupe"
    FILIERES ||--o{ MATIERES : "propose"
    FILIERES ||--o{ EMPLOIS_DU_TEMPS : "concerne"

    CLASSES ||--o{ ETUDIANTS : "compose"

    MATIERES ||--o{ EMPLOIS_DU_TEMPS : "planifie"
    MATIERES ||--o{ NOTES : "porte"
    MATIERES ||--o{ ABSENCES : "concerne"
    MATIERES ||--o{ SUPPORTS_COURS : "associe"

    ENSEIGNANTS ||--o{ EMPLOIS_DU_TEMPS : "enseigne"
    ENSEIGNANTS ||--o{ SUPPORTS_COURS : "produit"
    ENSEIGNANTS ||--o{ DISPONIBILITES_ENSEIGNANTS : "dispose"

    ETUDIANTS ||--o{ NOTES : "recoit"
    ETUDIANTS ||--o{ ABSENCES : "subit"

    SALLES ||--o{ EMPLOIS_DU_TEMPS : "accueille"
```

## Lecture rapide

- Une `filiere` contient plusieurs `matieres`, `classes`, `etudiants` et `emplois_du_temps`.
- Une `classe` regroupe plusieurs `etudiants`.
- Un `emploi_du_temps` relie une `filiere`, une `matiere`, un `enseignant` et une `salle`.
- Un `etudiant` peut avoir plusieurs `notes` et `absences`.
- Un `enseignant` a plusieurs `disponibilites_enseignants` et peut produire plusieurs `supports_cours`.
- Les rôles `admin`, `professeur` et `etudiant` sont gérés dans `users` via le champ `role`.