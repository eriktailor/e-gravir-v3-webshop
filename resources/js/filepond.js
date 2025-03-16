/**
 * Import FilePond js and css
 */
import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';

/**
 * Import image preview plugin js and css
 */
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

/**
 * Register FilePond plugins
 */
FilePond.registerPlugin(FilePondPluginImagePreview);

/**
 * Format existing images
 */
function formatExistingFiles(images) {
    if (!images) return [];
    return images.map((image) => ({
        source: image.id,
        options: {
            type: 'local',
            metadata: { poster: image.url }
        }
    }));
}


/**
 * Init function
 */
function initFilePond(selector, existingImages = null, options = {}) {
    const inputElement = document.querySelector(selector);
    if (!inputElement) return;

    const pond = FilePond.create(inputElement, {
        allowMultiple: true,
        credits: false,
        allowRevert: true,
        instantUpload: false,
        imagePreviewHeight: 160,
        labelIdle: 'Húzd ide a képeidet vagy <span class="filepond--label-action"> kiválasztás </span>',

        server: {
            load: (source, load) => {
                const img = existingImages?.find(img => img.id == source);
                if (img) {
                    fetch(img.url)
                        .then(res => res.blob())
                        .then(blob => load(blob));
                }
            },
            revert: (uniqueFileId, load, error) => {
                // For newly uploaded files (if needed)
                console.log('Revert called, ID:', uniqueFileId);
                load();
            }
        },

        files: existingImages ? formatExistingFiles(existingImages) : [],
        ...options
    });

    /**
     * Always fire on ANY file removal
     */
    pond.on('removefile', (error, file) => {
        if (file && file.source) {
            console.log('Removing file ID:', file.source);

            fetch(`/admin/product-images/${file.source}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(res => {
                console.log('Delete response:', res.status);
            }).catch((err) => {
                console.error('Delete error:', err);
            });
        }
    });

    return pond;
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

    if (productImages) {
        initFilePond('#productImageUpload', window.existingProductImages ?? null, {
            allowMultiple: true,
            maxFiles: 10,
            name: 'images[]',
            storeAsFile: true,
            className: 'filepond-product-images'
        });
    }
});
