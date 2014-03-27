# [Sern Programming Website Theme](http://www.sernprogramming.com/)

[![Built with Grunt](https://cdn.gruntjs.com/builtwith.png)](http://gruntjs.com/)

The Sern Programming theme is a custom wordpress theme for sernprogramming.com based on the Roots WordPress theme framework, [HTML5 Boilerplate](http://html5boilerplate.com/) & [Bootstrap](http://getbootstrap.com/).


## Installation

Clone the git repo - `git clone git://github.com/i4web/sern-programming.git` - or [download it](https://github.com/i4web/sern-programming/archive/master.zip). [Install Grunt](http://gruntjs.com/getting-started), and then install the dependencies for this theme contained in `package.json` by running the following from your theme directory:

```
npm install
```


## Maintaining Your Custom Theme

After you've installed Grunt and ran `npm install` from the theme root, use `grunt watch` to watch for updates to your LESS and JS files and Grunt will automatically re-build as you write your code.

Use your favorite code editor to edit your LESS files located in the /assets/less/app.less. Once you save your changes the `grunt watch` command or `grunt` command will automatically compile the LESS code into a minified CSS stylesheet



## Home Page Widgets

Access your custom widgets area via your WordPress Administration panel. Hovering over the "Appearance" menu link will display the link to access your widgets. Once you're in the Widgets page you can view the "Home Page" box to display your current widgets. You may drag and drop those to re-arrange them as you please.

Your theme is equipped with 3 custom built widgets:

* GitHub - Simple widget to display your latest GitHub Repos
* Progress Bars - Displays a language and a progress bar to display your strength in that language out of 100
* Toolbox Widget - Display what is in your Developers toolbox made to look separate arrays

Settings for each of these widgets can also be edited through the "Widgets" page in the Administration panel.

## Editing your Radial Progress Bars

To edit your radial progress bars please visit the templates directory and edit home-strengths.php

## Adding a New Project that is hosted on GitHub

To add a new project to your Portfolio please follow the following steps in the admin area:

1. Add a New Project via the Portfolio menu link by hovering over "Portfolio" and selecting "Add New Project".
2. Enter in the title of your project and set your URL. By default WordPress will remove spaces from your title and replace them with dashes to make them URL friendly.
3. Select the type of project that you are adding inside the "Type" box located just below the Publish box on the right side of the page.
4. Create your Project write up, add images, and more inside the text editor.

Your Projects are equipped with the ability to add custom metadata for each project. Just below the text editor you will find a "Project Meta Data" box that has numerous fields that you can populate.

If you would like your project to display the data from its GitHub Repository then you simply have to enter its corresponding GitHub Repo title exactly as it appears. You may then leave all fields below it blank. `Please note that if this field is populated all custom metadata for the project will not be displayed`

Hit the publish button and witness the awesomeness by visiting your portfolio page.

## Adding a New Project that is NOT hosted on GitHub

To add a new project that is not hosted on GitHub please follow the steps listed above.

Once you've got the basics for your project setup you can add custom project metadata via the Project Stat Title - #X and Project Stat - #X fields. Try to keep the titles for these to 1 or two short words. When entering in custom stats for your project there is a known issue with the digit "0". WordPress uses that to indicate that the field has not been updated ( i.e. binary false ) and won't save the data into the database. Instead use the word "Zero".

To add a custom description for your project you can fill in the "Excerpt" box with your custom description in plain text.

Hit the publish button and witness the awesomeness by visiting your portfolio page.

## Custom Shortcodes in the WordPress text editor

We created some custom shortcodes to help you type up your project write ups with as little to no HTML code needed as possible. Shortcodes are used to wrap your content with opening and ending tags that will wrap your content with HTML. With your theme you have the following shortcodes available:

* The [pre] shortcode - used for displaying programming code on via your website
* The [kbd] shortcode - used to display HTML in the browsers default monotype font. Styled with Bootstrap to look like a terminal or CLI.

To demonstrate how you can use the shortcodes in your WordPress editor you can copy and paste the following inside the editor

```
My latest project MyNewGame was released today. I'm particularly excited about this project
because it's easy to install and you'll be playing it in now time. To download and install
my latest game all you have to do is use apt by typing
[kbd]sudo apt-get install doge[/kbd]

I'm really excited about a particularly cool function that I was able to come up with, first
one to get it wins
[pre]Array(16).join("wat" - 1) + " Batman!"[/pre]
```

## Editing your "About Chris" Page

We set you up with a default about page. Click on the "Pages" link on the WordPress admin menu and click to edit your "About Chris" page. You can edit its contents via the visual or text tab in the wordpress editor.

## Changing the Home Page Header Copy

If you would like to change the text that is overlayed over the Header image on your website open up the **home-header.php** file that is located in the templates directory of your theme's folder.

## Changing Pagination on Portfolio Page

To change the number of projects that appear per page simply go to your admin dashboard and hover over the "Settings" link and click on "Reading". Change the "Blog pages show at most" value to your desired value.

## Support

Contact [i-4Web](http://www.i-4web.com/) to ask questions and get support.
