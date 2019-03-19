(function(){
    var track = function(token, respectDoNotTrack) {
        if (token === null || token === undefined || (respectDoNotTrack && doNotTrack())) {
            return;
        }
        var uid = getCookie('__trackerGuid');
        if (uid === undefined) {
            var date = new Date;
            date.setDate(date.getDate() + 100);
            uid = guid();
            setCookie('__trackerGuid', uid, {'expires':date});
        }
        var params = {
            token: token,
            visitor: uid,
            url: window.location.href,
            browser: window.navigator.userAgent,
        };

        var http = new XMLHttpRequest();
        http.open('POST', 'http://tracker.loc/api/visit');
        http.setRequestHeader('Content-type', 'application/json');
        http.send(JSON.stringify(params));
    };

    window.__track = track;
    /**
     * @function _guid
     * @description Creates GUID for user based on several different browser variables
     * It will never be RFC4122 compliant but it is robust
     * @returns {Number}
     * @private
     */
    var guid = function() {

        var nav = window.navigator;
        var screen = window.screen;
        var guid = nav.mimeTypes.length;
        guid += nav.userAgent.replace(/\D+/g, '');
        guid += nav.plugins.length;
        guid += screen.height || '';
        guid += screen.width || '';
        guid += screen.pixelDepth || '';

        return guid;
    };

    /**
     * @function doNotTrack
     * @description Checks if use has declared Do Not Track (DNT) in their browser
     * Ignores IE10: Read this for further explanation: https://en.wikipedia.org/wiki/Do_Not_Track#Internet_Explorer_10_default_setting_controversy
     * @returns {*}
     */

    var doNotTrack = function() {

        if (!window.navigator.userAgent.match(/MSIE\s10\.0|trident\/6\.0/i)) {
            return window.navigator.doNotTrack || window.navigator.msDoNotTrack;
        }
    };

    var getCookie = function(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    };

    var setCookie = function(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    };
}());
