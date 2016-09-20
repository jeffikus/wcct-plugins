# wcct-plugins
WordCamp Cape Town Slides

# Installation Instructions

1. Upload the 2 plugins in the /plugins/ folder and activate them on your WordPress site.
2. Import the /dummy-content/ into your WordPress site.
3. Upload the /static-html/ to wherever you want to host the static html.
4. Open up index.html in the /static-html/ and modify the url on line 50 to be your WordPress sites url, this is the line you are looking for:
`url: 'http://wcct2016.jeffikus.com/wp-json/wp/v2/posts?filter[order]=ASC&filter[category_name]=slides&filter[posts_per_page]=-1',`