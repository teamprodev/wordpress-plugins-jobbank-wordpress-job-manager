var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    blockStyle = {};

registerBlockType('jobbank/price-table', {
	title: 'Pricing Table',
	icon: 'dashicons dashicons-money-alt ',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_price_table]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_price_table]' );
    },
});


registerBlockType('jobbank/registration-form', {
	title: 'Registration Form',
	icon: 'dashicons dashicons-forms',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_form_wizard]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_form_wizard]' );
    },
});

registerBlockType('jobbank/my-account', {
	title: 'My Account',
	icon: 'dashicons dashicons-universal-access',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_profile_template]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_profile_template]' );
    },
});

registerBlockType('jobbank/candidate-profile-public', {
	title: 'Candidate profile',
	icon: 'dashicons dashicons-businessman',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_candidate_profile_public]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_candidate_profile_public]' );
    },
});

registerBlockType('jobbank/employer-profile-public', {
	title: 'Employer profile',
	icon: 'dashicons dashicons-bank',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_employer_profile_public]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_employer_profile_public]' );
    },
});

registerBlockType('jobbank/login', {
	title: 'Login Form',
	icon: 'dashicons dashicons-unlock',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_login]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_login]' );
    },
});

registerBlockType('jobbank/employer-directory', {
	title: 'Employer Directory',
	icon: 'dashicons dashicons-admin-home',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_employer_directory]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_employer_directory]' );
    },
});

registerBlockType('jobbank/candidate-directory', {
	title: 'Candidate Directory',
	icon: 'dashicons dashicons-admin-users',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_candidate_directory]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_candidate_directory]' );
    },
});

registerBlockType('jobbank/categories-image', {
	title: 'Categories Block',
	icon: 'dashicons dashicons-category',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_categories]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_categories]' );
    },
});

registerBlockType('jobbank/featured', {
	title: 'Featured Listing',
	icon: 'dashicons dashicons-sticky',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_featured]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_featured]' );
    },
});

registerBlockType('jobbank/map-full', {
	title: 'Map Full',
	icon: 'dashicons dashicons-location-alt',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_map]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_map]' );
    },
});
registerBlockType('jobbank/all-listing', {
	title: 'All Listing With map',
	icon: 'dashicons dashicons-grid-view',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_archive_grid]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_archive_grid]' );
    },
});
registerBlockType('jobbank/all-listing-without-map', {
	title: 'All Listing Without map',
	icon: 'dashicons dashicons-grid-view',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_archive_grid_no_map]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_archive_grid_no_map]' );
    },
});

registerBlockType('jobbank/search-form', {
	title: 'Search Form',
	icon: 'dashicons dashicons-search',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[jobbank_search]' );
    },
    save: function() {
        return el( 'p', '', '[jobbank_search]' );
    },
});

registerBlockType('jobbank/filter', {
	title: 'Filter',
	icon: 'dashicons dashicons-admin-settings',
	category: 'jobbank-category',  		  
	edit: function() {
        return el( 'p', '', '[listing_filter]' );
    },
    save: function() {
        return el( 'p', '', '[listing_filter]' );
    },
});













