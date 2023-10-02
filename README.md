# Chuka Portal Redesign

## Introduction
The Chuka Portal, as it currently stands, leaves much to be desired in terms of user experience and technical implementation. This project aims to address these issues by redesigning the portal using modern web technologies and best practices to provide a seamless experience for its users.

## Motivation
The primary motivation behind this redesign is twofold:

1. User Interface (UI) Concerns: The current portal's UI is not up to the mark. It lacks a modern touch, is not intuitive, and can be challenging for users to navigate and use effectively.

2. Technical Shortcomings: The original tech team's implementation of the portal has been found lacking in several areas, leading to performance issues, potential security vulnerabilities, and overall poor user experience.

By rebuilding the portal, we aim to rectify these issues and provide a platform that is both aesthetically pleasing and technically sound.

## Tech-Stack
### Backend: 
Laravel - A robust PHP framework that offers a rich set of functionalities, ensuring a scalable and maintainable backend.

### Frontend:
Livewire - An elegant library for Laravel that makes building dynamic interfaces simple, without leaving the comfort of Laravel.


## Features
1. Modern UI: A complete overhaul of the user interface to make it more user-friendly, responsive, and visually appealing.

2. Enhanced Security: Implementing best practices to ensure user data is secure and the portal is protected against common web vulnerabilities.

3. Improved Performance: Optimizing both frontend and backend to ensure faster load times and smoother user interactions.

## TODO
- [ ] Intergrate the existing database
- [x] Create a new UI

## Getting Started
Clone the repository:

`git clone https://github.com/Raccoon254/chuka-portal.git chukaportal`

Navigate to the project directory:

`cd chukaportal`

Install composer dependencies:

`composer install`

Run migrations and seed the database:

`npm install`

Install npm dependencies: ie Vite

`php artisan migrate --seed`

Start the local development server:

`npm start` or [`npm run dev` and `php artisan serve`]

This will concurrently run the Laravel development server and the Webpack development server.
Visit http://localhost:8000 in your browser to access the portal.

Contribution
Contributions are welcome! Please create an issue or submit a pull request if you'd like to contribute to the project.

License
This project is licensed under the Apache License.
