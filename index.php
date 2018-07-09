<?php
$context = Timber::get_context();
$context['services'] = get_field('services');
$context['portfolio'] = get_field('portfolio');
$context['works'] = Timber::get_posts(array(
  'post_type' => 'works',
  'post_status' => 'publish',
  'posts_per_page' => '9'
));
$context['process'] = get_field('process');
$context['about'] = get_field('about');
$context['contact'] = get_field('contact');
Timber::render( 'index.twig', $context );
?>