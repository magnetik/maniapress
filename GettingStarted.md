# Table of contents #



# Introduction #

ManiaPress is a suite of plugins and theme to display your WordPress install directly in Maniaplanet.

# Demo #

This URL is the Maniaplanet Blog: http://blog.maniaplanet.com/
Now try to paste that URL in the address bar of the Manialink browser in Maniaplanet.

# Components #

ManiaPress consists of:
  * **ManiaPress Core plugin**: shared config and libraries
  * **ManiaPress Theme Switcher plugin**: automatically selects the ManiaPress Theme when viewing from Maniaplanet, so your install can be both a Manialink and a Website at the same time
  * **ManiaPress Theme**: a theme to display WP as a Manialink
  * **ManiaPress Event Publisher**: automatically post an Event to ManiaHome whenever you publish a post so that everyone that bookmarked your Manialink is kept posted

# Features #

todo

# Requirements #

  * **WordPress 3.0** or higher
  * **PHP 5.3** or or higher
  * (optional) cURL extension (http://php.net/manual/en/book.curl.php)
  * (optional) JSON extension (http://php.net/manual/en/book.json.php)
  * (optional) You must be able to make HTTPS requests on ws.maniaplanet.com

# Prerequisite: create a Manialink code #

It's better to have your own Manialink code to you can use the Bookmark button and the Event Publisher.

  * Let's say your blog URL is http://www.example.com
  * Login with your Maniaplanet account on http://player.maniaplanet.com
  * Go to **Manialinks**
  * Create a code. The "URL of the XML file" is your blog URL.

For example, the Manialink code **maniaplanetblog** points to http://blog.maniaplanet.com

# Installation #

Unzip the maniapress package directly in your WordPress install. The zip contains the same directory structure as WordPress:

```
wp-content/
   plugins/
      maniapress-code/
         ...
      maniapress-theme-switcher.php
      maniapress-event-publisher.php
   themes/
      maniapress/
         ...
```

Now you have two choices:

  * **You want your WP install to act only as a Manialink**: enable the **ManiaPress Theme** in the WP Admin panel
  * **You want your WP install to act as both a Manialink and a Website** depending on where it is viewed from: enable the **ManiaPress Theme Switcher** plugin

# Basic configuration #

By now, you should have a basic ManiaPress install working. Let's now see a couple of important configuration options.

To configure ManiaPress, go to **WP-Admin > Settings > ManiaPress** _(new in beta2)_

## Bookmark button ##

The first thing you will want to configure is your Manialink code. **If you set your Manialink code in the config, the ManiaHome bookmark button will automatically appear on your Manialink**.

## Navigation menu ##

ManiaPress Theme uses WP's built-in navigation menu system to handle it's navigation menu. **To customize the navigation menu on your Manialink, just create a navigation menu called "manialink"**.

## Theme customization ##

You can customize a bit the theme. You can change:
  * The background image or color (note that it will be streched to the full size of Maniaplanet's window)
  * The background color of the header
  * The background color of the content
  * The background color of the footer

Colors use the 3 hex chars + 1 alpha hex char. See http://tutorials.mania-creative.com/tm2_general_formattingtext/index-eng-1#colours

## ManiaHome Event Publishing ##

The Event Publishing is a really important feature. It will **automatically notify the players that bookmarked your Manialink when you publish a new Post by sending a public Event to ManiaHome**.

It's a bit long, but it's not complicated. Let's see how to set it up, step-by-step.

### 1. Create API credentials ###

The event publisher uses the Maniaplanet Web Services API, so you need credentials to use that API.

  * Connect with your account on http://developers.maniaplanet.com/webservices/
  * Click on "Create a new API user"
  * Follow the instructions

### 2. Authorize your API user to post event for your Manialink ###

For events to be posted, you only need the API user and the Manialink to be owned by the same player. If you created both, you have nothing to do!

### 3. Configure ManiaPress ###

Go to the ManiaPress config page and edit the settings. If the "API Test" says "Success", you're good to go!

### 4. Enable the plugin ###

Now you can enable the ManiaPress Event Publisher plugin. When you publish a new post, and event will be automatically sent to ManiaHome and seen by everyone who bookmarked your Manialink!