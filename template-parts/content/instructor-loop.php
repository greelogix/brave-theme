<!-- loop through all instructors -->
<?php
$posts_per_page = $args['num_instructors'] ?? -1;
$instructor_args = array(
    'post_type' => 'instructor',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'menu_order',
    'order' => 'ASC'
);
$instructors = get_posts($instructor_args); ?>
<div class="mt-6 px-2 grid grid-cols-1 gap-y-10 sm:gap-x-6 sm:gap-y-10 lg:gap-x-8 sm:grid-cols-2 lg:grid-cols-3">
    <?php
    foreach ($instructors as $instructor) {
        $featured_image = get_the_post_thumbnail_url($instructor->ID, 'large');
        $excerpt = wp_trim_words($instructor->post_content, 40) . '...' . '<span class="text-primary" href="#">Read More</span>';
    ?>
        <div class="overflow-hidden rounded-lg bg-white shadow relative">
            <a class="absolute inset-0" href="#" data-modal-id="instructor-<?php echo $instructor->ID; ?>">
                <span class="sr-only"><?php echo $instructor->post_title; ?></span>
            </a>
            <div class="h-96 bg-cover" style="background-image: url('<?php echo $featured_image; ?>')">
            </div>
            <div class="px-4 py-5 sm:p-6 prose">
                <!-- title -->
                <h3 class="text-xl font-medium leading-6 text-gray-900">
                    <?php echo $instructor->post_title; ?>
                </h3>
                <p class="text-sm -mt-2 font-medium uppercase text-gray-500">
                    <?php echo get_field('position', $instructor->ID); ?>
                </p>
                <!-- content -->
                <div class="mt-2 text-sm leading-5 text-gray-500">
                    <?php echo $excerpt; ?>
                </div>
            </div>
        </div>

        <!-- modal -->
        <?php echo get_template_part('template-parts/content/instructor-modal', null, [
            'title' => $instructor->post_title,
            'content' => $instructor->post_content,
            'position' => get_field('position', $instructor->ID),
            'id' => $instructor->ID,
            'image' => $featured_image,
        ]); ?>
    <?php
    }
    ?>
</div>

<script>
    // Get all instructor modal buttons
    const instructorModalButtons = document.querySelectorAll('[data-modal-id]');

    // Loop through all instructor modal buttons
    instructorModalButtons.forEach(button => {
        // Get the modal id from the button
        const modalId = button.dataset.modalId;

        // Get the modal element
        const modal = document.getElementById(modalId);

        // Get the close button
        const closeButton = modal.querySelector('button');
        const backdrop = modal.querySelector('[data-backdrop]');
        const content = modal.querySelector('[data-content]');
        const outer = modal.querySelector('[data-outer]');

        // Add click event listener to the button
        button.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            // Show the modal
            modal.style.display = 'block';
            // show the backdrop
            backdrop.style.display = 'block';
            // show the content
            content.style.display = 'block';
        });

        // Add click event listener to the close button
        closeButton.addEventListener('click', () => {
            // Hide the modal
            modal.style.display = 'none';
            backdrop.style.display = 'none';
            content.style.display = 'none';
        });

        // Add click event listener to the background backdrop
        outer.addEventListener('click', (e) => {
            e.stopPropagation();

            // Hide the modal
            modal.style.display = 'none';
            backdrop.style.display = 'none';
            content.style.display = 'none';
        });

        content.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    });
</script>