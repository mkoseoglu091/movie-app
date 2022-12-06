# User Manual

### Intro

Once you have the app up and running, this manual can help with how to use the application. If you have not set up the app yet, please refer to the README file in the root of the project.

If you have set up the application, the first thing to make a note of is, unless a user is logged in, the application only provides 3 simple features.
1. Showing the movies that are currently playing in cinemas
2. Searching for a Movie
3. Looking into the details of a movie such as its rating, budget, release date, actors and director.

Once a user logs in, several other features become available. So please click on the Register button on the navigation bar, to register a new user, or click on Login, if you already have an account registered.

### After Logging in

Once you have logged in, you will notice the navigation bar now has "My List", "Settings" and "Logout". You will be able to see all the movies that you have watched under My List. If you are a new user there will be no movies there.

Additionally, now that you are logged in, any movie that you view either through searching or from the Now Playing section, will have a sidebar, that allows you to add the movie to your list. The only field required when adding a movie is the watched date. The rest can be left empty.

All movies you add will automatically appear in My List. Inside My List, you can filter the movies that are shown by release date, watched date, director, or a combination of all 3. Release and watch dates are concrete limits, but the name of a director can be fuzzy, so if multiple director names match your key word, all directors that match are displayed, with an option to filter further.

### My List

Under My List, you can click on the details of movies, but unlike the details of movies that weren't in your list, this time you can see your rating, your comments and the date you watched the movie as well. You can also delete and edit this movie.

The Saved Scenes button takes you to a list of saved scenes for this particular movie. If you haven't saved any scenes yet, this list will be empty. You can add new scenes by typing the timestamp of the scene, but you have to manually provide a screenshot. The screenshot has to be 50KB or less, or if no screenshot is provided, a generic image is placed. Scenes can be edited or removed.

### Settings

Under settings, you have the option to either delete the user entirely, which also removes the movies and scenes associated with that user from the database, or you can choose to import movie data from a CSV file.

The CSV file in question must have the provided format:
Date (YYYY-MM-DD), String (Title), Bool (Watched in Cinemas), Bool (Watched Alone)

Any movie that could not be found will be listed in the message once the import is complete. This process may take a while, so please be patient. This is due to the app making API calls for every single line, and adding the details to the database.

Once the import is complete, and you see the success message, you will be able to see the movies added to My List. Since the CSV does not have a field for rating, all imported movies will have a default rating of 5. This can be edited through My List.

Finally you can log out to go back to the guest view of the appliation.

### Quickstart

Demo User:
email: demo@user.com
pass: 12341234

To quickly check out some of the features, please follow these steps:
1. mysql -u [user] -p movie_app < sql/quickstart.sql (this file can be found in docs, in the sql folder and in the root of the project.)
2. Log in using the demo user above
3. To test out the import feature, use the importTest.csv found in docs/demoFiles
4. To test adding  scenes, use the scene images Scene-1, Scene-2 and Scene-3 under docs/demoFiles