<?php
/**
 *
 * Template name: Contato
 *
 * @package Odin
 * @since 2.2.0
 */

get_header(); ?>
	<div class="col-md-12">
		<div class="container">
			<div class="row">
				<main id="content" class="<?php echo odin_classes_page_full(); ?>" tabindex="-1" role="main">

				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					endwhile;
				?>
				</main><!-- #main -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .col-md-12 -->
<?php
get_footer();
