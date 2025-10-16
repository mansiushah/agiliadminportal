<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>New Google Place Autocomplete (2025)</title>
  <style>
    body {
      font-family: sans-serif;
      padding: 2rem;
    }
    gmpx-place-autocomplete {
      width: 100%;
      max-width: 500px;
      padding: 12px;
      background-color: white;
      border-radius: 8px;
      border: 1px solid #ccc;
      display: block;
      margin-bottom: 1rem;
    }
    pre {
      background: #f3f3f3;
      padding: 1rem;
      border-radius: 6px;
    }
  </style>
</head>
<body>

  <h2>Search Company Address</h2>

  <gmpx-place-autocomplete
    id="autocomplete"
    placeholder="Start typing address..."
    aria-label="Search address">
  </gmpx-place-autocomplete>

  <pre id="result">Place data will appear here...</pre>



  <!-- ✅ Load new PlaceAutocompleteElement -->
  <script
    type="module"
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_places.key') }}&modules=placeAutocomplete">
  </script>

  <!-- ✅ JS to handle gmpx-place-autocomplete -->
  <script type="module">
    const autocomplete = document.getElementById('autocomplete');

    autocomplete.addEventListener('gmpx-placechange', async (event) => {
      const place = event.target.value;

      // Extract Place ID
      const placeId = place.id;

      console.log('Selected Place ID:', placeId);

      // 🔄 Send placeId to Laravel
      const response = await fetch('/get-place-details', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ place_id: placeId })
      });

      const data = await response.json();
      document.getElementById('result').textContent = JSON.stringify(data, null, 2);
    });
  </script>

</body>
</html>
