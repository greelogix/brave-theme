<?php
$parent_programs = get_posts([
    'post_type' => 'program',
    'post_parent' => 0,
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);

$num_programs = count($parent_programs);

function getColumnClasses($num_programs)
{
    switch ($num_programs) {
        case 1:
            return 'sm:grid-cols-1 lg:grid-cols-1 max-w-4xl';
        case 2:
            return 'sm:grid-cols-2 max-w-4xl';
        case 3:
            return 'sm:grid-cols-3';
        default:
            return 'sm:grid-cols-3 lg:grid-cols-4';
    }
}

$column_classes =  getColumnClasses($num_programs);
?>
<div class="mt-6 mx-auto items-center px-2 grid grid-cols-1 gap-y-10 sm:gap-x-6 sm:gap-y-0 lg:gap-x-8 <?php echo $column_classes; ?>">
    <?php foreach ($parent_programs as $program) {
        $featured_image = get_the_post_thumbnail_url($program->ID, 'large');
    ?>
        <div class="overflow-hidden rounded-lg bg-white shadow relative">
            <a class="absolute inset-0" href="<?php echo get_permalink($program->ID); ?>">
                <span class="sr-only"><?php echo $program->post_title; ?></span>
            </a>
            <div class="h-48 bg-cover" style="background-image: url('<?php echo $featured_image; ?>')">
            </div>
            <div class="px-4 py-5 sm:p-6">
                <!-- title -->
                <h3 class="text-lg font-medium leading-6">
                    <?php echo $program->post_title; ?>
                </h3>
                <!-- content -->
                <div class="mt-2 text-sm leading-5 text-gray-500">
                    <?php echo $program->post_excerpt ? $program->post_excerpt : wp_trim_words($program->post_content, 50); ?>
                </div>
            </div>
        </div>

    <?php } ?>


</div>
<div class="text-center mt-10">
    <a href="/programs" class="gs-button gs-button--primary">
        View All Programs
    </a>
</div>