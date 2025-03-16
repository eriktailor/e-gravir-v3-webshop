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
document.addEventListener('DOMContentLoaded', () => {

    const inputElement = document.querySelector('input[type="file"]');
    const existingImage = document.getElementById('existingImage')?.value || null;

    if (inputElement) {
        FilePond.create(inputElement, {
            allowMultiple: false,
            storeAsFile: true,
            credits: false,
            imagePreviewHeight: 160,
            server: {
                load: (source, load) => {
                    fetch(source)
                        .then(res => res.blob())
                        .then(blob => {
                            load(blob);
                        });
                }
            },
            files: existingImage
                ? [
                      {
                          source: existingImage, // full URL
                          options: {
                              type: 'local',
                              metadata: {
                                  poster: existingImage // show preview
                              }
                          }
                      }
                  ]
                : []
        });
    }

});