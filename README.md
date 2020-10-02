<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1.0.0-blue.svg?cacheSeconds=2592000" />
  <a href="https://github.com/WiseCoding/sql-guestbook/blob/master/LICENSE" target="_blank">
    <img alt="License: MIT" src="https://img.shields.io/github/license/WiseCoding/sql-guestbook" />
  </a>
</p>

# SQL Guest Book 📖

## 🌐 [Live](https://sql-guestbook-mattias.herokuapp.com/)

## 🏠 [Repo](https://github.com/WiseCoding/sql-guestbook#readme)

## Local

> Want to test the app locally?

- Create a database called `php_guestbook` on your `localhost`.
- Create the table `posts`...

```sql
CREATE TABLE posts(
  id INT NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  content varchar(10000) NOT NULL,
  author varchar(50) NOT NULL,
  date varchar(10) NOT NULL,
  PRIMARY KEY(id)
);
```

- `npm i` to install all npm dependencies.
- `php composer.phar install` to install all composer dependencies.
- All set 🥳.

# Assignment 📝

> **UPDATE**, now that we stored our entries in a file in the [previous exercise](https://github.com/WiseCoding/php-guestbook), let's connect and store the entries in a database instead.

> Let's make a guestbook in PHP. Every visitor of your page can leave a message that is then saved. Messages are then showed (last message on top) for everybody who visits the page.
> Make sure to deploy the site before 17:00 o'clock on Heroku and publish the URL on our usual exercises spreadsheet!

> [Solo Assignment](https://github.com/becodeorg/gnt-yu-3-21/tree/master/3.The-Mountain/6.About-databases) by [BeCode](https://becode.org/) 🎓

## _Must-have features_

- Posts must have the following attributes:
  - Title
  - Date
  - Content
  - Author name
  - Use at least 2 classes: Post & PostLoader
  - The messages are sorted from new (top) to old (bottom).
  - Make sure the script can handle site defacement attacks: use htmlspecialchars()
  - Only show the latest 20 posts.

## _Nice-to-have features_

- Profanity filter: at the top of your script create an array of "bad" words. If somebody tries to enter a message with on of those words, their messages gets rejected.
- When the user enters uses a "smiley" like ":-)", ";-)", ":-(" replace it with an image of such a smiley.
- Have an input field where the user can enter how many messages he wants to see displayed.

# The Team 👥

- [👨🏼‍💻Mattias](https://github.com/WiseCoding/)

# Built with 🛠

- [Visual Studio Code](https://code.visualstudio.com/)
- [Markdown](https://www.markdownguide.org/)
- [Tailwind](https://tailwindcss.com/)
- [PHP](https://www.php.net/)
- [MariaDB](https://mariadb.org/)

# License 📎

Copyright © 2020 [Mattias](https://github.com/WiseCoding).<br />
This project is [MIT](https://github.com/WiseCoding/sql-guestbook/blob/master/LICENSE) licensed.
