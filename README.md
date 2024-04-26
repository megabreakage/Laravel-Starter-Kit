# SMARTSTAY AIRBNB HOMES INSTALLATION INSTRUCTIONS

## [SMARTSTAY AIRBNB HOMES](https://smartstay.co.ke)

A Home Away From Home!

SmartStay Airbnb’s Homes is a collection of perfect, tranquil and modern Airbnb’s with stunning views. Having enough room for as many friends and family members to come along on your adventures as possible makes for an excellent vacation rental, and our homes are able to achieve that by providing enough room for many guests. Our homes aims to make it easy to choose the best Airbnb vacation rentals in Kenya for your next trip to this part of the world.

---

## Installation

-   Built on Laravel, VueJs, JavaScript, CSS3 & HTML5 technologies,
-   And sits on MYSQL Database.

### a. Pre-requisites

For a complete and successful installation ensure your machine is ready with the following applications. You can find the installation processes for all environments (Windows, Linux & MacOs) from online documentation.

1. Local instance of Apache/NGNIX server
2. PHP version 8.1.\* or later
3. Composer 2.6.\* or later
4. NPM 8.19.\* or later
5. MYSQL instance
6. Laravel 10.1\* or later

### b. Installation Steps

Follow the steps below to successfully intall the application.

1. Clone project repository _(make sure you have the right permissions)_ ,

    `git clone git@bitbucket.org:i-o-sync/smartstay-airbnb-homes.git`

2. Create a new git branch from master using this command

    `git checkout -b Dev`

3. Install Composer & Node dependencies by running the following commands on your terminal,
   `composer install`

    `npm install`

4. Run the following command on your terminal to prepare for installations,

    `php artisan key:generate`

    `php artisan storage:link`

    `php artisan config:clear`

    `php artisan migrate --seed`

5. Create a Database on your local/remote/ server or machine and call it **smart_stay**,
6. Open your `.env` file and use the credentials used in creating your database to update; **DATABASE_USERNAME**, **DATABASE_PASSWORD** & **DATABASE_NAME** . Remember to Save the `.env` file,
7. Remember to always save and commit your changes; however, small they are: The smaller the better!
8. Start your application by running the following commands on your terminal,

    - Open terminal one on your VS Code and run this command: `php artisan serve`
    - Open another terminal or split terminal one and run this command: `npm run dev`

9. Access your application via the IP generated e.g [127.0.0.1:8000](127.0.0.1:8000) or [localhost:8000](localhost:8000) or the URL assigned to your application e.g [https://airduka.com](https://smartstay.co.ke).
   \
   ENJOY!!

---

You are welcome.
\
Best Regards,

**i/O Sync Dev Team.**
