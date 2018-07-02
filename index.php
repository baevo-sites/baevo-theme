<?php
$context = Timber::get_context();
$context['services'] = get_field('services');
Timber::render( 'index.twig', $context );
?>