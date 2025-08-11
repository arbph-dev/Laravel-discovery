<!DOCTYPE html>
<html>
<head>
    <title>Conversion Carto</title>

    <style>
        label { display: block; margin-top: 10px; }
        #result { margin-top: 20px; padding: 10px; border: 1px solid #ccc; }
    </style>
</head>
<body>

<h2>Conversion DMS vers DD et Lambert93</h2>

<form id="cartoForm" method="POST" action="{{ route('carto.convert') }}">
    @csrf

    <label>Degrés: <input type="number" name="deg" required></label>
    <label>Minutes: <input type="number" name="min" required></label>
    <label>Secondes: <input type="number" name="sec" required></label>

    <label>Longitude (DD): <input type="text" name="lon" required></label>
    <label>Latitude (DD): <input type="text" name="lat" required></label>

    <button type="submit">Convertir</button>
</form>

<div id="result"></div>

<script>
document.getElementById('cartoForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    const response = await fetch(this.action, {
        method: 'POST',
        body: formData
    });

    const data = await response.json();

    document.getElementById('result').innerHTML = `
        <strong>Angle en degrés décimaux :</strong> ${data.dd}<br>
        <strong>Coordonnées Lambert93 :</strong> ${data.lambert}
    `;
});
</script>

</body>
</html>
