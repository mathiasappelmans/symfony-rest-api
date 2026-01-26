https://www.youtube.com/watch?v=Cd_9K749KfY


- composer install
- open docker desktop
- docker compose up -d
- in vscode, create a database connection mysql with credentials from .env file 
- php bin/console make:migration
- php bin/console doctrine:migrations:migrate
- php bin/console doctrine:fixtures:load
- php -S localhost:8000 -t public
- open in browser http://localhost:8000
- install Bruno (PostMan like tool)