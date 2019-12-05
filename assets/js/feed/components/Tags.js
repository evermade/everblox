import React, { useContext } from 'react';
import { MethodContext } from '../utils/Context';
import LinkButton from './LinkButton';

function Tags({ tags, selected }) {
  const methods = useContext(MethodContext);
  const selectedTags = tags.filter((tag) => {
    return selected.includes(tag.id);
  });

  return (
    <div className="l-feed-filters__tags">
      {selectedTags.map((tag, index) => {
        return (
          <LinkButton
            key={index}
            id={tag.id}
            wrapperClasses={'c-tag-filter'}
            text={tag.name}
            permalink={tag.permalink}
            clickHandler={(id) => methods.toggleFilter('tags', id)}
          />
        );
      })}
    </div>
  );
}

export default Tags;
