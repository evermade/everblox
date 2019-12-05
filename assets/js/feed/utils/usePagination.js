import { useState } from 'react';

function usePagination() {
  const [paged, setPaged] = useState(1);

  const loadMore = () => {
    setPaged((paged) => paged + 1);
  };

  return { paged, setPaged, loadMore };
}

export { usePagination };
