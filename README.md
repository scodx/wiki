# wiki
Provides a form where you can search for the top 10 finds giving a query term. You can access the form at `/wiki`, you can also append the term to the url like: `/wiki/italy`

## Steps and explanation

### 1. Loads a page at /wiki which explains what this page does.

This is done via routes in [wiki.routing.yml](/wiki.routing.yml)

### 2. The page should include a 'Search' form field.

A form is created at [src/Form/SearchForm.php](src/Form/SearchForm.php) and a route pointing to that route

### 3. A user can either enter a value in the form field or provide a url parameter (/wiki/[parameter]).

The search process is being done by consuming the [Wikipedia public API](https://www.mediawiki.org/wiki/API:Opensearch), this is a simple GET request to a endpoint that returns some json data

### 4. If a URL parameter is provided then the page displays wikipedia articles containing the parameter in the title.

and

### 5. If no parameter is provided, then the page displays wikipedia articles for the term provided in the 'Search' form field.

The search process is in a service created at [src/Services/Search.php](src/Services/Search.php). When `/Wiki` is displayed, it calls the form, if a term is entered it redirects to `/wiki/[term]` that does the search.

### 6. The page should display the term that is being searched.

and

### 7. Search results should include the Title, a link to the article, and the extract for the article.

The markup is being done at [templates/wiki.html.twig](templates/wiki.html.twig)


## Installation

This is not a contrib module so you will not find it at the drupal site nor install trough composer. You must download it and install it manually.

## Limitations

The search only returns the top 10 results, so there is no pagination in place.
