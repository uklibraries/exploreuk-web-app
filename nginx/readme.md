# How does configuration work?
The project assumes that you will have a web server operating at the host level. This document describes how to set up a configuration to produce a deployment with two environments, staging and prod, with potentially two different versions of the software running at once, blue and green.

The idea is that you will deploy a version (blue or green) of the software to the staging environment, run any tests (automated or manual), and once you're satisfied with the operability of that version, point the production environment to the version which you deployed, and then shut down the opposite version (blue or green).

This configuration works by switching the port of the $backend variable via a symlink to euk.blue or euk.green.

# Suggested setup
Include this stanza in your main configuration file (e.g., default.conf or nginx.conf)
`include /etc/nginx/conf.d/*.conf;`

Put these configuration files in this directory in your nginx/conf.d folder:
```bash
cp euk-prod.conf /etc/nginx/conf.d/euk-prod.conf
cp euk-staging.conf /etc/nginx/conf.d/euk-staging.conf
cp euk.blue /etc/nginx/conf.d/euk.blue
cp euk.green /etc/nginx/conf.d/euk.green
```

In the conf directory, set up symlinks for euk.prod and euk.staging, pointing to euk.blue or euk.green. euk-prod.conf and euk-staging.conf load the appropriate port by manipulating.
```bash
ln -sfn /etc/nginx/conf.d/euk-prod.conf /etc/nginx/conf.d/euk.blue
ln -sfn /etc/nginx/conf.d/euk-staging.conf /etc/nginx/conf.d/euk.green
```

To use these configurations without edits, you'll also need to install TLS certificates for euk.ukpdp.org, which acts as the URL for production. euk.ukpdp.org is treated as production, and localhost:81 is treated as staging.
```nginx
ssl_certificate /etc/ssl/certs/euk.ukpdp.org.fullchain.pem;
ssl_certificate_key /etc/ssl/private/euk.ukpdp.org.202508.key;
```

# Switching blue/green per environment
utils/flip.sh provides a utility for switching the active version of staging and production, restarting nginx when needed. An example is below, but see the script for specific usage.
```bash
# Assuming script is ran in the root of the project
PATH_TO_PROFILE=./utils/profiles/devprofile.sh bash utils/flip.sh prod blue
```
