# CSIS 3280 - Web Based Scripting Project

This is a web application developed for CSIS-3280 Web Based Scripting offered by Douglas College. The application uses TMDB as its 3rd party database for fetching movie details. Users can search movies, and add the movies they have watched to their personal lists with the date watched, rating and comments. Users can then filter their own watched movies by year, director etc. They can also add remove and modify important scenes (Basically take notes about certain scenes), and even add screenshots of these images. 

## Dependencies
1. Composer
2. Xampp
3. MySQL
4. PHP

## Installation
1. The database needs to be created, make sure MySQL is installed and running. On the terminal type "mysql -u root -p", then type "create database project;" to create  the project.
2. Make sure composer is installed. Inside the project file run "composer install" to get the vendor folder back inside the project.
3. Run "php artisan migrate" so the required database tables are created.
4. Run "npm install"
5. Run "npm run build"
6. You are ready to run the app, type "php artisan serve" to run the application. Copy the address that was outputted in the terminal to your browser and enjoy.

## How to Use
1. To view the movies you have watched click on my list
2. Home page shows the movies that are currently playing on cinemas
3. You can search for a movie using the search bar
4. After searching for a movie, if you are unable to see the movie you are looking for, you can use the movies TMDB ID to make a more detailed search (The app only shows the top 20 movies, so it is possible to not find the movie you are looking for. In that case go on TMDB, search again, and make a note of the ID)
5. Once you find the movie you are looking for, you can add that movie to your own list, but you need to provide a date watched. You can also provide a rating out of 10 and any comments.
6. The movies that you add will appear in 'My List', you can delete or edit these movies.
7. php artisan route:list to see all routes

#### To Do
1. Change all links to route() for cleaner code

## ngrok serve
php artisan serve
open ngrok.exe
ngrok http 8000