<?php
function render_faq_block($attributes)
{
    $output = '';

    if (isset($attributes['selectedFAQs']) && is_array($attributes['selectedFAQs'])) {
        $output .= '<h1>Selected FAQs</h1>';

        foreach ($attributes['selectedFAQs'] as $faqItem) {

            //extract title and content from each selected FAQ item
            $title = isset($faqItem['title']) ? $faqItem['title'] : '';
            $content = isset($faqItem['content']) ? $faqItem['content'] : '';

            $output .= "
                <p>
                <h2>$title</h2>
                <p>$content</p>
                </p>
            ";
        }

        $output .= '</div>';
    }

    return $output;
}
?>
