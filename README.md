# ExploreUK

This is the main portion of the ExploreUK web application. Document data is
pulled from [Solr](https://solr.apache.org/). Deploying to production is managed
in the
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
make env
make dev
```

The application should then be available at http://localhost:8080. Developers
should run `make help` to see helper commands through
[make](https://www.gnu.org/software/make/). There is a
[git submodule](https://git-scm.com/book/en/v2/Git-Tools-Submodules) that is
loaded on initialization in the `assets` directory, so new developers do not
need to source assets for installation.

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

`nginx/default.conf` is provided as an example configuration for development.
Developers are expected to create their own .env files for new environments,
including a `.env.dev` for development purposes. An `.env.example` file is
provided as a template for environment files, and the repo includes `.env.ci`
for continuous integration. Developers can choose to copy and edit
`.env.example` or run `make env` to generate a `.env.dev` file from the
template.

`docker-compose.yml` is the shared base and deliberately declares no `env_file`,
so it does not depend on any untracked file. Each environment supplies its own
through a compose file that is
[merged](https://docs.docker.com/compose/how-tos/multiple-compose-files/merge/)
onto the base: `docker-compose.dev.override.yml` points at `.env.dev` and
`docker-compose.ci.override.yml` points at `.env.ci`. Note that Compose appends
rather than replaces list fields such as `env_file` when merging, which is why
the base leaves it empty. A production file can be found in the
[ukl-ansible-playbooks](https://github.com/uklibraries/ukl-ansible-playbooks)
repository.

The `make` targets export `COMPOSE_FILE` so the base and dev override are always
loaded together. Developers invoking Compose directly need to do the same:

```
docker compose -f docker-compose.yml -f docker-compose.dev.override.yml up -d

# or
export COMPOSE_FILE=docker-compose.yml:docker-compose.dev.override.yml
docker compose up -d
```

### Optional: Findingaid

There is a service, findingaid, which is an integration with ExploreUK's
associated application, [findingaid](https://github.com/uklibraries/findingaid).
Its inclusion in the development environment is optional. Developers wishing to
include this application in dev should follow the docker installation
instructions in the findingaid repo, set the environment variable `FA_IMAGE` to
the name of a locally built findingaid image or a URL to the desired image, and
then use the `make dev-fa` command. The xml directory will be gitignored.

```
# Run ExploreUK with a findingaid image
FA_IMAGE="findingaid:local" make dev-fa
```

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

The following file is derived from
[Google's documentation of lazy loading images](https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/):

- app/assets/js/lazyload.js

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

- [Google's documentation of lazy loading images](https://developers.google.com/web/fundamentals/performance/lazy-loading-guidance/images-and-video/) -
  [Apache License, Version 2.0](https://www.apache.org/licenses/LICENSE-2.0)
- [Internet Archive BookReader](https://github.com/internetarchive/bookreader) -
  [GNU Affero GPL v3](https://www.gnu.org/licenses/agpl-3.0.en.html)
- [jQuery](http://jquery.com/) - [MIT License](https://opensource.org/license/mit) (Dual-licensed GPLv2/MIT; MIT selected)
- [jQuery UI](https://jqueryui.com/) - [MIT License](https://opensource.org/license/mit) (Dual-licensed GPLv2/MIT; MIT selected)
- [MediaElement.js](https://www.mediaelementjs.com/) -
  [MIT License](https://opensource.org/license/mit)
- [OpenSeadragon](https://openseadragon.github.io/) -
  [BSD 3-Clause License](https://opensource.org/license/bsd-3-clause)

An important note for users,
[Docker Desktop](https://www.docker.com/products/docker-desktop/) is
[not always](https://www.docker.com/legal/docker-subscription-service-agreement/)
free software. The recommended installation instructions mention ways of
installing the [Docker Engine](https://github.com/moby/moby) which is free
software underneath the
[Apache License, Version 2.0](https://www.apache.org/licenses/LICENSE-2.0).
