_Archived - No longer maintained_

# Genesis Starter Theme

Starter theme for Genesis framework based on Genesis Sample 2.3.0.

[**Demo**](http://genesis-starter.wpdemos.co/)

## Features

1. CSS Grid for Site Header Wrap, Content Sidebar Wrap, WordPress Galleries, Author Box, and Footer Widgets Wrap. Floats are used as fallback for browsers (IE) that do not yet support CSS Grid.
2. [Theme Logo](https://sridharkatakam.com/theme-logo-genesis/) in place of Custom Header so logo can be shown as an inline image instead of as a background for better SEO. To select/upload a logo, go to Appearance > Customize > Site Identity. Click on "Select logo" button, upload/select your logo image, click on "Skip Cropping" button and finally "Save & Publish".
3. Primary Navigation relocated inside the Header to the right with the hamburger menu icon remaining inline at smaller widths. Header Right widget area has been removed.
4. Secondary Navigation moved from the Footer to its normal location, below the Header.
5. [Footer Navigation Menu](https://sridharkatakam.com/footer-navigation-menu-genesis/).
6. Mobile First CSS (except for the mobile menu section).
7. Custom `col-1` to `col-6` classes for displaying items in 1 or 2 or 3 or 4 or 5 or 6 columns. A `col` class also needs to be added to the parent container of items. See [this](https://github.com/srikat/genesis-starter/wiki/Column-Classes) wiki page for sample HTML.
8. Blog Page Template has been removed. Archive Page Template has been renamed as Sitemap.
9. Added Single Post Navigation.
10. Removed all three-column content layouts.

## Installation Instructions

1. Click on `Clone or download` button at the top and download the zip file. Extract the zip file and rename `genesis-starter-master` to `genesis-starter`.
2. Upload the `genesis-starter` theme folder via FTP to your wp-content/themes/ directory. (The Genesis parent theme needs to be in the wp-content/themes/ directory as well.)
3. Go to your WordPress dashboard and select Appearance.
4. Activate the Genesis Starter theme.
5. Inside your WordPress dashboard, go to Genesis > Theme Settings and configure them to your liking.

## Theme Support

This child theme is provided as is - without any support.

Please visit http://my.studiopress.com/help/ for parent Genesis theme support.

### Change Log

*August 23, 2017*

Initial Release.

*August 24, 2017*

* Added line-height for paragraphs in footer.
* Added `hyphens: auto` for `.col`.
* Removed unneeded top margin for mobile menu icon.
* Changed Footer text.
