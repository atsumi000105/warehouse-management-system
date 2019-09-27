# Contributing to Coverd

Thank you for showing interest in helping make this project better for all!

## Code Style

For PHP:

  * Code Style: [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
  * Name Spaces: [PSR-4](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md)
  * Static Analysis: [PHPStan](https://github.com/phpstan/phpstan)

For JavaScript:
  * eslint: [plugin:vue/recommended](https://vuejs.github.io/eslint-plugin-vue/rules/)

## Submitting Issues & Feature Requests

* You can create an issue [here](https://github.com/happybottoms/coverd/issues/new), but
  before doing that please read the notes below on debugging and submitting issues,
  and include as many details as possible with your report.
* Include any of the following that you know: the version of Coverd you are using, the version of PHP you are using, the version of Yarn you are using, the OS, and the browser (and version).
* Include any error messages you are receiving and under which conditions if this is a bug.
* Try to make fixing this issue or adding this feature easier for the next person:
  * For the application:
    * If you submit a code-update, also submit appropriate tests
    * If you don't submit a code-update, submit appropriate tests to show what you want improved
* If you cannot supply tests, please be as descriptive as possible regarding the problem to be fixed or the feature you are wanting added.

## Pull Requests

* Ensure that you are using the latest pre-release version of Coverd
* Javascript: we use [yarn](https://yarnpkg.com) and not [npm](https://www.npmjs.com/)
  * In other words, you can update [package.json](package.json) and [yarn.lock](yarn.lock) but not `package-lock.json`
* Include screenshots and animated GIFs in your pull request whenever possible.
* Follow the whitespace/newline styles suggested in the [.editorconfig](.editorconfig) file (see: [editorconfig.org](http://editorconfig.org/) for information about this file).
* Run `yarn lint --fix`, `composer lint-fix`, and `composer analyze`. Fix any problems found before submitting your pull request.

## Git Commit Messages

* Use the present tense ("Add feature" not "Added feature")
* Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
* Limit the first line to 72 characters or less
* Reference issues and pull requests liberally
* Reference: https://chris.beams.io/posts/git-commit/
