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
	searchField: [],
	onFocus: function() {
        let control = this.control;
        $(control).addClass('ring ring-stone-950');
    },
	onBlur: function() {
        let control = this.control;
        $(control).removeClass('ring ring-stone-950');
    }
});

