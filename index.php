<?php /* Template Name: Inicio */ ?>
<?php get_header() ?>
<?php $metas = get_post_meta($post->ID) ?>
<?php 
	$args = array('post_type'=>'equipo','post_status'=>'publish');
	$equipo = new WP_Query( $args ); 

	$args2 = array('post_type'=>'servicio','post_status'=>'publish');
	$servicios = new WP_Query( $args2 ); 
?>
<section id="inicio" style="background-image:url(<?=imgUrl($post->ID)?>)">

</section>
<section id="quienes-somos">
<?php require get_template_directory() . '/image/psi.svg'; ?>
	<div class="container py-5">
		<div class="row pt-5">
			<div class="col-6 col-sm-6 col-md-6 col-lg-6">
				<?=apply_filters('content', $metas['quienes_somos'][0])?>
			</div>
			<div class="col-6 col-sm-6 col-md-6 col-lg-6">
				<img src="<?=wp_get_attachment_url( $metas['imagen_about'][0] )?>" class="img-fluid"/>
			</div>
		</div>
	</div>
	<div class="container-fluid pb-5">
		<div class="row py-5">
			<div class="col-6 col-sm-6 col-md-6 col-lg-6 d-flex justify-content-end px-0">
				<img src="<?=wp_get_attachment_url( $metas['imagen_2'][0] )?>" class="img-fluid"/>
			</div>
			<div class="col-6 col-sm-6 col-md-6 col-lg-6 blue d-flex align-items-center justify-content-center">
				<div class="col-12 col-sm-11 col-md-10 col-lg-10">
					<?=apply_filters('content', $metas['contenido_2'][0])?>
				</div>
			</div>
		</div>
	</div>
	</section>
