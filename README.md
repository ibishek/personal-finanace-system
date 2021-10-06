## About Personal Finance Management System

Personal finance is a single-user financial records keeping system. It encourages you to maintain your overspending habits. At first, you have to create an estimated spending amount called a budget for a definite term. After that, it assists you to keep track of how much you have earned and spent within that budget. You can get detailed reports via GUI charts powered by Chart js.

## Dashboard

![Dashboard Image](https://repository-images.githubusercontent.com/407355401/8d6267ae-6c7e-4423-a8b2-b0cb4d01f923)

## Required Applications

-   [XMPP](https://www.apachefriends.org/) or any web server for php code execution
-   [Node.js](https://nodejs.org/)
-   [Composer](https://getcomposer.org/)
-   [VS Code](https://code.visualstudio.com/) or any text editor/IDE
-   [Git Bash](https://git-scm.com/downloads)

## Install

-   `$ git clone https://github.com/ibishek/personal-finanace-system.git`
-   `$ cd project-folder`
-   `$ composer install`
-   Rename `.env.example` to `.env`
-   `$ php artisan key:generate`
-   Simply create a database named `personal_finance` or
-   Create a database and insert credentials inside .env file
-   `$ php artisan migrate`
-   `$ php artisan db:seed`
-   `$ php artisan serve`
-   User-email: `info@jondoe.com` and User-password: `jondoe` or click on default login button

## Schema Design

You can see the schema design from [here](https://dbdiagram.io/d/6142dfc5825b5b014604a4f8).

## Libraries, Frameworks and System

-   Accounting js for formating numbers/amounts _v0.4.2 public\vendor\js\accounting.min.js_
-   Bootstrap CSS Framework _v4.6.0 CDN_
-   Chart js _v3.5.1 CDN_
-   Font-awesome _v4.7.0 CDN_
-   jQuery JavaScript Library _v3.6.0 CDN_
-   Laravel PHP Framework _v8.61.0_
-   Particles js for snowfall effect in the login page _v2.0.0 public\vendor\js\particles.min.js with particles.settings.js and settings.json_
-   Popperjs _v2.10.1 CDN_
-   Sass to process scss _reources\sass\dev.scss_

## Font

-   Poppins _googlefonts_

## Bugs and Errors

If you discover any bugs and errors within this project, please do not hesitate to raise an [issue](https://github.com/ibishek/personal-finanace-system/issues/new/choose). All issues are corrected as soon as possible. Your simple effort could help us to make this project better. By default debuggin mode is false, however, you can change it in .env.

## Security Vulnerabilities

If you discover a security vulnerability within this project, please raise an [issue](https://github.com/ibishek/personal-finanace-system/issues/new/choose). All security vulnerabilities will be addressed as soon as possible. Your simple effort could help us to make this project more secure.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
