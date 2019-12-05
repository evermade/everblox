import React, { useContext } from 'react';
import classNames from 'classnames';
import config from '../config';
import { MethodContext } from '../utils/Context';
import { helper } from '../utils/Helper';

function Search({ query }) {
  const methods = useContext(MethodContext);

  const handleChange = (e) => {
    methods.setQuery(e.target.value);
  };

  const handleClear = () => {
    methods.setQuery('');
  };

  const iconClass = classNames({
    'c-feed-search__icon': true,
    'c-feed-search__icon--clear': query.length >= 1,
  });

  return (
    <div className="c-feed-search">
      <div className="c-feed-search__title">{config.text.searchTitle}</div>
      <div className="c-feed-search__field">
        <input
          className="c-feed-search__input"
          type="text"
          placeholder={config.text.searchPlaceholder}
          aria-label={config.text.searchAriaLabel}
          value={query}
          onChange={handleChange}
        />
        <div
          tabIndex="0"
          className={iconClass}
          onClick={handleClear}
          onKeyPress={(e) => helper.isEnterKey(e, handleClear)}
        />
      </div>
    </div>
  );
}

export default Search;
