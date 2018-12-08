# Groot

Groot is a static site generator that uses Twig as the view engine. This project is *_heavily_** based on Tighten's Jigsaw.

**This project is in _very_ early stages of development so use at your own risk.**

## Why Twig?

In Foster Commerce, we use Craft CMS to build out our projects. Rather than code the markup by hand, use a different view engine like Blade or ~Jade~ Pug, it's much easier for our workflow to use Twig.

## Usage

Install Groot globally.

```sh
composer global require fostercommerce/groot
```

Next, let's create a new project.

```sh
groot new blog
```

All our templates and pages are inside the `/app` directory. To compile our `.twig` files,

```sh
groot build
```

This writes our directory structure in a `markup` folder. All our assets are compiled there as well.

We can also constantly watch changes from our `twig` files by running

```sh
yarn run watch
```

When webpack detects a change in any of the `twig` files, it'll immediately run `groot build`.
