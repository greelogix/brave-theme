<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the `#content` element and all content thereafter.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package brave
 */
$is_contact_page = get_page_by_path('contact') ?: get_page_by_path('contact-us');
?>

</div><!-- #content -->

<?php get_template_part('template-parts/layout/footer', 'content'); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

<script>
    // form submission vanilla js
    var form = document.getElementById("cta-form");
    var inputButton = document.getElementById("submit-button");

    async function handleSubmit(event) {
        event.preventDefault();
        event.stopPropagation();

        var success = document.getElementById("success-message");
        var error = document.getElementById("error-message");
        var content = document.getElementById("form-content");
        var data = new FormData(event.target);

        // validation
        var required_fields = ["first_name", "last_name", "email", "phone", "trial_type"];
        var error_fields = [];
        required_fields.forEach(function(field) {
            if (!data.get(field)) {
                error_fields.push(field);
            }
        });

        if (error_fields.length > 0) {
            error.style.display = "block";
            error.innerHTML = "Please fill out all required fields";
            error_fields.forEach(function(field) {
                document.getElementById(field + "_error").style.display = "block";
            });
            return;
        }

        fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                method: form.method,
                body: data,
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                error.style.display = "none";
                success.innerHTML = "Thanks for your submission!";
                success.style.display = "block";
                content.innerHTML = "";
                form.reset()
            })
            .catch(error => {
                error.innerHTML = "Oops! There was a problem submitting your form"
                error.style.display = "block";
            });
    }

    function watchForm() {
        var inputs = document.querySelectorAll("input, select");
        inputs.forEach(function(input) {
            input.addEventListener("change", function() {
                document.getElementById(input.name + "_error").style.display = "none";
            });
        });
    }

    form.addEventListener("submit", handleSubmit)
</script>


<?php if ($is_contact_page) : ?>
    <style type="text/css">
        .acf-map {
            width: 100%;
            height: 400px;
            border: #ccc solid 1px;
            margin: 20px 0;
        }

        .acf-map img {
            max-width: inherit !important;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMw3B4EQJb21NwEf19FmZEoSHqkSb7voo&callback=Function.prototype"></script>
    <script type="text/javascript">
        (function($) {

            /**
             * initMap
             *
             * Renders a Google Map onto the selected jQuery element
             *
             * @date    22/10/19
             * @since   5.8.6
             *
             * @param   jQuery $el The jQuery element.
             * @return  object The map instance.
             */
            function initMap($el) {

                // Find marker elements within map.
                var $markers = $el.find('.marker');

                // Create gerenic map.
                var mapArgs = {
                    zoom: $el.data('zoom') || 16,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map($el[0], mapArgs);

                // Add markers.
                map.markers = [];
                $markers.each(function() {
                    initMarker($(this), map);
                });

                // Center map based on markers.
                centerMap(map);

                // Return map instance.
                return map;
            }

            /**
             * initMarker
             *
             * Creates a marker for the given jQuery element and map.
             *
             * @date    22/10/19
             * @since   5.8.6
             *
             * @param   jQuery $el The jQuery element.
             * @param   object The map instance.
             * @return  object The marker instance.
             */
            function initMarker($marker, map) {

                // Get position from marker.
                var lat = $marker.data('lat');
                var lng = $marker.data('lng');
                var latLng = {
                    lat: parseFloat(lat),
                    lng: parseFloat(lng)
                };

                // Create marker instance.
                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map
                });

                // Append to reference for later use.
                map.markers.push(marker);

                // If marker contains HTML, add it to an infoWindow.
                if ($marker.html()) {

                    // Create info window.
                    var infowindow = new google.maps.InfoWindow({
                        content: $marker.html()
                    });

                    // Show info window when marker is clicked.
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, marker);
                    });
                }
            }

            /**
             * centerMap
             *
             * Centers the map showing all markers in view.
             *
             * @date    22/10/19
             * @since   5.8.6
             *
             * @param   object The map instance.
             * @return  void
             */
            function centerMap(map) {

                // Create map boundaries from all map markers.
                var bounds = new google.maps.LatLngBounds();
                map.markers.forEach(function(marker) {
                    bounds.extend({
                        lat: marker.position.lat(),
                        lng: marker.position.lng()
                    });
                });

                // Case: Single marker.
                if (map.markers.length == 1) {
                    map.setCenter(bounds.getCenter());

                    // Case: Multiple markers.
                } else {
                    map.fitBounds(bounds);
                }
            }

            // Render maps on page load.
            $(document).ready(function() {
                $('.acf-map').each(function() {
                    var map = initMap($(this));
                });
            });

        })(jQuery);
    </script>
<?php endif; ?>

</body>

</html>