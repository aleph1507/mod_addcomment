<?php
/**
 * add comment module
 */

// no direct access
defined('_JEXEC') or die;
// include the syndicate functions once
require_once  dirname(__FILE__) . '/helper.php';

$doc = JFactory::getDocument();
$article_id = JFactory::getApplication()->input->get('id');

$js = <<<JS
(function ($) {
    $(document).on('click', '#submit', function(event) {
        var comment = $('#comment').val();
        var article_id = '<?php echo $article_id; ?>';
        var commentsDiv = $('#comments');
        if(comment.length > 120) {
            $('#result').html('Comment must not be longer then 120 characters');
        } else if (comment.length <= 0) {
            $('#result').html('You cannot post an empty comment');
        } else {
            request = {
                'option' : 'com_ajax',
                'module' : 'addcomment',
                'data'   : comment,
                'format' : 'raw'
            };
            $.ajax({
                type   : 'POST',
                data   : request,
                success: function (affectedRows) {
                    if(commentsDiv.html() === 'Be the first to comment on this post')
                        commentsDiv.html('');
                    $('<div style="border-bottom:1px solid black;">' + comment + '</div>').prependTo('#comments');
                    $('#comment').val('');
                }
            });
        }
        return false;
    });
})(jQuery)
JS;

$doc->addScriptDeclaration($js);
$comments = modAddCommentHelper::getComments($params);
require JModuleHelper::getLayoutPath('mod_addcomment');