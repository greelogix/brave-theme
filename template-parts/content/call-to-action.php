<?php
// get program post types
$programs = get_posts(array(
    'post_type' => 'program',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    'post_parent__not_in' => array(0),
    'meta_query' => array(
        array(
            'key' => 'free_trial',
            'value' => 1,
            'compare' => 'LIKE'
        )
    )
));
?>
<div class="bg-white">
    <div class="px-6 py-12 sm:px-6 sm:py-18 lg:px-8">
        <div class="mx-auto text-center">
            <h2 class="text-3xl font-bold sm:text-4xl">
                <?php echo get_field('cta_headline', 'option'); ?>
            </h2>
            <?php if (get_field('cta_body', 'option')) : ?>
                <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-gray-600">
                    <?php echo get_field('cta_body', 'option'); ?>
                </p>
            <?php endif; ?>
            <form method="post" id="cta-form">
                <div id="form-content">
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <!-- first name -->
                        <div class="w-full">
                            <label for="first_name" class="sr-only">First name</label>
                            <input type="text" name="first_name" id="first_name" autocomplete="given-name" class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="First name">
                            <!-- error -->
                            <div class="text-red-500 text-sm" id="first_name_error" style="display: none;">
                                Please enter your first name.
                            </div>
                        </div>
                        <!-- last name -->
                        <div class="w-full">
                            <label for="last_name" class="sr-only">Last name</label>
                            <input type="text" name="last_name" id="last_name" autocomplete="family-name" class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Last name">
                            <!-- error -->
                            <div class="text-red-500 text-sm" id="last_name_error" style="display: none;">
                                Please enter your last name.
                            </div>
                        </div>
                        <!-- email -->
                        <div class="w-full">
                            <label for="email" class="sr-only">Email</label>
                            <input id="email" name="email" type="email" autocomplete="email" class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Email">
                            <!-- error -->
                            <div class="text-red-500 text-sm" id="email_error" style="display: none;">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <!-- phone -->
                        <div class="w-full">
                            <label for="phone" class="sr-only">Phone</label>
                            <input id="phone" name="phone" type="tel" autocomplete="tel" class="block w-full px-4 py-3 text-gray-900 placeholder-gray-500 border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Phone">
                            <!-- error -->
                            <div class="text-red-500 text-sm" id="phone_error" style="display: none;">
                                Please enter a valid phone number.
                            </div>
                        </div>
                        <input type="hidden" name="incentive" value="Free Trial" />
                        <!-- Trial Type -->
                        <div class="w-full">
                            <label for="trial_type" class="sr-only">Trial Type</label>
                            <select id="trial_type" name="trial_type" autocomplete="trial_type">
                                <option value="">Trial Type</option>
                                <?php foreach ($programs as $program) {
                                    echo '<option value="' . $program->post_title . '">' . $program->post_title . '</option>';
                                } ?>
                            </select>
                            <!-- error -->
                            <div class="text-red-500 text-sm" id="trial_type_error" style="display: none;">
                                Please select a trial type.
                            </div>
                        </div>

                    </div>
                    <div class="w-full mt-3">
                        <button type="submit" class="gs-button gs-button--primary w-full" id="submit-button">
                            Submit
                        </button>
                    </div>
                    <?php wp_nonce_field('lead_capture', 'security-code-here'); ?>
                    <input name="action" value="lead_capture" type="hidden">
                </div>

                <div id="success-message" class="mt-5 text-green-500 text-lg" style="display:none">
                </div>
                <div id="error-message" class="mt-5 text-red-500 text-sm" style="display:none"></div>
            </form>
        </div>
    </div>
</div>