# SekaiBit Search

Website to search businesses that accepts bitcoin

## Local Setup
- clone the project `git clone https://github.com/connollysekai/SekaiBit.git`
- go to project directory `cd SekaiBit`
- install composer dependencies `composer install`
- install node dependencies `npm install`
- create an .env file by running `cp .env.example .env`. Add your environment variables
- generate app key `php artisan key:generate`
- run migration `php artisan migrate`
- create search index `php artisan scout:mysql-index App\\Tag` and `php artisan scout:mysql-index App\\Listing`
- run queue worker `php artisan queue:work`
- run the app `php artisan serve`

## Deploying on Laravel Forge
- setup your server and DB
- create and start a queue worker
- add these commands in the deployment script after migration command
```
php artisan scout:mysql-index App\\Tag
php artisan scout:mysql-index App\\Listing
php artisan queue:restart
```
- deploy your app

## Compiling Assets 

SekaiBit Search uses **TailwindCss** for the style. Theme colors and fonts can be updated in the **tailwind.config.js** file. It uses **Laravel Mix's** postCss function to compile css files and uses **purgecss** to remove unused styles. 

### Compiling Commands
Compiles the assets for development. No minification is used
```
npm run dev 
```
Compiles assets while watching file changes. It uses browsersync to reload browser when a file chage is detected.
```
npm run watch
```
Compiles and minifies assets for production. **Purgecss** is used to remove the unused styles
```
npm run prod
```

## Mail Notifications

The app sends a notification mail when users registers his website with his email address. Make sure to add your mailgun credentials on the .env file. Ex:
```
MAIL_MAILER=mailgun
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=65f1d65b7d9210
MAIL_PASSWORD=26edb023688a48
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=fromaddress@email.com
MAIL_FROM_NAME="${APP_NAME}"
MAIL_SUPPORT_ADDRESS=supportaddress@email.com
MAILGUN_DOMAIN=yourmailgundomain
MAILGUN_SECRET=yourmailgunseacret

```

## Fulltext Search with Scout

SekaiBit Search uses **Laravel Scout** to utilize full search functionality on the models using mysql driver. Make sure to add the option on your .env file.
```
SCOUT_DRIVER=mysql
```

## Cache & Queue

**Redis** is used for queueing tag updates and caching user search sessions. Make sure to have redis as default cache driver and queue connection. Ex:
```
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
```





