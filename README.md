exploreuk-web-app
=================

This is the main portion of the ExploreUK web application. Document
data is pulled from Solr, and other settings are managed in Omeka
admin mode.

This is based in part on euk: https://github.com/uklibraries/euk/ .

Developer installation
----------------------

We use Docker for development. Quickstart:

```
git clone git@github.com:uklibraries/exploreuk-web-app.git
cd exploreuk-web-app
git checkout dev
git submodule init; git submodule update
docker compose watch
```

The application should be available at http://localhost:8080 .
The code is synced, linted, and tested on save. Linter and test
results appear in `docker compose logs -f`.

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

[Docker](https://www.docker.com/) has been added as an option to scaffold reproducible environments for this application. There are various configurations and init files to produce a working [Omeka Classic](https://omeka.org/classic/) database which can be used as a base for development or production.

### Configuration
`.env.example` and `nginx/default.conf` are provided as configurations. Developers are expected to create their own .env files for their particular purpose at each stage (e.g., .env.dev, .env.ci, .env.prod). .env.example provides a starting point for creating these files.

The docker-compose.yml file is specifically for development. Other compose files are designed to be [merged](https://docs.docker.com/compose/how-tos/multiple-compose-files/merge/) with the dev compose file. A production file can be found in the [ukl-ansible-playbooks](https://github.com/uklibraries/ukl-ansible-playbooks) repository.

### Using development compose file
For development, it is expected that developers will use [watch](https://docs.docker.com/compose/how-tos/file-watch/) to sync file changes. Starting up a dev environment can be accomplished with this command:
```bash
docker compose up --watch
```

### Optional: Findingaid
There is a service, findingaid, which is an integration with [findingaid](https://github.com/uklibraries/findingaid). Its inclusion in the development environment is optional. Developers wishing to include this should follow the docker installation instructions in the findingaid repo, set an environment variable FA_IMAGE to the location of the image (locally or in a container registry), and can then include the service with a command like this:
```bash
docker compose --profile with_fa up --watch
```
Please see the [docker documentation](https://docs.docker.com/) for details on docker usage.

Tests
-----

There are PHPUnit tests in the /tests directory organized by suite. Additionally, when using watch, tests are ran on file changes.
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
docker exec -it exploreuk-web-app-omeka-1 /vendor/bin/phpcs -w --exclude=Generic.Files.LineLength --standard=PSR12 /tests /app/catalog.php /app/application/libraries/ExploreUK

# Fix PSR-12 violations which can be fixed automatically.
docker exec -it exploreuk-web-app-omeka-1 /vendor/bin/phpcbf -w --exclude=Generic.Files.LineLength --standard=PSR12 /tests /app/catalog.php /app/application/libraries/ExploreUK
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
