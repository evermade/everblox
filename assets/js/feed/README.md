# Feed App
- The app uses React to filter, sort and paginate posts.
- Functions as a more robust alternative to the default WordPress archives.
- Filters and posts are pulled from WordPress REST API.
- Remaps posts and filters to only pull relevant information from them – make the JSON as light as possible.
- Uses hash parameters to remember state of the app.

## Relevant file locations

### JavaScript
- You're here.

### REST API
- The API endpoint hook is located in `{theme}/lib/blocks/Feed/rest-api.php`.
- Configuration data, including text content is coming through a script localization in `{theme}/functions.php`

### SCSS
- Layout styles in `{theme}/assets/scss/layouts`.
- Various card styles in `{theme}/assets/scss/components/{*}-card.scss`.
- Other component styles in `{theme}/assets/scss/components`.

## Adding new post types to the Feed
1. Add the post type identifier to the `$postTypes` array in `rest-api.php`.
2. Create the relevant card component in `./components`, e.g. `EventCard.js` for `event`.
3. Go to `./components/Results.js` and include the new card component. Also add the type identifier into the `getCardComponent` function.

## Adding new filters
In the example we are adding a "genre" custom taxonomy filter.

### Generating the filter in the REST API
1. Create a remapping function if you need to change the format of the data, e.g. `mapGenre()`. Only get the data you need to keep the JSON light!
2. Add the meta information you want to filter by into the `$myPost` object in the query, e.g. `$myPost->genre = mapGenre(...)`.
3. Generate an array of unique values of the custom taxonomy for the app filters, by adding it to the `getFiltersFromPosts` function.
4. Add the filter title into the localize script array in `functions.php`.

### Reading the filter in the App
1. Go to `./utils/useFilters.js` and add the new filter into the `selected` state object, e.g. `genres: helper.getParam(params, 'genres', 'array')`
2. While there, also add the array filtering into the `filterPosts` function.
3. If you want to store the filter's state in hash parameters, go to `./App.js` and add it to the `updateParams` function, e.g. `genres: selected.genres.join(',')`
4. Create the actual filter component into `./components/Filters`. For example a `MultiSelect` component:

```
<MultiSelect
  name="genres"
  title={config.text.genresTitle}
  options={filters.genres}
  selected={selected.genres}
/>
```

## Authors
If you need assistance with anything, come poke any of the numerous authors in the shoulder.

- Timo Sundvik