import React, { useContext } from 'react';
import classNames from 'classnames';
import { MethodContext } from '../utils/Context';
import config from '../config';
import Spinner from './Spinner';
import LoadMore from './LoadMore';
import StoryCard from './StoryCard';

const getCardComponent = (post) => {
  if (!post || !post.type) return false;

  switch (post.type.id) {
    case 'story': {
      return <StoryCard {...post} />;
    }
  }

  return null;
};

const buildCards = (posts, perPage) => {
  return posts.map((post, index) => {
    const delay = index % perPage;

    const cardClass = classNames({
      'l-feed__item': true,
      'fadeInUp animated': true,
      [`delay--${delay}`]: true,
    });

    const cardComponent = getCardComponent(post);

    if (cardComponent) {
      return (
        <div className={cardClass} key={post.id}>
          {cardComponent}
        </div>
      );
    } else {
      return false;
    }
  });
};

function Results({ posts, hasMorePosts, perPage, loading }) {
  const methods = useContext(MethodContext);
  const cardElements = buildCards(posts, perPage);

  const componentClass = classNames({
    'l-feed__results': true,
    'l-feed__results--loading': loading,
  });

  return (
    <>
      <div className={componentClass}>
        {loading ? (
          <Spinner />
        ) : cardElements.length ? (
          cardElements
        ) : (
          <h3 className="l-feed__not-found">{config.text.notFound}</h3>
        )}
      </div>

      {hasMorePosts && (
        <LoadMore text={config.text.loadMore} clickHandler={methods.loadMore} />
      )}
    </>
  );
}

export default Results;
