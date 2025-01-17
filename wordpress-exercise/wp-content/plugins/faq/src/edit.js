import { useState, useEffect } from '@wordpress/element';
import { CheckboxControl, Button, Placeholder, PanelBody } from '@wordpress/components';
import { InspectorControls } from '@wordpress/block-editor';
import ServerSideRender from '@wordpress/server-side-render';
import apiFetch from '@wordpress/api-fetch';
import { loadFAQs } from './index.js';
import './faq-block.css';

export default function FAQBlockEdit({ attributes, setAttributes }) {
    const [availableCategories, setAvailableCategories] = useState([]);
    const [availableTags, setAvailableTags] = useState([]);
    const [availableFAQs, setAvailableFAQs] = useState([]);
    const [loading, setLoading] = useState(false);
    const [step, setStep] = useState(1);
    const [dropdown, setDropdown] = useState(null);

    const { selectedCategories = [], selectedTags = [], selectedFAQs = [] } = attributes;

    useEffect(() => {
        if (step === 2) {
            fetchCategoriesAndTags();
        }
    }, [step]);

    useEffect(() => {
        if (step === 2 && (selectedCategories.length || selectedTags.length)) {
            loadFAQs(selectedCategories, selectedTags, setAvailableFAQs, setLoading);
        }
    }, [step, selectedCategories, selectedTags]);

    const fetchCategoriesAndTags = async () => {
        try {
            const categoriesResponse = await apiFetch({ path: '/wp/v2/categories' });
            const tagsResponse = await apiFetch({ path: '/wp/v2/tags' });
            setAvailableCategories(categoriesResponse);
            setAvailableTags(tagsResponse);
        } catch (error) {
            console.error('Error loading categories and tags:', error);
        }
    };

    const handleStart = () => {
        setStep(2);
    };

    const handleNextStep = () => {
        setStep(3);
    };

    const handleDone = () => {
        setStep(4);
    };

    const handleCategorySelection = (categoryId) => {
        const updatedCategories = selectedCategories.includes(categoryId) ?
            selectedCategories.filter((id) => id !== categoryId) :
            [...selectedCategories, categoryId];
        setAttributes({ selectedCategories: updatedCategories });
    };

    const handleTagSelection = (tagId) => {
        const updatedTags = selectedTags.includes(tagId) ?
            selectedTags.filter((id) => id !== tagId) :
            [...selectedTags, tagId];
        setAttributes({ selectedTags: updatedTags });
    };

    const handleFAQSelection = (faqId, isChecked) => {
        const updatedFAQs = isChecked ?
            [...selectedFAQs, availableFAQs.find(faq => faq.id === faqId)] :
            selectedFAQs.filter((faq) => faq.id !== faqId);
        setAttributes({ selectedFAQs: updatedFAQs });
    };

    const isCategorySelected = (categoryId) => selectedCategories.includes(categoryId);
    const isTagSelected = (tagId) => selectedTags.includes(tagId);
    const isFAQSelected = (faqId) => selectedFAQs.some(faq => faq.id === faqId);

    const toggleDropdown = (menu) => {
        setDropdown(dropdown === menu ? null : menu);
    };

    return (
        <>
            {step === 1 && (
                <div className="faq-block">
                    <h2 className="title">Add FAQ</h2>
                    <Button primary onClick={handleStart} className="add-faq-button">
                        +
                    </Button>
                </div>
            )}

            {step === 2 && (
                <div className="faq-block">
                    <h2>Select Category and Tags</h2>
                    <div className="faq-block-select">
                        <div className="dropdown">
                            <button className="dropdown-toggle" onClick={() => toggleDropdown('categories')}>
                                Search md-faq-category <span className={`dropdown-arrow ${dropdown === 'categories' ? 'open' : ''}`}>&#9660;</span>
                            </button>
                            <div className={`dropdown-menu ${dropdown === 'categories' ? 'active' : ''}`}>
                                {availableCategories.map((category) => (
                                    <div key={category.id}>
                                        <CheckboxControl
                                            label={category.name}
                                            checked={isCategorySelected(category.id)}
                                            onChange={() => handleCategorySelection(category.id)}
                                        />
                                    </div>
                                ))}
                            </div>
                        </div>

                        <div className="dropdown">
                            <button className="dropdown-toggle" onClick={() => toggleDropdown('tags')}>
                                Search md-faq-tag <span className={`dropdown-arrow ${dropdown === 'tags' ? 'open' : ''}`}>&#9660;</span>
                            </button>
                            <div className={`dropdown-menu ${dropdown === 'tags' ? 'active' : ''}`}>
                                {availableTags.map((tag) => (
                                    <div key={tag.id}>
                                        <CheckboxControl
                                            label={tag.name}
                                            checked={isTagSelected(tag.id)}
                                            onChange={() => handleTagSelection(tag.id)}
                                        />
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                    <h2>Select FAQs</h2>
                    {loading}
                    {availableFAQs.map((faq) => (
                        <CheckboxControl
                            key={faq.id}
                            label={faq.title && faq.title.rendered ? faq.title.rendered : 'Unknown FAQ'}
                            checked={isFAQSelected(faq.id)}
                            onChange={(isChecked) => handleFAQSelection(faq.id, isChecked)}
                        />
                    ))}
                    <Button onClick={handleNextStep}>Next</Button>
                </div>
            )}

            {step === 3 && (
                <div className="faq-block">
                    <h2>Reorder FAQs</h2>
                    {selectedFAQs.map((faq) => (
                        <div key={faq.id}>
                            <span>{faq.title ? faq.title.rendered : 'Unknown FAQ'}</span>
                        </div>
                    ))}
                    <Button onClick={handleDone}>Done</Button>
                </div>
            )}

            {step === 4 && (
                <div className="faq-block">
                    <h2>Selected FAQs</h2>
                    {selectedFAQs.map((faq) => (
                        <div key={faq.id}>
                            <span>{faq.title ? faq.title.rendered : 'Unknown FAQ'}</span>
                        </div>
                    ))}
                    <ServerSideRender
                    block="faq-block/faq"
                    attributes={{ selectedFAQs: selectedFAQs.map(faq => faq.id) }}
                    />
                </div>
            )}




            
        </>
    );
}
