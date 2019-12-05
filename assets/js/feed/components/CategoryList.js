import React, { useContext } from 'react';
import { MethodContext } from '../utils/Context';
import LinkButton from './LinkButton';

function CategoryList({ categories }) {
  const methods = useContext(MethodContext);

  return (
    <div className="c-category-list">
      {categories.map((category, index) => {
        return (
          <React.Fragment key={category.id}>
            <LinkButton
              id={category.id}
              wrapperClasses={'c-category-list__item'}
              classes={'c-category-list__link'}
              text={category.name}
              permalink={category.permalink}
              clickHandler={() => methods.setFilter('categories', category.id)}
            />
            {index + 1 !== categories.length && (
              <span className="c-category-list__separator"> | </span>
            )}
          </React.Fragment>
        );
      })}
    </div>
  );
}

export default CategoryList;
