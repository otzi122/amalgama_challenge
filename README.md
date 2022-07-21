# Amalgama Challenge

### Instalación

* run containers **docker-compose up -d**

I have chosen to start with a blank base plugin to save some time in the folders structure, i share a copy of the database in case it is necessary to restore it,

* User **admin**
* Pass **admin@admin.cl**

* Restore DB command

docker-compose cp backup.sql db:/tmp/restore-db.sql && docker-compose exec db sh -c "exec mysql -u root -p'amalgama-pass' -f -D amalga
ma-data < /tmp/restore-db.sql;"

### Autor ✒️
* **Luis J Pinto** *