/**
 * Import Tom Select js and css
 */
import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.default.css';

/**
 * Tags input
 */
new TomSelect("#tagsInput",{
	persist: false,
	createOnBlur: true,
	create: true,
    highlight: false,
});

