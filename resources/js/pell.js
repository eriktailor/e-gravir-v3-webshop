/**
 * Import Pell editor
 */
import pell from 'pell';
import 'pell/dist/pell.min.css';

$(document).ready(function() {

    /**
     * Init pell on product form's description field
     */
    const editor = pell.init({
        element: document.getElementById('editor'),
        actions: [
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'olist',
            'ulist',
            'link'
        ],
        onChange: html => {
            $('#hiddenTextarea').val(html);
        }
    });

});