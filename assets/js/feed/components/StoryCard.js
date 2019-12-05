import React from 'react';
import classNames from 'classnames';
import CategoryList from './CategoryList';
import TagList from './TagList';
import config from '../config';

const ReadMoreButton = () => (
  <div className="c-text-button c-text-button--icon-after" role="button">
    <span className="c-text-button__text">{config.text.readMore}</span>
    <span
      className="c-text-button__icon"
      dangerouslySetInnerHTML={{ __html: config.svg.arrowRight }}
    />
  </div>
);

function StoryCard({
  title,
  excerpt,
  categories,
  tags,
  permalink,
  featuredImage,
}) {
  const componentClass = classNames(
    'c-story-card',
    !featuredImage ? 'c-story-card--no-image' : '',
  );

  return (
    <div className={componentClass}>
      <a href={permalink} className="c-story-card__link wrapper-link">
        {featuredImage && (
          <div className="c-story-card__image-wrapper">
            <div
              className="c-story-card__image"
              style={{ backgroundImage: `url(${featuredImage})` }}
            />
          </div>
        )}
        <div className="c-story-card__content">
          <h3 className="c-story-card__title">{title}</h3>
          <div className="c-story-card__excerpt">{excerpt}</div>
          <div className="c-story-card__more">
            <ReadMoreButton />
          </div>
        </div>
      </a>
      <div className="c-story-card__categories">
        <CategoryList categories={categories} />
      </div>

      <div className="c-story-card__tags">
        <TagList tags={tags} />
      </div>
    </div>
  );
}

export default StoryCard;
