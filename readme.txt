=== PBS Starter Add-on ===
Contributors: zinndigital
Tags: page builder, blocks, add-on, example, developer
Requires at least: 6.8
Tested up to: 7.1
Requires PHP: 8.2
Stable tag: 1.0.0
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A complete, working example of a Page Builder Sandwich add-on. Copy it to start your own.

== Description ==

Everything Page Builder Sandwich lets an add-on add, in one small plugin built against the published API:

* a block (`pbsw_register_block()`), styled with the builder's Style panel, its CSS loaded only where it is used;
* a style control (`pbsw_register_style_control()`): "Text wrapping" in every block's Typography section, with no JavaScript;
* a dynamic data source (`pbsw_register_dynamic_source()`): "Greeting", for any heading, paragraph or button (Pro);
* a display condition (`pbsw_register_condition()`): "Weekday", for templates and blocks (Pro);
* a form action (`pbsw_register_form_action()`): keeps a log of form submissions (Pro form builder);
* a panel on the builder's admin screen, typed with [@zinn-digital/pbs-types](https://www.npmjs.com/package/@zinn-digital/pbs-types).

Developer reference: https://zinndigital.com/wordpress-plugins/page-builder-sandwich/mcp-api

== Installation ==

1. `npm install && npm run build`
2. Copy the folder to `wp-content/plugins/` and activate it (Page Builder Sandwich must be active).

== Changelog ==

= 1.0.0 =
* First release: block, style control, dynamic source, condition, form action and an admin panel.

== Credits ==

By Neil Lock — CEO, Zinn Digital® Ltd, https://zinndigital.com
