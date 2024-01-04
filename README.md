### Introduction
---
The BULK SMS For Eliana-Connect


### Setup
---
Clone the repo and follow below steps.
1. Run `composer update`
2. Copy `.env.example` to `.env`
3. Set valid database credentials of env variables `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`
4. In the same `.env` ON `BULK_SMS_TOKEN` add the Bulk SMS API KEY there  
5. Run `php artisan key:generate` to generate application key
6. Run `php artisan migrate --seed`

The super admin credentials are:
1. `email:admin@econnect.com`
2. `password: test1234`  

