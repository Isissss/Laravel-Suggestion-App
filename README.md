
# Suggestion App - Laravel Framework

This project was part of a (back-end) course of the University of Applied Sciences Rotterdam. It was the first time working with a framework. I built a suggestion app where users can leave comments and vote on suggestions. It also comes with various Admin features.

Live application: [https://iettech.nl/](https://iettech.nl/) (2022)
## Tech Stack

**Client:** Vanilla Javascript, Bootstrap, Blade, Vite

**Server:** Node, Laravel Framework (PHP), MySQL


## Features

- User can create, edit, delete, see other suggestions
- User must have liked or reacted to three different posts before they may post something
- User can like other suggestions
- Users can filter based on category, tags, search field and order (most popular or most recent)
- Admins can set categories to inactive (which hides it from the public) and add new ones
- Admins can manage profiles
- Admins can change the status of suggestions, which will trigger an e-mail to be sent to the user and a Trello card to be made on the configured board (user does not have to wait for this to go through, thanks to Laravel's queue system)
 
## Lessons Learned
This was my first app using a framework in general. I have learned to:
- Work with the [Laravel](https://laravel.com/) framework
- Implement basic CRUD functionalities 
- Work with controllers/models/routes
- Implement many-to-many and one-to-many relationships within the project (suggestions can have multiple tags, it is also possible to filter based on tags)
- Combine different filters at the same time (category filter, order filter and search field)
- Make AJAX calls to add functionalities like liking a post, toggling active state of a category without having to reload the page
- Work with Laravel concepts like queues, gates, policies, query scopes, storage 
- Work with an e-mail API ([MailTrap](https://mailtrap.io))
- Work with Trello / Minecraft's APIs
 
 
This was the first time I got to deploy an application and learn about CI/CD concepts. I was able to automate the deployment through GitHub Actions. This was a painful process but paid off in the end.   

## Future additions 
Due to the lack of time there are plenty of things that I was not able to implement. In the future I might want to add the following:
- Changelog of updates done
- Discord integration
- Notification center
- Badge system
 
## Screenshots

![App Screenshot](https://github.com/Isissss/Isissss/blob/main/images/Screenshot_21.png?raw=true)
![App Screenshot](https://github.com/Isissss/Isissss/blob/main/images/Screenshot_22.png?raw=true)
![App Screenshot](https://github.com/Isissss/Isissss/blob/main/images/Screenshot_20.png?raw=true)
## Run Locally

Clone the project

```bash
  git clone https://github.com/Isissss/Laravel-Suggestion-App
```

Go to the project directory

```bash
  cd my-project
```

Install dependencies

```bash
  npm install
  composer install
```

Create DB and import tables

```bash
  php artisan migrate
```

Start the server

```bash
  npm run dev
  php artisan serve
```

