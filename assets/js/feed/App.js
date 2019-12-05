import React, { useEffect, useMemo } from 'react';
import { createHashHistory } from 'history';
import config from './config';

import { MethodContext } from './utils/Context';
import { useData } from './utils/useData';
import { useFilters } from './utils/useFilters';
import { usePagination } from './utils/usePagination';
import { helper } from './utils/Helper';

import Filters from './components/Filters';
import Results from './components/Results';

function App({ perPage }) {
  const { loadData, dataState, posts, filters } = useData();
  const { selected, setSelected, query, setQuery, filterPosts } = useFilters();
  const { paged, setPaged, loadMore } = usePagination();

  // Initiate data loading
  useEffect(() => {
    loadData(config.apiUrl);
  }, [config]);

  /**
   * Filtering, sorting and pagination methods.
   *
   * Note that this way of passing methods through Context API causes
   * unnecessary renders. If performance is an issue, it's recommended
   * to use a state management solution like Redux or MobX.
   */
  const methods = useMemo(() => {
    const setFilter = (filter, id) => {
      setSelected((selected) => {
        let x = { ...selected };

        Object.keys(x).forEach((key) => {
          x[key] = [];
        });

        x[filter] = [id];

        return x;
      });
      setQuery('');
      setPaged(1);
    };

    const addFilter = (filter, id) => {
      setSelected({
        ...selected,
        [filter]: !selected[filter].includes(id)
          ? selected[filter].concat(id)
          : selected[filter],
      });
      setPaged(1);
    };

    const toggleFilter = (filter, id) => {
      setSelected({
        ...selected,
        [filter]: helper.toggleInArray(selected[filter], id),
      });
      setPaged(1);
    };

    const clearFilter = (filter) => {
      setSelected({
        ...selected,
        [filter]: [],
      });
      setPaged(1);
    };

    return {
      addFilter,
      setFilter,
      toggleFilter,
      clearFilter,
      setQuery,
      loadMore,
    };
  }, [selected, setSelected, setPaged, setQuery]);

  // Sorting functions
  const sortByDateDescending = (a, b) => {
    return b.timestamp - a.timestamp;
  };

  // Pagination function
  const paginatePosts = (posts) => {
    return posts.slice(0, perPage * paged);
  };

  // Keep URL parameters updated with the app.
  useEffect(() => {
    const updateParams = () => {
      const history = createHashHistory();
      const str = helper.generateHashString({
        categories: selected.categories.join(','),
        types: selected.types.join(','),
        tags: selected.tags.join(','),
      });

      window.location.hash = str;
      history.replace(str);
    };

    updateParams();
  }, [selected]);

  // Filter, sort and page the posts
  const filteredPosts = filterPosts(posts);
  const sortedPosts = filteredPosts.sort(sortByDateDescending);
  const pagedPosts = paginatePosts(sortedPosts);

  return (
    <div className="l-feed__app">
      <MethodContext.Provider value={methods}>
        <Filters
          filters={filters}
          selected={selected}
          query={query}
          hasTags={!!selected.tags.length}
          loading={dataState !== 'loaded'}
        />
        <Results
          posts={pagedPosts}
          hasMorePosts={pagedPosts.length < filteredPosts.length}
          perPage={perPage}
          loading={dataState !== 'loaded'}
        />
      </MethodContext.Provider>
    </div>
  );
}

export default App;
