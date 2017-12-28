# wp-readme

Generate readme.txt from GitHub's README.md

## Concept

Many WordPress plugin developers host their code on GitHub.
But [WordPress' official repository](https://wordpress.org/plugins/) hosts
plugin file in SVN repos.

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

You can run it with [travis2wpplugin](https://github.com/miya0001/travis2wpplugin).
Put script above in `bin.sh`. For example, see [HameSlack](https://github.com/hametuha/hameslack).

## Contribution

If you find bugs, plase make [issues](https://github.com/fumikito/wp-readme/issues). Any pull requests are welcomed.
