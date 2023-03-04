# DirPag (Directory Paginator)
This is a small library that helps you search and paginate results of directory content or iterables.

Let's say you want to build a web-based file manager, some folders may have thousands of files. Displaying all of them on a single page will slow down page load time. In fact, keeping all the files in memory alone might crash some servers. With this library, you can paginate the directory content, perform your operations, and get faster page load.

## Install

```shell
composer require dirpag/dirpag
```
## Usage

There are two use cases.

1. You have a directory you would like to paginate its contents.
1. You want to search for a file or folder in a directory and get the results (max depth of 1)

Before delving into each of the above, it is vital we look at the `DirPag\Result` object, which I will refer to as the `result object` from now on.

The result object contains three important pieces of information which are accessed via the following methods.

1. `->values()` : This is an array of the paged content.
2. `->last_page()` : This is the last page. This is important if you wish to display pages to the user to pick.
3. `->total_count()` : This is the total number of items in the iterable or directory.

The examples and explanations below will clear things up. Just remember that all the three major operations return a `result object`.


### PAGINATING DIRECTORY CONTENT

Here, the `DirPag\DirPag::page($path, $page_number)` static method is used.

```php
<?php

use DirPag\DirPag;

DirPag::limit(10);

$items = DirPag::page("/path/to/directory", 4);
print_r($items->values());

```

### SEARCHING A DIRECTORY AND PAGINATING THE RESULTS

Here, the `DirPag\DirPag::search($query, $path, $page_number)` static method is used. The `$query` parameter is expected to be a regular expression **(With the delimiters)**. Please note that it must be a properly crafted regular expression.

```php
<?php

<?php

use DirPag\DirPag;

DirPag::limit(10);

// Search the folder for all files or folders whose name ends with '.php' and give page 4 of the results
$search = DirPag::search("/.*\.php/", "/path/to/directory", 4);

print_r($search->values());

```


## Contact
To contact or contribute, contact the email below.

**Twitter** : [@phrenotyper](https://twitter.com/phrenotyper)

**Email** : paul.contrib@gmail.com