BookYap - static HTML version
=============================

Upload the CONTENTS of this folder (including the hidden .htaccess file) to the web root of
bookyap.com, or to any subfolder for a staging preview. All links are relative.

Pages
-----
All 123 page URLs are unchanged: home, about, contact, all 67 book reviews, 6 categories and
their paged archives, 30 tag pages and the author pages. Each URL is a folder with index.html.
Found from the sitemap, WordPress's own list of posts/pages/categories/tags, and a full crawl.

Redirects (28)
-------------
The 28 redirects found on the live site (reviews moved between categories, and
/category/.../page/1/ -> /category/.../) are included three ways:
  .htaccess    real 301 redirects for Apache/LiteSpeed (works at the root or in a subfolder)
  _redirects   real 301 redirects for Cloudflare Pages
  HTML pages   small redirect pages at each old URL, as a fallback on any other host

Images
------
Every image and file referenced by every page was downloaded and checked. Four files referenced
by the theme do not exist on the live server either (so they are missing there too):
favicon_by.ico (the site favicon), logo_bookyap.svg (an old logo; the visible logo is the .webp),
ecailles.png (an old background pattern) and Phongs-Headshot-300x300.png.

Contact form
------------
The Contact Form 7 form on /contact/ now posts to send.php (needs PHP).
IMPORTANT: no email address is published on the site, so open send.php and set $to.
Until then the form shows its error message instead of sending.
On Cloudflare Pages PHP does not run - the form would need a different handler there.
The search box opens a Google search limited to bookyap.com.

Noindex (staging)
-----------------
Every page has <meta name="robots" content="noindex, nofollow" />; .htaccess and _headers send an
X-Robots-Tag: noindex, nofollow header.
BEFORE GOING LIVE: remove that meta line from each page, the noindex block from .htaccess and
the X-Robots-Tag line from _headers, or the site will drop out of Google.
