/**
 * Import EasyEditor
 */
import 'easyeditor/src/jquery.easyeditor';
import 'easyeditor/src/easyeditor.css';

$(document).ready(function() {

    /**
     * Init on admin product form description field
     */
    new EasyEditor('#description', {
        css: ({
            minHeight: '200px',
            maxHeight: '450px'
        }),
        onLoaded: function(){
            console.log('Easy Editor Loaded!');
        },
        buttons : ['bold', 'italic', 'link', 'code', 'h3', 'x', 'source']
    });

});
