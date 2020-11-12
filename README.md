# Back-end Blue flamingos internship intake

This project was created for Blueflamingos

To install run
```bash
composer update
```
Then copy the .env.example file to .env.
Make sure to fill in the API_TOKEN field!

Now run migrations
```bash
artisan migrate
```

You can now get the products
```bash
artisan products:update
```
The installation is now complete. To start the API run
```bash
artisan serve
```

