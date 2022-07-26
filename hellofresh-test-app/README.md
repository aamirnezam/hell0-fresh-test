<!--
*** Thanks for checking out this README Template. If you have a suggestion that would
*** make this better, please fork the repo and create a pull request or simply open
*** an issue with the tag "enhancement".
*** Thanks again! Now go create something AMAZING! :D
-->
# HelloFresh-Test-Documentation

<!-- PROJECT Name -->
<p align="center">
  <h3 align="center">This is a part of HelloFresh Test, submitted by Aamir Nezam.</h3>
</p>

<!-- TABLE OF CONTENTS -->

## Table of Contents

- [About the Project](#about-the-project)
  - [Built With](#built-with)
- [Personas](#personas)
- [Usage Scenarios](#usage-scenario)
- [Paper Prototype](#paper-prototype)
- [Usability Test Results](#usability-test-results)
- [Features](#features)
- [High-Level Architecture](#high-level-architecture)
- [Technical Research](#technical-research)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
- [Usage](#usage)
- [Acknowledgements](#acknowledgements)

<!-- ABOUT THE PROJECT -->

## About The Project

![RE/ACTION poster]()

The application process automatically generated given JSON file with recipe data and calulcated some stats.

### Built With

This application is build in Laravel 8 Framework (PHP).

#### Major Frameworks

- [Laravel](https://laravel.com/)
- [MongoDB](https://www.mongodb.com/)

#### Development Toolkit:

- [VS Code](https://code.visualstudio.com/) (IDE)

#### Accounts made for the nezam.aamir79@gmail.com

- [x] MongoDB - created under nezam.aamir79@gmail.com

<!-- Features list -->

## Features

- [x] Count the number of unique recipe names.
- [x] Count the number of occurences for each unique recipe name (alphabetically ordered by recipe name).
- [x] Count the number of deliveries to postcode 10120 that lie within the delivery time between 10AM and 3PM,
- [x] List the recipe names (alphabetically ordered) that contain in their name one of the following words:
Potato
Veggie
Mushroom

<!-- Personas -->

## Personas

[Personas]()

- Only person one for admin.

<!-- Usage Scenarios -->

## Usage Scenarios

[Usage Scenarios]()

- Thers are one scenarios for admin. It can run a command to view json response of a particular given file (json data);

<!-- Information Architecture -->

## Information Architecture

![Information Architecture]()

- Information Architecture to lay out the structure of Project Name.

<!-- Paper Prototype -->

## Paper Prototype

![Paper Prototype]()
- This application has been developed with a prototype data. To download data click here.

<!-- Usability Testing Documentation -->

## Usability Testing Documentation

[Usability Testing Documentation]()

- Usability Testing Documentation folder contains 'Test Plan' and 'Test Script'

<!-- Usability Test Results -->

## Usability Test Results

[Usability Test Results]()

- When you run php artisan  fixtures_data:response the system will generate a json formatted data with recipe data and calculated some stats.

<!-- High-Level Architecture -->

## High-Level Architecture

![High-Level Architecture]()

I have used MVC architecture that separates domain/application/business…logic from the rest of the user interface. It does this by separating the application into three parts: the model, the view, and the controller.

The model manages fundamental behaviors and data of the application. It can respond to requests for information, respond to instructions to change the state of its information, and even notify observers in event-driven systems when information changes. This could be a database or any number of data structures or storage systems. In short, it is the data and data-management of the application.

The view effectively provides the user interface element of the application. It’ll render data from the model into a form that is suitable for the user interface.

The controller receives user input and makes calls to model objects and the view to perform appropriate actions.

<!-- Technical Research -->

## Technical Research

[Technical Research Document]()

Technical research for ORM-like query on JSON.

<!-- Getting Started -->

## Getting Started

The following given instructions for setting up this project locally.
To get a local copy up and running follow these simple example steps.

1. Install PHP in your system.
2. Install Composer (If already installed then ignore)
3. Clone this repository.
4. Update your composer ( - composer update)
5. Now to run project locally type - php artisan serv
6. Paste a prototype json file named as "hf_test_calculation_fixtures.json" in public folder
7. Navigate to your project folder in CLI
8. To get json response type - php artisan  fixtures_data:response

### Prerequisites

## Usage

<!-- Files ROADMAP -->

## Files Roadmap

To check CLI command logic 
- app/Console/Commands/RecipeCommand.php
- app/Console/Kernel.php
- Command - php artisan fixtures_data:response

To check URL command logic 
- app/Http/Controllers/RecipeController.php
- routes/web.php
- http://localhost:8000/show_fixtures
<!-- Contact -->
## Contact

**Project Developer:** [Aamir Nezam](mailto:nezam.aamir79@gmail.com)

<!-- Acknowledgements -->
## Acknowledgements

Thank you HelloFresh for giving this task. I have learned a lot during this exercise. I am looking forward with you.
