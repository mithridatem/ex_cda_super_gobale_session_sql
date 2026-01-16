# ex_cda_super_gobale_session_sql  
## Pour récupérer le projet :

### 1 cloner le repository
```bash
git clone https://github.com/mithridatem/ex_cda_super_gobale_session_sql.git projet
```

### 2 se déplacer dans le projet :
```bash
cd projet
```

### 3 créer le dossier public
```bash
mkdir public
```

### 4 créer un fichier : .env à la racine du projet
```bash
cat .env
```

```env
# Remplacer par vos informations de la base de données
DB_USERNAME=login_bdd
DB_PASSWORD=password_bdd
DB_NAME=nom_bdd
DB_HOST=localhost
```

### 5 créer la base de données avec le script base.sql

### 6 installer les dépendances avec composer
```bash
composer install
```

### 7 Démarrer le projet
```bash
php -S 127.0.0.1:8000
```

**Le site sera accessible avec l'url** :

http://127.0.0.1:8000 dans le navigateur web.

