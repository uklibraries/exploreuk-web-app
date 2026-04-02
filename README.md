# ExploreUK

This is the main portion of the ExploreUK web application. Document data is
pulled from [Solr](https://solr.apache.org/), and other settings are managed in
the [Omeka Classic](https://omeka.org/classic/) admin panel. Deploying to
production is managed in the
[ukl-ansible-playbooks](https://github.com/uklibraries/ukl-ansible-playbooks)
repository.

## Developer installation

Developer installations have been tested on Linux (through Windows with
[WSL](https://learn.microsoft.com/en-us/windows/wsl/)) and macOS.

### Quickstart

```
git clone git@github.com:uklibraries/exploreuk-web-app.git
cd exploreuk-web-app
git submodule init; git submodule update
make dev
```

The application should then be available at http://localhost:8080. Developers
should run `make help` to see helper commands through
[make](https://www.gnu.org/software/make/). There are
[git submodules](https://git-scm.com/book/en/v2/Git-Tools-Submodules) and a
mysql database that is loaded on initialization in the `assets` directory, so
new developers do not need to source assets for installation.

### Dependencies

We use [Docker](https://www.docker.com/) for reproducible environments.
Developers will want to consult the
[docker documentation for installation](https://docs.docker.com/engine/install/).
We make use of [make](https://www.gnu.org/software/make/) to manage commands,
which is a standard Linux utility and an old (but functional) version is
included with macOS. Developers can also use
[watchexec](https://github.com/watchexec/watchexec) to run tests on every file
change, which will require separate installation. [Homebrew](https://brew.sh/)
is a recommended package manager that works for both Linux and macOS. Using
Docker requires access to a Linux kernel. Mac users should consider using
[Colima](https://github.com/abiosoft/colima) to access a Linux kernel. Windows
users should strongly consider working in WSL.

```
# macOS
brew install docker

# macOS optional
brew install make watchexec
```

### Configuration

`.env.example` and `nginx/default.conf` are provided as configurations for
development. Developers are expected to create their own .env files for new
environments, but a .env.example is provided as a template, and the repo
includes .env.dev and .env.ci for those environments.

The docker-compose.yml file is specifically for development. Other compose files
are designed to be
[merged](https://docs.docker.com/compose/how-tos/multiple-compose-files/merge/)
with the dev compose file. A production file can be found in the
[ukl-ansible-playbooks](https://github.com/uklibraries/ukl-ansible-playbooks)
repository.

### Optional: Findingaid

There is a service, findingaid, which is an integration with ExploreUK's
associated application, [findingaid](https://github.com/uklibraries/findingaid).
Its inclusion in the development environment is optional. Developers wishing to
include this should follow the docker installation instructions in the
findingaid repo, and then use the `make dev-fa` command.

## Coding standard

This program attempts to adhere to the
[PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard for all PHP code.
For convenience, the dev environment provides
[PHP_CodeSniffer](https://github.com/PHPCSStandards/PHP_CodeSniffer/), which
detects and can repair many PSR-12 violations. For convenience, developers can
use `make lint` to get a report of linting violations, and `make lint-fix` to
fix those that can be automatically fixed. These deliberately exclude line
length as a fix.

## Notes

This is based in part on euk: https://github.com/uklibraries/euk/

The following directories are derived in part from the
[HTML5 Up Prologue](https://html5up.net/prologue) theme:

- theme/assets/css
- theme/assets/js/ie

Additionally, the HTML in the following directory is derived in part from the
HTML5 Up Prologue theme:

- theme/templates

The following file is derived from
[Google's documentation of lazy loading images](https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/):

- theme/assets/js/lazy-loading.js

## Licenses

Copyright (C) 2018-2026 Neal Powers, Nicole Sand, MLE Slone, and Eric Weig.

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either [version 3](https://www.gnu.org/licenses/gpl-3.0.en.html) of
the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program. If not, see <https://www.gnu.org/licenses/>.

We make use of code which has their own licensing:

- [HTML5 Up Prologue](https://html5up.net/prologue) -
  [Creative Commons Attribution 3.0 License](https://creativecommons.org/licenses/by/3.0/)
- [Google's documentation of lazy loading images](https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/) -
  [Apache License, Version 2.0](https://www.apache.org/licenses/LICENSE-2.0)
- [Internet Archive BookReader](https://github.com/internetarchive/bookreader) -
  [GNU Affero GPL](https://www.gnu.org/licenses/agpl-3.0.en.html)
- [jQuery](http://jquery.com/) - dual-licensed under the
  [GPLv2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html) and
  [MIT](https://opensource.org/license/mit) licenses
- [jQuery UI](https://jqueryui.com/) - dual-licensed under the
  [GPLv2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html) and
  [MIT](https://opensource.org/license/mit) licenses
- [MediaElement.js](https://www.mediaelementjs.com/) -
  [MIT](https://opensource.org/license/mit)
- [OpenSeadragon](https://openseadragon.github.io/) -
  [new BSD license](https://opensource.org/license/bsd-3-clause)
- [A Simple CSS Tooltip](https://chrisbracco.com/a-simple-css-tooltip/) -
  [Creative Commons Attribution-ShareAlike 4.0 International License](https://creativecommons.org/licenses/by-sa/4.0/)

An important note for users,
[Docker Desktop](https://www.docker.com/products/docker-desktop/) is
[not always](https://www.docker.com/legal/docker-subscription-service-agreement/)
free software. The recommended installation instructions mention ways of
installing the [Docker Engine](https://github.com/moby/moby) which is free
software underneath the
[Apache License, Version 2.0](https://www.apache.org/licenses/LICENSE-2.0).
