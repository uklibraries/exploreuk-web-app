// 
// This file shows the minimum you need to provide to BookReader to display a book
//
// Copyright(c)2008-2009 Internet Archive. Software license AGPL version 3.



var pages = json;

// Create the BookReader object
br = new BookReader();
br.search_host = search_host;
br.imagesBaseURL = imagesBaseURL;

// search()
//______________________________________________________________________________
br.search = function (term) {
    //console.log('search called with term=' + term);

    $('#textSrch').blur(); //cause mobile safari to hide the keyboard

    var url = br.search_host + '?q=' + escape(term);

    term = term.replace(/\//g, ' '); // strip slashes, since this goes in the url
    this.searchTerm = term;

    this.removeSearchResults();
    this.showProgressPopup('<img id="searchmarker" src="'+this.imagesBaseURL + 'marker_srch-on.png'+'"> Search results will appear below...');
    $.ajax({url:url, dataType:'json', success: br.BRSearchCallback});
}

// BRSearchCallback()
//______________________________________________________________________________
br.BRSearchCallback = function (results) {
    //console.log('got ' + results.matches.length + ' results');
    br.removeSearchResults();
    br.searchResults = results;
    //console.log(br.searchResults);

    if (0 == results.matches.length) {
        var errStr  = 'No matches were found.';
        var timeout = 1000;
        if (false === results.indexed) {
            errStr  = "<p>This book hasn't been indexed for searching yet. We've just started indexing it, so search should be available soon. Please try again later. Thanks!</p>";
            timeout = 5000;
        }
        $(br.popup).html(errStr);
        setTimeout(function(){
            $(br.popup).fadeOut('slow', function() {
                br.removeProgressPopup();
            })
        },timeout);
        return;
    }

    var i;
    for (i=0; i<results.matches.length; i++) {
        br.addSearchResult(results.matches[i].text, br.leafNumToIndex(results.matches[i].par[0].page));
    }
    br.updateSearchHilites();
    br.removeProgressPopup();
}

// Return the width of a given page.  Here we assume all images are 800 pixels wide
br.getPageWidth = function(index) {
    if (index >= 0 && index < pages.length) {
        return parseInt(pages[index]["reference_image_width_s"][0], 10);
    }
    else {
        return 800;
    }
}

// Return the height of a given page.  Here we assume all images are 1200 pixels high
br.getPageHeight = function(index) {
    if (index >= 0 && index < pages.length) {
        return parseInt(pages[index]["reference_image_height_s"][0], 10);
    }
    else {
        return 1200;
    }
}

// We load the images from archive.org -- you can modify this function to retrieve images
// using a different URL structure
br.getPageURI = function(index, reduce, rotate) {
    // reduce and rotate are ignored in this simple implementation, but we
    // could e.g. look at reduce and load images from a different directory
    // or pass the information to an image server
    var url;
    if (index >= 0 && index < pages.length) {
        url = pages[index]["reference_image_url_s"];
    }
    else {
        url = '/images/logo.png'
    }

    return url;
}

// Return which side, left or right, that a given page should be displayed on
br.getPageSide = function(index) {
    if (0 == (index & 0x1)) {
        return 'R';
    } else {
        return 'L';
    }
}

// This function returns the left and right indices for the user-visible
// spread that contains the given index.  The return values may be
// null if there is no facing page or the index is invalid.
br.getSpreadIndices = function(pindex) {   
    var spreadIndices = [null, null]; 
    if ('rl' == this.pageProgression) {
        // Right to Left
        if (this.getPageSide(pindex) == 'R') {
            spreadIndices[1] = pindex;
            spreadIndices[0] = pindex + 1;
        } else {
            // Given index was LHS
            spreadIndices[0] = pindex;
            spreadIndices[1] = pindex - 1;
        }
    } else {
        // Left to right
        if (this.getPageSide(pindex) == 'L') {
            spreadIndices[0] = pindex;
            spreadIndices[1] = pindex + 1;
        } else {
            // Given index was RHS
            spreadIndices[1] = pindex;
            spreadIndices[0] = pindex - 1;
        }
    }
    
    return spreadIndices;
}

// For a given "accessible page index" return the page number in the book.
//
// For example, index 5 might correspond to "Page 1" if there is front matter such
// as a title page and table of contents.
br.getPageNum = function(index) {
    return index+1;
}

br.leafNumToIndex = function (leafNum) {
    return leafNum - 1;
}

// Total number of leafs
br.numLeafs = pages.length; //15;

// Book title and the URL used for the book title link
//br.bookTitle = item_title;
br.bookTitle = 'ExploreUK';
br.bookUrl  = '/';

br.getEmbedCode = function(frameWidth, frameHeight, viewParams) {
    return "Embed code not supported in bookreader demo.";
}

// Let's go!
br.init();

/* hide unused components */
$('#BRtoolbar').find('.play').hide();
$('#BRtoolbar').find('.pause').hide();
$('#BRtoolbar').find('.info').hide();
$('#BRtoolbar').find('.share').hide();
$('#BRtoolbar').find('.read').hide();
$('#BRtoolbar').find('.logo').hide();
$('#BRreturn').hide();

function updateOuter() {
    var origin = window.location.protocol + '//' + window.location.hostname;
    var page = parseInt(br.paramsFromFragment(window.location.hash).page, 10) - 1;
    parent.postMessage({page: json[page], hash: window.location.hash}, origin);
}

if ('onhashchange' in window) {
    window.addEventListener('hashchange', updateOuter);
}
updateOuter();

if (query) {
    $('#textSrch').val(query);
    br.search(query);
}
