exploreuk-web-app
=================

This is the main portion of the ExploreUK web application. Document
data is pulled from Solr, and other settings are managed in Omeka
admin mode.

This is based in part on euk: https://github.com/uklibraries/euk/ .

Installation
------------

Install Omeka.  Make sure to configure ImageMagick.

Install and activate the following plugins:

* [Hide Elements](https://github.com/zerocrates/HideElements)
* [Simple Pages](https://github.com/omeka/plugin-SimplePages)

Download and extract the repository in a working directory outside
your web installation.

Modify the Omeka installation's .htaccess file to include the
stanza included in the following file:

* htaccess-stanza.txt

This stanza should be included just before the line

> RewriteRule ^install/.\*$ install/install.php [L]

Change the Omeka rule

> RewriteRule .\* index.php

to read

> RewriteRule .\* catalog.php

From the root of the downloaded repository, run the command

> bash exe/build.sh

This will wipe out and recreate the dist directory, then build the file

* dist/omeuka.tar.gz

Extract this file in the Omeka root directory.

Log in to Omeka as a Super User.  Select the Omeuka Prologue theme,
then configure the theme appropriately.  Make sure to save changes to
the theme.  This ensures that the Solr configuration is saved to the
Omeka database.

Notes
-----

To use the maintenance scripts in the exe directory, the following
programs are required:

* bash
* npm
* rsync
* wget

Docker
------

Docker has been added as an option to quickly produce a development environment. `.env.example` and `nginx/default.conf.example` are provided as default configurations and should be changed for any production environment. A process for loading from a backup is detailed in the [backup readme](/backup/README.md).

Please see the [docker documentation](https://docs.docker.com/) for details on commands, but the following shell command should provide a working environment:
```bash
# Start containers detailed in docker-compose.yml in a detached state
docker compose up -d

# Stop containers
docker compose down

# List names and images of running containers on the host system
docker compose ps

# Login to a particular container in an interactive shell
docker exec -it $name_of_container sh

# Generate a dump for the SQL database
docker exec $name_of_container pg_dump -U $sql_database_username -d $db_name > /path/on/host/backup.sql

# Copy files from the container to the host
docker cp $container_name:$source_files_directory /path/on/host/file/destination

# Copy a file from the host to a container
docker cp /path/on/host $container_name:/path/in/container
```

Tests
-----

There are PHPUnit tests in the /tests directory organized by suite.
Usage:
```bash
# From the host, /tests location is required, optionally pass a subfolder for a particular test suite
docker exec -it <name_of_container> /vendor/bin/phpunit /tests[/subfolder]

# Example of above
docker exec -it exploreuk-web-app-omeka-1 /vendor/bin/phpunit /tests/integration

# From inside the container
/vendor/bin/phpunit

# Run a particular test suite by specifying a folder
/vendor/bin/phpunit /tests/integration
```

Coding standard
---------------

This program attempts to adhere to the [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard
for all PHP code. For convenience, the dev environment
provides [PHP_CodeSniffer](https://github.com/PHPCSStandards/PHP_CodeSniffer/), which detects
and can repair many PSR-12 violations.

```bash
# Detect PSR-12 violations.
docker exec -it exploreuk-web-app-omeka-1 /vendor/bin/phpcs -w --exclude=Generic.Files.LineLength --standard=PSR12 /app/shim

# Fix PSR-12 violations which can be fixed automatically.
docker exec -it exploreuk-web-app-omeka-1 /vendor/bin/phpcbf -w --exclude=Generic.Files.LineLength --standard=PSR12 /app/shim
```

Licenses
--------

Copyright (C) 2018-2025 Neal Powers, MLE Slone, and Eric Weig.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.

The following directories are derived in part from the [HTML5 Up Prologue](https://html5up.net/prologue)
theme, which is licensed under the
[Creative Commons Attribution 3.0 License](https://creativecommons.org/licenses/by/3.0/):

* theme/assets/css
* theme/assets/js/ie

Additionally, the HTML in the following directory is derived in part from the
HTML5 Up Prologue theme:

* theme/templates

The following file is derived from [Google's documentation of lazy loading images](https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/), which is licensed under the [Apache 2.0 License](https://www.apache.org/licenses/LICENSE-2.0):

* theme/assets/js/lazy-loading.js

This package includes some packages with other licenses:

* [Internet Archive BookReader](https://github.com/internetarchive/bookreader) - GNU Affero GPL
* [jQuery](http://jquery.com/) - dual-licensed under the GPLv2 and MIT licenses
* [jQuery UI](https://jqueryui.com/) - dual-licensed under the GPL and MIT licenses
* [MediaElement.js](https://www.mediaelementjs.com/) - MIT
* [OpenSeadragon](https://openseadragon.github.io/) - new BSD license
* [A Simple CSS Tooltip](https://chrisbracco.com/a-simple-css-tooltip/) - [Creative Commons Attribution-ShareAlike 4.0 International License](https://creativecommons.org/licenses/by-sa/4.0/)
* [back-to-top](https://github.com/CodyHouse/back-to-top) - BSD-3-Clause license (licenses/codyhouse.txt)
