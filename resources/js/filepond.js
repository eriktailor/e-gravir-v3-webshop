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
const existingImage = document.getElementById('existingImage')?.value || null;

const pond = FilePond.create(inputElement, {
    allowMultiple: false,
    server: null,
    storeAsFile: true,
    credits: false,
    imagePreviewHeight: 160,
    files: existingImage
        ? [
            {
                source: existingImage, // Full image URL like: /storage/categories/9/filename.webp
                options: {
                    type: 'local',
                    file: {
                        name: existingImage.split('/').pop(), // filename
                        size: null,
                        type: 'image/webp' // optional
                    },
                    metadata: {
                        poster: existingImage // shows preview!
                    }
                }
            }
        ]
        : []
});
