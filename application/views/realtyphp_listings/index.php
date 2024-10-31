<div class="wrap">

<h2><?php _e('Listings', 'realtyphp') ?><a href="?page=realtyphp_listings&action=create" 
	class="add-new-h2"><?php _e('Add new', 'realtyphp'); ?></a></h2>

<form method="post">
	 <input type="hidden" name="page" value="realtyphp_listings" />	
    <?php $listings_table->search_box(__('search by ID'), 'search_id'); ?>
</form>
    
<form id="movies-filter" method="get">
    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
    <?php $listings_table->display(); ?>
</form>


</div>