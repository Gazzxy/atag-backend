install:
	- php artisan migrate --seed

demo:
	- php artisan db:seed --class=DemoSeeder

unittest:
	- phpunit --testsuite=Unit
