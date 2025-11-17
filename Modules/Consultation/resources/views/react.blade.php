<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consultation React Form</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    @viteReactRefresh
    @vite(['resources/js/app.jsx', 'Modules/Consultation/resources/assets/js/ConsultationForm.jsx'])
</head>
<body>
    <div id="consultation-react"></div>
</body>
</html>
