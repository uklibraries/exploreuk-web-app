omeka-solr-shim
===============

This is the main portion of the Omeuka application, which serves
ExploreUK to users atop Omeka, pulling metadata from Solr.

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
* cleancss
* rsync
* wget

Licenses
--------

Copyright (C) 2018 Michael Slone and Eric Weig.

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
* [smart-fixed-navigation](https://github.com/CodyHouse/smart-fixed-navigation) - BSD-3-Clause license (licenses/codyhouse.txt)
