wordpress-plugins-class-loader
==============================

ClassLoader library for WordPress plugins. In simple words, when you use this extension, you no longer need to `include()` nor `require()` your classes.
Important note: it requires namespaces and strict directory structure implemented in your plugin.

Usage
=====

In order to use the library you need two variables:
* $pluginPath
* $namespacePrefix

Both of them are required and both od them are string typed.

$pluginPath parameter
=====================

This variable should contain a path to plugin directory. Easiest way to get it is to run following code from main plugin file:
`plugin_dir_path(__FILE__)`

$namespacePrefix parameter
==========================

As I have mentioned in the intro, this library requires you to use namespaces in your plugin. Moreover, you need to implement
strict directory tree structure that will match the namespaces. Sounds scary, but it's very simple. However I will explain from the beginning:

1. Plugin name: Say that your plugin is named 'Your Sample Plugin'. So, plugin directory should be named `your-sample-plugin`.
2. Main plugin file: According to how we named the directory, this file should be named `your-sample-plugin.php`. And of course, it should be placed directly in plugin folder.
3. Main plugin file namespace: Yes, this file should have a namespace as well. Even if it shouldn't contain any class. So, the namespace:
`namespace YourSamplePlugin;`
4. Directory structure: all the services, models, vendors and other classes should be placed in directory `Src`. Then in this directory you should create folders like `Services`, `Model`, `Vendor` etc.
5. Namespaces in classes: Well, it's obvious that namespace for vendor classes should be:
 `YourSamplePlugin\Src\Services\Vendor` (which is the same as directory structure, except `YourSamplePlugin` part)
6. Finally, `$namespacePrefix` variable should be just `YourSamplePlugin` (assuming that you run the class loader from plugin main file)

How to run
==========
`<?php`
`namespace YourSamplePlugin;`

`require_once(plugin_dir_path(__FILE__) . 'Src/Services/ClassLoader.php');`
`$classLoader = new ClassLoader(plugin_dir_path(__FILE__), 's2MemberProPostFinance');`
`$classLoader->register();`

`/* Plugin code */`