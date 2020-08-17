<?php $terms = get_terms( ['taxonomy' => 'sport'] );
if ( !empty( $terms ) && is_array($terms) ): ?>
	<ul class="nav nav-pills my-4">
		<?php foreach ( $terms as $sport ): ?>
			<li class="nav-item">
				<a class="nav-link <?= is_tax( "sport", $sport ) ? "active" : " "; ?>"
				   href="<?= get_term_link( $sport ); ?>"> <?= $sport->name; ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
