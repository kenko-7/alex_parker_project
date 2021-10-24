<?php 
/*
    ./app/views/categories.index.php
*/
?>

<ul class="menu-link">
    <?php foreach ($categories as $category):?>
	<li><a href="index.html"> <?php echo $category['name'];?>
                              <?php foreach ($nbrPosts as $nbrPost): ?>
                              <?php if($nbrPost['category_id'] === $category['id']): ?>[<?php echo $nbrPost['nbrPostsByCategory']; ?>]
                              <?php endif; ?>
                              <?php endforeach; ?>
    </a></li>                         
    <?php endforeach; ?>
</ul>