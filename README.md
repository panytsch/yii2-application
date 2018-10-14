<h3> How to install: </h3>

````
git clone https://github.com/panytsch/yii2-application

composer install 

php init

(create DB and connect to it)

php yii migrate/up

````

<h4>Get Admin login and pass:</h4>

send GET request to URL '{hostname}/admin/admin/get-new-admin'
with Authorization header key from backend params, <br>
and with email header 
<br><br>
<h4>Example:</h4>
Url: http://apka.local/admin/admin/get-new-admin <br>
Headers: <br> Authorization => HBpFX1AwzAdl473RPxWq7sjU <br>
email => email@adas.ua



