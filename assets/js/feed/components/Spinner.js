import React from 'react';
import classNames from 'classnames';

function Spinner({ scheme, size }) {
  const componentClass = classNames({
    'c-spinner': true,
    [`c-spinner--${scheme}`]: scheme,
    [`c-spinner--${size}`]: size,
  });

  return <div className={componentClass} />;
}

export default Spinner;
