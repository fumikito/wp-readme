# WP-README

Generate readme.txt from GitHub's README.md

[![Build Status](https://travis-ci.org/fumikito/wp-readme.svg?branch=master)](https://travis-ci.org/fumikito/wp-readme)

## Concept

Many WordPress plugin developers host their code on GitHub.
But [WordPress' official repository](https://wordpress.org/plugins/) hosts plugin file in SVN repos.

Readme | WordPress | GitHub
-------|-----------|----
File Extension|.txt|.md
Format|[Markdown](https://daringfireball.net/projects/markdown/)|[GitHub Markdown](https://guides.github.com/features/mastering-markdown/)

They are almost same, but little bit different.

This small PHP scripts converts Github's `README.md` to WordPress `readme.txt`.
You don't have to maintain 2 almost same text files.

## How To Use

Just grab and run PHP.

```
curl -L https://raw.githubusercontent.com/fumikito/wp-readme/master/wp-readme.php | php
```

Anoying? But best practice is automated deploy.
For example, you can run it with [travis2wpplugin](https://github.com/miya0001/travis2wpplugin).
Put script above in `bin.sh`. For example, see [HameSlack](https://github.com/hametuha/hameslack).

## Advanced Usage

### Control Visiblity

Surronding with special html comment, you can control visibility of section.

```
<!-- only:github/ -->
This section is visible only on github and will be removed from readme.txt.
<!-- /only:github -->
```

```
<!-- only:wp>
This section is visible only on WordPress.org because it's comment outed.
Be careful with comment format.
</only:wp -->
```

If you convert 1 repo to multiple delivery type(e.g. deliver the light version on WorgPress.org and the pro version on your site), you can use enviroment variable `WP_README_ENV`.

```
<!-- only:production>
This section will be revealed only if the enviroment is 'production'.
</only:production -->
<!-- not:production/ -->
This text should be removed if the environment is 'production'
<!-- /not:production -->
```

In command line, export variable and run this script.

```
export WP_README_ENV=production
curl -L https://raw.githubusercontent.com/fumikito/wp-readme/master/wp-readme.php | php
```

## Contribution

If you find bugs, plase make [issues](https://github.com/fumikito/wp-readme/issues). Any pull requests are welcomed.
