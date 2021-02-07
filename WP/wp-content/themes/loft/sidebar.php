<!-- sidebar-->
<div class="sidebar">

    <?php if($tags=get_terms(array('taxonomy'=>'post_tag', 'hide_empty'=>false))):?>

    <div class="sidebar__sidebar-item">
        <div class="sidebar-item__title">Теги</div>
        <div class="sidebar-item__content">
            <ul class="tags-list">
                <?php foreach( $tags as $tag) : ?>
                <li class="tags-list__item"><a href="<?php echo get_term_link($tag)?>" class="tags-list__item__link"><?php echo $tag->name ?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
   <?php endif;?>

    <?php if($categories=get_categories('hide_empty=0')):?>
    <div class="sidebar__sidebar-item">
        <div class="sidebar-item__title">Категории</div>
        <div class="sidebar-item__content">
            <ul class="category-list">
                <li class="category-list__item"><a href="#" class="category-list__item__link">
                        Акции</a>
                    <ul class="category-list__inner">
                        <?foreach($categories as $keys) :?>
                        <? if( $keys->name !== 'Без рубрики'):?>
                        <li class="category-list__item"><a href="<?php echo get_category_link( $keys)?>" class="category-list__item__link"><?php echo $keys->name ?></a></li>
                        <?endif;?>
                        <?endforeach;?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <?php endif;?>
    <?php dynamic_sidebar( 'MEC Single Sidebar' ); ?>
</div>
