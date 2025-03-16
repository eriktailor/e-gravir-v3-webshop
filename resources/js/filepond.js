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
 * Helper to format multiple existing images
 */
function formatExistingFiles(images) {
    if (!images) return [];

    if (Array.isArray(images)) {
        return images.map((image) => ({
            source: image,
            options: {
                type: 'local',
                metadata: { poster: image }
            }
        }));
    } else {
        return [
            {
                source: images,
                options: {
                    type: 'local',
                    metadata: { poster: images }
                }
            }
        ];
    }
}

/**
 * Init function
 */
function initFilePond(selector, existingImages = null, options = {}) {
    const inputElement = document.querySelector(selector);
    if (!inputElement) return;

    FilePond.create(inputElement, {
        allowMultiple: false,
        storeAsFile: true,
        credits: false,
        imagePreviewHeight: 160,
        server: existingImages
            ? {
                  load: (source, load) => {
                      fetch(source)
                          .then(res => res.blob())
                          .then(blob => {
                              load(blob);
                          });
                  }
              }
            : null,
        files: formatExistingFiles(existingImages),
        ...options
    });
}

document.addEventListener('DOMContentLoaded', () => {

    /**
     * Init global on all file inputs
     */
    const fileInputs = document.querySelectorAll('input[type="file"]:not(.filepond-override)');

    fileInputs.forEach((input) => {
        FilePond.create(input, {
            allowMultiple: false,
            storeAsFile: true,
            credits: false,
            imagePreviewHeight: 160,
        });
    });

    /**
     * Init on admin category image
     */
    const categoryImage = document.getElementById('categoryImageUpload');
    const existingCategoryImage = document.getElementById('existingImage')?.value || null;

    if (categoryImage) {
        initFilePond('#categoryImageUpload', existingCategoryImage, {
            allowMultiple: false,
            name: 'image',
            className: 'filepond-category-image'
        });
    }

    /**
     * Init on admin product gallery images
     */
    const productImages = document.getElementById('productImageUpload');
    const existingProductImages = Array.from(document.querySelectorAll('.existingGalleryImage')).map(img => img.value);

    if (productImages) {
        initFilePond('#gallery_images', existingProductImages.length > 0 ? existingProductImages : null, {
            allowMultiple: true,
            maxFiles: 10,
            name: 'image',
            className: 'filepond-product-images'
        });
    }



});