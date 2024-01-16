// selecteer de postcode- en huisnummer-inputvelden
const postcodeInput = document.getElementById('zipcode');
const huisnummerInput = document.getElementById('huisnummer-input');

// voeg een event listener toe aan beide velden
postcodeInput.addEventListener('input', updateAdres);
huisnummerInput.addEventListener('input', updateAdres);

function updateAdres() {
    if (postcodeInput.value && huisnummerInput.value) {

        // haal de postcode en het huisnummer op uit de inputvelden
        const postcode = postcodeInput.value.replace(/\s+/, "");
        const huisnummer = huisnummerInput.value.replace(/\s+/, "");

        // stuur een AJAX-verzoek naar de server om de bijbehorende adresgegevens op te halen
        $.ajax({
            url: `http://api.postcodedata.nl/v1/postcode/?postcode=${postcode}&streetnumber=${huisnummer}&ref=ref`,
            type: 'GET',
            dataType: 'json',
            success: function (adres) {
                // bijwerken van de straat-input met de juiste adresgegevens
                const addressInput = document.getElementById('address');
                const cityInput = document.getElementById('city');

                if (!adres.details) {
                    addressInput.style.borderColor = "red"
                    addressInput.value = "";
                } else {
                    let address = adres.details[0]
                    addressInput.style.borderColor = "unset"
                    addressInput.value = address.street + ' ' + huisnummer + ', ' + postcode + ' ' + address.city;
                    cityInput.value = address.city;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(`Er is een fout opgetreden: ${textStatus}`);
            }

        });
    }
}


$(document).ready(function() {
    $(".slider").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        infinite: false,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1080,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
        ]
    });
    $(".prev-btn").click(function () {
        $(".slick-list").slick("slickPrev");
    });

    $(".next-btn").click(function () {
        $(".slick-list").slick("slickNext");
    });
    $(".prev-btn").addClass("slick-disabled");
    $(".slick-list").on("afterChange", function () {
        if ($(".slick-prev").hasClass("slick-disabled")) {
            $(".prev-btn").addClass("slick-disabled");
        } else {
            $(".prev-btn").removeClass("slick-disabled");
        }
        if ($(".slick-next").hasClass("slick-disabled")) {
            $(".next-btn").addClass("slick-disabled");
        } else {
            $(".next-btn").removeClass("slick-disabled");
        }
    });
});

