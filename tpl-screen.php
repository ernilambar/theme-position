<?php
/**
 * Template Name: Screen
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme_Position
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			$all_themes = theme_position_get_all_themes();
			// nspre( $all_themes );
			?>

			<div id="main-screen">
				<div class="container">

					<?php if ( ! empty( $all_themes ) ) : ?>

						<ul>

							<?php foreach ( $all_themes as $theme ) : ?>
								<li>
									<a href="<?php echo esc_url( 'https://themes.trac.wordpress.org/ticket/' . $theme['id'] ); ?>" target="_blank" title="<?php echo esc_attr( $theme['name'] ); ?>">
									<img src="<?php echo get_template_directory_uri() . '/images/no-image.png'; ?>" alt="<?php echo esc_attr( $theme['name'] ); ?>" />
									</a>
								</li>
							<?php endforeach; ?>

						</ul>

					<?php else : ?>
						<p>Error</p>
					<?php endif; ?>

				</div><!-- .container -->
			</div><!-- #main-screen -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
