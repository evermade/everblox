import React, { useContext } from 'react';
import { MethodContext } from '../utils/Context';
import LinkButton from './LinkButton';

function TagList({ tags }) {
  const methods = useContext(MethodContext);

  return (
    <div className="c-tag-list">
      {tags.map((tag, index) => {
        return (
          <React.Fragment key={tag.id}>
            <LinkButton
              id={tag.id}
              wrapperClasses={'c-tag-list__item'}
              classes={'c-tag-list__link'}
              text={tag.name}
              permalink={tag.permalink}
              clickHandler={() => methods.addFilter('tags', tag.id)}
            />
            {index + 1 !== tags.length && (
              <span className="c-tag-list__separator"> | </span>
            )}
          </React.Fragment>
        );
      })}
    </div>
  );
}

export default TagList;
