<script src="{{ url('public/assets/js/jquery.js') }}"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js'></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQEQBjOnVPuOGPRaOl61LMymvICijb8_c&libraries=places&callback=initMap"
    async defer></script>
<script src="{{ url('public/assets/js/custom.js') }}"></script>
<!---Map js --->

<!-- Autocomplete JS Start -->
<script>
   let sessionToken;
let newestRequestId = 0;

async function initMap() {
    try {
        await google.maps.importLibrary("places");
    } catch (e) {
        console.error("Google Maps library failed to load:", e);
        return;
    }

    const input = document.getElementById('autocomplete');
    const dropdown = document.getElementById('dropdown');

    if (!input || !dropdown) {
        console.warn("Autocomplete input or dropdown not found.");
        return;
    }

    refreshToken();

    // Hide dropdown if Edit mode with existing address
    if (input.value.trim() !== '') {
        dropdown.classList.remove('show');
    }

    input.addEventListener('input', async function (e) {
        const value = e.target.value;

        if (value.length < 2) {
            dropdown.innerHTML = '';
            dropdown.classList.remove('show');
            return;
        }

        const requestId = ++newestRequestId;
        const request = { input: value, sessionToken };

        try {
            const { suggestions } = await google.maps.places.AutocompleteSuggestion.fetchAutocompleteSuggestions(request);
            if (requestId !== newestRequestId) return;
            displaySuggestions(suggestions);
        } catch (error) {
            console.error('Autocomplete error:', error);
            dropdown.classList.remove('show');
        }
    });

    function displaySuggestions(suggestions) {
        dropdown.innerHTML = '';

        if (!suggestions || suggestions.length === 0) {
            dropdown.classList.remove('show');
            return;
        }

        suggestions.forEach(suggestion => {
            const placePrediction = suggestion.placePrediction;

            const item = document.createElement('div');
            item.className = 'autocomplete-item';
            item.textContent = placePrediction.text.toString();

            item.addEventListener('click', () => selectPlace(placePrediction.toPlace()));
            dropdown.appendChild(item);
        });

        dropdown.classList.add('show');
    }

    async function selectPlace(place) {
        try {
            await place.fetchFields({
                fields: ['addressComponents', 'formattedAddress', 'id', 'location']
            });

            input.value = place.formattedAddress;
            dropdown.classList.remove('show');

            const components = {};
            if (place.addressComponents) {
                place.addressComponents.forEach(component => {
                    component.types.forEach(type => {
                        components[type] = component;
                    });
                });
            }

            // Populate fields
            setValue('line1', [
                components['street_number']?.longText || '',
                components['route']?.longText || ''
            ].join(' ').trim());

            setValue('line2', '');
            setValue('city', components['locality']?.longText || components['sublocality']?.longText || '');
            setValue('state', components['administrative_area_level_1']?.longText || '');
            setValue('postal_code', components['postal_code']?.longText || '');
            setValue('country', components['country']?.longText || '');
            setValue('place_id', place.id || '');

            // Fill latitude & longitude
            if (place.location) {
                setValue('latitude', place.location.lat());
                setValue('longitude', place.location.lng());
            }

            refreshToken();
        } catch (error) {
            console.error('Error fetching place details:', error);
        }
    }

    function setValue(id, value) {
        const el = document.getElementById(id);
        if (el) el.value = value;
    }

    function refreshToken() {
        sessionToken = new google.maps.places.AutocompleteSessionToken();
    }

    document.addEventListener('click', function (e) {
        if (!input.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });
}

window.initMap = initMap;

</script>
<!--Api key copy -->
<script>
$(document).on('click', '.copy-api-key', function () {
    let apiKey = $(this).data('key'); // get from data-key attribute
    navigator.clipboard.writeText(apiKey).then(() => {
        alert('API Key copied to clipboard!');
    }).catch(err => {
        alert('Failed to copy: ' + err);
    });
});
$(document).on('click', '.copy-promocode', function () {
    let apiKey = $(this).data('key'); // get from data-key attribute
    navigator.clipboard.writeText(apiKey).then(() => {
        alert('Promo code copied to clipboard!');
    }).catch(err => {
        alert('Failed to copy: ' + err);
    });
});
</script>
</script>
<!-- Toggle script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('modeToggle');
    const label = document.getElementById('modeLabel');
    let prevMode = toggle.checked ? 1 : 0; // store initial state
    toggle.addEventListener('change', function () {
        let newMode = this.checked ? 1 : 0;
        let currentUrl = window.location.href;
        // ✅ Show popup only on specific routes
        if (
            currentUrl.includes("organisations-add") ||
            (/\/organisations-user-add\/\d+$/.test(currentUrl)) ||
            (/\/organisations-user-edit\/\d+$/.test(currentUrl)) ||
            (/\/organisations-edit\/\d+$/.test(currentUrl))
        ) {
            const modal = new bootstrap.Modal(document.getElementById('SwitchOrganaizationModal'));
            modal.show();
            toggle.checked = prevMode;
            document.querySelector('#SwitchOrganaizationModal .Confirm_Delete_Btn').onclick = function () {
                modal.hide();
                updateEnvironment(newMode);
            };
            document.querySelector('#SwitchOrganaizationModal .Cancle_outline_btn').onclick = function () {
                modal.hide();
                toggle.checked = prevMode;
            };
        } else {
            updateEnvironment(newMode);
        }
    });
    function updateEnvironment(mode) {
        fetch("{{ route('update.environment') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ environment: mode })
        })
        .then(response => response.json())
        .then(data => {
            label.textContent = data.mode.toUpperCase() + ' MODE';
            prevMode = mode;
            let currentUrl = window.location.href;
            let orgId = "{{ $Organisationdata->id ?? '' }}";
            if (currentUrl.includes("organisations-add")) {
                window.location.href = "{{ route('organisations') }}";
            }
            else if (/\/organisations-edit\/(\d+)$/.test(currentUrl)) {
                // Redirect back to organisations list after editing
                window.location.href = "{{ route('organisations') }}";
            }
            else if (/\/organisations-user-add\/(\d+)$/.test(currentUrl) && orgId) {
                // Redirect to organisation detail
                window.location.href = "{{ route('organisations.view', ['id' => $Organisationdata->id ?? 0]) }}";
            }
            else if (/\/organisations-user-edit\/(\d+)$/.test(currentUrl) && orgId) {
                // Redirect to organisation detail
               // alert(orgId);
                window.location.href = "{{ route('organisations') }}";
            }
            else {
                location.reload();
            }
        });
    }
});
</script>
