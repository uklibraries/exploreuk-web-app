# What is this directory for?

This directory serves as a location to load from a backup. Files loaded into
this directory **will overwrite** the files directory. It is recommended to move
or delete the files in this directory once loading from backup is complete.

# How this directory should be organized

A `files` directory sourced from a working backup.

```
project-root
├── LICENSE.txt
├── README.md
├── app
├── backup
│   ├── README.md
│   └── files/
├── docker-compose.yml
├── dockerfile
├── entrypoint.sh
├── htaccess-stanza.txt
├── licenses
└── nginx
```

# How the backup works

`docker-compose.yml` is configured to mount the `files` directory within the
nginx container. A user can then run `utils/restore-files.sh` to put those files
in the right place.
