<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Limitless Laravel Template

Limitless Laravel Template is a Laravel project combined with Limitless template for ease of use and efficiency.

# USED TEMPLATE
    https://demo.interface.club/limitless/demo/template/html/layout_1/full/index.html

# REQUIREMENTS:
    PHP V8
    LARAVEL 9
    COMPOSER V2

# DEMO SERVER
    URL: https://demowebsite7.net/limitless-laravel-template/login
    https://gator2127.hostgator.com:2083/
    Username: demoweb4
    Password: Oks8iwkfoihKnwh6
    IP Address: 162.144.5.78
    Nameserver 1: ns4253.hostgator.com
    Nameserver 2: ns4254.hostgator.com

# How to use in REAL PROJECT
    
    create new `Private` repository
    https://github.com/organizations/Sytian-Productions/repositories/new

    copy paste this whole project and rename folder to new project name (e.g. outback)

    open a terminal then type the project's root directory and run the following:
    
    `git remote set-url origin https://github.com/Sytian-Productions/{project name}.git` 
    `git branch -M main`
    `git push -u origin main`

    git config remote.origin.push HEAD

    create new branch for dev
    `git checkout -b dev-{developer name}`

    `git push --set-upstream origin dev-{developer name}`

    `npm install`
    `npm run dev`
    `npm run watch`
    `npm run prod`

# Initial Data
    run `php artisan migrate`
    run `php artisan db:seed`
    run `php artisan db:seed` --class={Seeder Class name} // for specific seeders

# Cross-site Scripting Prevention
    every time na gagawa ng new route, always implement the `XSS` middleware, https://prnt.sc/HtWfK7dijGIW

# Timezone
    make sure that the timezone is set to `Asia/Manila` in `config/app.php`

# Emails

    DEMOSERVER MAILER

    laravel-template@demowebsite7.net
    [{W-SYP3p;oM

    sample-temp@demowebsite7.net
    nz^MC9Px}!u!

    for testing purposes, create and account in mailtrap (https://mailtrap.io/signin) and use the created credentials to .env file:

    MAIL_MAILER=smtp
    MAIL_HOST=mail.demowebsite7.net
    MAIL_PORT=587
    MAIL_USERNAME="yourmailtrapusername" (e.g. b401929a4c1d4b)
    MAIL_PASSWORD="yourmailtrappassword" (e.g. 7a507c3a2a9609)
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS="youremail'from'address"
    MAIL_FROM_NAME="${APP_NAME}"

# SYMBOLIC LINKS
    ln -s /home3/demoweb4/credibility/storage/app/public /home3/demoweb4/public_html/credibility/storage

==== CODE LEVEL ====
# PAGINATIONS
    If existing query is straight forward, use `Model::paginate($perPage)` helper.
    But if data has been done some manipulations, use $data = `$this->paginateData($data, $request)` helper. 

==== OTHERS ====

# OTHER ENHANCEMENTS 