# CSIS 3280 - Web Based Scripting Project

This is a web application developed for CSIS-3280 Web Based Scripting offered by Douglas College. The application uses TMDB as its 3rd party database for fetching movie details. Users can search movies, and add the movies they have watched to their personal lists with the date watched, rating and comments. Users can then filter their own watched movies by year, director etc. They can also add remove and modify important scenes (Basically take notes about certain scenes), and even add screenshots of these images. 

## Dependencies
1. Composer
2. Xampp
3. MySQL
4. PHP

## Installation
1. Make sure Xampp mysql is running
2. Make sure composer is installed. Inside the project file run "composer install" to get the vendor folder back inside the project.
3. Run "php artisan migrate" so the required database tables are created. If it asks to create database answer "yes"
4. Run "npm install" to install node_modules
5. Run "npm run build"
6. You are ready to run the app, type "php artisan serve" to run the application. Copy the address that was outputted in the terminal to your browser and enjoy.

## How to Use
Detailed User Manual Can be found under the docs folder, along with quickstart instructions to get some data into the database, demo files for importing and scene screenshots, UML diagram and video link to a video presentation that goes through the features of the application.

1. To view the movies you have watched click on my list
2. Home page shows the movies that are currently playing on cinemas
3. You can search for a movie using the search bar
4. After searching for a movie, if you are unable to see the movie you are looking for, you can use the movies TMDB ID to make a more detailed search (The app only shows the top 20 movies, so it is possible to not find the movie you are looking for. In that case go on TMDB, search again, and make a note of the ID)
5. Once you find the movie you are looking for, you can add that movie to your own list, but you need to provide a date watched. You can also provide a rating out of 10 and any comments.
6. The movies that you add will appear in 'My List', you can delete or edit these movies.
7. Added movies can be filtered by watch date, release date and director, or a combination of all.
8. Scenes can be added, edited, deleted. Images can be added to scenes but they have to be 50KB or less.
9. From Settings, a CSV file of movies can be imported. The format has to be as follows:
YYYY-MM-DD, Title, (True/False) watched in Cinemas?, (True/False) watched with friends?
10. Can login or register in order to access most features. Logged in users can delete their account through settings.
11. php artisan route:list to see all routes

## ngrok serve

php artisan serve
open ngrok.exe
ngrok http 8000

## ToDo
1. Optimize site for mobile
2. Image thumbnailing for scenes to allow users to upload images larger than 50KB