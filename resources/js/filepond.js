/**
 * Import FilePond js and css
 */
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';

/**
 *  Import image preview plugin js and css
 */
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

/**
 * Register FilePond plugins
 */
FilePond.registerPlugin(FilePondPluginImagePreview);

/**
 * Initialize filepond on file inputs
 */
const inputElement = document.querySelector('input[type="file"]');

const pond = FilePond.create(inputElement, {
    allowMultiple: false, // optional: if only 1 image needed
    className: 'imageupload',
    allowPaste: false,
    credits: false,
    dropValidation: true,
    labelIdle: 'Húzd ide a képet, vagy <span class="filepond--label-action"> tallózd </span>',
    imagePreviewHeight: 160,
    server: null, // Disable server processing
    storeAsFile: true // ✅ prevent FilePond clearing input, sends file via form
});
