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
Headers: <br> Authorization => ZmcrZVBDT09pZE0vK1JhRENMWFdpUHRoL2hsaVZuN3I3WlQ1M2FpODRZN1E4Z1ZQdk1aYVdnZHNDRVNNZ0hMYnRiaGFON3F4T21oVGlNYWo0N3BZUEZwUHRkTVd5ampYUXE2VWVBS0FoVnM9 <br>
email => email@adas.ua

<br>
<br>

<h2> Apache </h2>

<br>
<br>

Config your server to root project directory. .htaccess files worked here ^_^
<br>
Admin panel will be accessed with route '{host}/admin'
<br>
