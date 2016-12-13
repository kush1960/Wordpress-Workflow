<?php
// component

// defaults
if(!isset($cJokes)){
	$cJokes = getDefaults();
} ?>



<div class="cExample">
	<div class="tab"><?php echo $cJokes['tabTitle']; ?></div>
	<h1><?php echo $cJokes['title']; ?></h1>
	<p><?php echo $cJokes['content']; ?></p>
	<a class="cta" href="<?php echo $cJokes['ctaLink']; ?>"><?php echo $cJokes['cta']; ?></a>
</div>




<?php ////////////////////////////////////////////////////////////////////////



function getDefaults(){
	$defaults = array();
	$defaults['title'] = 'Kevin Potato';
	$defaults['tabTitle'] = 'Latest vegtable news';
	$defaults['content'] = 'Bacon ipsum dolor amet bacon cupim ribeye swine, spare ribs jerky landjaeger shank tongue shankle short ribs jowl tenderloin burgdoggen prosciutto. Ham short loin capicola filet mignon swine pork. Flank short loin prosciutto capicola ham hock shankle ground round tongue pig chicken beef ribs. Spare ribs short ribs chuck, tail burgdoggen bacon porchetta ribeye tenderloin chicken landjaeger corned beef turkey.';
	$defaults['cta'] = 'Grow your own';
	$defaults['ctaLink'] = 'http://www.suttons.co.uk/';
	return $defaults;	
}


// Docs for Style Guide in plain HTML.
if($docs){ ?>

	<h2>Best used on hot days. </h2>

<?php
}
unset($cJokes);
?>