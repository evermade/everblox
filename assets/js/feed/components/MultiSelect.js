import React, { useContext, useState } from 'react';
import classNames from 'classnames';
import { MethodContext } from '../utils/Context';
import config from '../config';
import { helper } from '../utils/Helper';

const buildLabel = (options, selected) => {
  if (!selected.length) return config.text.selectAll;

  // find the names of the selected options
  let names = selected
    .map((id) => {
      const match = options.find((option) => {
        return option.id === id;
      });

      return match && match.name ? match.name : false;
    })
    .filter((name) => {
      return name;
    });

  return names.length ? names.join(', ') : config.text.selectAll;
};

function Option({ id, name, selected, clickHandler }) {
  const handleClick = () => {
    clickHandler(id);
  };

  const handleKeyPress = (e) => {
    e.stopPropagation();

    helper.isEnterKey(e, handleClick);
  };

  const componentClass = classNames({
    'c-multiselect__option': true,
    'c-multiselect__option--selected': selected,
  });

  return (
    <li
      tabIndex="0"
      className={componentClass}
      onClick={handleClick}
      onKeyPress={handleKeyPress}>
      {name}
    </li>
  );
}

function MultiSelect({ name, title, options, selected }) {
  const methods = useContext(MethodContext);
  const [open, setOpen] = useState(false);
  const label = buildLabel(options, selected);
  const optionElements = options.map((item) => {
    return (
      <Option
        key={item.id}
        id={item.id}
        name={item.name}
        selected={selected.includes(item.id)}
        clickHandler={(id) => methods.toggleFilter(name, id)}
      />
    );
  });

  const toggleOptions = () => {
    setOpen((open) => !open);
  };

  const closeOptions = () => {
    setOpen(false);
  };

  const clearFilter = () => {
    methods.clearFilter(name);
  };

  const componentClass = classNames({
    'c-multiselect': true,
    'c-multiselect--open': open,
  });

  return (
    <div
      tabIndex="0"
      className={componentClass}
      onKeyPress={(e) => helper.isEnterKey(e, toggleOptions)}
      onKeyDown={(e) => helper.isEscapeKey(e, closeOptions)}>
      <div className="c-multiselect__title" onClick={toggleOptions}>
        {title}
      </div>
      <div className="c-multiselect__field" onClick={toggleOptions}>
        {label}
      </div>
      <ul className="c-multiselect__options">
        {optionElements}
        <div
          tabIndex="0"
          className="c-multiselect__clear"
          onClick={clearFilter}
          onKeyPress={(e) => helper.isEnterKey(e, clearFilter)}>
          {config.text.selectClear}
        </div>
      </ul>
    </div>
  );
}

export default MultiSelect;
