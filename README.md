# How to set up and install
This application uses Laravel and Mysql, make sure you do the regular process of `composer update` whenever you're gonna work on it
or `composer install` if It's the first time you're using. Also don't forget to run `php artisan migrate` to execute the migrations.

# Instructions
You should use the `url` query string to send the URL you want to shorten, you must access the index of the 
application as such: http://localhost/?url=www.google.com.br. It should return a JSON and the shorten URL on it.

By accessing http://localhost/urls/top it will return the top 100 most accessed URLs.

# Challenges
- **Treatment of the URL**, this is a data which can be valid in multiple ways: with http, https, www, .me, .com, .us and so many more -
 therefore It's troublesome to know exactly what data to expect and to treat accordingly. My decision to this problem was to
  validate only the necessary and let the room for improvements. 
- **The hash of the shortened URL**, the code I used to generate the hash currently doesn't grant    
It will be unique. Not only that but It has 13 characters of size, with the usage of a different hash function we could 
  reduce this to 7~8 characters at least but a more complex algorith is necessary to do all this work.

# Future improvements
- Make a middleware to sanitize and add a layer of security over the url param (I have a feeling as It's now, It won't pass in the pentest tools);
- Use custom exceptions for the errors;
- Improve the generation of hash in order to shorten even more the URL;
- Redact the data return since we probably won't be using timestamps on that and so this is an irrelevant data;
