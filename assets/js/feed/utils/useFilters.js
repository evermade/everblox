import { useState } from 'react';
import { helper } from './Helper';

function useFilters() {
  const params = window.location.hash;

  const [selected, setSelected] = useState({
    categories: helper.getParam(params, 'categories', 'array') || [],
    types: helper.getParam(params, 'types', 'array') || [],
    tags: helper.getParam(params, 'tags', 'array') || [],
  });

  const [query, setQuery] = useState('');

  /**
   * Filtering function that does the heavy lifting in the app.
   *
   * @param {array} allPosts - All post objects loaded from WP data
   *
   * @return {array} - Array containing the filtered posts
   */

  const filterPosts = (allPosts) => {
    const { categories, types, tags } = selected;
    let posts = [...allPosts];

    // filter by categories
    if (categories.length) {
      posts = posts.filter((post) => {
        return post.categories.some((category) => {
          return categories.includes(category.id);
        });
      });
    }

    // filter by types
    if (types.length) {
      posts = posts.filter((post) => {
        return types.includes(post.type.id);
      });
    }

    // filter by tags
    if (tags.length) {
      posts = posts.filter((post) => {
        return post.tags.some((tag) => {
          return tags.includes(tag.id);
        });
      });
    }

    // filter by search query
    if (query.length) {
      posts = posts.filter((post) => {
        const targets = [
          post.title,
          post.type.name,
          post.type.label,
          ...helper.getTaxonomyNames(post.categories),
          ...helper.getTaxonomyNames(post.tags),
        ];

        return targets.some((target) => {
          return target.toUpperCase().includes(query.toUpperCase());
        });
      });
    }

    return posts;
  };

  return {
    selected,
    setSelected,
    query,
    setQuery,
    filterPosts,
  };
}

export { useFilters };
