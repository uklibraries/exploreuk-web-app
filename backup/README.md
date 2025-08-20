# What is this directory for?
This directory serves as a location to load from a backup. Files loaded into this directory **will overwrite** the database and files directories. It is recommended to move or delete the files in this directory once loading from backup is complete.

# How this directory should be organized
This directory should contain an "omeuka.sql" file at the top level, as well as a `files` directory sourced from a working Omeka installation or backup.
```
project-root
├── LICENSE.txt
├── README.md
├── app
├── backup
│   ├── README.md
│   ├── files/
│   └── omeuka.sql
├── docker-compose.yml
├── dockerfile
├── entrypoint.sh
├── htaccess-stanza.txt
├── licenses
└── nginx
```

# How the backup works
`docker-compose.yml` is configured to mount the `files` directory here within the nginx container. `entrypoint.sh` will check for existence of these files and then overwrite the `var/www/html/files` directory in the container. The SQL container will mount the `omeuka.sql` file and has built-in utilities for loading the file as an SQL dump.
