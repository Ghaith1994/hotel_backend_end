<h1>Hotel Review App</h1>

# Tech-stack
- PHP 7.4 or higher
- Symfony 5
- Doctrine
- Mysql RDMS

# To Run The Project Local
<ol>
<li>
Install the required packages
    by running command 'composer install' in root project directory</li>
<li>
Edit .env file with <br> 
a- Database connection string <br>
b- Front end server ip that use in cros allow orgin
</li>

<li>
Create the database by running the command <br>
'php bin/console doctrine:database:create --if-not-exists' 
</li>

<li>
Migrate the database by running the command <br>
'php bin/console doctrine:schema:update --force' 
</li>

<li>
Migrate the database by running the command <br>
'php bin/console doctrine:schema:update --force' 
</li>

<li>
Fill the database by random data by running the following command
'php bin/console doctrine:fixtures:load --purge-with-truncate'
</li>
</ol>


# To Test The Project Local
<ol>
<li>
Install the required packages
    by running command 'composer install' in root project directory</li>
<li>
Edit .env.test.local file with <br> 
a- Database connection string <br>
b- Front end server ip that use in cros allow orgin
</li>

<li>
Create the database by running the command <br>
'php bin/console --env=test doctrine:database:create --if-not-exists' 
</li>

<li>
Migrate the database by running the command <br>
'php bin/console --env=test doctrine:schema:update --force' 
</li>

<li>
Migrate the database by running the command <br>
'php bin/console --env=test doctrine:schema:update --force' 
</li>

<li>
Fill the database by random data by running the following command
'php bin/console --env=test doctrine:fixtures:load --purge-with-truncate'
</li>

<li>
run the unit test by running the command <br>
"vendor/bin/phpunit"
</li>
</ol>

# API
<ol>
<li>
{backendServerIp}:{backendServerPort}/hotel
</li>
<li>
{backendServerIp}:{backendServerPort}/hotel/{hotelId}/hotel-reviews
</li>
</ol>

