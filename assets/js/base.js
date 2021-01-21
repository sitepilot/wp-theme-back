
/* Atra Footer Fix
/* ----------------------------------------------- */
module.exports = {
    astra: {
        /**
         * Force footer to the bottom of the screen.
         */
        footerFix: function () {
            let adminbarHeight = jQuery('#wpadminbar').length ? jQuery('#wpadminbar').height() : 0;
            let headerHeight = jQuery('header').length ? jQuery('header').height() : 0;
            let footerHeight = jQuery('footer').length ? jQuery('footer').height() : 0;
            let contentHeight = window.innerHeight - adminbarHeight - headerHeight - footerHeight;

            jQuery('#content').css("min-height", contentHeight);
        }
    }
} 