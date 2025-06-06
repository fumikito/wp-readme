# WP-README

Convert a GitHub README.md into a WordPress plugin readme.txt

## Concept

Many WordPress plugin developers host their code on GitHub.
But [WordPress' official repository](https://wordpress.org/plugins/) hosts plugin file in SVN repos.

Readme | WordPress | GitHub
-------|-----------|----
File Extension|.txt|.md
Format|[Markdown](https://daringfireball.net/projects/markdown/)|[GitHub Markdown](https://guides.github.com/features/mastering-markdown/)

They are almost same, but little bit different.

This small PHP script converts GitHub’s `README.md` into a WordPress `readme.txt` file.
This allows you to maintain a single source of documentation for both GitHub and WordPress.org, eliminating the need to manage two separate files.

## Usage

Just grab and run PHP.

```
curl -L https://raw.githubusercontent.com/fumikito/wp-readme/master/wp-readme.php | php
```

Annoying? But the best practice is automated deployment.
For example, you can run it with GitHub Actions.
Fortunately, there is [a GitHub Action](https://github.com/tarosky/workflows/blob/main/actions/wp-readme/action.yml) to run this script!

```yml
jobs:
  release:
    steps:
      - name: Generate readme.txt
        uses: tarosky/workflows/actions/wp-readme@main
```

Or put the script above in `bin.sh` manually. For example, see [HameSlack]([https://github.com/hametuha/hameslack/blob/df443230683295ac2d72b224c17463f01f657929/bin/build.sh#L25-L27)).

## Advanced Usage

### Control Visiblity

By surrounding sections with special HTML comments, you can control their visibility.

```
<!-- only:github/ -->
This section is visible only on github and will be removed from readme.txt.
<!-- /only:github -->
```

```
<!-- only:wp>
This section is visible only on WordPress.org because it's commented out.
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
