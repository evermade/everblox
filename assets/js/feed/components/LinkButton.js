import React from 'react';

function LinkButton({
  id,
  wrapperClasses,
  classes,
  text,
  permalink,
  clickHandler,
}) {
  const handleClick = (e) => {
    e.preventDefault();
    e.stopPropagation();

    clickHandler(id);
  };

  return (
    <div className={wrapperClasses}>
      <a href={permalink} className={classes} onClick={handleClick}>
        {text}
      </a>
    </div>
  );
}

export default LinkButton;
