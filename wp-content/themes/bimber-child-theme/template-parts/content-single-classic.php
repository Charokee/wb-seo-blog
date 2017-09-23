<?php
/**
 * The default template for displaying single post content (with sidebar).
 * This is a template part. It must be used within The Loop.
 *
 * @package Bimber_Theme 4.10
 */

$bimber_entry_data = bimber_get_template_part_data();
$bimber_elements   = $bimber_entry_data['elements'];

$queried_object = get_queried_object();
$post_description = get_field('post_description', $queried_object);

?>

<?php
if ( bimber_show_breadcrumbs() ) :
	bimber_render_breadcrumbs();
endif;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-tpl-classic' ); ?> itemscope="" itemtype="<?php echo esc_attr( bimber_get_entry_microdata_itemtype() ); ?>">
	<header class="entry-header entry-header-01">
		<?php
		if ( $bimber_elements['categories'] ) :
			bimber_render_entry_categories( array(
				'use_microdata' => true,
			) );
		endif;
		?>

		<?php bimber_render_entry_flags( array( 'show_collections' => false ) ); ?>

		<?php the_title( '<h1 class="g1-mega g1-mega-1st entry-title" itemprop="headline">', '</h1>' ); ?>

		<?php echo $post_description; ?>

		<?php
		if ( bimber_can_use_plugin( 'wp-subtitle/wp-subtitle.php' ) ) :
			the_subtitle( '<h2 class="entry-subtitle g1-gamma g1-gamma-3rd" itemprop="description">', '</h2>' );
		endif;
		?>
		<?php get_template_part( 'template-parts/snax-bar-item' ); ?>
		<?php if ( $bimber_elements['author'] || $bimber_elements['date'] || $bimber_elements['views'] || $bimber_elements['comments_link'] ) : ?>
			<p class="entry-meta entry-meta-m">
				<span class="entry-meta-wrap">
						<?php
						if ( $bimber_elements['author'] ) :
							bimber_render_entry_author( array(
								'avatar'        => $bimber_elements['avatar'],
								'avatar_size'   => 40,
								'use_microdata' => true,
							) );
						endif;
						?>

						<?php
						if ( $bimber_elements['date'] ) :
							bimber_render_entry_date( array( 'use_microdata' => true ) );
						endif;
						?>
				</span>

				<span class="entry-meta-wrap">

					<?php
					if ( $bimber_elements['views'] ) :
					    bimber_render_entry_view_count();
					endif;
					?>

					<?php
					if ( $bimber_elements['comments_link'] ) :
					    bimber_render_entry_comments_link();
					endif;
					?>
				</span>
			</p>
		<?php endif; ?>

		<?php bimber_render_top_share_buttons(); ?>

	</header>

	<?php
	if ( bimber_show_entry_featured_media( $bimber_elements['featured_media'] ) ) :
		bimber_render_entry_featured_media( array(
			'size'          => 'bimber-grid-2of3',
			'class'         => 'entry-featured-media-main',
			'use_microdata' => true,
			'apply_link'    => false,
			'show_caption'  => true,
			'allow_video'   => true,
		) );
	endif;
	?>

	<div class="g1-content-narrow g1-typography-xl entry-content" itemprop="articleBody">
		<?php the_content(); ?>
	</div>

	<?php
	do_action( 'bimber_after_single_content', array(
		'layout' => 'with-sidebar',
		'elements'  => $bimber_elements,
	) );
	?>
</article>

<?php
if ( bimber_is_post_flyin_nav_enabled() ) :
	get_template_part( 'template-parts/post/flyin-next-prev' );
endif;
