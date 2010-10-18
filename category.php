<?php
/*
Template Name: カテゴリ別一覧
*/



/**
 * このカテゴリリストの機能について、
 * このカテゴリリストは、現在のカテゴリに、$my_tagsに、指定したタグが存在する場合　
 * タグ名ごとに、区分して、現在のタグを含む一覧を表示します。
 *
 * 例えば、カテゴリ名に、エントリ１にカテゴリ「実用書」タグ、園芸、
 * エントリ2に「実用書」タグ、料理　エントリ3に「実用書」タグ、冠婚葬祭　とした場合
 * カテゴリリンク　実用書をクリックすると、園芸　実用書　冠婚葬祭の各項目の下に、それぞれの投稿が並びます。
 * 本屋などの、カテゴリ別の、本リストのように整然と、関連項目ごとに整理できます。
 *
 * $my_tags　が空の場合は、通常のカテゴリリストを表示します。
 */
 
 
?>
<?php get_header("xhtml1"); ?>
<?php
/**
 * リストとして表示する項目となる　タグを指定します。
 *
 *
 */
//$my_tags = array("coffee"); 
?>

<div id="yui-main">
<!--<?php echo basename(__FILE__,'.php');?>[<?php echo basename(dirname(__FILE__));?>]-->
<div class="yui-b">
<!--main-->
<!-- Use Standard Nesting Grids and Special Nesting Grids to subdivid regions of your layout. -->
<!-- Special Nesting Grid C has two children, the first is 2/3, the second is 1/3 -->
<?php
		if(function_exists('bcn_display')){
		/**
		 * Display the breadcrumb
		 * plugin:http://mtekk.weblogs.us/code/breadcrumb-navxt/
		 *
		 */
		
		echo '<div class="breadcrumb">';
		bcn_display();
		echo '</div>';
		}
	?>
<div class="<?php echo $yui_inner_layout;?>">
<!-- content -->
<div class="yui-u first <?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>

  <?php if(isset($my_tags) and !empty($my_tags)){
        
		$class = 'class="'.basename(__FILE__,'.php').' my_tags"';
		}else{
		$class = 'class="'.basename(__FILE__,'.php').'"';
		}?>
  <?php

// 一覧表示させるタグ を設定
if(isset($my_tags) and !empty($my_tags)){
	
	foreach ( $my_tags as $my_tag ) :
	/**
	 *カテゴリ category
	 *リンクカテゴリーを表す「link_category」
	 *タグ「post_tag」
	 *
	 *
	 */

		$tag_obj  = get_term_by( 'name', $my_tag, 'post_tag' );
	/**
	 * オブジェクトがなければ、continue;以下をスキップして次のループへ移る
	 *
	 *
	 */
		if ( !$tag_obj ) continue; 
	/**
	 * オブジェクトから、idを取得
	 *
	 *
	 */
		$tag_ID   = $tag_obj->term_id;
	/**
	 * カテゴリIDとタグIDでクエリ
	 *
	 *'category__in', 'category__not_in', 'category__and',
	 * 'post__in', 'post__not_in','tag__in', 'tag__not_in',
	 * 'tag__and', 'tag_slug__in', 'tag_slug__and'
	 */
		$my_args  = array(
		   'cat' => get_query_var( 'cat' ),// comma separated list of positive or negative integers
			'tag__and' => array( $tag_ID ),
		);
	/**
	 * @http://www.tig12.net/downloads/apidocs/wp/wp-includes/WP_Query.class.html
	 * 　
	 *　インスタンスを作成
	 */
		$my_query = new WP_Query( $my_args );
	/**
	 * 投稿があれば、リスト表示する
	 * 　
	 *
	 */
	 


		
		if ( $my_query->have_posts() ){
	?>
  <h2 class="h2"><a href="<?php echo get_tag_link( $tag_ID ); ?>"><?php echo $my_tag; ?></a></h2>
  <dl <?php echo $class;?>>
    <?php        while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
    <dd><a href="<?php the_permalink(); ?>" title="<?php the_time('Y年n月j日'); ?>">
      <?php the_title(); ?>
      </a>&nbsp;
      <?php edit_post_link('Edit', '', '  '); ?>
    </dd>
    <?php   endwhile; ?>
  </dl>
  <?php  } endforeach; ?>

<?php

		  
}else{

	if (have_posts()){ ?>
<h2 <?php echo $class;?>>
  <?php the_category('&nbsp;,&nbsp;') ?>
</h2>
<ul <?php echo $class;?>>
<li>
  <div style="width:120px;float:left">Tags</div>
  <div style="margin-left:130px;">Title</div>
</li>
<?php while (have_posts()) : the_post(); ?>
<li <?php post_class() ?> id="post-<?php the_ID(); ?>">
  <div style="width:120px;float:left">
    <?php the_tags('', ', ', ''); ?>
    
  </div>
  <div style="margin-left:130px;"> <strong><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>   <?php the_time('Y年n月j日'); ?>  by <?php the_author() ?>">
    <?php the_title(); ?>
    </a></strong>&nbsp;<?php comments_popup_link('', '　1 コメント', '　% コメント'); ?>
    <?php edit_post_link('Edit', '', ''); ?>
  </div>
  <br style="clear:both;" />
</li>
<?php endwhile; ?>
</ul>

<?php } ?>
<?php
}

?>
</div>
<!-- navigation-->
<div class="yui-u">
  <!--rsidebar start-->
  <?php if($rsidebar_show){get_sidebar('2');} ?>
  <!--rsidebar end-->
</div>
<!--add col here -->
</div>
<!--main-->
</div>
</div>
<!--sidebar-->
<!-- navigation 2 -->
<div class="yui-b">
  <!--lsidebar start-->
  <?php get_sidebar('1'); ?>
  <!--lsidebar end-->
</div>
<!-- navigation 2 -->
<!--sidebar-->
</div>

<?php get_footer(); ?>