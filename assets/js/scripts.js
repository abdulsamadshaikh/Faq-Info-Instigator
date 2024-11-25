document.addEventListener('DOMContentLoaded', () => {
    // FAQ collapsible accordion
    const faqTitles = document.querySelectorAll('.faq-title h3');
    const toggles = document.querySelectorAll('.faq-title');

    function closeActiveAccordion() {
        const activeItem = document.querySelector('.faq.active');
        if (activeItem) {
            const activeContent = activeItem.querySelector('.faq-content');
            if (activeContent) { // Ensure activeContent is not null
                activeContent.style.maxHeight = null;
            }
            activeItem.classList.remove('active');
        }
    }

    function toggleAccordion(item) {
        const content = item.querySelector('.faq-content');
        if (content) { // Ensure content is not null
            if (item.classList.contains('active')) {
                content.style.maxHeight = null;
                item.classList.remove('active');
            } else {
                closeActiveAccordion();
                item.classList.add('active');
                const contentHeight = content.scrollHeight + 'px';
                content.style.maxHeight = contentHeight;
            }
        }
    }

    toggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const faqItem = toggle.closest('.faq');
            if (faqItem) { // Ensure faqItem is not null
                toggleAccordion(faqItem);
            }
        });
    });

    faqTitles.forEach(faqTitle => {
        faqTitle.addEventListener('click', () => {
            const faqItem = faqTitle.closest('.faq');
            if (faqItem) { // Ensure faqItem is not null
                toggleAccordion(faqItem);
            }
        });
    });

    const allFaqItems = document.querySelectorAll('.faq');
    allFaqItems.forEach(faqItem => {
        const content = faqItem.querySelector('.faq-content');
        if (content) { // Ensure content is not null
            content.style.maxHeight = '0px'; // Ensure initial state is hidden
        }
    });
});