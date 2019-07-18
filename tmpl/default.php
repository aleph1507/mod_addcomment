<?php
// no direct access
defined('_JEXEC') or die; ?>
<div style="display:flex; justify-content: space-between;">
    <div style="display:flex; flex-direction:column; width: 50%; padding: 0 2em;">
        <form>
            <textarea style="display:block; width:80%;" placeholder="<?php echo 'Comment...' ?>" id="comment"></textarea>
            <input style="display:block; width:80%;" type="submit" id="submit">
        </form>
        <div id="errorsDiv" style="display:none;">Comment must not exceed 120 characters</div>
        <div id="charCount"></div>
    </div>

    <div id="comments" style="width: 50%; padding: 0 2em; max-height: 10em; overflow-y: scroll;"></div>
</div>




<script>
    var comments = '<?php echo $comments; ?>';
    var commentsDiv = document.getElementById('comments');
    comments = comments.replace(/\[|\]/g, '');
    if(comments.length <= 0) {
        document.getElementById('comments').innerHTML = 'Be the first to comment on this post';
    } else {
        comments = comments.split(',');
        for(var i = 0; i<comments.length; i++) {
            comments[i] = JSON.parse(comments[i]);
            commentsDiv.innerHTML +=
                `<div style="border-bottom:1px solid black;">${comments[i].comment}</div>`;
        }
    }

    document.getElementById('comment').addEventListener("input", handleCommentChange);

    function handleCommentChange(event) {
        var submitBtn = document.getElementById('submit');
        var errorsDiv = document.getElementById('errorsDiv');
        var charCountDiv = document.getElementById('charCount');
        if(event.target.value) {
            charCountDiv.innerHTML = event.target.value.length + '/120 characters';
            if (event.target.value.length > 120) {
                errorsDiv.style.display = 'inline-block';
                submitBtn.disabled = true;
            } else {
                errorsDiv.style.display = 'none';
                submitBtn.disabled = false;
            }
        }
    }
</script>