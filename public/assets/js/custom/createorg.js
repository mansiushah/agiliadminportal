//state drop down hide show
document.addEventListener('DOMContentLoaded', function () {
    const countrySelect = document.getElementById('countrySelect');
    const usaStateGroup = document.getElementById('usaStateGroup');
    function toggleUsaStates() {
        const selectedOption = countrySelect.options[countrySelect.selectedIndex];
        const countryCode = selectedOption ? selectedOption.getAttribute('data-code') : '';
        if (countryCode === 'US' || countryCode === 'USA') {
            usaStateGroup.style.display = 'block';   // Show
        } else {
            usaStateGroup.style.display = 'none';    // Hide
            usaStateGroup.querySelector('select').value = ''; // Reset state
        }
    }
    // Initial check on page load
    toggleUsaStates();
    // Check again when the country changes
    countrySelect.addEventListener('change', toggleUsaStates);
});
/// Dyanmic VAT number code
$(document).ready(function () {
    const $countrySelect = $('#countrySelect');
    const baseTaxUrl = $countrySelect.data('tax-url');
    const $container = $('#vatFieldsContainer');

    function loadTaxFields(countryCode) {
        $container.empty();
        if (!countryCode) return;

        $.ajax({
            url: `${baseTaxUrl}/${countryCode}`,
            method: 'GET',
            success: function (response) {
                if (Array.isArray(response) && response.length > 0) {

                    // Loop through all VAT fields returned from backend
                    response.forEach(function (field, index) {
                        const label = field.display_name || 'Tax Registration Number';
                        const placeholder = field.placeholder || '';
                        const stripeTaxType = (field.stripe_tax_type || '').trim();

                        // 🔹 Find old or saved value (this block belongs right here)
                        let savedValue = '';

                        if (Array.isArray(window.oldTaxRegistrations) && window.oldTaxRegistrations.length > 0) {
                            const oldMatch = window.oldTaxRegistrations.find(
                                item => (item.stripe_tax_type || '').trim() === stripeTaxType
                            );
                            if (oldMatch) {
                                savedValue = oldMatch.tax_registration_number || '';
                            }
                        } else if (Array.isArray(window.savedTaxRegistrations) && window.savedTaxRegistrations.length > 0) {
                            const dbMatch = window.savedTaxRegistrations.find(
                                item => (item.stripe_tax_type || '').trim() === stripeTaxType
                            );
                            if (dbMatch) {
                                savedValue = dbMatch.tax_registration_number || '';
                            }
                        }

                        // 🔹 Build HTML
                        const taxFieldHtml = `
                            <div class="form-row add_user_form_row">
                                <div class="form-group col-md-12">
                                    <label for="tax_registration_number_${index}">${label} (optional)</label>
                                    <input type="text"
                                           class="form-control"
                                           id="tax_registration_number_${index}"
                                           name="tax_registration_number[]"
                                           placeholder="${placeholder}"
                                           value="${savedValue}">
                                    <input type="hidden"
                                           name="stripe_tax_type[]"
                                           value="${stripeTaxType}">
                                </div>
                            </div>`;
                        $container.append(taxFieldHtml);
                    });
                }
            }
        });
    }

    // 🔹 On country change
    $countrySelect.on('change', function () {
        const code = $(this).find(':selected').data('code');
        loadTaxFields(code);
    });

    // 🔹 Auto-trigger if editing or old country selected
    const selectedCountryCode = $countrySelect.find(':selected').data('code');
    if (selectedCountryCode) {
        loadTaxFields(selectedCountryCode);
    }
});
$(document).ready(function () {
    let selectedCurrencyId = "{{ $organisation->country_id ?? '' }}"; // from Laravel
    let selectedCountryCode = $('#countrySelect').find(':selected').data('code'); // already selected

    // Function to load currencies
    function loadCurrencies(country_code, preselected = null) {
        $('#currency').html('<option value="">Select Currency</option>');
        if (country_code) {
            $.ajax({
                //url: '/php/M-0402/Ad-Agilis/Ad-agilis-admin/get-currencies/' + country_code,
                url: '/get-currencies/' + country_code,
                type: 'GET',
                success: function (data) {
                    if (data.length > 0) {
                        $.each(data, function (index, currency) {
                            let isSelected = (preselected && preselected == currency.id) ? 'selected' : '';
                            $('#currency').append(
                                `<option value="${currency.id}" ${isSelected}>
                                    ${currency.currency} (${currency.symbol ?? ''})
                                </option>`
                            );
                        });
                    } else {
                        $('#currency').append('<option value="">No currency found</option>');
                    }
                }
            });
        }
    }

    // 🔄 Load currencies on country change
    $('#countrySelect').on('change', function () {
        let country_code = $(this).find(':selected').data('code');
        loadCurrencies(country_code);
    });

    // 🧠 Auto-load when editing (if country already selected)
    if (selectedCountryCode) {
        loadCurrencies(selectedCountryCode, selectedCurrencyId);
    }
});

/*$(document).ready(function() {
    $('#countrySelect').on('change', function() {
        let country_code =$(this).find(':selected').data('code');;
        $('#currency').html('<option value="">Select Currency</option>');
        console.log(country_code);
        if(country_code) {
            $.ajax({
                url: '/php/M-0402/Ad-Agilis/Ad-agilis-admin/get-currencies/' + country_code,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    if (data.length > 0) {
                        $.each(data, function(index, currency) {

                            $('#currency').append(
                               `<option value="${currency.id}">
                                    ${currency.currency} (${currency.symbol ?? ''})
                                </option>`
                            );
                        });
                    } else {
                        $('#currency').append('<option value="">No currency found</option>');
                    }
                }
            });
        }
    });
});*/
/*$(document).ready(function () {
    const baseTaxUrl = $('#countrySelect').data('tax-url');
    $('#countrySelect').on('change', function () {
        const countryCode = $(this).find(':selected').data('code');
        const container = $('#vatFieldsContainer');
        container.empty();
        if (!countryCode) return;
        $.ajax({
            url: baseTaxUrl + '/' + countryCode,
            method: 'GET',
            success: function (response) {
                if (Array.isArray(response) && response.length > 0) {
                    response.forEach(function (field, index) {
                        const label = field.display_name || 'Tax Registration Number';
                        const placeholder = field.placeholder || '';
                        const stripeTaxType = (field.stripe_tax_type || '').trim();
                        // Match saved value from DB
                        let savedValue = '';
                        if (window.savedTaxRegistrations && Array.isArray(window.savedTaxRegistrations)) {
                            const match = window.savedTaxRegistrations.find(
                                item => (item.stripe_tax_type || '').trim() === stripeTaxType
                            );
                            if (match) {
                                savedValue = match.tax_registration_number || '';
                            }
                        }
                        const taxFieldHtml = `
                          <div class="form-row add_user_form_row">
                            <div class="form-group col-md-12">
                              <label for="tax_registration_number_${index}">${label} (optional)</label>
                              <input type="text"
                                     class="form-control"
                                     id="tax_registration_number_${index}"
                                     name="tax_registration_number[]"
                                     placeholder="${placeholder}"
                                     value="${savedValue}">
                              <input type="hidden"
                                     name="stripe_tax_type[]"
                                     value="${stripeTaxType}">
                            </div>
                          </div>
                        `;
                        container.append(taxFieldHtml);
                    });
                }
            }
        });
    });
    // Only trigger change after savedTaxRegistrations is defined
    if (typeof window.savedTaxRegistrations !== 'undefined' && $('#countrySelect').val()) {
        $('#countrySelect').trigger('change');
    }
});*/
