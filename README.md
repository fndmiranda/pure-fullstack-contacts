# A pure full-stack contacts project

> Pure PHP and JavaScript (ES6).

## Installation

Import database file in:
```bash
pure-fullstack-contacts.sql
```

Define database constants in:
```bash
config/app.php
```

Config BASE_API to define your project address in:
```bash
webpack.config.js
```

## Composer

You can generate classes for autoload via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer dump-autoload
```

## NPM

Install the NPM modules
```bash
npm install
```

## Compiling ES6 to ES5

After the NPM modules have been installed, use the default Babel script to convert the files from ES6 to ES5.

```bash
npm run webpack
```