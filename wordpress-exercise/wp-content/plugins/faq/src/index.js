
import { registerBlockType } from '@wordpress/blocks';

import './style.scss';

import Edit from './edit';
import metadata from './block.json';

import save from './save'; // Import the save function

registerBlockType(metadata.name, {
  attributes: {
      selectedFAQs: {
          type: 'array',
          default: []
      }
  },
  edit: Edit,
  save,
});

import apiFetch from '@wordpress/api-fetch';

export const loadFAQs = async (selectedCategories, selectedTags, setSelectedFAQs, setLoading) => {
  setLoading(true);
  try {
    // Ensure that selectedCategories and selectedTags are arrays
    if (!Array.isArray(selectedCategories) || !Array.isArray(selectedTags)) {
      throw new Error('Selected categories and tags must be arrays.');
    }

    // Convert any non-integer IDs to integers
    const categoryIds = selectedCategories.map(id => parseInt(id, 10)).filter(id => !isNaN(id));
    const tagIds = selectedTags.map(id => parseInt(id, 10)).filter(id => !isNaN(id));

    // Construct the URL with properly formatted query parameters
    const categoriesQueryParam = categoryIds.length > 0 ? `categories=${categoryIds.join(',')}` : '';
    const tagsQueryParam = tagIds.length > 0 ? `tags=${tagIds.join(',')}` : '';
    const queryParams = [categoriesQueryParam, tagsQueryParam].filter(param => param).join('&');
    const url = `/wp/v2/faq?${queryParams}&per_page=100`;
    
    const response = await apiFetch({ path: url });
    setSelectedFAQs(response.map(faq => ({ ...faq, isChecked: false }))); // Set initial isChecked to false
  } catch (error) {
    console.error('Error loading FAQs:', error);
    setSelectedFAQs([]); // Set to empty array in case of error
  } finally {
    setLoading(false);
  }
};


