# How to use Laravel 8 (For a quick building new web application framework)

- Please download & install composer in your computer
- Please download & install Git in your computer

## Step to deploy this repo to localhost

- Open Git terminal by right-click to current repo folder and choose *Git Bash here*
- First, clone this repo in CLI:

```
git clone https://github.com/haikal-dev/iot-health-system.git iot-project
```

- Go to 'iot-project' directory

- Copy '.env.example' & paste as '.env' in same directory

- Second, update composer by CLI:

```
composer update
```

- Generate application key by CLI

```
php artisan key:generate
```

- Import SQL file to your MySQL Server Database

- Edit your Telegram ID and Telegram Bot Secret Key in your .env file

- Last, deploy staging server using CLI: 

```
php artisan serve
```

- Your staging server should be run on http://localhost:8000
