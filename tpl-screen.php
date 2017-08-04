<?php
/**
 * Template Name: Screen
 *
 * @package Theme_Position
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			$all_themes = theme_position_get_all_themes();
			$all_themes = array_reverse( $all_themes );
			?>

			<div id="main-screen">
				<div class="container">

					<p>This is the list of themes in the Review queue. It takes a while to load all screenshots. Please be patient.</p>

					<?php if ( ! empty( $all_themes ) ) : ?>

						<ul>

							<?php foreach ( $all_themes as $theme ) : ?>
								<?php
									$screenshot_url = 'https://themes.svn.wordpress.org/' . $theme['slug'] . '/' . $theme['version'] . '/screenshot.png';
								 ?>
								<li>
									<a href="<?php echo esc_url( 'https://themes.trac.wordpress.org/ticket/' . $theme['id'] ); ?>" target="_blank" title="<?php echo esc_attr( $theme['name'] ); ?>">
									<img class="lazy" src="<?php echo get_template_directory_uri() . '/images/ajax-loader.gif'; ?>" alt="<?php echo esc_attr( $theme['name'] ); ?>" data-src="<?php echo esc_url( $screenshot_url ); ?>" />
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
get_footer();