<section id="equipo" class="py-5">
	<div class="container py-5">
		<div class="row">
			<div class="col-12">
				<div class="splide" aria-label="Splide Basic HTML Example">
					<div class="splide__track">
						<ul class="splide__list">
							<?php foreach ($equipo->posts as $o):?>
								<div class="splide__slide">
									<div class="item">
										<img src="<?=imgUrl($o->ID)?>" alt="">
										<div class="p-2">
											<h5 class="text-center"><?=$o->post_title?></h5>
											<hr>
											<?=apply_filters('content', $o->post_content);?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="servicios">
	<div class="container py-5">
		<div class="row">
			<div class="col-12 col-sm-6 col-md-4 col-lg-3 img">
				<?=apply_filters('content', $metas['titulo'][0])?>
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-9 px-4">
				<?=apply_filters('content', $metas['contenidoqo'][0])?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row justify-content-center">
			<?php foreach ($servicios->posts as $o):?>
				<div class="col-4 col-sm-6 col-lg-4 col-lg-3">
					<div class="service">
						<img src="<?=imgUrl($o->ID)?>" alt="">
						<h5 class="text-center"><?=$o->post_title?></h5>
						<button class="viewmore">VER MÁS</button>
						<div class="contentItem" hidden>
							<div class="images">
								<svg width="542" height="199" viewBox="0 0 542 199" fill="none" class="red" xmlns="http://www.w3.org/2000/svg">
									<rect x="0.5" y="0.5" width="541" height="198" stroke="white"/>
									<line x1="24.5" y1="-2.18557e-08" x2="24.5" y2="199" stroke="white"/>
									<line x1="50.5" y1="-2.18557e-08" x2="50.5" y2="199" stroke="white"/>
									<line x1="76.5" y1="-2.18557e-08" x2="76.5" y2="199" stroke="white"/>
									<line x1="102.5" y1="-2.18557e-08" x2="102.5" y2="199" stroke="white"/>
									<line x1="128.5" y1="-2.18557e-08" x2="128.5" y2="199" stroke="white"/>
									<line x1="154.5" y1="-2.18557e-08" x2="154.5" y2="199" stroke="white"/>
									<line x1="180.5" y1="-2.18557e-08" x2="180.5" y2="199" stroke="white"/>
									<line x1="206.5" y1="-2.18557e-08" x2="206.5" y2="199" stroke="white"/>
									<line x1="232.5" y1="-2.18557e-08" x2="232.5" y2="199" stroke="white"/>
									<line x1="258.5" y1="-2.18557e-08" x2="258.5" y2="199" stroke="white"/>
									<line x1="284.5" y1="-2.18557e-08" x2="284.5" y2="199" stroke="white"/>
									<line x1="310.5" y1="-2.18557e-08" x2="310.5" y2="199" stroke="white"/>
									<line x1="336.5" y1="-2.18557e-08" x2="336.5" y2="199" stroke="white"/>
									<line x1="362.5" y1="-2.18557e-08" x2="362.5" y2="199" stroke="white"/>
									<line x1="388.5" y1="-2.18557e-08" x2="388.5" y2="199" stroke="white"/>
									<line x1="414.5" y1="-2.18557e-08" x2="414.5" y2="199" stroke="white"/>
									<line x1="440.5" y1="-2.18557e-08" x2="440.5" y2="199" stroke="white"/>
									<line x1="466.5" y1="-2.18557e-08" x2="466.5" y2="199" stroke="white"/>
									<line x1="492.5" y1="-2.18557e-08" x2="492.5" y2="199" stroke="white"/>
									<line x1="518.5" y1="-2.18557e-08" x2="518.5" y2="199" stroke="white"/>
									<line x1="-4.37114e-08" y1="24.5" x2="542" y2="24.5" stroke="white"/>
									<line x1="-4.37114e-08" y1="49.5" x2="542" y2="49.5" stroke="white"/>
									<line x1="-4.37114e-08" y1="74.5" x2="542" y2="74.5" stroke="white"/>
									<line x1="-4.37114e-08" y1="99.5" x2="542" y2="99.5" stroke="white"/>
									<line x1="-4.37114e-08" y1="124.5" x2="542" y2="124.5" stroke="white"/>
									<line x1="-4.37114e-08" y1="149.5" x2="542" y2="149.5" stroke="white"/>
									<line x1="-4.37114e-08" y1="174.5" x2="542" y2="174.5" stroke="white"/>
								</svg>
								<img src="<?=imgUrl($o->ID)?>" class="img-fluid">
							</div>
							<?=apply_filters('content', $o->post_content);?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="container-fluid mt-4 pt-4">
		<div class="row d-flex align-items-center text-center">
			<div class="col-12 col-sm-12 col-md-3 col-lg-3 px-0">
				<div class="green">
					<h2>MODALIDAD<br>PRESENCIAL</h2>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6 px-0">
				<img src="<?=get_template_directory_uri()?>/image/middle.png" class="img-fluid">
			</div>
			<div class="col-12 col-sm-12 col-md-3 col-lg-3 px-0">
				<div class="green">
					<h2>MODALIDAD<br>EN LÍNEA</h2>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="contacto">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11177.390347477436!2d-89.61086255302355!3d20.964602831174222!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f56711251fa1b45%3A0xbb80e9e83bca46d7!2sCAPSI!5e0!3m2!1ses!2smx!4v1683700290805!5m2!1ses!2smx" style="width:100%;" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
<div id="myModal" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
		<svg width="58" height="58" viewBox="0 0 58 58" fill="none" class="close" data-bs-dismiss="modal" xmlns="http://www.w3.org/2000/svg">
			<circle cx="29" cy="29" r="29" fill="#00B6D6"/>
			<path d="M17 17L42 42" stroke="white" stroke-width="5" stroke-linejoin="round"/>
			<path d="M42 17L17 42" stroke="white" stroke-width="5" stroke-linejoin="round"/>
		</svg>
      <div class="modal-body text-center">
        <p>Modal body text goes here.</p>
      </div>
    </div>
  </div>
</div>
<?php
get_footer();
