<div class="testimoniales-container">
    <?php foreach($testimonials as $testimonial) : ?>
    <div class="testimonial">
        <blockquote><?php echo $testimonial->review; ?></blockquote>
        <p><?php echo $testimonial->name; ?></p>
    </div>
    <?php endforeach; ?>
</div>