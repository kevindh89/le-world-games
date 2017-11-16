Le World Games
========

Just an open source project for practicing techniques and improve development skills.

[![Build Status](https://travis-ci.org/kevindh89/le-world-games.svg?branch=master)](https://travis-ci.org/kevindh89/le-world-games)

My plan is to put a live demo online somewhere in a short while.

# Project ideas

* A flag guessing game: players see a flag and get to choose the right country in multiple choice
* Extend the project with several other "world related" games like guessing the country based on a photo etc.

# Technical plans

* Setup CI with Travis and other DevOps/code quality tools
* Use a modern frontend framework like React and other fancy frontend stuff
* Use GraphQL as database
* Setup performance and error monitoring (i.e. with Blackfire.io, Airbrake, Rollbar)
* Get well known with and setup packages like Snyk (for finding security vulnerabilities)

# Setup development environment

Run a local webserver:
```
php bin/console server:run
```

The application is now available on: http://localhost:8000