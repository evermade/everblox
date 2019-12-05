import React from 'react';
import classNames from 'classnames';
import config from '../config';

import MultiSelect from './MultiSelect';
import Search from './Search';
import Tags from './Tags';
import Spinner from './Spinner';

function Filters({ filters, selected, query, hasTags, loading }) {
  const componentClass = classNames({
    'l-feed-filters': true,
    'l-feed-filters--has-tags': hasTags,
  });

  return (
    <div className={componentClass} data-style-color>
      <h6 className="l-feed-filters__title">{config.text.filtersTitle}</h6>
      {loading ? (
        <Spinner />
      ) : (
        <>
          <div className="l-feed-filters__content">
            <div className="l-feed-filters__filters">
              <div className="l-feed-filters__categories">
                <MultiSelect
                  name="categories"
                  title={config.text.categoriesTitle}
                  options={filters.categories}
                  selected={selected.categories}
                />
              </div>
              <div className="l-feed-filters__types">
                <MultiSelect
                  name="types"
                  title={config.text.typesTitle}
                  options={filters.types}
                  selected={selected.types}
                />
              </div>
            </div>
            <div className="l-feed-filters__filters">
              <div className="l-feed-filters__search">
                <Search query={query} />
              </div>
            </div>
          </div>
          <Tags tags={filters.tags} selected={selected.tags} />
        </>
      )}
    </div>
  );
}

export default Filters;
