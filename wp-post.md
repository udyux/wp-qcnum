#

The development of a proper website, by today's standards, is akin to the development process for a car. Things can be split into two main fields. Allow me to demonstrate:
- You're going to need engineers who can take care of the bits that actually make it a car. They'll be taking care of the engine, brakes, steering, etc. These are our backend developers, the ones who get things moving.

- You're also going to need people who will make it look good but also ensure the aerodynamics are just right as to not hinder performance. The cabin must be sleek without compromising usability. These are the frontend developers.

### It takes two to tango
We're long past the days delivering static files to clients. People expect a CMS these days, a job for the engineers.

But what if you're like me, someone who indulges in gratuitous Internet Explorer bashing and spends his time wondering why the z-index isn't doing what it should? In other words, what if you're a frontend developer and you've taken on a project alone?

This is a situation I faced recently when completing a project as an intern for a local non-profit. I was give some guidelines for a design and was asked to renew their website administered on WordPress. I knew my way around PHP sufficiently, but backend logic is just not my thing.

In this post, I hope to lend a helping hand to those of you who are faced with a similar situation. I'll share with you the snippets and logic that helped me shape a simplified and reusable WordPress starter theme that can speed up your development process and let you worry about what you do best: the frontend.

### Like it or not
WordPress is a big player in the CMS game with a lot of opinions around it. It's not perfect but your clients are familiar with it and there are some great features in all that code.

##### cons
- Security comes up often when discussing WordPress. It is known to have quite a few vulnerabilities, but this is in part due to popularity.
- It isn't the most flexible in terms of workflow and the codebase is quite abstracted, making it difficult to understand what's going on under the hood at times.
- It's a big, heavy machine for somewhat simple tasks. It seems to suffer from the same weaknesses as most of the themes you can buy: it tries to do too much, making it overly complex.
- This one is more subjective. The procedural style PHP of the codebase feels a bit old fashioned and the silly abstractions like `the_loop` simply don't click with me.

##### pros
- Clients know and trust WordPress. Whether or not they're right isn't that important, they're paying the bill.
- There's a ton of StackOverflow threads out there for when you're confused and the official WordPress documentation is beginner friendly and useful (I'm looking at you, PHP).
- There are many well developed built-in features that will make your life a whole lot easier.
- Once you get your head around it and have an appropriate toolbox set up, you can develop a new theme from the ground up incredibly quickly.

### Start your engines
Let me start by saying this: *you don't always have to do it the WordPress way*.

If you know what you're doing, dig in a little and make things work the way you want them to. I like to keep my files segregated based on their roles. WordPress' standard routing is very opinionated on how you should structure your project but you don't always have to abide by their rules.

Here's what my starter theme's root folder looks like. Take note that this structure may not by valid for some marketplaces.

```
ROOT/
├── fonts/
├── images/
├── inc/
│   ├── custom-functions.php
│   ├── default-pages.php
│   ├── enqueue-assets.php
│   ├── option-pages.php
│   ├── post-types.php
│   └── theme-settings.php
├── js/
│   ├── page-specific.js
│   └── site.js
├── layouts/
│   ├── 404.php
│   ├── page.php
│   ├── archive.php
│   ├── post.php
│   ├── footer.php
│   ├── header.php
│   ├── home.php
│   └── partials/
│       ├── archive-nav.php
│       ├── form-search.php
│       ├── main-footer.php
│       ├── main-header.php
│       └── main-nav.php
├── admin-style.css
├── functions.php
├── index.php *
├── screenshot.png
└── style.css *
```
*Required files are marked with a **

As for plugins, I highly recommend Admin Menu Editor and the very powerful Advanced Custom Fields, both of which are free and offer a pro version with added features. More on these two later.


### Under the hood
Let's take a look at whats going on:
- `functions.php` is the engine of your theme. WordPress automatically finds this file and runs it on startup. In my case, it's just a collection of `require` statements pointing to the `inc/` folder. These are the parts in your engine.
  - `inc/custom-functions.php` holds all your custom functions for use in the layouts and partials.
  - `inc/default-pages.php` defines and automatically creates any pages that should exist by default on your client's site.
  - 'inc/enqueue-assets.php' takes care of enqueuing scripts and stylesheets.
  - 'inc/option-pages.php' defines any additional option pages through Advanced Custom Fields' API.
  - 'inc/post-types.php' defines any custom post-types you want to use in your project.
  - 'inc/theme-settings.php' determines global WordPress settings for your theme.

- `index.php` is the steering wheel. It receives all traffic and points it to the right layout model.

- `style.css` is, naturally, the main stylesheet.

You simply can't get around the WordPress required root level files `index.php` and `style.css`.

##### Routing
I've set up a custom routing/rendering function that will make it easy to structure things just the way you like. Take note that I've prefixed the function names with my theme's name to avoid any future collisions with plugin functions.

```
/* routing */

function _udyux_get_layout() {
  $path = get_template_directory() . '/layouts';

  $pages = array(
    'home'    => is_front_page(),
    'article' => get_post_type() === 'article' && is_single(),
    'about'   => is_page_template('layouts/about.php'),
    'archive' => is_archive() || is_search()
  );

  // default to 404
  $page = '404';
  foreach ($pages as $this_page => $is) {
    if ($is) {
      $page = $this_page;
      break;
    }
  }

  // render
  require "{$path}/header.php";
  require "{$path}/{$page}.php";
  require "{$path}/footer.php";
}
```
There are two things you need to control here.

First is `$pages` array. You can use the [built-in conditional tags](https://codex.wordpress.org/Conditional_Tags) to check which page you need to load. The array's keys should represent the name of the template file to load.
*Sidenote, I've used the archive format for search results here.*

Then, if you decide to put your templates/views/partials (whatever you like to call them) elsewhere than `./layouts/` you need to change the path in `$path`.

Then use the following function to call shared partials within your template.

```
/* get partial */

function _udyux_get_partial($type, $name) {
  $path = get_template_directory() . '/layouts/partials';
  require "{$path}/{$type}-{$name}.php";
}
```

##### Settings
Here are a few useful snippets I found along the way to change some of WordPress' default settings.

######
