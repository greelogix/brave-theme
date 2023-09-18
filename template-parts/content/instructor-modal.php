<div class="relative z-10" id="instructor-<?php echo $args['id']; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
    <div data-backdrop class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" style="display: none;"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto" data-outer>
        <div class="flex min-h-full justify-center p-4 sm:p-0">
            <div data-content class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-3xl sm:p-6" style="display: none;">
                <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                    <button type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div>
                    <img class="w-full object-cover sm:w-full" src="<?php echo $args['image']; ?>" alt="">
                    <div class="mt-3 sm:mt-5">
                        <h3 class="text-xl font-medium leading-6 text-gray-900">
                            <?php echo $args['title']; ?>
                        </h3>
                        <?php
                        if (isset($args['position'])) { ?>
                            <p class="text-sm mt-1 mb-4 font-medium uppercase text-gray-500">
                                <?php echo $args['position']; ?>
                            </p>
                        <?php } ?>
                        <div class="mt-2 prose">
                            <?php echo $args['content']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>