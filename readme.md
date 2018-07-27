## What project uses
**Backend**
- [Laravel 5.6](https://github.com/laravel/laravel)
 
**Frontend**
- [Vue.js 2.5](https://github.com/vuejs/vue) *(for tiny page components requiring some kind of interaction)*
- [axios 0.17](https://github.com/axios/axios) *(for handling ajax requests)*
- [Bulma 0.7](https://github.com/jgthms/bulma) *(for fast and beauty design prototyping)*
- [vue-snotify](https://github.com/artemsky/vue-snotify) *(for toasts/notifications)*

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
 
 ### Campaign's Front Page
 ![Campaign front page](https://i.imgur.com/cvTvTYj.png)
 Front page of the Campaign where main information is displayed:
 - Title, its type and category
 - Amount of followers, supporters and other stats
 - Description with markdown
 - Goals (display one that's currently uncompleted)
 - Pledges
 
  ### Campaign's Feed Page
 ![Campaign feed page](https://i.imgur.com/EXjowfx.png)
 Feed page of the Campaign where all its posts are stored.
 It's assumed that campaign should deliver some content to its audience. One way to do it is to create posts which also supports markdown.
 On the right side you may see two blocks. First one contains all the tags used by the campaign. If some of they have been attached to the posts, number on the right of the tag pills are displayed. Block below is for groupping data about posts by time gaps (months in this case). You may see how much posts have been posted during each month.
 Owner of the campaign can flexibly set up a privacy level for a post: from most unsecure (everyone who visits the page, even unathencited user may see the page) to the secure one (only the user who paid some amount of money (supported via some pledge) may see the content of the post)
 Posts may be discussed via coments and liked by users.
 
   ### Campaign's Feed Page
 ![Campaign feed page](https://i.imgur.com/0stRQqx.png)
 Here few new posts have been added. Last one (in the bottom) is public and available for everyone, the second is available for the followers and the first one is available only for the supportes with "Middle supporter" pledge or higher.
 Because our authenticated user hasn't neither supported or follower the campaign, it can't see the content of the first two posts.
 
   ### Campaign's Posts Markdown Support
 ![Campaign post markdown support](https://i.imgur.com/MZoCjvp.png)
 When adding the post to the campaign feed you encounter with Body textarea with two tabs. The first one, loaded by default, is source code of the post (you may see it in the top left corner of the image). You may right there simple text, nobody forces you to use this hard and unclear at the first sight syntax. But if you are already familiar with it or want to customize / format your message a bit - you're welcome. You may switch to the second Preview tab (top right corner) to immediately see how your markdown code will be parsed and displayed while outputting. Final result of storing this post is displayed below.
 
   ### Campaign's Community Page
 ![Campaign community page](https://i.imgur.com/R4v7MZG.png)
 Community page is created as a place where audience of the campaign may freely speak, share its thoughts and was developed as a place where owner of the campaign may gather feedback.
 Also, because it's a place where a lot of people write some stuff, I've implemented reply functionality. If you reply to a user, your comment will be displayed right under it. I decided to implement it on my own just to practice. Of course in real heavy project I would prefer to use some kind of open-source library for this purpose, like [this one](https://github.com/lazychaser/laravel-nestedset).
 
   ### Campaign's Goals Page
 ![Campaign goals page](https://i.imgur.com/aFIrm3M.png)
 As an example of secondary pages here is the page of the campaign's goals. If you as a visitor want to see all the goals at once or if you as a campaign owner want to edit some of them, you should go here. Similar page exists for pledges managing and other entities.
 
   ### User Profile Page
 ![User Profile Page](https://i.imgur.com/K0DLaS7.png)
 Most of your stats and digital footprints are stored and displayed on your profile page. Here you may see some brief statistics and detailed last activity below. Almost each public actions performed by a user is tracked by implemented RecordsActivity system and displays in this activity feed with individual template for each one.
