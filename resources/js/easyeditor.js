/**
 * Import EasyEditor
 */
import 'easyeditor/src/jquery.easyeditor';
import 'easyeditor/src/easyeditor.css';

$(document).ready(function($) {

    /**
     * Init on admin product form description field
     */
    new EasyEditor('#description', {
        css: ({
            minHeight: '200px',
            maxHeight: '450px'
        }),
        buttons : ['bold', 'italic', 'link', 'h3',, 'source', 'x']
    });

    /**
     * Copy the content of editor into hidden textarea on product form submit
     */
    $('#productForm').on('submit', function() {
        $('.editor').each(function(){
            var content = $(this).html();
            var target = $(this).attr('id').replace('-editor', '');
            $('#' + target).val(content);
        });
    });

});