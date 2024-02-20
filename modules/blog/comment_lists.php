<?php
$commentLists = getRaw("SELECT * FROM comments WHERE blog_id=$id AND status=1 ORDER BY create_at DESC");
?>
<div class="blog-comments">
  <h2 class="title"><?php echo count($commentLists) > 1 ? count($commentLists) . ' Comments Found!' : count($commentLists) . ' Comment Found!'; ?></h2>
  <div class="comments-body">
    <?php
    if (!empty($commentLists)) :
      foreach ($commentLists as $item) :
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
                <p><span><?php echo getDateFormat($item['create_at'], 'd M, Y'); ?> at<i class="fa fa-clock-o"></i><?php echo getDateFormat($item['create_at'], 'h:i A'); ?>,</span><a href="#"><i class="fa fa-comment-o"></i>replay</a></p>
              </div>
              <p><?php echo $item['content']; ?></p>
            </div>
          </div>
          <!-- <div class="comment-list">
        <div class="head">
          <img src="images/client2.jpg" alt="#">
        </div>
        <div class="body">
          <h4>Josep Bambo</h4>
          <div class="comment-info">
            <p><span>03 May, 2018 at<i class="fa fa-clock-o"></i>12:40PM,</span><a href="#"><i class="fa fa-comment-o"></i>replay</a></p>
          </div>
          <p>sagittis ex consectetur sed. Ut viverra elementum libero, nec tincidunt orci vehicula quis</p>
        </div>
      </div> -->
        </div>
        <!--/ End Single Comments -->
      <?php endforeach; else : ?>
      <div class="alert">
        <span class="closebtn" style="cursor: pointer;" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Sorry!</strong> No comments found
      </div>
    <?php endif; ?>
  </div>
</div>