# Cata

A WordPress theme by [Thought & Expression Co.](https://thought.is) for hybrid sites — sites that use the block editor for content, but still render the front end with classic PHP templates.

> [!IMPORTANT]
> **Starting a new site?** New sites in the Thought & Expression Company network should start with the [goth](https://github.com/thoughtis/goth) theme instead. Goth supports full site editing and can be used as a parent theme or as the starting point for a site-specific block theme. Cata remains in use for existing hybrid sites.

## What it provides

- **Classic PHP templates** (`header.php`, `footer.php`, `index.php`, `single.php`, `page.php`, `404.php`, etc.) with reusable pieces in `template-parts/`.
- **Block editor support** via `theme.json` (v2): fluid font scale, root-padding-aware alignments, content/wide layout widths, spacing scale, and editor styles.
- **PHP features** organized as autoloaded classes in `includes/`, initialized in `includes/bootstrap.php`:
  - Block styles (e.g. Streaming) and block image sizes
  - Custom rich-text formats (Mark)
  - Asset enqueueing, image sizes and content width
  - Excerpts, nav menus, sidebar, languages, admin and block editor customizations

## Requirements

- WordPress
- PHP
- Node.js (for building assets)
- Composer (for coding-standards tooling)

## Development

Install dependencies:

```sh
npm install
composer install
```

### Build assets

JavaScript and LESS sources live in `assets/src/` and are compiled with [esbuild](https://esbuild.github.io/) into `assets/dist/`:

```sh
npm run build
```

### Watch + live reload

`npm start` builds, watches for changes, and serves the site through [BrowserSync](https://browsersync.io/) at `http://localhost:3000/`:

```sh
npm start
```

The BrowserSync proxy target is configured in `bin/browser-sync.js` (defaults to `dev.local`).

### Coding standards

PHP coding standards use [VIP WPCS](https://github.com/Automattic/VIP-Coding-Standards) via PHPCS (see `phpcs.xml.dist`):

```sh
vendor/bin/phpcs
```

## Credits

Inspiration from [_s](https://github.com/Automattic/_s), [Susty](https://github.com/jacklenox/susty) and [Storefront](https://github.com/woocommerce/storefront).

## License

[GNU General Public License v2 or later](LICENSE).
