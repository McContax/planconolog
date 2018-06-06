<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Plan_Conolog
 * @since 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
			<div id="site-generator">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'planconolog' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'planconolog' ); ?>"><?php printf( __( 'Proudly powered by %s', 'planconolog' ), 'WordPress' ); ?></a>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>