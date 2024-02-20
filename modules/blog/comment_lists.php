<?php
$commentLists = getRaw("SELECT * FROM comments WHERE blog_id=$id AND status=1 ORDER BY create_at DESC");
$commentData = [];
?>
<div class="blog-comments">
  <h2 class="title"><?php echo count($commentLists) > 1 ? count($commentLists) . ' Comments Found!' : count($commentLists) . ' Comment Found!'; ?></h2>
  <div class="comments-body">
    <?php
    if (!empty($commentLists)) :
      foreach ($commentLists as $item) :
        $commentData[$item['id']] = $item;
        if ($item['parent_id'] == 0) :
    ?>
          <!-- Single Comments -->
          <div class="single-comments">
            <div class="main">
              <div class="head">
                <img src="<?php echo getAvatar($item['email']); ?>" alt="#">
              </div>
              <div class="body">
                <h4><?php echo $item['name']; ?></h4>
                <div class="comment-info">
                  <p><span><?php echo getDateFormat($item['create_at'], 'd M, Y'); ?> at<i class="fa fa-clock-o"></i><?php echo getDateFormat($item['create_at'], 'h:i A'); ?>,</span><a href="<?php echo _WEB_HOST_ROOT . '?module=blog&action=detail&id=' . $id . '&comment_id=' . $item['id']; ?>#comment-form"><i class="fa fa-comment-o"></i>reply</a></p>
                </div>
                <p><?php echo $item['content']; ?></p>
              </div>
            </div>
            <?php getCommentList($commentLists, $item['id'], $id); ?>
          </div>
          <!--/ End Single Comments -->
      <?php endif; endforeach; else : ?>
      <div class="alert">
        <span class="closebtn" style="cursor: pointer;" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Sorry!</strong> No comments found
      </div>
    <?php endif; ?>
  </div>
</div>