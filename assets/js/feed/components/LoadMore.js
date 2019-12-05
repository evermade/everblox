import React from 'react';

function LoadMore({ text, clickHandler }) {
  const handleClick = () => {
    clickHandler();
  };

  return (
    <div className="l-feed__more">
      <button className="c-button" onClick={handleClick}>
        {text}
      </button>
    </div>
  );
}

export default LoadMore;
