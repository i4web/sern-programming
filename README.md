# [Seneum Programming Website Theme](http://www.sernprogramming.com/)

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

Access your custom widgets via your WordPress Administration panel. Your theme is equipped with 3 custom built widgets:

* Github - Simple widget to display your latest Github Repos
* Progress Bars - Displays a language and a progress bar to display your strength in that language out of 100
* Toolbox Widget - Display what is in your Developers toolbox made to look separate arrays

## Editing your Radial Progress Bars

To edit your radial progress bars please visit the templates directory and edit home-strengths.php

## Adding a New Project that is hosted on Github

To add a new project to your Portfolio please follow the following steps in the admin area:

* Add a New Project via the Portfolio menu link by hovering over "Portfolio" and selecting "Add New Project". 
* Enter in the title of your project and set your URL. By default WordPress will remove spaces from your title and replace them with dashes to make them URL friendly.
* Select the type of project that you are adding inside the "Type" box located just below the Publish box on the right side of the page.
* Create your Project write up, add images, and more inside the text editor.

Your Projects are equipped with the ability to add custom metadata for each project. Just below the text editor you will find a "Project Meta Data" box that has numerous fields that you can populate. 

If you would like your project to display the data from its Github Repository the you simply have to enter its corresponding Github Repo title exactly as it appears. You may then leave all fields below it blank. `Please note that if this field is populated all custom metadata for the project will not be displayed`

Hit the publish button and witness the awesomeness by visiting your portfolio page.

## Adding a New Project that is NOT hosted on Github

To add a new project that is not hosted on Github please follow the steps listed above.

Once you've got the basics for your project setup you can add custom project metadata via the Project Stat Title - #X and Project Stat - #X fields. Try to keep the titles for these to 1 or two short words. When entering in custom stats for your project there is a known issue with the digit "0". WordPress uses that to indicate that the field has not been updated ( i.e. binary false ) and won't save the data into the database. Instead use the word "Zero".

To add a custom description for your project you can fill in the "Excerpt" box with your custom description in plain text. 

Hit the publish button and witness the awesomeness by visiting your portfolio page.

## Support

Contact [i-4Web](http://www.i-4web.com/) to ask questions and get support.
