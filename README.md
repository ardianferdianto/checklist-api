# checklist-api

```composer install```

generate key

```php artisan key:generate```

use the value inside ```APP_KEY``` as our Authorizations header

Example header:

```json
Authorization:key:base64:FNR+ZqgvdID1Bp87wIOy9MIkZK6OaO26I3gzziTIWTM=
Content-Type:application/json
```
