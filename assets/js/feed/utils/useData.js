import { useState } from 'react';
import 'whatwg-fetch';

function useData() {
  const [dataState, setDataState] = useState('unloaded');
  const [posts, setPosts] = useState([]);
  const [filters, setFilters] = useState([]);

  const loadData = async (url) => {
    setDataState('loading');

    const requestOptions = {
      method: 'GET',
    };

    window
      .fetch(`${url}`, requestOptions)
      .then(parseResponse)
      .then((data) => {
        setPosts(data.posts);
        setFilters(data.filters);
        setDataState('loaded');
      })
      .catch((error) => {
        setDataState('error');
        throw new Error(error);
      });
  };

  return { loadData, dataState, posts, filters };
}

function parseResponse(response) {
  return response.text().then((text) => {
    const data = text && JSON.parse(text);

    if (!response.ok) {
      const error = (data && data.message) || response.statusText;

      return Promise.reject(error);
    }

    return data;
  });
}

export { useData };
