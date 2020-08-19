<?php require APPROOT . '/views/inc/header.php'; ?>
<h1>This one come from <?php echo $data['title']; ?></h1>
<ul>
    <?php foreach($data['post'] as $post) : ;?>
        <li>
            <?php echo $post->title ;?>        
        </li>
    <?php endforeach ;?>
</ul>
<?php require APPROOT . '/views/inc/footer.php'; ?>
