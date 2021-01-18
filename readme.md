# phi-slim-starter

Starting skeleton for small websites we use at Phisolutions.

Powered by [Slim Framework](http://www.slimframework.com/), [Twig](https://twig.symfony.com/) and [Tailwindcss](https://tailwindcss.com/).

## Requirements

- php >= 7.2

# Install

- composer install
- npm install
- copy `.env.example` file in root and name it `.env`

**To compile js/css:** run any script defined in `package.json` or add your own.

# How to

## Routes

Add routes to `/src/Routes/web.php` or `/src/Routes/api.php`\
_There are 2 pre-defined routes. One inline, another using Controller. Use them as an example._

## Templates

This skeleton is using Twig as templating engine. Templates should by default go to /src/Templates.

**Disable/enable template caching**: `templateCache` in config.php
**Path to cache files**: `/cache/`

**How to render template from route**:

```
    return $this->get('view')->render($response,    'test.html', [
        'name' => $args['name']
    ]);
```

_This snippet renders `test.html` and passes \$name_

**To echo out passed variables**: `{{name}}`

### Layouts

Twig can use layouts. Check prepared simple layout `src/Templates/layouts/layout.html` and `/src/Templates/test.html` to see how to use it and extend it.

_For further information how to use Twig in Slim [Check documentation](https://github.com/slimphp/Twig-View)_

## Container

### To access container:

**Inline Route**: `$this->get('...')`\
**Controller Routes**: `$this->container->get('config')`

### To set custom variables / instances to container

You can do this by adding code to `/src/container.php` by following same principles as already in there.

## Database

This project is using [dibi datbase wrapper](https://dibiphp.com/).
To use Database:

- Set database env variables in .env file
- Set `usingDatabase=true` in `src/config.php`
- To get database instance: `$container->get('config')`

## Emails

This is project is using [swiftmailer](https://swiftmailer.symfony.com/).
To use mailing:

- Set `usingMailer=true` in `src/config.php`
- To get mailer: `$container->get('mailer')`
- To send an email

```
    // Create a message
    $message = (new Swift_Message('Wonderful Subject'))
    ->setFrom(['john@doe.com' => 'John Doe'])
    ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
    ->setBody('Here is the message itself')
    ;

    //Send the message
    $result = $this->get('mailer')->send($message);
```

_For further information how to use SwiftMailer, [Check documentation](https://swiftmailer.symfony.com/docs/)_

## CORS

CORS is enabled by default.

- Set `domain = '<domain>'` in `src/config.php` to your domain in order for it to work properly.
- - If you don't set domain in config, CORS won't be enabled
- To turn CORS off, set `usingCors = false` in `src/config.php`

_For further information how to CORS works in Slim, [Check documentation](https://www.slimframework.com/docs/v4/cookbook/enable-cors.html)_

## CSS-FRAMEWORKS

### Tailwindcss

We are following [documentation](https://tailwindcss.com/docs/guides/laravel).

_At the time of writing this guide, Laravel Mix doesn't support PostCSS 8, so we we have to install the compatibility build_

- Install Tailwind and dependencies using `npm`

```
npm install -D tailwindcss@npm:@tailwindcss/postcss7-compat @tailwindcss/postcss7-compat postcss@^7 autoprefixer@^9
```

- Create config file `npx tailwindcss init`

- Configure `webpack.mix.js` file which should look something like this

```
mix.js('resources/js/app.js', 'assets/js')
     .sass('resources/sass/style.scss', 'assets/css')
     .postCss("resources/tailwind/tailwind.css", "assets/css", [
        require("tailwindcss"),
       ]);
```

_In this example, we are using sass for our css and postCss to compile tailwind.css file. You have to create the tailwind file in `resources/tailwind/tailwind.css` for this example to work_

- tailwind.css file should look like this

```
@tailwind base;
@tailwind components;
@tailwind utilities;
```

- Run any of predefined npm scripts to compile resources and your tailwind file should be in `assets/css`
