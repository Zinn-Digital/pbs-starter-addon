# PBS Starter Add-on

A complete, working example of an add-on for [Page Builder Sandwich](https://zinndigital.com/wordpress-plugins/page-builder-sandwich), built against the published API. Copy it to start your own.

It adds one of everything an add-on can add:

| What | How |
|---|---|
| A block, styled with the builder's Style panel; its CSS loads only where it is used | `pbsw_register_block()` |
| "Text wrapping" in every block's Style panel, with no JavaScript | `pbsw_register_style_control()` |
| A "Greeting" dynamic data source for headings, paragraphs and buttons (Pro) | `pbsw_register_dynamic_source()` |
| A "Weekday" display condition for templates and blocks (Pro) | `pbsw_register_condition()` |
| A form action that keeps a log of submissions (Pro form builder) | `pbsw_register_form_action()` |
| A panel on the builder's admin screen, typed with [`@zinn-digital/pbs-types`](https://www.npmjs.com/package/@zinn-digital/pbs-types) | the `pbs.admin.panels` filter |

```sh
npm install
npm run typecheck
npm run build
```

Then copy the folder to `wp-content/plugins/` and activate it next to Page Builder Sandwich.

Developer reference (every function, hook, REST route, WP-CLI command and MCP ability): https://zinndigital.com/wordpress-plugins/page-builder-sandwich/mcp-api

This repository is generated from the Zinn Digital monorepo; please open issues here, changes are made there.

License: GPL-2.0-or-later. By Neil Lock — CEO, Zinn Digital® Ltd.
