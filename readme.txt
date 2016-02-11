=== Vk.com sharing for Jetpack ===
Contributors: jeherve
Tags: WordPress.com, Jetpack, sharing, vk.com, vk 
Requires at least: 4.1.1
Tested up to: 4.4.2
Stable tag: 1.2.3

Add a Vk.com sharing button to the Jetpack Sharing module

== Description ==

Extends the Jetpack plugin and allows you to add a Vk.com sharing button to the list of sharing services available under Settings > Sharing in your dashboard.

Important: for this plugin to work, you must activate [Jetpack](http://wordpress.org/plugins/jetpack/) first, and activate the Sharing module.

If you find issues, you can report them [here](http://wordpress.org/plugins/vk-sharing-jetpack/), or submit a pull request [on GitHub](https://github.com/jeherve/vk-sharing-jetpack/).

**Note:** Once you've added the button under Settings > Sharing, it won't appear on that page. Save your changes, and look at one of your posts to see the button in action.

== Installation ==

1. Install the Jetpack plugin, connect the plugin to WordPress.com
2. Activate the Sharing module
3. Install the VK.com Sharing for Jetpack plugin via the WordPress.org plugin repository, or via your dashboard
4. Activate the plugin
5. Go to Settings > Sharing, and drag the Vk.com button to the sharing area.
6. Enjoy! :)

== FAQ ==

= Can I use VK's Like button instead of the Share button? =

The Like button requires an app ID and a Vk.com account. To use the Like button you would have to create your own app on Vk.com. I wanted this plugin to be simple to use, so I chose the Share button instead.

= Why is this not in Jetpack yet? =

If this Jetpack addon becomes popular, I will propose that we add Vk.com in Jetpack's Sharing module.

== Changelog ==

= 1.2.3 =
* Fix that layout issue with the Icon-only view again, this time on mobile too.

= 1.2.2 =
* Fix layout issue with the Icon-only view, props @kat-liger

= 1.2.1 =
* Fix layout issue with the Icon-only view, props @msveshnikov

= 1.2 =
* Refactor Official sharing button to respect [new guidelines](https://vk.com/pages?oid=-17680044&p=Sharing_External_Pages)
* Add new function to get excerpt for Official sharing button
* Add some missing escaping, props @jkudish

= 1.1 =
* Update the plugin to be compatible with Jetpack 3.0
* Refactor the plugin organization to avoid all Fatal errors
* Create new button options for Icon and Icon + Text button styles
* Add a notice when Jetpack is deactivated

= 1.0 =
* Initial Release
