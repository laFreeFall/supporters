## What project uses
**Backend**
- [Laravel 5.6](https://github.com/laravel/laravel)
 
**Frontend**
- [Vue.js 2.5](https://github.com/vuejs/vue)
- [axios 0.17](https://github.com/axios/axios)
- [Bulma 0.7](https://github.com/jgthms/bulma)

## Installation
Download the project
`git clone lafreefall/supporters projectname`

`cd projectname`

- Backend

1. Copy .env.example, rename to .env and fill with your environment data
`cp .env.example .env`
2. Generate app key
`php artisan key:generate`

3. Install Composer
`composer install`

4. Create database and put its name in your `.env` file

5. Create and populate database tables
`php artisan migrate --seed`

6. Host
`php artisan server` to start on [localhost:8000](http://localhost:8000/)

- Frontend

1. Go to project folder and install all the dependencies
`npm install`

2. If you want to change something and need a watcher
`npm run watch`

3. If you need to bundle final file
`npm run build`

## Short brief about project entities and features

 - **Campaign** - a page which may be created by a user for describing it's product (it may be a company with a lot of employees or a single person): it's title/name, what it does, what content it creates and how and why it may be useful for people.
 - **Follower** - a person, who has followed a Campaign. Following is a free feature for users and allow them to get notified about new Campaign actions and see all the stuff related to followed Campaigns in the personal feed.
 - **Pledge** - type of a paid subscription to a Campaign. Contains amount of fee and features which person gets after supporting like weekly emails or monthly Skype talks or placing his name on the official website or some other benefits.
 - **Supporter** - a person who pays some amount of money on monthy basis to a campagn and receives some unique content from it.
 - Every person may subscribe to or support an unlimited amount of Campaigns.
 - Every person has it's own Profile page where their last activity displays: comments, likes, subscribes, etc.
 - Every campaign may have up to 15 pledges.
 - Every campaign has ability to create posts which may be accessible to all (or only to the followers) or only to the supporterse (and even choose which support level (pledge) it should be).
 - Markdown is available in Campaign posts and Campaign descriptions.
